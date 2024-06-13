import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { AutenticacionService } from '../../services/autenticacion.service';
import { MenuService } from 'src/app/services/menu.service';
import { Usuario } from 'src/app/interfaces/usuario.interface';
import { SolicitarRestablecimientoComponent } from 'src/app/components/renew-password/solicitar-codigo/solicitar-restablecimiento.component';
import { RestablecerContrasenaComponent } from 'src/app/components/renew-password/restablecer-password/restablecer-contrasena.component';
import { ModalController } from '@ionic/angular';
import { ClientesSignUpPage } from 'src/app/components/clientes/sign-up/sign-up';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export class LoginComponent {
  credenciales = {

    username: '',
    password: ''

  };

  errorInicioSesion: boolean = false;



  constructor(

    private router: Router,
    private autenticacionService: AutenticacionService,
    private menuService: MenuService,
    private modalController: ModalController
  ) { }

  ngOnInit(): void {
  }
  setMenuDom(roles: string[]): void {
    let menuDomicilio: any[] = [];
    if (roles.includes('ROLE_EMPLEADO')) {
      menuDomicilio = [

        { title: 'Inicio', url: 'welcome', icon: 'home' },

        { title: 'Carta', url: 'carta', icon: 'restaurant' },

        { title: 'Pedidos', url: 'pedidos-emple', icon: 'archive' },

        { title: 'Registros', url: 'registro', icon: 'folder-open' },

        { title: 'Gestionar tickets', url: 'tickets', icon: 'ticket' }


      ];
    } else if (roles.includes('ROLE_ADMIN')) {
      menuDomicilio = [
        { title: 'Clientes', url: '/clientes/listado', icon: 'people' },
        { title: 'Empleados', url: '/empleados/listado', icon: 'briefcase' },
        { title: 'Productos', url: '/productos/listado', icon: 'pizza' },
        { title: 'Categorías', url: '/categorias/listado', icon: 'list' },
        { title: 'Mesas', url: '/mesas/listado', icon: 'tablet-landscape' }


      ];

    } else {
      menuDomicilio = [
        { title: 'Inicio', url: 'welcome', icon: 'home' },
        { title: 'Carta a domicilio', url: 'carta-domicilio', icon: 'restaurant' },
        { title: 'Mis pedidos', url: 'clientes/mis-pedidos', icon: 'archive' },
        { title: 'Perfil', url: 'clientes/profile', icon: 'person' }
      ];
    }


    this.menuService.setMenu(menuDomicilio);
  }


  login() {
    this.autenticacionService.iniciarSesion(this.credenciales).subscribe({
      next: (autenticado: boolean) => {
        if (autenticado) {
          this.autenticacionService.obtenerUsuario().subscribe({
            next: (usuario: Usuario | undefined) => {
              if (usuario && usuario.roles && Array.isArray(usuario.roles)) {
                let roles: string[] = usuario.roles.map(role => role.name);
                this.setMenuDom(roles);
                localStorage.removeItem('codigoMesa');
                if (roles.includes('ROLE_ADMIN')) {
                  this.router.navigate(['/clientes/listado']);
                } else if (roles.includes('ROLE_EMPLEADO')) {
                  this.router.navigate(['/pedidos-emple']);
                } else {
                  this.router.navigate(['/carta-domicilio']);
                }
              } else {
                this.errorInicioSesion = true;
              }
            },
            error: (error: any) => {
              this.errorInicioSesion = true;
            }
          });
        } else {
          this.errorInicioSesion = true;
        }
      },
      error: (error: any) => {
        this.errorInicioSesion = true;
      }
    });
  }

  async openSolicitarRestablecimiento() {
    const modal = await this.modalController.create({
      component: SolicitarRestablecimientoComponent
    });
    modal.onDidDismiss().then((result) => {
      if (result.data && result.data.success) {
        this.openRestablecerContrasena();
      }
    });
    return await modal.present();

  }

  async openRestablecerContrasena() {
    const modal = await this.modalController.create({
      component: RestablecerContrasenaComponent
    });
    return await modal.present();
  }
  async openModalCliente() {
    const modal = await this.modalController.create({
      component: ClientesSignUpPage
    });
    return await modal.present();
  }
}





