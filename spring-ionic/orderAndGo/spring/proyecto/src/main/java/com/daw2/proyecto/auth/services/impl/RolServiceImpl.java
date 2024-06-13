package com.daw2.proyecto.auth.services.impl;


import com.daw2.proyecto.auth.models.Rol;
import com.daw2.proyecto.auth.models.RolEnum;
import com.daw2.proyecto.auth.repository.RolRepository;
import com.daw2.proyecto.auth.services.RolService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.List;


@Service
public class RolServiceImpl implements RolService {
    @Autowired
    private RolRepository rolRepository;

    @Override
    public List<Rol> findAll() {
        return rolRepository.findAll();
    }

    @Override
    public Rol findById(Long id) {
        return rolRepository.findById(id).orElse(null);
    }

    @Override
    public Rol save(Rol rol) {
        return rolRepository.save(rol);
    }

    @Override
    public void deleteById(Long id) {
        rolRepository.deleteById(id);
    }

    @Override
    public Rol getByName(RolEnum roleCliente) {
        return rolRepository.getByName(roleCliente);
    }
}
