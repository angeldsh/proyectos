package com.daw2.proyecto.service;

import com.daw2.proyecto.auth.models.Cliente;
import com.daw2.proyecto.model.entity.Direccion;
import com.daw2.proyecto.model.entity.Pedido;
import com.daw2.proyecto.model.entity.Ticket;

import java.util.List;

public interface PedidosService {
    List<Pedido> findAll();

    Pedido save(Pedido pedido);

    Pedido actualizarEstadoPedido(Long pedidoId, String nuevoEstado);

    Pedido findById(Long pedidoId);

    List<Pedido> findByCliente(Cliente cliente);

    List<Pedido> findByTicketId(Long ticketId);

    Long deletePedidosByTicketId(Long id);

    List<Pedido> findByTicket(Ticket ticket);

    List<Pedido> findByDireccion(Direccion direccion);

    void delete(Pedido pedido);
}
