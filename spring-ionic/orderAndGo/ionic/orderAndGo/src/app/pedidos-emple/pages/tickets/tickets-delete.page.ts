import { Component, OnInit } from '@angular/core';
import { AlertController } from '@ionic/angular';
import { TicketService } from 'src/app/services/tickets.service';

@Component({
  selector: 'app-ticket-delete',
  templateUrl: './tickets-delete.page.html',
})
export class TicketDeletePage implements OnInit {
  tickets: any[] = [];

  constructor(private ticketService: TicketService, private alertController: AlertController) { }

  ngOnInit() {
   
    this.ticketService.getOpenTickets();
    this.ticketService.tickets$.subscribe(
      tickets => this.tickets = tickets,
    );
  }

  async cerrarTicket(mesaNum: string) {
    const confirmacion = await this.mostrarConfirmacion();
    if (confirmacion) {
      const mesaIdNumber = Number(mesaNum);
      if (isNaN(mesaIdNumber)) {
        this.mostrarAlerta('Error', 'Por favor, ingrese un ID de mesa válido.');
        return;
      }
  
      this.ticketService.closeTicket(mesaIdNumber).subscribe(
        () => {
          this.mostrarAlerta('Éxito', 'Se ha cerrado el ticket correctamente.');
        },
        error => {
          console.error('Error:', error); 
  
          let errorMessage = 'Ocurrió un error al cerrar el ticket.';
          if (error.status === 400) {
            errorMessage = 'Mesa no encontrada o no hay tickets activos para esta mesa.';
          } else if (error.status === 409) {
            errorMessage = 'No se puede cerrar el ticket porque algunos pedidos asociados no están completados.';
          }
  
          this.mostrarAlerta('Error', errorMessage);
        }
      );
    }
  }
  
  
  
  async mostrarConfirmacion(): Promise<boolean> {
    return new Promise<boolean>((resolve) => {
      this.alertController.create({
        header: 'Confirmación',
        message: '¿Estás seguro de que quieres cerrar el ticket?',
        buttons: [
          {
            text: 'Cancelar',
            role: 'cancel',
            cssClass: 'secondary',
            handler: () => {
              resolve(false);
            }
          },
          {
            text: 'Aceptar',
            handler: () => {
              resolve(true);
            }
          }
        ]
      }).then(alert => alert.present());
    });
  }
  async mostrarAlerta(titulo: string, mensaje: string) {
    const alert = await this.alertController.create({
      header: titulo,
      message: mensaje,
      buttons: ['Aceptar']
    });
    await alert.present();
  }
}
