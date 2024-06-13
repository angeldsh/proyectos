package com.daw2.proyecto.auth.services;

import com.daw2.proyecto.auth.models.Empleado;

import java.util.List;

public interface EmpleadosService {
    List<Empleado> findAll();

    Empleado save(Empleado empleado);

    Empleado findById(Long empleadoId);

    void delete(Empleado empleado);
}
