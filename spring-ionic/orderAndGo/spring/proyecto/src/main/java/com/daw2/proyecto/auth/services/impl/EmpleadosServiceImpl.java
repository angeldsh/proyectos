package com.daw2.proyecto.auth.services.impl;

import com.daw2.proyecto.auth.models.Cliente;
import com.daw2.proyecto.auth.models.Empleado;
import com.daw2.proyecto.auth.repository.ClienteRepository;
import com.daw2.proyecto.auth.repository.EmpleadoRepository;
import com.daw2.proyecto.auth.services.ClientesService;
import com.daw2.proyecto.auth.services.EmpleadosService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import org.springframework.transaction.annotation.Transactional;

import java.util.List;

@Service
public class EmpleadosServiceImpl implements EmpleadosService {
    @Autowired
    private EmpleadoRepository empleadoRepository;

    @Override
    @Transactional(readOnly = true)
    public List<Empleado> findAll() {
        return empleadoRepository.findAll();
    }

    @Override
    @Transactional
    public Empleado save(Empleado empleado) {
        return empleadoRepository.save(empleado);
    }

    @Override
    @Transactional
    public Empleado findById(Long empleadoId) {
        return empleadoRepository.findById(empleadoId).orElse(null);
    }

    @Transactional
    @Override
    public void delete(Empleado empleado) {
        empleadoRepository.delete(empleado);
    }

}
