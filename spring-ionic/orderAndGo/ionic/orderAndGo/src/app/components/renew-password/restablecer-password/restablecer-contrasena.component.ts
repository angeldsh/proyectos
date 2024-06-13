import { Component } from '@angular/core';
import { AlertController, ModalController } from '@ionic/angular';
import { AutenticacionService } from 'src/app/auth/services/autenticacion.service';

@Component({
  selector: 'app-restablecer-contrasena',
  templateUrl: './restablecer-contrasena.component.html',
  styleUrls: ['./restablecer-contrasena.component.scss']
})
export class RestablecerContrasenaComponent {
  codigo: string = '';
  newPassword: string = '';
  confirmPassword: string = '';

  constructor(private modalController: ModalController, private authService: AutenticacionService, private alertController: AlertController) { }

  dismiss() {
    this.modalController.dismiss();
  }

  restablecerContrasena() {
    const regex = /^(?=.*[A-Z])(?=.*[0-9]).{8,}$/;
    if (!regex.test(this.newPassword)) {
      this.mostrarMensajeError('La contraseña debe tener al menos 8 caracteres, una mayúscula y un número');
      return;
    }

    if (this.newPassword !== this.confirmPassword) {
      this.mostrarMensajeError('Las contraseñas no coinciden');
      return;
    }

    this.authService.cambiarPassword(this.codigo, this.newPassword).subscribe(
      () => {
        this.mostrarMensajeExito('Contraseña restablecida con éxito');
        this.dismiss();
      },
      () => {
        this.mostrarMensajeError('Error al restablecer la contraseña');
      }
    );
  }
  async mostrarMensajeError(mensaje: string): Promise<void> {
    const alert = await this.alertController.create({
      header: 'Error',
      message: mensaje,
      buttons: ['OK']
    });
    await alert.present();
  }
  async mostrarMensajeExito(mensaje: string): Promise<void> {
    const alert = await this.alertController.create({
      header: 'Éxito',
      message: mensaje,
      buttons: ['OK']
    });
    await alert.present();
  }
}

