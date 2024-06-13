package com.daw2.viajes.dao;

import com.daw2.viajes.entity.Empleado;

public interface EmpleadoDao extends GenericDao<Empleado, Long>{
    boolean empleadoTieneViaje(long id);
}
