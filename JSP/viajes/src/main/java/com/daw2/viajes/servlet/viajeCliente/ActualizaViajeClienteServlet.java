package com.daw2.viajes.servlet.viajeCliente;

import com.daw2.viajes.dao.ClienteDao;
import com.daw2.viajes.dao.ViajeClienteDao;
import com.daw2.viajes.dao.ViajeDao;
import com.daw2.viajes.dao.impl.ClienteDaoImpl;
import com.daw2.viajes.dao.impl.ViajeClienteDaoImpl;
import com.daw2.viajes.dao.impl.ViajeDaoImpl;
import com.daw2.viajes.entity.Cliente;
import com.daw2.viajes.entity.Viaje;
import com.daw2.viajes.entity.ViajeCliente;
import com.daw2.viajes.service.ViajeClienteService;
import jakarta.servlet.ServletException;
import jakarta.servlet.annotation.WebServlet;
import jakarta.servlet.http.HttpServlet;
import jakarta.servlet.http.HttpServletRequest;
import jakarta.servlet.http.HttpServletResponse;

import java.io.IOException;
import java.util.List;

@WebServlet(name = "actualizaViajeClienteServlet", value = "/viajes-clientes/actualizar")
public class ActualizaViajeClienteServlet extends HttpServlet {
    private List<ViajeCliente> viajesClientes;
    private ViajeDao viajeDao;
    private ClienteDao clienteDao; // Agrega el DAO de empleados
    private ViajeClienteDao viajeClienteDao;

    public void init() {
        viajeDao = new ViajeDaoImpl();
        clienteDao = new ClienteDaoImpl();
        viajeClienteDao = new ViajeClienteDaoImpl();
    }

    public void doGet(HttpServletRequest request, HttpServletResponse response) throws IOException, ServletException {
        String id = request.getParameter("id").trim();

        List<Cliente> clientes = clienteDao.findAll();
        request.setAttribute("clientes", clientes);

        List<Viaje> viajes = viajeDao.findAll();
        request.setAttribute("viajes", viajes);

        ViajeCliente viajeCliente= null;
        try{
            long idActualiza = Long.parseLong(id);
            viajeCliente = viajeClienteDao.get(idActualiza);
        }catch (Exception ex){}
        request.setAttribute("viajeCliente", viajeCliente);
        viajesClientes = viajeClienteDao.findAll();
        request.setAttribute("viajesClientes", viajesClientes);
        request.getRequestDispatcher("/viajeCliente/actualiza.jsp").forward(request,response);

    }
    public void doPost(HttpServletRequest request, HttpServletResponse response) throws IOException, ServletException {
        ViajeCliente viajeCliente = ViajeClienteService.formToEntity(request);

        if(viajeClienteDao.update(viajeCliente)){
            request.setAttribute("mensaje", "Viaje Cliente actualizado correctamente");
            viajesClientes = viajeClienteDao.findAll();
        }else {
            request.setAttribute("mensaje", "Viaje cliente no actualizado");
        }

        // Agrega la lista de encuestas como atributo
        request.setAttribute("viajesClientes", viajesClientes);


        request.getRequestDispatcher("/viajeCliente/listado.jsp").forward(request, response);
    }
    public void destroy() {
    }
}