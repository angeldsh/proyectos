import { Component } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { DialogService } from 'src/app/shared/services/dialog.service';
import { switchMap, tap } from 'rxjs';
import { ValidacionService } from 'src/app/shared/services/validacion.service';
import { PeliculasService } from '../../services/peliculas.service';
import { Pelicula } from '../../interfaces/pelicula.interface';
import { Genero } from '../../interfaces/genero.interface';
import { ValidacionTituloService } from '../../validators/validacion-titulo.service';


@Component({
  selector: 'app-editar',
  templateUrl: './editar.component.html'
})
export class EditarComponent {
  generos: Genero[] = [];

  // Defino el formulario
  // En esta definición incluyo
  // - Nombres de los campos. Deben coincidir con los del objeto
  // - Opciones de los campos
  // - Validaciones locales
  // - Validaciones asíncronas
  formulario: FormGroup = this.fb.group({
    id: [-1],

    titulo: ['',
      [Validators.required, this.validacionService.validarEmpiezaMayuscula],
      //Desactivar si el id es diferente a -1
      [this.validacionTituloService]
    ],

    director: [
      '',
      [Validators.required, this.validacionService.validarEmpiezaMayuscula
      ],

    ],
    edad: [
      '',
      [Validators.required, this.validacionService.validarNumero]
    ],
    genero: [
      '',
      [Validators.required]
    ],
    fechaEstreno: [
      '',
      [Validators.required]
    ],
    duracion: [
      '',
      [Validators.required, this.validacionService.validarNumero]
    ],
    reparto: [
      '',
      [Validators.required, this.validacionService.validarComas]
    ],
    sinopsis: [
      '',
      [Validators.required]
    ],

  }, {
    // 008 Este segundo argumento que puedo enviar al formgroup permite por ejemplo ejecutar
    // validadores sincronos y asíncronos. Son validaciones al formgroup
    //La validacion de director de arriba no se hace en este caso pasa directamente a esta obviando la de arriba
    validators: [this.validacionService.camposNoIguales('titulo', 'director')]

  });


  actualizando: boolean = false;

  //-------------------------------------------------------------------------------------
  // Inicialización
  //-------------------------------------------------------------------------------------

  constructor(

    private activatedRoute: ActivatedRoute,
    private fb: FormBuilder,
    private router: Router,

    private dialogService: DialogService,

    private peliculasService: PeliculasService,

    private validacionService: ValidacionService,


    private validacionTituloService: ValidacionTituloService


  ) { }

  /**
   * Inicialización de la página
   */
  ngOnInit(): void {

    // Si no estamos en modo edición, sale de aquí
    if (this.router.url.includes('editar')) {
      this.cargarPelicula();
      this.actualizando = true;

      // Se carga la validación asíncrona en caso de edición
      // TODO arreglar par que funcione guardar nombre que existe
    }
    this.cargarGeneros();

  }
  cargarGeneros(): void {
    this.peliculasService.getGeneros()
      .subscribe(
        generos => this.generos = generos
      );
  }

  //-------------------------------------------------------------------------------------
  // Funciones generales del formulario
  //-------------------------------------------------------------------------------------
  /**
   * Guarda los cambios y vuelve a la pantalla anterior. 
   */
  guardar() {

    // Si el formulario no es válido, muestra un mensaje de error y termina
    if (this.formulario.invalid) {

      // Marco los campos como tocados. De ese modo se mostrarán todos los errores
      // registrados en los campos
      this.formulario.markAllAsTouched();

      // Muestro mensaje de error
      this.dialogService.mostrarMensaje('Por favor, revise los datos');

      // Finaliza
      return;
    }

    // Si id_pelicula es > 0 significa que la pelicula ya existía. Es actualización
    if (this.formulario.get('id')?.value > 0) {

      // Actualiza la pelicula
      this.actualizarPelicula();

    } else {

      // Crea la pelicula
      this.crearPelicula();
    }
  }

  /**
   * Comprueba si un campo es válido
   * @param campo 
   * @returns 
   */
  esCampoNoValido(campo: string): boolean | undefined {
    return this.formulario.get(campo)?.invalid && this.formulario.get(campo)?.touched;
  }
  /**
   * Devuelve mensaje de error de un campo
   * @param campo 
   * @returns 
   */
  mensajeErrorCampo(campo: string): string {
    const errors = this.formulario.get(campo)?.errors;
    let mensajeError = '';
    if (errors) {
      // EL for in recorre los atributos de un objeto y el for of los elementos de un array
      for (let e in errors) {
        const mensaje = this.validacionService.getMensajeError(e);
        mensajeError += mensajeError + mensaje;
        break;
      }
    }
    return mensajeError;
  }



  //-------------------------------------------------------------------------------------
  // Funciones de persistencia. Permiten guardar y recuperar peliculas
  //-------------------------------------------------------------------------------------

  /**
   * Crea una pelicula partir de los datos en el form y pasa a modo edición
   */
  crearPelicula() {
    //El getRawValue devuelve un objeto de los valores en crudo, sin parsear o formatear
    this.peliculasService.agregarPelicula(this.formulario.getRawValue()).subscribe(
      {
        // Se ejecuta cuando se recibe una respuesta exitosa del servidor.
        next: (pelicula: Pelicula) => {

          // Se ha guardado la pelicula. Redirige a la página de edición
          this.router.navigate(['/peliculas/listado']);

          // Muestro un toast indicando que se ha guardado la pelicula
          this.dialogService.mostrarToast("Pelicula creada");

          // Muestra la pelicula en el log
          console.log(pelicula);
        },

        // El observer ha recibido una notificación completa
        complete: () => {
        },

        // El observer ha recibido un error
        error: (error) => {

          this.dialogService.mostrarMensaje('No ha sido posible crear la pelicula: ' + error, 'ERROR');
          console.log(error);
        }
      }
    );
  }

  /**
   * Crea una pelicula partir de los datos en el form y pasa a modo edición
   */
  actualizarPelicula() {
    //El getRawValue devuelve un objeto de los valores en crudo, sin parsear o formatear
    this.peliculasService.actualizarPelicula(this.formulario.getRawValue()).subscribe(
      {
        // Se ejecuta cuando se recibe una respuesta exitosa del servidor.
        next: (pelicula: Pelicula) => {
          this.router.navigate(['/peliculas/listado']);
        },

        // El observer ha recibido una notificación completa
        complete: () => {
          this.dialogService.mostrarToast("Pelicula actualizada");

        },

        // El observer ha recibido un error
        error: (error) => {

          this.dialogService.mostrarMensaje('No ha sido posible crear la pelicula: ' + error, 'ERROR');
          console.log(error);
        }
      }
    );
  }


  cargarPelicula() {
    this.activatedRoute.params
      .pipe(
        switchMap(({ id }) => this.peliculasService.getPelicula(id)),
        tap(console.log)
      )
      .subscribe({
        next: (pelicula: Pelicula) => {
          this.formulario.reset(pelicula);
          if (pelicula.id != -1) {
            //Eliminar validaciones de TitulosIguales
            this.formulario.get('titulo')?.clearValidators();
            this.formulario.get('titulo')?.clearAsyncValidators();
            this.formulario.get('titulo')?.updateValueAndValidity();
          }
        },
        error: (error) => {
          this.router.navigate(['/peliculas/listado']);

          this.dialogService.mostrarMensaje('No ha sido posible cargar la pelicula: ' + error, 'ERROR');

          console.log(error);
        }
      })
  }

}
