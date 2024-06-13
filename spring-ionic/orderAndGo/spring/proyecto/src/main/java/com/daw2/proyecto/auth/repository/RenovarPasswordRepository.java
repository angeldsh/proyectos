package com.daw2.proyecto.auth.repository;

import com.daw2.proyecto.auth.models.RenovarPassword;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

import java.util.Optional;

@Repository
public interface RenovarPasswordRepository extends JpaRepository<RenovarPassword, Long> {

    Optional<Object> findByCodigo(String token);
}
