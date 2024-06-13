package com.daw2.viajes.servlet.empleado;


import com.daw2.viajes.dao.EmpleadoDao;

import com.daw2.viajes.dao.impl.EmpleadoDaoImpl;

import com.daw2.viajes.entity.Empleado;

import com.daw2.viajes.service.EmpleadoService;
import jakarta.servlet.ServletException;
import jakarta.servlet.annotation.WebServlet;
import jakarta.servlet.http.HttpServlet;
import jakarta.servlet.http.HttpServletRequest;
import jakarta.servlet.http.HttpServletResponse;

import java.io.IOException;
import java.util.List;

@WebServlet(name = "nuevoEmpleadoServlet", value = "/empleados/nuevos")
public class NuevoEmpleadoServlet extends HttpServlet {
    private List<Empleado> empleados;
    private EmpleadoDao empleadoDao;

    public void init() {
        empleadoDao = new EmpleadoDaoImpl();
    }

    public void doGet(HttpServletRequest request, HttpServletResponse response) throws IOException, ServletException {
        empleados = empleadoDao.findAll();
        request.setAttribute("empleados", empleados);
        request.getRequestDispatcher("/empleado/nuevo_empleado.jsp").forward(request,response);

    }
    public void doPost(HttpServletRequest request, HttpServletResponse response) throws IOException, ServletException {
        Empleado empleado = EmpleadoService.formToEntity(request);

        if(empleadoDao.add(empleado)!=null){
            request.setAttribute("mensaje", "Empleado añadido correctamente");
            empleados = empleadoDao.findAll();
        }else {
            request.setAttribute("mensaje", "Empleado no añadido");
        }

        // Agrega la lista de encuestas como atributo
        request.setAttribute("empleados", empleados);


        request.getRequestDispatcher("/empleado/listado_empleados.jsp").forward(request, response);
    }
    public void destroy() {
    }
}


