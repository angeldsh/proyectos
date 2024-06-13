package com.daw2.viajes.servlet.viaje;

import com.daw2.viajes.dao.ViajeClienteDao;
import com.daw2.viajes.dao.ViajeDao;
import com.daw2.viajes.dao.impl.ViajeClienteDaoImpl;
import com.daw2.viajes.dao.impl.ViajeDaoImpl;
import com.daw2.viajes.entity.Viaje;
import com.daw2.viajes.entity.ViajeCliente;
import com.daw2.viajes.service.ViajeService;
import jakarta.servlet.ServletException;
import jakarta.servlet.annotation.WebServlet;
import jakarta.servlet.http.HttpServlet;
import jakarta.servlet.http.HttpServletRequest;
import jakarta.servlet.http.HttpServletResponse;

import java.io.IOException;
import java.util.List;

@WebServlet(name = "borraViajeServlet", value = "/viajes/borrar")
public class BorraViajeServlet extends HttpServlet {
    private List<Viaje> viajes;
    private ViajeDao viajeDao;

    private List<ViajeCliente> viajesClientes;

    private ViajeClienteDao viajesClientesDao;

    public void init() {
        viajeDao = new ViajeDaoImpl();
        viajesClientesDao = new ViajeClienteDaoImpl();
    }

    public void doGet(HttpServletRequest request, HttpServletResponse response) throws IOException, ServletException {
        String id = request.getParameter("id").trim();

        Viaje viaje= null;
        try{
            long idBorra = Long.parseLong(id);
            viaje = viajeDao.get(idBorra);
        }catch (Exception ex){}
        request.setAttribute("viaje", viaje);
        viajes = viajeDao.findAll();
        request.setAttribute("viajes", viajes);
        request.getRequestDispatcher("/viaje/borra_viaje.jsp").forward(request,response);

    }
    public void doPost(HttpServletRequest request, HttpServletResponse response) throws IOException, ServletException {
        Viaje viaje = ViajeService.formToEntity(request);
        long id = viaje.getId();
        viajesClientes = viajesClientesDao.findByViajeId(id);

        if (viajesClientes.isEmpty()) {
            if (viajeDao.delete(id)) {
                request.setAttribute("mensaje", "Viaje eliminado correctamente");
                viajes = viajeDao.findAll();
            } else {
                request.setAttribute("mensaje", "Viaje no eliminado");
            }
        } else {
            request.setAttribute("mensaje", "No se puede eliminar el viaje porque tiene viajes-clientes asociados.");
        }

        // Agrega la lista de encuestas como atributo
        request.setAttribute("viajes", viajes);


        request.getRequestDispatcher("/viaje/listado_viajes.jsp").forward(request, response);
    }
    public void destroy() {
    }
}