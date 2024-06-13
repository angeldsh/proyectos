package com.daw2.proyecto.auth.services;

import com.daw2.proyecto.auth.models.Cliente;

import java.util.List;

public interface ClientesService {
    List<Cliente> findAll();

    Cliente save(Cliente cliente);

    Cliente findById(Long clienteId);

    void delete(Cliente cliente);
}
