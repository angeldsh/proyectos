package com.daw2.proyecto.model.repository;


import com.daw2.proyecto.auth.models.Cliente;
import com.daw2.proyecto.model.entity.Direccion;
import com.daw2.proyecto.model.entity.Pedido;
import com.daw2.proyecto.model.entity.Ticket;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

import java.util.List;

@Repository
public interface PedidoRepository extends JpaRepository<Pedido, Long> {

    List<Pedido> findByCliente(Cliente cliente);

    List<Pedido> findByTicketId(Long ticketId);

    Long deletePedidosByTicketId(Long id);

    List<Pedido> findByTicket(Ticket ticket);

    List<Pedido> findByDireccion(Direccion direccion);
}
