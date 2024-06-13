package com.daw2.proyecto.auth.services;

import com.daw2.proyecto.auth.models.Rol;
import com.daw2.proyecto.auth.models.RolEnum;

import java.util.List;

public interface RolService {
    List<Rol> findAll();

    Rol findById(Long id);

    Rol save(Rol rol);

    void deleteById(Long id);

    Rol getByName(RolEnum roleCliente);
}

