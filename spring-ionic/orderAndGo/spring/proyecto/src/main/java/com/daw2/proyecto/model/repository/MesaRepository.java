package com.daw2.proyecto.model.repository;


import com.daw2.proyecto.model.entity.Mesa;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

@Repository
public interface MesaRepository extends JpaRepository<Mesa, Long> {

    Object findByNumero(Long numero);
}
