package com.daw2.viajes.servlet.viaje;


import com.daw2.viajes.dao.ViajeClienteDao;
import com.daw2.viajes.dao.ViajeDao;
import com.daw2.viajes.dao.impl.ViajeClienteDaoImpl;
import com.daw2.viajes.dao.impl.ViajeDaoImpl;
import com.daw2.viajes.entity.Viaje;
import com.daw2.viajes.entity.ViajeCliente;
import jakarta.servlet.ServletException;
import jakarta.servlet.annotation.WebServlet;
import jakarta.servlet.http.HttpServlet;
import jakarta.servlet.http.HttpServletRequest;
import jakarta.servlet.http.HttpServletResponse;

import java.io.IOException;
import java.util.List;

@WebServlet(name = "listadoViajeServlet", value = "/viajes/listado")
public class ListadoViajeServlet extends HttpServlet {
    private List<Viaje> viajes;
    private ViajeDao viajeDao;

    private List<ViajeCliente> viajesClientes;
    private ViajeClienteDao viajeClienteDao;

    public void init() {
        viajeDao = new ViajeDaoImpl();
        viajeClienteDao = new ViajeClienteDaoImpl();
    }

    public void doGet(HttpServletRequest request, HttpServletResponse response) throws IOException, ServletException {
        String titulo = request.getParameter("titulo");
        String descripcion = request.getParameter("descripcion");


        List<ViajeCliente> viajesClientes = viajeClienteDao.findAll();
        request.setAttribute("viajesClientes", viajesClientes);

        // Obtener el empleadoId de la solicitud
        Long empleadoId = null;
        String empleadoIdParam = request.getParameter("empleadoId");
        if (empleadoIdParam != null && !empleadoIdParam.isEmpty()) {
            empleadoId = Long.parseLong(empleadoIdParam);
        }

        // Verificar si se proporcionó un empleadoId y obtener la lista de viajes correspondiente
        if (empleadoId != null) {
            viajes = viajeDao.findByEmpleadoId(empleadoId);
            request.setAttribute("viajes", viajes);
            request.getRequestDispatcher("/empleado/tabla_boton.jsp").forward(request, response);
        }else if (titulo != null && descripcion != null){
            viajes = viajeDao.findByTituloDescripcion(titulo, descripcion);
            request.setAttribute("viajes", viajes);
            request.getRequestDispatcher("/viaje/tabla_viaje.jsp").forward(request, response);
        } else if (titulo != null) {
            viajes = viajeDao.findByTitulo(titulo);
            request.setAttribute("viajes", viajes);
            request.getRequestDispatcher("/viaje/tabla_viaje.jsp").forward(request, response);
        }else if (descripcion != null) {
            viajes = viajeDao.findByDescripcion(descripcion);
            request.setAttribute("viajes", viajes);
            request.getRequestDispatcher("/viaje/tabla_viaje.jsp").forward(request, response);
        } else {
            viajes = viajeDao.findAll();
            request.setAttribute("viajes", viajes);
            request.getRequestDispatcher("/viaje/listado_viajes.jsp").forward(request, response);
        }



    }

    public void destroy() {
    }
}