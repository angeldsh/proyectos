package com.daw2.proyecto.service.impl;


import com.daw2.proyecto.model.entity.Direccion;
import com.daw2.proyecto.model.repository.DireccionRepository;
import com.daw2.proyecto.service.DireccionesService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.List;

@Service
public class DireccionesServiceImpl implements DireccionesService {
    @Autowired
    private DireccionRepository direccionRepository;


    @Override
    public List<Direccion> findAll() {
        return direccionRepository.findAll();
    }

    @Override
    public Direccion save(Direccion direccion) {
        return direccionRepository.save(direccion);
    }

    @Override
    public List<Direccion> findByClienteId(Long clienteId) {
        return direccionRepository.findByClienteId(clienteId);
    }

    @Override
    public Direccion findById(Long direccionId) {
        return direccionRepository.findById(direccionId).orElse(null);
    }

    @Override
    public void deleteById(Long direccionId) {
        direccionRepository.deleteById(direccionId);
    }
}
