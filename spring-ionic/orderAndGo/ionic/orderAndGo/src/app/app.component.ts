import { Component, HostListener } from '@angular/core';
import { AutenticacionService } from './auth/services/autenticacion.service';
import { Router } from '@angular/router';
import { MenuService } from './services/menu.service';
import { RedirectService } from './services/redirect.service';
@Component({
  selector: 'app-root',
  templateUrl: 'app.component.html',
  styleUrls: ['app.component.scss'],
})
export class AppComponent {
  public appPages: any[] = [];
  constructor(public autenticacionService: AutenticacionService, private redirectService: RedirectService, private router: Router, private menuService: MenuService) {
  }
  ngOnInit(): void {
    this.menuService.appPages$.subscribe(menu => {
      this.appPages = menu;
    });
  }
  @HostListener('window:beforeunload', ['$event'])
  onBeforeUnload(event: any) {
    localStorage.removeItem('codigoMesa');
  }


  logout() {
    this.autenticacionService.cerrarSesion();
    localStorage.removeItem('codigoMesa');
    this.appPages = [];
    this.router.navigateByUrl('/auth/login');
  }
  isPedidoMesa(): boolean {
    return localStorage.getItem('codigoMesa') !== null;
  }
}
