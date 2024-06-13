package com.daw2.proyecto.model.repository;


import com.daw2.proyecto.model.entity.Categoria;
import com.daw2.proyecto.model.entity.Producto;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

import java.util.List;

@Repository
public interface ProductoRepository extends JpaRepository<Producto, Long> {

    List<Producto> findByCategoria(Categoria categoria);
}
