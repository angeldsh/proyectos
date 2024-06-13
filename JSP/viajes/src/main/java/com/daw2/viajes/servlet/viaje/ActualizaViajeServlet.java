package com.daw2.viajes.servlet.viaje;

import com.daw2.viajes.dao.EmpleadoDao;
import com.daw2.viajes.dao.ViajeDao;
import com.daw2.viajes.dao.impl.EmpleadoDaoImpl;
import com.daw2.viajes.dao.impl.ViajeDaoImpl;
import com.daw2.viajes.entity.Empleado;
import com.daw2.viajes.entity.Viaje;
import com.daw2.viajes.service.ViajeService;
import jakarta.servlet.ServletException;
import jakarta.servlet.annotation.WebServlet;
import jakarta.servlet.http.HttpServlet;
import jakarta.servlet.http.HttpServletRequest;
import jakarta.servlet.http.HttpServletResponse;

import java.io.IOException;
import java.util.List;

@WebServlet(name = "actualizaViajeServlet", value = "/viajes/actualizar")
public class ActualizaViajeServlet extends HttpServlet {
    private List<Viaje> viajes;
    private ViajeDao viajeDao;

    private EmpleadoDao empleadoDao; // Agrega el DAO de empleados

    public void init() {
        viajeDao = new ViajeDaoImpl();
        empleadoDao = new EmpleadoDaoImpl(); // Inicializa el DAO de empleados
    }

    public void doGet(HttpServletRequest request, HttpServletResponse response) throws IOException, ServletException {
        List<Empleado> empleados = empleadoDao.findAll();
        request.setAttribute("empleados", empleados);

        String id = request.getParameter("id").trim();

        Viaje viaje= null;
        try{
            long idActualiza = Long.parseLong(id);
            viaje = viajeDao.get(idActualiza);
        }catch (Exception ex){}
        request.setAttribute("viaje", viaje);
        viajes = viajeDao.findAll();
        request.setAttribute("viajes", viajes);
        request.getRequestDispatcher("/viaje/actualiza_viaje.jsp").forward(request,response);

    }
    public void doPost(HttpServletRequest request, HttpServletResponse response) throws IOException, ServletException {
        Viaje viaje = ViajeService.formToEntity(request);

        if(viajeDao.update(viaje)){
            request.setAttribute("mensaje", "Viaje actualizado correctamente");
            viajes = viajeDao.findAll();
        }else {
            request.setAttribute("mensaje", "Viaje no actualizado");
        }

        // Agrega la lista de encuestas como atributo
        request.setAttribute("viajes", viajes);


        request.getRequestDispatcher("/viaje/listado_viajes.jsp").forward(request, response);
    }
    public void destroy() {
    }
}