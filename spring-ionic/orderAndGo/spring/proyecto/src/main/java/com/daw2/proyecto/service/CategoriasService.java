package com.daw2.proyecto.service;


import com.daw2.proyecto.model.entity.Categoria;

import java.util.List;

public interface CategoriasService {
    List<Categoria> findAll();

    Categoria save(Categoria categoria);

    Categoria findById(Long id);

    void delete(Categoria categoria);
}
