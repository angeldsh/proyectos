package com.daw2.proyecto.service;

import com.daw2.proyecto.model.entity.Categoria;
import com.daw2.proyecto.model.entity.Producto;

import org.springframework.web.multipart.MultipartFile;


import java.util.List;

public interface ProductosService {
    List<Producto> findAll();

    Producto save(Producto producto);

    void delete(Producto producto);

    void saveImagen(Producto producto, MultipartFile fichero);

    Producto findById(Long id);

    Producto update(Long id, Producto productoActualizado, MultipartFile nuevaImagen);

    List <Producto> findByCategoria(Categoria categoria);
}
