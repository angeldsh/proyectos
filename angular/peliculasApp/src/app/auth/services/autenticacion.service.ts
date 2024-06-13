import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable, map, of } from 'rxjs';
import { environment } from 'src/environments/environment';
import { LoginRequest, LoginResponse } from '../interfaces/auth.interface';
import { Router } from '@angular/router';

@Injectable({
  providedIn: 'root'
})
export class AutenticacionService {

  // URL Inicio de sesión
  private loginUrl: string = `${environment.peliculasBackendBaseUrl}/login`;

  // Token JWT que nos devuelve el servidor al iniciar sesión
  private jwtToken: string | null = null;


  constructor(
    private httpClient: HttpClient,
    private router: Router
  ) { }

  iniciarSesion(login: string, pass: string): Observable<boolean> {

    // Crea el objeto que contiene las credenciales
    const credenciales: LoginRequest = {
      email: login,
      password: pass
    }

    // Retorna un observable
    return this.httpClient.post<LoginResponse>(this.loginUrl, credenciales)
      .pipe(
        map((response) => {

          // Toma el token JWT y lo almacena
          this.jwtToken = response.accessToken;
          // Si estoy en este punto, devuelvo true.
          // Si hay error de autenticación lo debe gestionar el
          // cliente
          return true;
        })
      );
  }

  isSesionIniciada(): Observable<boolean> { // | boolean {

    // Si tengo el usuario inicializado es que tengo sesión
    // retorno un true
    if (this.jwtToken) {
      return of(true);
    } else {
      return of(false);
    }
  }

  getJwtToken(): string | null {
    return this.jwtToken;
  }

  cerrarSesion(): void {
    this.jwtToken = null;
    this.router.navigate(['/auth/login']);
  }
}
