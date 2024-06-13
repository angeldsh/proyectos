package com.daw2.proyecto.service;

import com.daw2.proyecto.model.entity.Mesa;
import com.daw2.proyecto.model.entity.Ticket;

import java.util.List;

public interface TicketsService {
    List<Ticket> findAll();

    Ticket save(Ticket pedidoMesa);

    List<Ticket> findByMesaId(Long mesaId);

    Ticket createNewTicket(Mesa mesa);

    String generateUniqueAccessCode();

    Ticket findTicketById(Long ticketId);

    boolean validateTicketAccessCode(String codigoAcceso);

    List <Ticket> findByMesa(Mesa mesa);

    void delete(Ticket ticket);

    Ticket findByAccessCode(String codigoAcceso);

    List<Ticket> findOpenTickets();

}
