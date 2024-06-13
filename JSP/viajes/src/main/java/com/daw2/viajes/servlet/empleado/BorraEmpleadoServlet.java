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

@WebServlet(name = "borraEmpleadoServlet", value = "/empleados/borrar")
public class BorraEmpleadoServlet extends HttpServlet {
    private List<Empleado> empleados;
    private EmpleadoDao empleadoDao;

    public void init() {
        empleadoDao = new EmpleadoDaoImpl();
    }


    public void doGet(HttpServletRequest request, HttpServletResponse response) throws IOException, ServletException {
        String id = request.getParameter("id").trim();

        Empleado empleado= null;
        try{
            long idBorra = Long.parseLong(id);
            empleado = empleadoDao.get(idBorra);
        }catch (Exception ex){}
        request.setAttribute("empleado", empleado);
        empleados = empleadoDao.findAll();
        request.setAttribute("empleados", empleados);
        request.getRequestDispatcher("/empleado/borra_empleado.jsp").forward(request,response);

    }
    public void doPost(HttpServletRequest request, HttpServletResponse response) throws IOException, ServletException {
        Empleado empleado = EmpleadoService.formToEntity(request);
        long id = empleado.getId();
        if(!empleadoDao.empleadoTieneViaje(id)){
            if(empleadoDao.delete(id)){
                request.setAttribute("mensaje", "Empleado eliminado correctamente");
                empleados = empleadoDao.findAll();
            }else {
                request.setAttribute("mensaje", "Empleado no eliminado");
            }
        } else {
            request.setAttribute("mensaje", "No se puede eliminar el empleado porque tiene viajes asociados.");
        }
        // Agrega la lista de encuestas como atributo
        request.setAttribute("empleados", empleados);


        request.getRequestDispatcher("/empleado/listado_empleados.jsp").forward(request, response);
    }
    public void destroy() {
    }
}