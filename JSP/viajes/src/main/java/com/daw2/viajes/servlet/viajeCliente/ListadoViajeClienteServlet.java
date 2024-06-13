package com.daw2.viajes.servlet.viajeCliente;


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

@WebServlet(name = "listadoViajeClienteServlet", value = "/viajes-clientes/listado")
public class ListadoViajeClienteServlet extends HttpServlet {
    private List<ViajeCliente> viajesClientes;


    private ViajeClienteDao viajeClienteDao;





    public void init() {
        viajeClienteDao = new ViajeClienteDaoImpl();

    }

    public void doGet(HttpServletRequest request, HttpServletResponse response) throws IOException, ServletException {

        // Obtener el empleadoId de la solicitud
        String viajeTitulo = request.getParameter("viajeTitulo");

        // Verificar si se proporcionó un viajeTitulo y obtener la lista de viajes correspondiente
        if (viajeTitulo == null || viajeTitulo.isEmpty()) {
            viajesClientes = viajeClienteDao.findAll();
            request.setAttribute("viajesClientes", viajesClientes);
            request.getRequestDispatcher("/viajeCliente/listado.jsp").forward(request, response);
        } else {
            viajesClientes = viajeClienteDao.findByTitulo(viajeTitulo);
            request.setAttribute("viajesClientes", viajesClientes);
            request.getRequestDispatcher("/viajeCliente/tabla.jsp").forward(request, response);
        }

    }


    public void destroy() {
    }
}