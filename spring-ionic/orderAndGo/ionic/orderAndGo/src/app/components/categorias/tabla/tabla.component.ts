import { Component, Input, OnInit, AfterViewInit, OnDestroy } from '@angular/core';
import { AlertController, ModalController } from '@ionic/angular';
import { CategoriaModalPage } from '../edit/modal-categoria';
import { Categoria } from 'src/app/interfaces/categoria.interface';
import { CategoriasService } from 'src/app/services/categorias.service';
import * as $ from 'jquery';
import 'datatables.net';
import * as Spanish from 'src/assets/spanish.json';


@Component({
  selector: 'app-tabla',
  templateUrl: './tabla.component.html',
  styleUrls: ['./tabla.component.scss'],
})
export class TablaComponent implements OnInit, AfterViewInit, OnDestroy {
  @Input() categorias: Categoria[] = [];
  private dataTable: any;

  constructor(
    private modalController: ModalController,
    private categoriasService: CategoriasService,
    private alertController: AlertController
  ) { }

  ngOnInit(): void {
    this.categorias = []; 
    this.loadCategorias();
  }

  ngAfterViewInit(): void {
    this.initializeDataTable();
  }

  ngOnDestroy(): void {
    if (this.dataTable) {
      this.dataTable.destroy();
    }
  }

  loadCategorias(): void {
    this.categoriasService.getCategorias().subscribe(
      categorias => {
        this.categorias = categorias || []; 
        this.updateDataTable();
      }
    );
  }

  initializeDataTable(): void {
    $(document).ready(() => {
      this.dataTable = $('#tablaCategorias').DataTable({
        data: this.categorias,
        columns: [
          { data: 'id' },
          { data: 'nombre' },
          {
            data: null, orderable: false, render: (data, type, row) => {
              return `
            <button class="btn btn-primary btn-sm me-2 editar-categoria" data-id="${data.id}">
              <ion-icon name="create"></ion-icon>
            </button>
            <button class="btn btn-danger btn-sm eliminar-categoria" data-id="${data.id}">
              <ion-icon name="trash"></ion-icon>
            </button>
            `;
            }
          }
        ],
        language: Spanish
      });

      $('#tablaCategorias tbody').off('click', '.editar-categoria');
      $('#tablaCategorias tbody').on('click', '.editar-categoria', (event) => {
        const id = $(event.currentTarget).data('id');
        const categoria = this.categorias.find(c => c.id === id);
        if (categoria) {
          this.editarCategoria(categoria);
        }
      });

      $('#tablaCategorias tbody').off('click', '.eliminar-categoria');
      $('#tablaCategorias tbody').on('click', '.eliminar-categoria', (event) => {
        const id = $(event.currentTarget).data('id');
        const categoria = this.categorias.find(c => c.id === id);
        if (categoria) {
          this.eliminarCategoria(categoria);
        }
      });
    });
  }

  updateDataTable(): void {
    if (this.dataTable) {
      this.dataTable.clear();
      this.dataTable.rows.add(this.categorias);
      this.dataTable.draw();
    }
  }

  async editarCategoria(categoria: Categoria) {
    const modal = await this.modalController.create({
      component: CategoriaModalPage,
      componentProps: { categoria }
    });

    await modal.present();
    const { data } = await modal.onWillDismiss();

    if (data && data.categoria) {
      const categoriaActualizada = data.categoria;
      const index = this.categorias.findIndex(c => c.id === categoriaActualizada.id);

      if (index !== -1) {
        this.categorias[index] = categoriaActualizada;
      } else {
        this.categorias.push(categoriaActualizada);
      }
      this.updateDataTable();
    }
  }
  async eliminarCategoria(categoria: Categoria) {
    if (categoria.id) {
      const confirmacion = await this.mostrarConfirmacion();
      if (confirmacion) {
        this.categoriasService.eliminarCategoria(categoria.id).subscribe(
          () => {
            this.categorias = this.categorias.filter(c => c.id !== categoria.id);
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
        message: '¿Estás seguro de que quieres eliminar esta categoría?',
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
      message: 'Hubo un error al eliminar la categoría.',
      buttons: ['OK']
    });
    await alert.present();
  }
}
