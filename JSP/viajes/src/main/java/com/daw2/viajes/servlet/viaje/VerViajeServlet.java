package com.daw2.viajes.servlet.viaje;

import com.daw2.viajes.dao.ViajeDao;
import com.daw2.viajes.dao.impl.ViajeDaoImpl;
import com.daw2.viajes.entity.Viaje;
import jakarta.servlet.ServletException;
import jakarta.servlet.annotation.WebServlet;
import jakarta.servlet.http.HttpServlet;
import jakarta.servlet.http.HttpServletRequest;
import jakarta.servlet.http.HttpServletResponse;

import java.io.IOException;
import java.util.List;

@WebServlet(name = "verViajeServlet", value = "/viajes/ver")
public class VerViajeServlet extends HttpServlet {
    private List<Viaje> viajes;
    private ViajeDao viajeDao;

    public void init() {
        viajeDao = new ViajeDaoImpl();
    }

    public void doGet(HttpServletRequest request, HttpServletResponse response) throws IOException, ServletException {
        String id = request.getParameter("id").trim();

        Viaje viaje= null;
        try{
            long idVer = Long.parseLong(id);
            viaje = viajeDao.get(idVer);
        }catch (Exception ex){}
        request.setAttribute("viaje", viaje);
        viajes = viajeDao.findAll();
        request.setAttribute("viajes", viajes);
        request.getRequestDispatcher("/viaje/ver_viaje.jsp").forward(request,response);

    }

    public void destroy() {
    }
}