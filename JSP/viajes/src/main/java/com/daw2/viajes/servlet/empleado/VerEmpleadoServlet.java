package com.daw2.viajes.servlet.empleado;
import com.daw2.viajes.dao.EmpleadoDao;
import com.daw2.viajes.dao.impl.EmpleadoDaoImpl;
import com.daw2.viajes.entity.Empleado;
import jakarta.servlet.ServletException;
import jakarta.servlet.annotation.WebServlet;
import jakarta.servlet.http.HttpServlet;
import jakarta.servlet.http.HttpServletRequest;
import jakarta.servlet.http.HttpServletResponse;

import java.io.IOException;
import java.util.List;

@WebServlet(name = "verEmpleadoServlet", value = "/empleados/ver")
public class VerEmpleadoServlet extends HttpServlet {
    private List<Empleado> empleados;
    private EmpleadoDao empleadoDao;

    public void init() {
        empleadoDao = new EmpleadoDaoImpl();
    }


    public void doGet(HttpServletRequest request, HttpServletResponse response) throws IOException, ServletException {
        String id = request.getParameter("id").trim();

        Empleado empleado= null;
        try{
            long idVer = Long.parseLong(id);
            empleado = empleadoDao.get(idVer);
        }catch (Exception ex){}
        request.setAttribute("empleado", empleado);
        empleados = empleadoDao.findAll();
        request.setAttribute("empleados", empleados);
        request.getRequestDispatcher("/empleado/ver_empleado.jsp").forward(request,response);

    }

    public void destroy() {
    }
}