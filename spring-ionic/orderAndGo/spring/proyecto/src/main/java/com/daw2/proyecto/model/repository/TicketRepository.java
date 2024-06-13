package com.daw2.proyecto.model.repository;


import com.daw2.proyecto.model.entity.Mesa;
import com.daw2.proyecto.model.entity.Ticket;
import com.daw2.proyecto.model.entity.TicketStatus;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

import java.util.List;

@Repository
public interface TicketRepository extends JpaRepository<Ticket, Long> {

    List<Ticket>  findByMesaId(Long mesaId);

    Ticket findByCodigoAcceso(String codigoAcceso);

    List <Ticket> findByMesa(Mesa mesa);

    List<Ticket> findByStatus(TicketStatus ticketStatus);
}







