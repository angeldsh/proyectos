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

@WebServlet(name = "nuevoViajeServlet", value = "/viajes/nuevos")
public class NuevoViajeServlet extends HttpServlet {
    private List<Viaje> viajes;
    private ViajeDao viajeDao;
    private EmpleadoDao empleadoDao; // Agrega el DAO de empleados

    public void init() {
        viajeDao = new ViajeDaoImpl();
        empleadoDao = new EmpleadoDaoImpl(); // Inicializa el DAO de empleados
    }

    public void doGet(HttpServletRequest request, HttpServletResponse response) throws IOException, ServletException {
        // Recupera la lista de empleados para poder mostrarla en el formulario
        List<Empleado> empleados = empleadoDao.findAll();
        request.setAttribute("empleados", empleados);

        viajes = viajeDao.findAll();
        request.setAttribute("viajes", viajes);

        request.getRequestDispatcher("/viaje/nuevo_viaje.jsp").forward(request, response);
    }

    public void doPost(HttpServletRequest request, HttpServletResponse response) throws IOException, ServletException {
        System.out.println("POST");

        Viaje viaje = ViajeService.formToEntity(request);

        if(viajeDao.add(viaje)!=null){
            request.setAttribute("mensaje", "Viaje añadido correctamente");
            viajes = viajeDao.findAll();
        }else {
            request.setAttribute("mensaje", "Viaje no añadido");
        }

        // Agrega la lista de encuestas como atributo
        request.setAttribute("viajes", viajes);

        request.getRequestDispatcher("/viaje/listado_viajes.jsp").forward(request, response);
    }
    public void destroy() {
    }
}


