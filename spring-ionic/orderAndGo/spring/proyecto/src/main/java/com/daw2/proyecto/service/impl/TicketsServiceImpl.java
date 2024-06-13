package com.daw2.proyecto.service.impl;

import com.daw2.proyecto.model.entity.Mesa;
import com.daw2.proyecto.model.entity.Ticket;
import com.daw2.proyecto.model.entity.TicketStatus;
import com.daw2.proyecto.model.repository.TicketRepository;
import com.daw2.proyecto.service.TicketsService;
import org.apache.commons.lang3.RandomStringUtils;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import org.springframework.transaction.annotation.Transactional;

import java.util.List;

@Service
public class TicketsServiceImpl implements TicketsService {
    @Autowired
    private TicketRepository ticketsRepository;

    @Override
    @Transactional(readOnly = true)
    public List<Ticket> findAll() {
        return ticketsRepository.findAll();
    }

    @Override
    @Transactional
    public Ticket save(Ticket ticket) {
        return ticketsRepository.save(ticket);
    }

    @Override
    @Transactional
    public List<Ticket> findByMesaId(Long mesaId) {
        return ticketsRepository.findByMesaId(mesaId);
    }

    @Override
    @Transactional
    public Ticket createNewTicket(Mesa mesa) {
        Ticket ticket = new Ticket();
        ticket.setMesa(mesa);
        ticket.setCodigoAcceso(generateUniqueAccessCode());
        ticket.setStatus(TicketStatus.ACTIVO);
        return ticketsRepository.save(ticket);
    }

    @Override
    @Transactional
    public String generateUniqueAccessCode() {
        // Genera un código único aleatorio
        return RandomStringUtils.randomAlphanumeric(6).toUpperCase(); // Ejemplo de código aleatorio
    }

    @Override
    @Transactional
    public Ticket findTicketById(Long ticketId) {
        return ticketsRepository.findById(ticketId).orElse(null);
    }

    @Override
    @Transactional
    public boolean validateTicketAccessCode(String codigoAcceso) {
        Ticket ticket = ticketsRepository.findByCodigoAcceso(codigoAcceso);
        return ticket != null && ticket.getStatus() == TicketStatus.ACTIVO;
    }

    @Override
    @Transactional
    public List <Ticket> findByMesa(Mesa mesa) {
        return ticketsRepository.findByMesa(mesa);
    }

    @Override
    @Transactional
    public void delete(Ticket ticket) {
        ticketsRepository.delete(ticket);
    }

    @Override
    @Transactional
    public Ticket findByAccessCode(String codigoAcceso) {
        return ticketsRepository.findByCodigoAcceso(codigoAcceso);
    }

    @Override
    public List<Ticket> findOpenTickets() {
        return ticketsRepository.findByStatus(TicketStatus.ACTIVO);
    }
}
