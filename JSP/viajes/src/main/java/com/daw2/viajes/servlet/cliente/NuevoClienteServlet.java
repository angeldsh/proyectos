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

@WebServlet(name = "nuevoClienteServlet", value = "/clientes/nuevos")
public class NuevoClienteServlet extends HttpServlet {
    private List<Cliente> clientes;
    private ClienteDao clienteDao;

    public void init() {
        System.out.println("INIT");
        clienteDao = new ClienteDaoImpl() {
        };
    }

    public void doGet(HttpServletRequest request, HttpServletResponse response) throws IOException, ServletException {
        System.out.println("GET");
        clientes = clienteDao.findAll();
        request.setAttribute("clientes", clientes);
        request.getRequestDispatcher("/cliente/nuevo_cliente.jsp").forward(request,response);

    }
    public void doPost(HttpServletRequest request, HttpServletResponse response) throws IOException, ServletException {
        System.out.println("POST");

        Cliente cliente = ClienteService.formToEntity(request);

        if(clienteDao.add(cliente)!=null){
            request.setAttribute("mensaje", "Cliente añadido correctamente");
            clientes = clienteDao.findAll();
        }else {
            request.setAttribute("mensaje", "Cliente no añadido");
        }

        // Agrega la lista de encuestas como atributo
        request.setAttribute("clientes", clientes);

        request.getRequestDispatcher("/cliente/listado_clientes.jsp").forward(request, response);
    }
    public void destroy() {
    }
}


