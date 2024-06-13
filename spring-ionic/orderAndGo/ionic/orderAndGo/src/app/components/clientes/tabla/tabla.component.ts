import { Component, Input } from '@angular/core';
import { Cliente } from 'src/app/interfaces/cliente.interface';
import { AlertController, ModalController } from '@ionic/angular';
import { ClientesService } from 'src/app/services/clientes.service';
import { ClienteModalPage } from '../edit/modal-cliente';
import * as Spanish from 'src/assets/spanish.json';


@Component({
  selector: 'app-tabla',
  templateUrl: './tabla.component.html',
  styleUrls: ['./tabla.component.scss'],
})
export class TablaComponent {

  @Input() clientes: Cliente[] = [];
  private dataTable: any;

  constructor(private modalController: ModalController, private clientesService: ClientesService, private alertController: AlertController) {}

  ngOnInit(): void {
    this.loadClientes(); 
  }

  ngOnDestroy(): void {
    if (this.dataTable) {
      this.dataTable.destroy();
    }
  }

  loadClientes(): void {
    this.clientesService.getClientes().subscribe(
      clientes => {
        this.clientes = clientes;
        this.initializeDataTable(); 
      }
    );
  }

  initializeDataTable(): void {
    $(document).ready(() => {
      this.dataTable = $('#tablaClientes').DataTable({
        data: this.clientes,
        columns: [
          { data: 'nif' },
          { data: 'telefono' },
          { data: 'usuario.username' },
          {
            data: null,
            orderable: false,
            render: (data, type, row) => `
              <button class="btn btn-primary btn-sm me-2 editar-cliente" data-id="${data.id}">
                <ion-icon name="create"></ion-icon>
              </button>
              <button class="btn btn-danger btn-sm eliminar-cliente" data-id="${data.id}">
                <ion-icon name="trash"></ion-icon>
              </button>
            `
          }
        ],
        language: Spanish
      });

      $('#tablaClientes').on('click', '.editar-cliente', (event) => {
        const id = $(event.currentTarget).data('id');
        const cliente = this.clientes.find(c => c.id === id);
        if (cliente) {
          this.editarCliente(cliente);
        }
      });

      $('#tablaClientes').on('click', '.eliminar-cliente', (event) => {
        const id = $(event.currentTarget).data('id');
        const cliente = this.clientes.find(c => c.id === id);
        if (cliente) {
          this.eliminarCliente(cliente);
        }
      });
    });
  }

  updateDataTable(): void {
    if (this.dataTable) {
      this.dataTable.clear();
      this.dataTable.rows.add(this.clientes);
      this.dataTable.draw();
    }
  }

  async editarCliente(cliente: Cliente) {
    const modal = await this.modalController.create({
      component: ClienteModalPage,
      componentProps: { cliente }
    });

    await modal.present();
    const { data } = await modal.onWillDismiss();

    if (data && data.cliente) {
      const clienteActualizado = data.cliente;
      const index = this.clientes.findIndex(c => c.id === clienteActualizado.id);

      if (index !== -1) {
        this.clientes[index] = clienteActualizado;
      } else {
        this.clientes.push(clienteActualizado);
      }
      this.updateDataTable();
    }
  }

  async eliminarCliente(cliente: Cliente) {
    if (cliente.id) {
      const confirmacion = await this.mostrarConfirmacion();
      if (confirmacion) {
        this.clientesService.eliminarCliente(cliente.id).subscribe(
          () => {
            this.clientes = this.clientes.filter(c => c.id !== cliente.id);
            this.updateDataTable();
          },
          (error: any) => {
            if (error && error.status === 400 && error.error === 'Cliente tiene datos asociados') {
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
        message: '¿Estás seguro de que quieres eliminar este cliente?',
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
      message: 'El cliente tiene datos asociados y no puede ser eliminado.',
      buttons: ['OK']
    });
    await alert.present();
  }
  
  async mostrarMensajeError() {
    const alert = await this.alertController.create({
      header: 'Error',
      message: 'Hubo un error al eliminar el cliente.',
      buttons: ['OK']
    });
    await alert.present();
  }
}