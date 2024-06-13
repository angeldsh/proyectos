package com.daw2.viajes.servlet.cliente;

import com.daw2.viajes.dao.ClienteDao;
import com.daw2.viajes.dao.impl.ClienteDaoImpl;
import com.daw2.viajes.entity.Cliente;
import com.daw2.viajes.service.ClienteService;
import jakarta.servlet.ServletException;
import jakarta.servlet.annotation.WebServlet;
import jakarta.servlet.http.HttpServlet;
import jakarta.servlet.http.HttpServletRequest;
import jakarta.servlet.http.HttpServletResponse;

import java.io.IOException;
import java.util.List;

@WebServlet(name = "actualizaClienteServlet", value = "/clientes/actualizar")
public class ActualizaClienteServlet extends HttpServlet {
    private List<Cliente> clientes;
    private ClienteDao clienteDao;

    public void init() {
        clienteDao = new ClienteDaoImpl();
    }

    public void doGet(HttpServletRequest request, HttpServletResponse response) throws IOException, ServletException {
        String id = request.getParameter("id").trim();

        Cliente cliente= null;
        try{
            long idActualizar = Long.parseLong(id);
            cliente = clienteDao.get(idActualizar);
        }catch (Exception ex){}
        request.setAttribute("cliente", cliente);
        clientes = clienteDao.findAll();
        request.setAttribute("clientes", clientes);
        request.getRequestDispatcher("/cliente/actualiza_cliente.jsp").forward(request,response);

    }
    public void doPost(HttpServletRequest request, HttpServletResponse response) throws IOException, ServletException {
        Cliente cliente = ClienteService.formToEntity(request);

        if(clienteDao.update(cliente)){
            request.setAttribute("mensaje", "Cliente actualizado correctamente");
            clientes = clienteDao.findAll();
        }else {
            request.setAttribute("mensaje", "Cliente no actualizado");
        }

        // Agrega la lista de encuestas como atributo
        request.setAttribute("clientes", clientes);


        request.getRequestDispatcher("/cliente/listado_clientes.jsp").forward(request, response);
    }
    public void destroy() {
    }
}