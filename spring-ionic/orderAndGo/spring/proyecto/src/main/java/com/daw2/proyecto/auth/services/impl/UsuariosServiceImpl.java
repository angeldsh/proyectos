package com.daw2.proyecto.auth.services.impl;

import com.daw2.proyecto.auth.models.Usuario;
import com.daw2.proyecto.auth.repository.UsuariosRepository;
import com.daw2.proyecto.auth.services.UsuariosService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import org.springframework.transaction.annotation.Transactional;

import java.util.List;
import java.util.Optional;

@Service
public class UsuariosServiceImpl implements UsuariosService {
    @Autowired
    private UsuariosRepository usuariosRepository;

    @Override
    @Transactional(readOnly = true)
    public Optional<Usuario> findByUsername(String username) {
        return usuariosRepository.findByUsername(username);
    }

    @Override
    @Transactional(readOnly = true)
    public List<Usuario> findAll() {
        return usuariosRepository.findAll();
    }

    @Override
    @Transactional
    public Usuario save(Usuario usuario) {
        return usuariosRepository.save(usuario);
    }

    @Override
    public void delete(Usuario usuario) {
        usuariosRepository.delete(usuario);
    }

    @Override
    public Boolean findByEmail(String email) {
        return usuariosRepository.existsByEmail(email);
    }


}
