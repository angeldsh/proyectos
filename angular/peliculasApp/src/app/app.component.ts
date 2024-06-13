import { Component } from '@angular/core';
import { AutenticacionService } from './auth/services/autenticacion.service';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  constructor(
    private autenticacionService: AutenticacionService
  ) { }
  title = 'peliculasApp';
  ejecutarCerrarSesion() {
    this.autenticacionService.cerrarSesion();
    console.log('Cerrando sesión');
  }
}
