package com.daw2.viajes.dao.impl;
import com.daw2.viajes.dao.ClienteDao;
import com.daw2.viajes.entity.Cliente;
import com.daw2.viajes.entity.Empleado;
import jakarta.persistence.EntityManager;
import jakarta.persistence.EntityManagerFactory;
import jakarta.persistence.Persistence;
import jakarta.persistence.Query;

import java.util.List;

public class ClienteDaoImpl implements ClienteDao {
    private EntityManagerFactory emf;
    public ClienteDaoImpl() { //Conexion con la bbdd
        try {
            emf = Persistence.createEntityManagerFactory("default");
        } catch (Exception e) {
            e.printStackTrace();
        }
    }
    @Override
    public Long add(Cliente entity) {
        Long id = null;
        EntityManager em = emf.createEntityManager();
        try {
            em.getTransaction().begin();
            em.persist(entity);
            em.flush();
            em.getTransaction().commit();
            id = entity.getId();
        } catch (Exception e) {
            //  e.printStackTrace();
            em.getTransaction().rollback();
        }finally {
            em.close();
        }
        return id;
    }

    @Override
    public boolean add(List<Cliente> list) {
        boolean error=false;
        EntityManager em = emf.createEntityManager();
        try {
            em.getTransaction().begin();
            for(Cliente cliente:list){
                em.persist(cliente);
                em.flush();
            }
            em.getTransaction().commit();
        } catch (Exception e) {
            error=true;
            em.getTransaction().rollback();
        }finally {
            em.close();
        }
        return !error;
    }

    @Override
    public boolean update(Cliente entity) {
        boolean error = false;
        EntityManager em = emf.createEntityManager();
        try {
            em.getTransaction().begin();
            // He utilizado merge para actualizar la encuesta existente con la nueva encuesta
            em.merge(entity);
            em.flush();
            em.getTransaction().commit();
        } catch (Exception e) {
            error = true;
            em.getTransaction().rollback();
        } finally {
            em.close();
        }
        return !error;
    }

    @Override
    public boolean delete(long id) {
        boolean error=false;
        EntityManager em = emf.createEntityManager();
        try {
            Cliente cliente = em.find(Cliente.class,id);
            em.getTransaction().begin();
            em.remove(cliente);
            em.getTransaction().commit();
        } catch (Exception e) {
            error=true;
            em.getTransaction().rollback();
        }finally {
            em.close();
        }
        return !error;
    }

    @Override
    public boolean deleteAll() {
        return false;
    }

    @Override
    public Cliente get(long id) {
        EntityManager em = emf.createEntityManager();
        Query query = em.createQuery("SELECT e FROM Cliente e WHERE e.id=:id", Cliente.class);
        query.setParameter("id", id);
        Cliente cliente = (Cliente) query.getSingleResult();
        em.close();
        return cliente;
    }

    @Override
    public List<Cliente> findAll() {
        List<Cliente> clientes;
        EntityManager em = emf.createEntityManager();
        clientes = em.createQuery("SELECT e FROM Cliente e", Cliente.class).getResultList();
        em.close();
        return clientes;
    }

    @Override
    public List<Cliente> findByNif(String nif) {
        return null;
    }

    @Override
    public boolean clienteTieneViaje(long id){
     //Comprobar si el cliente tiene algun vaije asociado
        boolean tieneViaje=false;
        EntityManager em = emf.createEntityManager();
        Query query = em.createQuery("SELECT c FROM Cliente c WHERE c.id=:id", Cliente.class);
        query.setParameter("id", id);
        Cliente cliente = (Cliente) query.getSingleResult();
        if(!cliente.getViajeClientes().isEmpty()){
            tieneViaje=true;
        }
        em.close();
        return tieneViaje;
    }
}

