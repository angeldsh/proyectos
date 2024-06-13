package com.daw2.proyecto.model.repository;


import com.daw2.proyecto.model.entity.Direccion;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

import java.util.List;

@Repository
public interface DireccionRepository extends JpaRepository<Direccion, Long> {

    List<Direccion> findByClienteId(Long clienteId);
}
