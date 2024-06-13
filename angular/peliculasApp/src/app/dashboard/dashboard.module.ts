import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import * as CanvasJSAngularChart from '../../lib/canvasjs.angular.component';
import { DashboardRoutingModule } from './dashboard-routing.module';
import { DashboardComponent } from './pages/dashboard/dashboard.component';
import { PeliculasModule } from '../peliculas/peliculas.module';
import { EstadisticasGeneroComponent } from './components/estadisticas-genero/estadisticas-genero.component';
var CanvasJSChart = CanvasJSAngularChart.CanvasJSChart;



@NgModule({
  declarations: [
    CanvasJSChart,
    DashboardComponent,
    EstadisticasGeneroComponent
  ],
  imports: [
    PeliculasModule,
    CommonModule,
    DashboardRoutingModule
  ]
})
export class DashboardModule { }
