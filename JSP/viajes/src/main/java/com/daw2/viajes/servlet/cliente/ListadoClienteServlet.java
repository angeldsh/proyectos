package com.daw2.viajes.servlet.cliente;

import com.daw2.viajes.dao.ClienteDao;
import com.daw2.viajes.dao.ViajeClienteDao;
import com.daw2.viajes.dao.impl.ClienteDaoImpl;
import com.daw2.viajes.dao.impl.ViajeClienteDaoImpl;
import com.daw2.viajes.entity.Cliente;
import com.daw2.viajes.entity.ViajeCliente;
import jakarta.servlet.ServletException;
import jakarta.servlet.annotation.WebServlet;
import jakarta.servlet.http.HttpServlet;
import jakarta.servlet.http.HttpServletRequest;
import jakarta.servlet.http.HttpServletResponse;

import java.io.IOException;
import java.util.List;

@WebServlet(name = "listadoClienteServlet", value = "/clientes/listado")
public class ListadoClienteServlet extends HttpServlet {
    private List<Cliente> clientes;
    private ClienteDao clienteDao;
    private List<ViajeCliente> viajesClientes;


    private ViajeClienteDao viajeClienteDao;

    public void init() {
        clienteDao = new ClienteDaoImpl();
        viajeClienteDao = new ViajeClienteDaoImpl();
    }

    public void doGet(HttpServletRequest request, HttpServletResponse response) throws IOException, ServletException {

        // Obtener el empleadoId de la solicitud
        Long clienteId = null;
        String clienteIdParam = request.getParameter("clienteId");
        if (clienteIdParam != null && !clienteIdParam.isEmpty()) {
            clienteId = Long.parseLong(clienteIdParam);
        }

        // Verificar si se proporcionó un empleadoId y obtener la lista de viajes correspondiente
        if (clienteId == null) {
            clientes = clienteDao.findAll();
            request.setAttribute("clientes", clientes);
            request.getRequestDispatcher("/cliente/listado_clientes.jsp").forward(request,response);
        } else {
            viajesClientes = viajeClienteDao.findByClienteId(clienteId);
            request.setAttribute("viajesClientes", viajesClientes);
            request.getRequestDispatcher("/cliente/tabla_boton.jsp").forward(request, response);
        }

    }

    public void destroy() {
    }
}