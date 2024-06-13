package com.daw2.viajes.service;

import com.daw2.viajes.dao.EmpleadoDao;
import com.daw2.viajes.dao.impl.EmpleadoDaoImpl;
import com.daw2.viajes.entity.Empleado;
import com.daw2.viajes.entity.Viaje;
import jakarta.servlet.http.HttpServletRequest;

import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.Date;


public class ViajeService {
    private static EmpleadoDao empleadoDao = new EmpleadoDaoImpl();
    public static Viaje formToEntity(HttpServletRequest request) {

        Long id = null;
        try{
            id = Long.parseLong(request.getParameter("id").trim());
        }catch (Exception ex){}
        String codigo = request.getParameter("codigo").trim();
        String titulo = request.getParameter("titulo").trim();
        String descripcion = request.getParameter("descripcion").trim();
        String numParticipantesStr = request.getParameter("numParticipantes");
        String salidaStr = request.getParameter("salida").trim();
        String llegadaStr = request.getParameter("llegada").trim();
        String precioStr = request.getParameter("precio").trim();


        Integer numParticipantes = null;
        Date salida = null;
        Date llegada = null;
        Double precio = null;
        SimpleDateFormat dateFormat = new SimpleDateFormat("yyyy-MM-dd");
        // Convertimos de String a Date y de String a double
        try {
            numParticipantes = Integer.parseInt(numParticipantesStr);
            salida = dateFormat.parse(salidaStr);
            llegada = dateFormat.parse(llegadaStr);
            precio = Double.parseDouble(precioStr);
        } catch (ParseException | NumberFormatException e) {
            e.printStackTrace();
        }

        Long empleadoId = null;
        Empleado empleado = null;
        try {
            empleadoId = Long.parseLong(request.getParameter("empleado").trim());
            if (empleadoId != null) {
                empleado = empleadoDao.get(empleadoId);
            }
        } catch (Exception ex) {
            ex.printStackTrace();
        }


        Viaje viaje = new Viaje();
        viaje.setId(id);
        viaje.setCodigo(codigo);
        viaje.setTitulo(titulo);
        viaje.setEmpleado(empleado);
        viaje.setDescripcion(descripcion);
        viaje.setNumParticipantes(numParticipantes);
        viaje.setSalida(salida);
        viaje.setLlegada(llegada);
        viaje.setPrecio(precio);
        return viaje;
    }
}
