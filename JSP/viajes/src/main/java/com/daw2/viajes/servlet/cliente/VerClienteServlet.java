package com.daw2.viajes.servlet.cliente;

import com.daw2.viajes.dao.ClienteDao;
import com.daw2.viajes.dao.impl.ClienteDaoImpl;
import com.daw2.viajes.entity.Cliente;
import jakarta.servlet.ServletException;
import jakarta.servlet.annotation.WebServlet;
import jakarta.servlet.http.HttpServlet;
import jakarta.servlet.http.HttpServletRequest;
import jakarta.servlet.http.HttpServletResponse;

import java.io.IOException;
import java.util.List;

@WebServlet(name = "verClienteServlet", value = "/clientes/ver")
public class VerClienteServlet extends HttpServlet {
    private List<Cliente> clientes;
    private ClienteDao clienteDao;

    public void init() {
        clienteDao = new ClienteDaoImpl();
    }

    public void doGet(HttpServletRequest request, HttpServletResponse response) throws IOException, ServletException {
        String id = request.getParameter("id").trim();

        Cliente cliente= null;
        try{
            long idVer = Long.parseLong(id);
            cliente = clienteDao.get(idVer);
        }catch (Exception ex){}
        request.setAttribute("cliente", cliente);
        clientes = clienteDao.findAll();
        request.setAttribute("clientes", clientes);
        request.getRequestDispatcher("/cliente/ver_cliente.jsp").forward(request,response);

    }

    public void destroy() {
    }
}