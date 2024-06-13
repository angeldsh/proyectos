import { Component } from '@angular/core';

import { DialogService } from 'src/app/shared/services/dialog.service';
import { PeliculasService } from '../../services/peliculas.service';
import { Pelicula } from '../../interfaces/pelicula.interface';

@Component({
  selector: 'app-listado',
  templateUrl: './listado.component.html'
})
export class ListadoComponent {

  // Lista de Peliculas representados en la tabla
  peliculas: Pelicula[] = [];

  //------------------------------------------------------------------
  // Inicialización
  //------------------------------------------------------------------
  constructor(
    private peliculasService: PeliculasService,
    private dialogService: DialogService
  ) { }

  ngOnInit(): void {
    // Carga la lista de Peliculas
    this.cargarPeliculas();
  }

  //------------------------------------------------------------------
  // Gestores de eventos
  //------------------------------------------------------------------

  /**
    *  Método a invocar para lanzar la búsqueda 
    */
  buscar(termino: string): void {

    // Aquí se hace la búsqueda por el término de búsqueda
    this.cargarPeliculas(termino);
  }

  /**
   * Borrar pelicula que recibe el evento. El evento de la tabla de Peliculas emite el ID en la tabla
   * 
   * @param indice 
   */
  borrarPelicula(indice: number) {

    // Obtiene la pelicula a eliminar
    const pelicula = this.peliculas[indice];

    // Si el usuario me confirma que quiere eliminar la pelicula, la elimina
    this.dialogService.solicitarConfirmacion(`¿Está seguro de que quiere eliminar la pelicula: ${pelicula.titulo}?`, 'Atención',
      () => {

        // Elimina la pelicula
        this.peliculasService.borrarPelicula(pelicula).subscribe((peliculaEliminada) => {

          // Muestra un objeto vacío, ya que el servidor no devuelve nada.
          console.log(peliculaEliminada);

          // Elimina la pelicula del array
          this.peliculas.splice(indice, 1);
        });
      }
    );
  }

  //------------------------------------------------------------------
  // Carga de datos
  //------------------------------------------------------------------

  /**
   * Pasado el término, carga los Peliculas.
   * 
   * @param termino 
   */
  cargarPeliculas(termino: string = ''): void {

    // Llama a cargar los Peliculas desde el servicio
    this.peliculasService.getPeliculas(termino)
      .subscribe(
        peliculas => this.peliculas = peliculas
      );
  }

  cargarPeliculasDesc(): void {
    this.peliculasService.getPeliculasDesc()
      .subscribe(
        peliculas => this.peliculas = peliculas
      );
  }
}
