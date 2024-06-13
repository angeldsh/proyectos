package com.daw2.proyecto.auth.services.impl;

import com.daw2.proyecto.auth.models.Cliente;
import com.daw2.proyecto.auth.repository.ClienteRepository;
import com.daw2.proyecto.auth.services.ClientesService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import org.springframework.transaction.annotation.Transactional;

import java.util.List;

@Service
public class ClientesServiceImpl implements ClientesService {
    @Autowired
    private ClienteRepository clientesRepository;

    @Override
    @Transactional(readOnly = true)
    public List<Cliente> findAll() {
        return clientesRepository.findAll();
    }

    @Override
    @Transactional
    public Cliente save(Cliente cliente) {
        return clientesRepository.save(cliente);
    }

    @Override
    public Cliente findById(Long clienteId) {
        return clientesRepository.findById(clienteId).orElse(null);
    }

    @Override
    public void delete(Cliente cliente) {
        clientesRepository.delete(cliente);
    }

}
