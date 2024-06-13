import { Injectable } from '@angular/core';
import { AbstractControl, FormControl, ValidationErrors } from '@angular/forms';

@Injectable({
  providedIn: 'root'
})
export class ValidacionService {

  constructor() { }

  //VALIDACIONES DE CAMPOS

  private mensajesError:any = {
    noEmpiezaMayuscula: 'El campo debe empezar por mayúscula',
    required: 'El campo es obligatorio',
    iguales: 'Los campos no pueden ser iguales',
    noEsNumero: 'El campo debe ser un número',
    noEstaSeparadoPorComas: 'Los nombres deben estar separados por comas'
  }

  getMensajeError(error: string) : string {
  return this.mensajesError[error];
  }
  registrarMensajeError(clave: string, valor: string) {
    this.mensajesError[clave] = valor;
  }


  validarEmpiezaMayuscula(control: FormControl) : ValidationErrors | null {
      
    // Obtiene el valor en el control
    const inicial :string = control.value?.trim()[0];     
 
    // Si el valor no pasa la validación, tenemos problemas
    if(inicial && inicial != inicial.toUpperCase()) {
      
      // Rengo que devolver un objeto con el error
      return {
        // El atributo indica la validación que no se ha pasado
        // Los campos tendrán estos errores por lo que se puede mostrar un mensaje
        noEmpiezaMayuscula: true
      }
    }

    // Null implica que todo OK. Nada que notificar
    return null;
  }
  validarNumero(control: FormControl) : ValidationErrors | null {
        
      //Obtener valor
      const valor = control.value?.trim();
      //Comprobar que no sea vacio y que sea un numero
      if(valor && isNaN(valor)) {
        return {
          noEsNumero: true
        }
      }
      return null;
      
    }
    validarComas(control: FormControl) : ValidationErrors | null {

      if (control.value) {
        const nombres = control.value.split(",");
        for (let i = 0; i < nombres.length; i++) {
          const nombre = nombres[i].trim();
      
          if (nombre.length === 0) {
            return{
              noEstaSeparadoPorComas: true
            };
          }
        }
      }
      return null;
    }

  //VALIDACIONES DE FORMULARIO
  camposNoIguales(campo1: string, campo2: string) {
    
    // Retorna una función que trata el formgroup que va a hacer las comprobaciones
    return ( formGroup : AbstractControl): ValidationErrors | null => {

      const valor1 = formGroup.get(campo1)?.value;
      const valor2 = formGroup.get(campo2)?.value;

      if(valor1 == valor2) {

        // Defino el error
        const error = {
          iguales: true
        }
        // Establece el error en el segundo campo que se ha comparado
        // Esto es importante para que se pueda mostrar el error correctamente en la vista
        formGroup.get(campo2)?.setErrors(error);

        // Retorna el error
        return error;
      }
      //He eliminado el else porque borraba los errores de otras validaciones
      return null;
    }
  }

}
