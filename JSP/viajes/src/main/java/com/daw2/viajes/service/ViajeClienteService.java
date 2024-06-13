package com.daw2.viajes.service;
import com.daw2.viajes.dao.ClienteDao;
import com.daw2.viajes.dao.ViajeDao;
import com.daw2.viajes.dao.impl.ClienteDaoImpl;

import com.daw2.viajes.dao.impl.ViajeDaoImpl;
import com.daw2.viajes.entity.Cliente;

import com.daw2.viajes.entity.Viaje;
import com.daw2.viajes.entity.ViajeCliente;

import jakarta.servlet.http.HttpServletRequest;


public class ViajeClienteService {
    private static ClienteDao clienteDao= new ClienteDaoImpl();
    private static ViajeDao viajeDao= new ViajeDaoImpl();

    public static ViajeCliente formToEntity(HttpServletRequest request) {

        Long id = null;
        try{
            id = Long.parseLong(request.getParameter("id").trim());
        }catch (Exception ex){}

        Long clienteId = null;
        Cliente cliente = null;
        try {
            clienteId = Long.parseLong(request.getParameter("cliente").trim());
            if (clienteId != null) {
                cliente = clienteDao.get(clienteId);
            }
        } catch (Exception ex) {
            ex.printStackTrace();
        }
        Long viajeId = null;
        Viaje viaje = null;
        try {
            viajeId = Long.parseLong(request.getParameter("viaje").trim());
            if (viajeId != null) {
                viaje = viajeDao.get(viajeId);
            }
        } catch (Exception ex) {
            ex.printStackTrace();
        }

        String pagadoStr = request.getParameter("pagado");
        Double pagado = null;
        try {
            pagado = Double.parseDouble(pagadoStr);
        } catch (NumberFormatException e) {
            e.printStackTrace();
        }

        ViajeCliente viajeCliente = new ViajeCliente();
        viajeCliente.setId(id);
        viajeCliente.setCliente(cliente);
        viajeCliente.setViaje(viaje);
        viajeCliente.setPagado(pagado);


        return viajeCliente;
    }
}
