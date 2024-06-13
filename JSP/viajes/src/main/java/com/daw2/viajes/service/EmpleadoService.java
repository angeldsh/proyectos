package com.daw2.viajes.service;

import com.daw2.viajes.entity.Empleado;
import jakarta.servlet.http.HttpServletRequest;

public class EmpleadoService {
    public static Empleado formToEntity(HttpServletRequest request){
        Long id = null;
        try{
            id = Long.parseLong(request.getParameter("id").trim());
        }catch (Exception ex){}
        String nif = request.getParameter("nif").trim();
        String nombre = request.getParameter("nombre").trim();
        String apellido1 = request.getParameter("apellido1").trim();
        String apellido2 = request.getParameter("apellido2").trim();
        String email = request.getParameter("email").trim();

        Empleado empleado = new Empleado();
        empleado.setId(id);
        empleado.setNif(nif);
        empleado.setNombre(nombre);
        empleado.setApellido1(apellido1);
        empleado.setApellido2(apellido2);
        empleado.setEmail(email);

        return empleado;
    }
}
