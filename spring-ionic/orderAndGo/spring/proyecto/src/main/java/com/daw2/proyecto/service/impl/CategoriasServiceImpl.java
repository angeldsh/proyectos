package com.daw2.proyecto.service.impl;

import com.daw2.proyecto.model.entity.Categoria;
import com.daw2.proyecto.model.repository.CategoriaRepository;
import com.daw2.proyecto.service.CategoriasService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import org.springframework.transaction.annotation.Transactional;

import java.util.List;

@Service
public class CategoriasServiceImpl implements CategoriasService {
    @Autowired
    private CategoriaRepository categoriaRepository;


    @Override
    @Transactional(readOnly = true)
    public List<Categoria> findAll() {
        return categoriaRepository.findAll();
    }

    @Override
    @Transactional
    public Categoria save(Categoria categoria) {
        return categoriaRepository.save(categoria);
    }

    @Transactional(readOnly = true)
    @Override
    public Categoria findById(Long id) {
        return categoriaRepository.findById(id).orElse(null);
    }

    @Override
    public void delete(Categoria categoria) {
        categoriaRepository.delete(categoria);
    }


}
