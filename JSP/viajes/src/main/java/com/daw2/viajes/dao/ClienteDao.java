package com.daw2.viajes.dao;

import com.daw2.viajes.entity.Cliente;

import java.util.List;
public interface ClienteDao extends GenericDao<Cliente, Long>{
    List<Cliente> findByNif(String nif); //Metodo para la clase en concreto
    boolean clienteTieneViaje(long id);
}
