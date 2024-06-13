import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { MenuComponent } from './components/menu/menu.component';
import { FormsModule } from '@angular/forms';
import { RouterModule } from '@angular/router';
import { FiltroBusquedaComponent } from './components/filtro-busqueda/filtro-busqueda.component';



@NgModule({
  declarations: [
   
    MenuComponent,
    FiltroBusquedaComponent
    
  ],  
  imports: [
    CommonModule,
    FormsModule,
    RouterModule
  ],
  exports: [
    MenuComponent,
    FiltroBusquedaComponent
  ]
})
export class SharedModule { }
