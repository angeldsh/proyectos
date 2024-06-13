package com.daw2.viajes.dao;
import java.io.Serializable;
import java.util.List;

public interface GenericDao <T,PK extends Serializable> {
    PK add(T entity);
    boolean add(List<T> list);
    boolean update(T entity);
    boolean delete(long id);
    boolean deleteAll();
    T get(long id);
    List<T> findAll();
}

