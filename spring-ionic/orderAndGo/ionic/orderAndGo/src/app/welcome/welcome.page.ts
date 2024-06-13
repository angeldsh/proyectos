import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { AutenticacionService } from '../auth/services/autenticacion.service';
import { AlertController, ModalController } from '@ionic/angular';
import { CodigoMesaModalComponent } from '../components/modal-codigo-mesa/codigo-mesa-modal';
import { TicketService } from '../services/tickets.service';
import { MenuService } from '../services/menu.service';


@Component({
  selector: 'app-welcome',
  templateUrl: './welcome.page.html',
  styleUrls: ['./welcome.page.scss'],
})

export class WelcomePage {

  constructor(private menuService: MenuService, private router: Router, private authService: AutenticacionService, private modalController: ModalController, private ticketService: TicketService
    , private alertController: AlertController

  ) { }




  setMenuLocal(): void {
    const menuLocal = [
      { title: 'Inicio', url: 'welcome', icon: 'home' },
      { title: 'Carta', url: 'carta', icon: 'restaurant' },
      { title: 'Mis pedidos', url: 'clientes/mis-pedidos', icon: 'archive' }
    ];

    this.menuService.setMenu(menuLocal);
  }
  setMenuDom(): void {
    const menuDomicilio = [
      { title: 'Inicio', url: 'welcome', icon: 'home' },
      { title: 'Carta a domicilio', url: 'carta-domicilio', icon: 'restaurant' },
      { title: 'Mis pedidos', url: 'clientes/mis-pedidos', icon: 'archive' },
      { title: 'Perfil', url: 'clientes/profile', icon: 'person' }
    ];

    this.menuService.setMenu(menuDomicilio);
  }
  async pedirEnLocal() {
    const modal = await this.modalController.create({
      component: CodigoMesaModalComponent,
      cssClass: 'codigo-mesa-modal'
    });

    modal.onDidDismiss().then((result) => {
      if (result && result.data) {
        const codigoMesa = result.data;
        this.ticketService.verificarCodigo(codigoMesa).subscribe(
          (response) => {
            if (response == true) {
              localStorage.setItem('codigoMesa', codigoMesa);
              this.setMenuLocal();
              this.router.navigate(['/carta']);
            } else {
              this.mostrarMensajeError('El código de acceso no es válido.');

            }
          },
          (error: any) => {
            this.mostrarMensajeError('Error al verificar código de acceso.');
          }
        );
      }
    });

    await modal.present();
  }


  async mostrarMensajeError(mensaje: string): Promise<void> {
    const alert = await this.alertController.create({
      header: 'Error',
      message: mensaje,
      buttons: ['OK']
    });
    await alert.present();
  }

  async pedirADomicilio() {
    localStorage.removeItem('codigoMesa');
    const sesionIniciada = await this.authService.isSesionIniciada().toPromise();
    if (!sesionIniciada) {
      this.router.navigate(['/auth/login']);

    } else {
      this.setMenuDom();
      this.router.navigate(['/carta-domicilio']);
    }
  }

}

