import { Component, EventEmitter, Input, Output } from '@angular/core';
import { Pelicula } from '../../interfaces/pelicula.interface';

@Component({
  selector: 'app-tabla-peliculas',
  templateUrl: './tabla-peliculas.component.html'
})
export class TablaPeliculasComponent {
  page: number = 1;

  /**
   * Esto es el array de peliculas que se va a renderizar
   */
  @Input() peliculas: Pelicula[] = [];

  /**
   * Evento que se va a emitir desde este componente cuando se quiera 
   * borrar una pelicula
   */
  @Output() onBorrar: EventEmitter<number> = new EventEmitter();

  constructor() { }

  /**
   * Para borrar peliculas se pasa el índice dentro de la tabla de peliculas.
   * Más que nada porque luego se evita tener que recorrer la tabla para hacer la eliminación
   * 
   * @param indice 
   */
  borrarPelicula(indice: number): void {
    this.onBorrar.emit(indice);
  }
}
