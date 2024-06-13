package com.daw2.viajes.servlet.viajeCliente;

import com.daw2.viajes.dao.ViajeClienteDao;
import com.daw2.viajes.dao.impl.ViajeClienteDaoImpl;
import com.daw2.viajes.entity.ViajeCliente;
import jakarta.servlet.ServletException;
import jakarta.servlet.annotation.WebServlet;
import jakarta.servlet.http.HttpServlet;
import jakarta.servlet.http.HttpServletRequest;
import jakarta.servlet.http.HttpServletResponse;

import java.io.IOException;
import java.util.List;

@WebServlet(name = "verViajeClienteServlet", value = "/viajes-clientes/ver")
public class VerViajeClienteServlet extends HttpServlet {
    private List<ViajeCliente> viajesClientes;
    private ViajeClienteDao viajeClienteDao;

    public void init() {
        viajeClienteDao = new ViajeClienteDaoImpl();
    }

    public void doGet(HttpServletRequest request, HttpServletResponse response) throws IOException, ServletException {
        String id = request.getParameter("id").trim();

        ViajeCliente viajeCliente= null;
        try{
            long idVer = Long.parseLong(id);
            viajeCliente = viajeClienteDao.get(idVer);
        }catch (Exception ex){}
        request.setAttribute("viajeCliente", viajeCliente);
        viajesClientes = viajeClienteDao.findAll();
        request.setAttribute("viajesClientes", viajesClientes);
        request.getRequestDispatcher("/viajeCliente/ver.jsp").forward(request,response);

    }

    public void destroy() {
    }
}