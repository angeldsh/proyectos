package com.daw2.proyecto.auth.services;

public interface RenovarPasswordService {
    void solicitarRestablecimientoDeContrasena(String email);

    void cambiarContrasena(String token, String nuevaContrasena);


}
