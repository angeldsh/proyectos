package com.daw2.proyecto.service.impl;


import com.daw2.proyecto.model.entity.Mesa;
import com.daw2.proyecto.model.repository.MesaRepository;
import com.daw2.proyecto.service.MesasService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import org.springframework.transaction.annotation.Transactional;

import java.util.List;

@Service
public class MesasServiceImpl implements MesasService {
    @Autowired
    private MesaRepository mesaRepository;


    @Override
    @Transactional(readOnly = true)
    public List<Mesa> findAll() {
        return mesaRepository.findAll();
    }

    @Override
    @Transactional
    public Mesa save(Mesa mesa) {
        return mesaRepository.save(mesa);
    }

    @Override
    @Transactional
    public Object findById(Long id) {
        return mesaRepository.findById(id);
    }

    @Override
    public Object findByNum(Long numero) {
        return mesaRepository.findByNumero(numero);
    }

    @Override
    public void deleteById(Long id) {
        mesaRepository.deleteById(id);
    }
}
