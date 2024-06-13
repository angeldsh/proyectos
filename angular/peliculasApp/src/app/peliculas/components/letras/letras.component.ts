import { Component, EventEmitter, Output } from '@angular/core';

@Component({
  selector: 'app-letras',
  templateUrl: './letras.component.html'
})
export class LetrasComponent {
  @Output() letraSeleccionada = new EventEmitter<string>();

  letras = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];

  onSeleccionarLetra(letra: string): void {
    this.letraSeleccionada.emit(letra);
  }
}
