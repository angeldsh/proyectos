import { Component, Input, OnInit, AfterViewInit, OnDestroy } from '@angular/core';
import { AlertController, ModalController } from '@ionic/angular';
import { EmpleadoModalPage } from '../edit/modal-empleado';
import { Empleado } from 'src/app/interfaces/empleado.interface';
import { EmpleadosService } from 'src/app/services/empleados.service';
import * as $ from 'jquery';
import 'datatables.net';
import * as Spanish from 'src/assets/spanish.json';


@Component({
  selector: 'app-tabla',
  templateUrl: './tabla.component.html',
  styleUrls: ['./tabla.component.scss'],
})
export class TablaComponent implements OnInit, AfterViewInit, OnDestroy {
  @Input() empleados: Empleado[] = [];
  private dataTable: any;

  constructor(
    private modalController: ModalController,
    private empleadosService: EmpleadosService,
    private alertController: AlertController
  ) {}

  ngOnInit(): void {
    this.empleados = [];
    this.loadEmpleados();
  }

  ngAfterViewInit(): void {
    this.initializeDataTable();
  }

  ngOnDestroy(): void {
    if (this.dataTable) {
      this.dataTable.destroy();
    }
  }

  loadEmpleados(): void {
    this.empleadosService.getEmpleados().subscribe(
      empleados => {
        this.empleados = empleados || [];
        this.updateDataTable();
      }
    );
  }

  initializeDataTable(): void {
    $(document).ready(() => {
      this.dataTable = $('#tablaEmpleados').DataTable({
        data: this.empleados,
        columns: [
          { data: 'nif' },
          { data: 'telefono' },
          { data: 'usuario.username' },
          { data: null, orderable: false, render: (data, type, row) => {
            return `
              <button class="btn btn-primary btn-sm me-2 editar-empleado" data-id="${data.id}">
                <ion-icon name="create"></ion-icon>
              </button>
              <button class="btn btn-danger btn-sm eliminar-empleado" data-id="${data.id}">
                <ion-icon name="trash"></ion-icon>
              </button>
            `;
          }}
        ],
        language: Spanish
      });

      $('#tablaEmpleados tbody').off('click', '.editar-empleado');
      $('#tablaEmpleados tbody').on('click', '.editar-empleado', (event) => {
        const id = $(event.currentTarget).data('id');
        const empleado = this.empleados.find(e => e.id === id);
        if (empleado) {
          this.editarEmpleado(empleado);
        }
      });

      $('#tablaEmpleados tbody').off('click', '.eliminar-empleado');
      $('#tablaEmpleados tbody').on('click', '.eliminar-empleado', (event) => {
        const id = $(event.currentTarget).data('id');
        const empleado = this.empleados.find(e => e.id === id);
        if (empleado) {
          this.eliminarEmpleado(empleado);
        }
      });
    });
  }

  updateDataTable(): void {
    if (this.dataTable) {
      this.dataTable.clear();
      this.dataTable.rows.add(this.empleados);
      this.dataTable.draw();
    }
  }

  async editarEmpleado(empleado: Empleado) {
    const modal = await this.modalController.create({
      component: EmpleadoModalPage,
      componentProps: { empleado }
    });

    await modal.present();
    const { data } = await modal.onWillDismiss();

    if (data && data.empleado) {
      const empleadoActualizado = data.empleado;
      const index = this.empleados.findIndex(e => e.id === empleadoActualizado.id);

      if (index !== -1) {
        this.empleados[index] = empleadoActualizado;
      } else {
        this.empleados.push(empleadoActualizado);
      }
      this.updateDataTable(); 
    }
  }

  async eliminarEmpleado(empleado: Empleado) {
    if (empleado.id) {
      const confirmacion = await this.mostrarConfirmacion();
      if (confirmacion) {
        this.empleadosService.eliminarEmpleado(empleado.id).subscribe(
          () => {
            this.empleados = this.empleados.filter(e => e.id !== empleado.id);
            this.updateDataTable();
          },
          (error: any) => {
            if (error && error.status === 400 && error.error === 'Empleado tiene datos asociados') {
              this.mostrarMensajeDatosAsociados();
            } else {
              this.mostrarMensajeError();
            }
          }
        );
      }
    }
  }
  
  async mostrarConfirmacion(): Promise<boolean> {
    return new Promise<boolean>((resolve) => {
      this.alertController.create({
        header: 'Confirmación',
        message: '¿Estás seguro de que quieres eliminar este empleado?',
        buttons: [
          {
            text: 'Cancelar',
            role: 'cancel',
            cssClass: 'secondary',
            handler: () => {
              resolve(false);
            }
          },
          {
            text: 'Aceptar',
            handler: () => {
              resolve(true);
            }
          }
        ]
      }).then(alert => alert.present());
    });
  }
  
  async mostrarMensajeDatosAsociados() {
    const alert = await this.alertController.create({
      header: 'Error',
      message: 'El empleado tiene datos asociados y no puede ser eliminado.',
      buttons: ['OK']
    });
    await alert.present();
  }
  
  async mostrarMensajeError() {
    const alert = await this.alertController.create({
      header: 'Error',
      message: 'Hubo un error al eliminar el empleado.',
      buttons: ['OK']
    });
    await alert.present();
  }
}
