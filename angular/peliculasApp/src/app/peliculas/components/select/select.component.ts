import { Component, EventEmitter, Input, Output } from '@angular/core';
import { Genero } from '../../interfaces/genero.interface';

@Component({
  selector: 'app-select',
  templateUrl: './select.component.html'
})
export class SelectComponent {
  @Input() generos: Genero[] = [];
  @Output() generoSeleccionado: EventEmitter<string> = new EventEmitter<string>();


  seleccionarGenero(event: any) {
    const seleccionado = event.target.value;
    if (seleccionado) {
      this.generoSeleccionado.emit(seleccionado);
    }
  }

}
