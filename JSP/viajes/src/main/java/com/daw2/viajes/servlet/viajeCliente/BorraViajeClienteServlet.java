package com.daw2.viajes.servlet.viajeCliente;

import com.daw2.viajes.dao.ViajeClienteDao;

import com.daw2.viajes.dao.impl.ViajeClienteDaoImpl;
import com.daw2.viajes.entity.ViajeCliente;
import com.daw2.viajes.service.ViajeClienteService;
import jakarta.servlet.ServletException;
import jakarta.servlet.annotation.WebServlet;
import jakarta.servlet.http.HttpServlet;
import jakarta.servlet.http.HttpServletRequest;
import jakarta.servlet.http.HttpServletResponse;

import java.io.IOException;
import java.util.List;

@WebServlet(name = "borraViajeClienteServlet", value = "/viajes-clientes/borrar")
public class BorraViajeClienteServlet extends HttpServlet {
    private List<ViajeCliente> viajesClientes;
    private ViajeClienteDao viajeClienteDao;

    public void init() {
        viajeClienteDao = new ViajeClienteDaoImpl();
    }

    public void doGet(HttpServletRequest request, HttpServletResponse response) throws IOException, ServletException {
        String id = request.getParameter("id").trim();

        ViajeCliente viajeCliente= null;
        try{
            long idBorra = Long.parseLong(id);
            viajeCliente = viajeClienteDao.get(idBorra);
        }catch (Exception ex){}
        request.setAttribute("viajeCliente", viajeCliente);
        viajesClientes = viajeClienteDao.findAll();
        request.setAttribute("viajesClientes", viajesClientes);
        request.getRequestDispatcher("/viajeCliente/borra.jsp").forward(request,response);

    }
    public void doPost(HttpServletRequest request, HttpServletResponse response) throws IOException, ServletException {
        ViajeCliente viajeCliente = ViajeClienteService.formToEntity(request);
        long id = viajeCliente.getId();
        if(viajeClienteDao.delete(id)){
            request.setAttribute("mensaje", "Viaje Cliente eliminado correctamente");
            viajesClientes = viajeClienteDao.findAll();
        }else {
            request.setAttribute("mensaje", "Viaje Cliente no eliminado");
        }

        // Agrega la lista de encuestas como atributo
        request.setAttribute("viajesClientes", viajesClientes);


        request.getRequestDispatcher("/viajeCliente/listado.jsp").forward(request, response);
    }
    public void destroy() {
    }
}