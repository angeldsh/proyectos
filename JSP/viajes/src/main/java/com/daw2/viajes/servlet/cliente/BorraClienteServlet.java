package com.daw2.viajes.servlet.cliente;

import com.daw2.viajes.dao.ClienteDao;
import com.daw2.viajes.dao.ViajeClienteDao;
import com.daw2.viajes.dao.impl.ClienteDaoImpl;
import com.daw2.viajes.dao.impl.ViajeClienteDaoImpl;
import com.daw2.viajes.entity.Cliente;
import com.daw2.viajes.entity.ViajeCliente;
import com.daw2.viajes.service.ClienteService;
import jakarta.servlet.ServletException;
import jakarta.servlet.annotation.WebServlet;
import jakarta.servlet.http.HttpServlet;
import jakarta.servlet.http.HttpServletRequest;
import jakarta.servlet.http.HttpServletResponse;

import java.io.IOException;
import java.util.List;

@WebServlet(name = "borraClienteServlet", value = "/clientes/borrar")
public class BorraClienteServlet extends HttpServlet {
    private List<Cliente> clientes;
    private ClienteDao clienteDao;

    private List<ViajeCliente> viajesClientes;

    private ViajeClienteDao viajesClientesDao;

    public void init() {
        clienteDao = new ClienteDaoImpl();
        viajesClientesDao = new ViajeClienteDaoImpl();
    }

    public void doGet(HttpServletRequest request, HttpServletResponse response) throws IOException, ServletException {
        String id = request.getParameter("id").trim();

        Cliente cliente= null;
        try{
            long idBorra = Long.parseLong(id);
            cliente = clienteDao.get(idBorra);
        }catch (Exception ex){}
        request.setAttribute("cliente", cliente);
        clientes = clienteDao.findAll();
        request.setAttribute("clientes", clientes);
        request.getRequestDispatcher("/cliente/borra_cliente.jsp").forward(request,response);

    }
    public void doPost(HttpServletRequest request, HttpServletResponse response) throws IOException, ServletException {
        Cliente cliente = ClienteService.formToEntity(request);
        long id = cliente.getId();
        viajesClientes = viajesClientesDao.findByClienteId(id);

        if (viajesClientes.isEmpty()) {
            if(clienteDao.delete(id)){
                request.setAttribute("mensaje", "Cliente eliminado correctamente");
                clientes = clienteDao.findAll();
            }else {
                request.setAttribute("mensaje", "Cliente no eliminado");
            }
        } else {
            request.setAttribute("mensaje", "No se puede eliminar el cliente porque tiene viajes-clientes asociados.");
        }

        // Agrega la lista de encuestas como atributo
        request.setAttribute("clientes", clientes);


        request.getRequestDispatcher("/cliente/listado_clientes.jsp").forward(request, response);
    }
    public void destroy() {
    }
}