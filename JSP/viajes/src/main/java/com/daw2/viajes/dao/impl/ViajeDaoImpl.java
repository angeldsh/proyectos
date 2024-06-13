package com.daw2.viajes.dao.impl;

import com.daw2.viajes.dao.ViajeDao;
import com.daw2.viajes.entity.Viaje;
import com.daw2.viajes.entity.ViajeCliente;
import jakarta.persistence.EntityManager;
import jakarta.persistence.EntityManagerFactory;
import jakarta.persistence.Persistence;
import jakarta.persistence.Query;

import java.util.List;

public class ViajeDaoImpl implements ViajeDao {
    private EntityManagerFactory emf;
    public ViajeDaoImpl() { //Conexion con la bbdd
        try {
            emf = Persistence.createEntityManagerFactory("default");
        } catch (Exception e) {
            e.printStackTrace();
        }
    }
    @Override
    public Long add(Viaje entity) {
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
    public boolean add(List<Viaje> list) {
        boolean error=false;
        EntityManager em = emf.createEntityManager();
        try {
            em.getTransaction().begin();
            for(Viaje viaje:list){
                em.persist(viaje);
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
    public boolean update(Viaje entity) {
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
            Viaje viaje = em.find(Viaje.class,id);
            em.getTransaction().begin();
            em.remove(viaje);
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
    public Viaje get(long id) {
        EntityManager em = emf.createEntityManager();
        Query query = em.createQuery("SELECT e FROM Viaje e WHERE e.id=:id", Viaje.class);
        query.setParameter("id", id);
        Viaje viaje = (Viaje) query.getSingleResult();
        em.close();
        return viaje;
    }

    @Override
    public List<Viaje> findAll() {
        List<Viaje> viajes;
        EntityManager em = emf.createEntityManager();
        viajes = em.createQuery("SELECT e FROM Viaje e", Viaje.class).getResultList();
        em.close();
        return viajes;
    }

    @Override
    public List<Viaje>findByEmpleadoId(Long empleadoId) {
        EntityManager em = emf.createEntityManager();
        Query query = em.createQuery("SELECT e FROM Viaje e WHERE e.empleado.id = :empleadoId", Viaje.class);
        query.setParameter("empleadoId", empleadoId);
        List<Viaje> viajes = query.getResultList();
        em.close();
        return viajes;
    }
    @Override
    public List<Viaje>  findByTitulo(String titulo) {
        EntityManager em = emf.createEntityManager();
        Query query = em.createQuery("SELECT v FROM Viaje v WHERE v.titulo LIKE :titulo", Viaje.class);
        query.setParameter("titulo","%" + titulo + "%");
        List<Viaje> viajes = query.getResultList();
        return viajes;
    }
    @Override
    public List<Viaje>  findByDescripcion(String descripcion) {
        EntityManager em = emf.createEntityManager();
        Query query = em.createQuery("SELECT v FROM Viaje v WHERE v.descripcion LIKE :descripcion", Viaje.class);
        query.setParameter("descripcion", "%" + descripcion + "%");
        List<Viaje> viajes = query.getResultList();
        return viajes;
    }
    @Override
    public List<Viaje>  findByTituloDescripcion(String titulo, String descripcion) {
        EntityManager em = emf.createEntityManager();
        Query query = em.createQuery("SELECT v FROM Viaje v WHERE v.titulo LIKE :titulo AND v.descripcion LIKE :descripcion", Viaje.class);
        query.setParameter("titulo", "%" + titulo + "%");
        query.setParameter("descripcion", "%" + descripcion + "%");
        List<Viaje> viajes = query.getResultList();
        return viajes;
    }


}
