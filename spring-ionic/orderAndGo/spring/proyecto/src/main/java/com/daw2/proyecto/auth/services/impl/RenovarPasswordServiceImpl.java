package com.daw2.proyecto.auth.services.impl;

import com.daw2.proyecto.auth.models.RenovarPassword;
import com.daw2.proyecto.auth.models.Usuario;
import com.daw2.proyecto.auth.repository.RenovarPasswordRepository;
import com.daw2.proyecto.auth.repository.UsuariosRepository;
import com.daw2.proyecto.auth.services.RenovarPasswordService;
import com.daw2.proyecto.email.service.EmailService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.stereotype.Service;
import org.springframework.transaction.annotation.Transactional;

import java.security.SecureRandom;
import java.util.Base64;
import java.util.Optional;

@Service
public class RenovarPasswordServiceImpl implements RenovarPasswordService {
    @Autowired
    private RenovarPasswordRepository renovarPasswordRepository;
    @Autowired
    private UsuariosRepository usuarioRepository;
    @Autowired
    private EmailService emailService;
    @Autowired
    private PasswordEncoder passwordEncoder;


    @Transactional
    @Override
    public void solicitarRestablecimientoDeContrasena(String email) {
        Optional<Usuario> usuarioOptional = usuarioRepository.findByEmail(email);
        if (!usuarioOptional.isPresent()) {
            throw new RuntimeException("No existe un usuario con el email proporcionado.");
        }

        Usuario usuario = usuarioOptional.get();
        String codigo = generarCodigo();

        RenovarPassword renovarPassword = new RenovarPassword();
        renovarPassword.setEmail(email);
        renovarPassword.setCodigo(codigo);
        renovarPassword.setUsuario(usuario);

        renovarPasswordRepository.save(renovarPassword);


        enviarEmailDeRestablecimiento(email, codigo);
    }

    private String generarCodigo() {
        SecureRandom random = new SecureRandom();
        int numero = random.nextInt(999999);
        return String.format("%06d", numero); // Asegura que el código tenga 6 dígitos
    }

    private void enviarEmailDeRestablecimiento(String email, String resetLink) {
        String subject = "Restablecimiento de contraseña";
        String text = "Este es el código generado para restablecer su contraseña: " + resetLink;
        emailService.sendSimpleMessage(email, subject, text);
    }

    @Override
    @Transactional
    public void cambiarContrasena(String token, String nuevaContrasena) {
        RenovarPassword renovarPassword = (RenovarPassword) renovarPasswordRepository.findByCodigo(token)
                .orElseThrow(() -> new RuntimeException("Token no válido"));
        Usuario usuario = renovarPassword.getUsuario();

        String contrasenaEncriptada = passwordEncoder.encode(nuevaContrasena);

        usuario.setPassword(contrasenaEncriptada);
        usuarioRepository.save(usuario);

        renovarPasswordRepository.delete(renovarPassword);
    }
}
