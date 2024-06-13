import { Component, Input, OnInit, AfterViewInit, OnDestroy } from '@angular/core';
import { AlertController, ModalController } from '@ionic/angular';
import { MesaModalPage } from '../edit/modal-mesas'; 
import { Mesa } from 'src/app/interfaces/mesa.interface';
import { MesasService } from 'src/app/services/mesas.service';
import * as $ from 'jquery';
import 'datatables.net';
import * as Spanish from 'src/assets/spanish.json';

@Component({
  selector: 'app-tabla',
  templateUrl: './tabla.component.html',
  styleUrls: ['./tabla.component.scss'],
})
export class TablaComponent implements OnInit, AfterViewInit, OnDestroy {
  @Input() mesas: Mesa[] = [];
  private dataTable: any;

  constructor(
    private modalController: ModalController,
    private mesasService: MesasService,
    private alertController: AlertController
  ) { }

  ngOnInit(): void {
    this.mesas = [];
    this.loadMesas();
  }

  ngAfterViewInit(): void {
    this.initializeDataTable();
  }

  ngOnDestroy(): void {
    if (this.dataTable) {
      this.dataTable.destroy();
    }
  }

  loadMesas(): void {
    this.mesasService.getMesas().subscribe(
      mesas => {
        this.mesas = mesas || [];
        this.updateDataTable();
      }
    );
  }

  initializeDataTable(): void {
    $(document).ready(() => {
      this.dataTable = $('#tablaMesas').DataTable({
        data: this.mesas,
        columns: [
          { data: 'id' },
          { data: 'numero' },
          {
            data: null, orderable: false, render: (data, type, row) => {
              return `
            <button class="btn btn-primary btn-sm me-2 editar-mesa" data-id="${data.id}">
              <ion-icon name="create"></ion-icon>
            </button>
            <button class="btn btn-danger btn-sm eliminar-mesa" data-id="${data.id}">
              <ion-icon name="trash"></ion-icon>
            </button>
            `;
            }
          }
        ],
        language: Spanish
      });

      $('#tablaMesas tbody').off('click', '.editar-mesa');
      $('#tablaMesas tbody').on('click', '.editar-mesa', (event) => {
        const id = $(event.currentTarget).data('id');
        const mesa = this.mesas.find(m => m.id === id);
        if (mesa) {
          this.editarMesa(mesa);
        }
      });

      $('#tablaMesas tbody').off('click', '.eliminar-mesa');
      $('#tablaMesas tbody').on('click', '.eliminar-mesa', (event) => {
        const id = $(event.currentTarget).data('id');
        const mesa = this.mesas.find(m => m.id === id);
        if (mesa) {
          this.eliminarMesa(mesa);
        }
      });
    });
  }

  updateDataTable(): void {
    if (this.dataTable) {
      this.dataTable.clear();
      this.dataTable.rows.add(this.mesas);
      this.dataTable.draw();
    }
  }

  async editarMesa(mesa: Mesa) {
    const modal = await this.modalController.create({
      component: MesaModalPage,
      componentProps: { mesa }
    });

    await modal.present();
    const { data } = await modal.onWillDismiss();

    if (data && data.mesa) {
      const mesaActualizada = data.mesa;
      const index = this.mesas.findIndex(m => m.id === mesaActualizada.id);

      if (index !== -1) {
        this.mesas[index] = mesaActualizada;
      } else {
        this.mesas.push(mesaActualizada);
      }
      this.updateDataTable();
    }
  }

  async eliminarMesa(mesa: Mesa) {
    if (mesa.id) {
      const confirmacion = await this.mostrarConfirmacion();
      if (confirmacion) {
        this.mesasService.eliminarMesa(mesa.id).subscribe(
          () => {
            this.mesas = this.mesas.filter(m => m.id !== mesa.id);
            this.updateDataTable();
          },
          (error: any) => {
            this.mostrarMensajeError();
          }
        );
      }
    }
  }
  async mostrarConfirmacion(): Promise<boolean> {
    return new Promise<boolean>((resolve) => {
      this.alertController.create({
        header: 'Confirmación',
        message: '¿Estás seguro de que quieres eliminar esta mesa?',
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

  async mostrarMensajeError() {
    const alert = await this.alertController.create({
      header: 'Error',
      message: 'Hubo un error al eliminar la mesa.',
      buttons: ['OK']
    });
    await alert.present();
  }
}
