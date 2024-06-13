import { Component, Input, OnInit, AfterViewInit, OnDestroy } from '@angular/core';
import { AlertController, ModalController } from '@ionic/angular';
import { ProductoModalPage } from '../edit/modal-producto';
import { Producto } from 'src/app/interfaces/producto.interface';
import { ProductosService } from 'src/app/services/productos.service';
import * as $ from 'jquery';
import 'datatables.net';
import * as Spanish from 'src/assets/spanish.json';


@Component({
  selector: 'app-tabla',
  templateUrl: './tabla.component.html',
  styleUrls: ['./tabla.component.scss'],
})
export class TablaAdmComponent implements OnInit, AfterViewInit, OnDestroy {
  @Input() productos: Producto[] = [];
  private dataTable: any;

  constructor(
    private modalController: ModalController,
    private productosService: ProductosService,
    private alertController: AlertController
  ) { }

  ngOnInit(): void {
    this.loadProductos();
  }

  ngAfterViewInit(): void {
    this.initializeDataTable();
  }

  ngOnDestroy(): void {
    if (this.dataTable) {
      this.dataTable.destroy();
    }
  }

  loadProductos(): void {
    this.productosService.getProductos().subscribe(
      productos => {
        this.productos = productos;
        this.updateDataTable();
      }
    );
  }

  initializeDataTable(): void {
    $(document).ready(() => {
      this.dataTable = $('#tablaProductos').DataTable({
        data: this.productos,
        columns: [
          { data: 'nombre' },
          { data: 'categoria.nombre' },
          { data: 'precio', render: function (data) { return data + '€'; } },
          {
            data: null, orderable: false, render: (data, type, row) => {
              return `
              <button class="btn btn-primary btn-sm me-2 editar-producto" data-id="${data.id}">
                <ion-icon name="create"></ion-icon>
              </button>
              <button class="btn btn-danger btn-sm eliminar-producto" data-id="${data.id}">
                <ion-icon name="trash"></ion-icon>
              </button>
            `;
            }
          }
        ],
        language: Spanish
      });

      $('#tablaProductos tbody').off('click', '.editar-producto');
      $('#tablaProductos tbody').on('click', '.editar-producto', (event) => {
        const id = $(event.currentTarget).data('id');
        const producto = this.productos.find(p => p.id === id);
        if (producto) {
          this.editarProducto(producto);
        }
      });

      $('#tablaProductos tbody').off('click', '.eliminar-producto');
      $('#tablaProductos tbody').on('click', '.eliminar-producto', (event) => {
        const id = $(event.currentTarget).data('id');
        const producto = this.productos.find(p => p.id === id);
        if (producto) {
          this.eliminarProducto(producto);
        }
      });
    });
  }

  updateDataTable(): void {
    if (this.dataTable) {
      this.dataTable.destroy();
    }
    this.initializeDataTable();
  }

  async editarProducto(producto: Producto) {
    const modal = await this.modalController.create({
      component: ProductoModalPage,
      componentProps: { producto }
    });

    await modal.present();
    const { data } = await modal.onWillDismiss();

    if (data && data.producto) {
      const productoActualizado = data.producto;
      const index = this.productos.findIndex(p => p.id === productoActualizado.id);

      if (index !== -1) {
        this.productos[index] = productoActualizado;
      } else {
        this.productos.push(productoActualizado);
      }
      this.updateDataTable();
    }
  }

  async eliminarProducto(producto: Producto) {
    if (producto.id) {
      const confirmacion = await this.mostrarConfirmacion();
      if (confirmacion) {
        this.productosService.eliminarProducto(producto.id).subscribe(
          () => {
            this.productos = this.productos.filter(p => p.id !== producto.id);
            this.updateDataTable(); 
          },
          (error: any) => {
            this.mostrarMensajeError();
          }
        );
      }
    } else {
    }
  }

  async mostrarConfirmacion(): Promise<boolean> {
    return new Promise<boolean>((resolve) => {
      this.alertController.create({
        header: 'Confirmación',
        message: '¿Estás seguro de que quieres eliminar este producto?',
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
      message: 'Hubo un error al eliminar el producto.',
      buttons: ['OK']
    });
    await alert.present();
  }
}
