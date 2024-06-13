package com.daw2.viajes.dao;


import com.daw2.viajes.entity.Viaje;

import java.util.List;

public interface ViajeDao extends GenericDao<Viaje, Long>{
    List<Viaje> findByEmpleadoId(Long id); //Metodo para encontrar viajes por id de empleado

    List<Viaje>  findByTitulo(String titulo);
    List<Viaje>  findByDescripcion(String descripcion);
    List<Viaje>  findByTituloDescripcion(String titulo, String descripcion);


}
