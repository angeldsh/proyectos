import { Component } from '@angular/core';
import { PeliculasService } from 'src/app/peliculas/services/peliculas.service';

@Component({
  selector: 'app-estadisticas-genero',
  templateUrl: './estadisticas-genero.component.html',
})
export class EstadisticasGeneroComponent {

  // Define la variable que va a almacenar los puntos en el gráfico
  dataPoints: any[] = [];

  // Puntero a la gráfica
  chart: any;

  // Opciones del gráfico 
  chartOptions: any = {};

  constructor(

    private peliculasService: PeliculasService

  ) { }

  ngAfterViewInit(): void {

    // Carga los datos del gráfico
    this.peliculasService.getPeliculas().subscribe(peliculas => {

      // Crea un mapa con los puntos
      const puntos = new Map();

      // Para cada pelicula
      for (let pelicula of peliculas) {

        const punto = puntos.get(pelicula.genero);
        if (punto) {
          punto.y++;
        } else {
          puntos.set(
            pelicula.genero,
            {
              name: pelicula.genero,
              y: 1
            }
          );
        }
      }

      // Añade los puntos en el Map al array
      puntos.forEach(punto => this.dataPoints.push(punto));

      // Si no asigna aquí las opciones
      // no se refresca el gráfico
      this.chartOptions = {
        exportEnabled: false,
        animationEnabled: true,
        title: {
          text: "Películas por géneros"
        },
        legend: {
          horizontalAlign: "right",
          verticalAlign: "center"
        },
        data: [{
          type: "pie",
          showInLegend: true,
          toolTipContent: "<b>{name}</b>: ${y} (#percent%)",
          indexLabel: "{name}",
          legendText: "{name} (#percent%)",
          indexLabelPlacement: "outside",
          dataPoints: this.dataPoints
        }]
      };
    });
  }
}
