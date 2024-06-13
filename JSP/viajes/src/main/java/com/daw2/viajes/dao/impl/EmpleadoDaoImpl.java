package com.daw2.viajes.dao.impl;

import com.daw2.viajes.dao.EmpleadoDao;
import com.daw2.viajes.entity.Empleado;
import jakarta.persistence.EntityManager;
import jakarta.persistence.EntityManagerFactory;
import jakarta.persistence.Persistence;
import jakarta.persistence.Query;

import java.util.List;

public class EmpleadoDaoImpl implements EmpleadoDao {
    private EntityManagerFactory emf;

    public EmpleadoDaoImpl() { //Conexion con la bbdd
        try {
            emf = Persistence.createEntityManagerFactory("default");
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    @Override
    public Long add(Empleado entity) {
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
        } finally {
            em.close();
        }
        return id;
    }

    @Override
    public boolean add(List<Empleado> list) {
        boolean error = false;
        EntityManager em = emf.createEntityManager();
        try {
            em.getTransaction().begin();
            for (Empleado empleado : list) {
                em.persist(empleado);
                em.flush();
            }
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
    public boolean update(Empleado entity) {
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
        boolean error = false;
        EntityManager em = emf.createEntityManager();
        try {
            Empleado empleado = em.find(Empleado.class, id);
            em.getTransaction().begin();
            em.remove(empleado);
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
    public boolean deleteAll() {
        return false;
    }

    @Override
    public Empleado get(long id) {
        EntityManager em = emf.createEntityManager();
        Query query = em.createQuery("SELECT e FROM Empleado e WHERE e.id=:id", Empleado.class);
        query.setParameter("id", id);
        Empleado empleado = (Empleado) query.getSingleResult();
        em.close();
        return empleado;
    }

    @Override
    public List<Empleado> findAll() {
        List<Empleado> empleados;
        EntityManager em = emf.createEntityManager();
        empleados = em.createQuery("SELECT e FROM Empleado e", Empleado.class).getResultList();
        em.close();
        return empleados;
    }

    @Override
    public boolean empleadoTieneViaje(long id) {
        boolean tieneViaje = false;
        EntityManager em = emf.createEntityManager();
        Query query = em.createQuery("SELECT e FROM Empleado e WHERE e.id=:id", Empleado.class);
        query.setParameter("id", id);
        Empleado empleado = (Empleado) query.getSingleResult();
        if (!empleado.getViajes().isEmpty()) {
            tieneViaje = true;
        }
        em.close();
        return tieneViaje;
    }
}

