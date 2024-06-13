import { Component, EventEmitter, Output } from '@angular/core';

@Component({
  selector: 'app-menu',
  templateUrl: './menu.component.html'
})
export class MenuComponent {
  
  @Output() onCerrarSesion : EventEmitter<any> = new EventEmitter();

  cerrarSesion() {
    this.onCerrarSesion.emit();
  }
}
