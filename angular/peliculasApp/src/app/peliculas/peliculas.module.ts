import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { PeliculasRoutingModule } from './peliculas-routing.module';
import { ListadoComponent } from './pages/listado/listado.component';
import { EditarComponent } from './pages/editar/editar.component';
import { VerComponent } from './pages/ver/ver.component';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { SharedModule } from '../shared/shared.module';
import { HTTP_INTERCEPTORS, HttpClientModule } from '@angular/common/http';
import { TablaPeliculasComponent } from './components/tabla-peliculas/tabla-peliculas.component';
import { AlfabeticoComponent } from './pages/alfabetico/alfabetico.component';
import { GeneroComponent } from './pages/genero/genero.component';
import { LetrasComponent } from './components/letras/letras.component';
import { SelectComponent } from './components/select/select.component';
import { NgxPaginationModule } from 'ngx-pagination';



@NgModule({
  declarations: [
    ListadoComponent,
    EditarComponent,
    VerComponent,
    TablaPeliculasComponent,
    AlfabeticoComponent,
    GeneroComponent,
    LetrasComponent,
    SelectComponent,
  ],
  imports: [
    CommonModule,
    FormsModule,
    HttpClientModule,
    PeliculasRoutingModule,
    SharedModule,
    ReactiveFormsModule,
    NgxPaginationModule
  ],

})
export class PeliculasModule { }
