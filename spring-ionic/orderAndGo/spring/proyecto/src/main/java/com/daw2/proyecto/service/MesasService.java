package com.daw2.proyecto.service;

import com.daw2.proyecto.model.entity.Mesa;

import java.util.List;

public interface MesasService {
    List<Mesa> findAll();

    Mesa save(Mesa mesa);

    Object findById(Long id);

    Object findByNum(Long numero);


    void deleteById(Long id);
}
