import { Component } from '@angular/core';
import { AlertController } from '@ionic/angular';
import { TicketService } from 'src/app/services/tickets.service';

@Component({
  selector: 'app-ticket-create',
  templateUrl: './tickets.page.html',
  styleUrls: ['./tickets.page.scss'],
})
export class TicketCreatePage {
  mesaNum: string = "";

  constructor(private ticketService: TicketService, private alertController: AlertController) { }

  crearTicket() {
    const mesaIdNumber = Number(this.mesaNum);
    if (isNaN(mesaIdNumber)) {
      this.mostrarAlerta('Error', 'Por favor, ingrese un ID de mesa válido.');
      return;
    }

    this.ticketService.createTicket(mesaIdNumber).subscribe(
      (response: null) => {
        if (response == null) {
          this.mostrarAlerta('Error', 'Ocurrió un error al crear el ticket.');
          return;
        }
        this.mesaNum = "";
        this.mostrarAlerta('Ticket creado', 'Se ha creado un nuevo ticket correctamente.');
      },
      (error: any) => {
        this.mostrarAlerta('Error', 'Ocurrió un error al crear el ticket.');
      }
    );
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