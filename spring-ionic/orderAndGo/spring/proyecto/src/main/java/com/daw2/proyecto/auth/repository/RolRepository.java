package com.daw2.proyecto.auth.repository;

import com.daw2.proyecto.auth.models.Rol;
import com.daw2.proyecto.auth.models.RolEnum;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

@Repository
public interface RolRepository extends JpaRepository<Rol, Long> {
    Rol getByName(RolEnum name);

}
