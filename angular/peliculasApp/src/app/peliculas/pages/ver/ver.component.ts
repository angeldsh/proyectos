import { Component } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';

import { switchMap, tap } from 'rxjs';
import { Pelicula } from '../../interfaces/pelicula.interface';
import { PeliculasService } from '../../services/peliculas.service';

@Component({
  selector: 'app-ver',
  templateUrl: './ver.component.html'
})
export class VerComponent {

  pelicula!: Pelicula;

  //-------------------------------------------------------------------------------------
  // Inicialización
  //-------------------------------------------------------------------------------------

  constructor(

    private activatedRoute: ActivatedRoute,
    private router: Router,

    private peliculasService: PeliculasService

  ) { }

  /**
   * Inicialización de la página
   */
  ngOnInit(): void {

    // Carga la pelicula
    this.cargarPelicula();

  }


  //-------------------------------------------------------------------------------------
  // Funciones de persistencia. Permiten guardar y recuperar peliculas
  //-------------------------------------------------------------------------------------

  /**
   * Cuando estamos editando, este método carga la pelicula que estamos editando en el formulario
   */
  cargarPelicula() {

    // Si estamos en modo edición, obtiene los parámeros
    // y carga los datos
    this.activatedRoute.params

      // Usamos switchMap, que permite cambiar el id (el parámetro de entrada)
      // por la pelicula
      .pipe(

        switchMap(({ id }) => this.peliculasService.getPelicula(id)),

        // Este pipe muestra lo que viene
        tap(console.log)
      )
      // Finalmente, este subscribe recibe el resultado, que será el objeto
      .subscribe(pelicula => {

        // Carga los datos
        this.pelicula = pelicula;
      });
  }
}
