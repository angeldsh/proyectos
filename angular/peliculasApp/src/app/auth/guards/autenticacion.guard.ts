import { CanActivateFn, Router } from '@angular/router';
import { tap } from 'rxjs';
import { AutenticacionService } from '../services/autenticacion.service';
import { inject } from '@angular/core';

export const autenticacionGuard: CanActivateFn = (route, state) => {

  // Router
  const router = inject(Router);

  // Servicio de autenticación  
  const autenticacionService = inject(AutenticacionService);

  // Devuelve si la sesión está iniciada
  return autenticacionService.isSesionIniciada()
    .pipe(
      tap(autenticado => {

        if (!autenticado) {
          router.navigate(['/auth/login']);
        }

        return autenticado;
      })
    );
};
