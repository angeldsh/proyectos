package com.daw2.viajes.dao.impl;

import com.daw2.viajes.dao.ViajeClienteDao;
import com.daw2.viajes.entity.Viaje;
import com.daw2.viajes.entity.ViajeCliente;
import jakarta.persistence.EntityManager;
import jakarta.persistence.EntityManagerFactory;
import jakarta.persistence.Persistence;
import jakarta.persistence.Query;

import java.util.List;

public class ViajeClienteDaoImpl implements ViajeClienteDao {
    private EntityManagerFactory emf;
    public ViajeClienteDaoImpl() { //Conexion con la bbdd
        try {
            emf = Persistence.createEntityManagerFactory("default");
        } catch (Exception e) {
            e.printStackTrace();
        }
    }
    @Override
    public Long add(ViajeCliente entity) {
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
    public boolean add(List<ViajeCliente> list) {
        boolean error=false;
        EntityManager em = emf.createEntityManager();
        try {
            em.getTransaction().begin();
            for(ViajeCliente viajeCliente:list){
                em.persist(viajeCliente);
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
    public boolean update(ViajeCliente entity) {
        boolean error = false;
        EntityManager em = emf.createEntityManager();
        try {
            em.getTransaction().begin();
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
            ViajeCliente viajeCliente = em.find(ViajeCliente.class,id);
            em.getTransaction().begin();
            em.remove(viajeCliente);
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
    public ViajeCliente get(long id) {
        EntityManager em = emf.createEntityManager();
        Query query = em.createQuery("SELECT e FROM ViajeCliente e WHERE e.id=:id", ViajeCliente.class);
        query.setParameter("id", id);
        ViajeCliente viajeCliente = (ViajeCliente) query.getSingleResult();
        em.close();
        return viajeCliente;
    }

    @Override
    public List<ViajeCliente> findAll() {
        List<ViajeCliente> viajeCliente;
        EntityManager em = emf.createEntityManager();
        viajeCliente = em.createQuery("SELECT e FROM ViajeCliente e", ViajeCliente.class).getResultList();
        em.close();
        return viajeCliente;
    }
    @Override
    public List<ViajeCliente>findByClienteId(Long clienteId) {
        EntityManager em = emf.createEntityManager();
        Query query = em.createQuery("SELECT vc FROM ViajeCliente vc WHERE vc.cliente.id = :clienteId", ViajeCliente.class);
        query.setParameter("clienteId", clienteId);
        List<ViajeCliente> viajes = query.getResultList();
        em.close();
        return viajes;
    }
    @Override
    public List<ViajeCliente>findByViajeId(Long viajeId) {
        EntityManager em = emf.createEntityManager();
        Query query = em.createQuery("SELECT vc FROM ViajeCliente vc WHERE vc.viaje.id = :viajeId", ViajeCliente.class);
        query.setParameter("viajeId", viajeId);
        List<ViajeCliente> viajes = query.getResultList();
        em.close();
        return viajes;
    }
    @Override
    public List<ViajeCliente>  findByTitulo(String titulo) {
        EntityManager em = emf.createEntityManager();
        Query query = em.createQuery("SELECT vc FROM ViajeCliente vc WHERE vc.viaje.titulo = :titulo", ViajeCliente.class);
        query.setParameter("titulo", titulo);

        List<ViajeCliente> viajesClientes = query.getResultList();

        return viajesClientes;
    }


}
