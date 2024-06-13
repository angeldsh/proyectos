import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { ListadoComponent } from './pages/listado/listado.component';
import { EditarComponent } from './pages/editar/editar.component';
import { VerComponent } from './pages/ver/ver.component';
import { AlfabeticoComponent } from './pages/alfabetico/alfabetico.component';
import { GeneroComponent } from './pages/genero/genero.component';

const routes: Routes = [
  {
    path: 'listado',
    component: ListadoComponent
  },
  {
    path: 'genero',
    component: GeneroComponent
  },
  {
    path: 'alfabetico',
    component: AlfabeticoComponent
  },
  {
    path: 'agregar',
    component: EditarComponent
  },
  {
    path: 'editar/:id',
    component: EditarComponent
  },
  {
    path: ':id',
    component: VerComponent
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class PeliculasRoutingModule { }
