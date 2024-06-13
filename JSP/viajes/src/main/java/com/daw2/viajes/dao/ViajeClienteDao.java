package com.daw2.viajes.dao;

import com.daw2.viajes.entity.Viaje;
import com.daw2.viajes.entity.ViajeCliente;

import java.util.List;

public interface ViajeClienteDao extends GenericDao <ViajeCliente, Long>{
    List<ViajeCliente> findByClienteId(Long id);

    List<ViajeCliente>findByViajeId(Long id);

    List<ViajeCliente> findByTitulo(String titulo);


}
