package com.daw2.proyecto.api;

import com.daw2.proyecto.auth.models.Cliente;
import com.daw2.proyecto.auth.models.Rol;
import com.daw2.proyecto.auth.models.RolEnum;
import com.daw2.proyecto.auth.models.Usuario;
import com.daw2.proyecto.auth.services.ClientesService;
import com.daw2.proyecto.auth.services.RolService;
import com.daw2.proyecto.auth.services.UsuariosService;
import com.daw2.proyecto.model.entity.Direccion;
import com.daw2.proyecto.service.DireccionesService;
import com.daw2.proyecto.service.PedidosService;
import org.springframework.beans.BeanUtils;
import org.springframework.beans.BeanWrapper;
import org.springframework.beans.BeanWrapperImpl;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.security.access.prepost.PreAuthorize;
import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.web.bind.annotation.*;

import java.util.HashSet;
import java.util.List;
import java.util.Set;

@CrossOrigin("*")
@RestController
@RequestMapping("/api/clientes")
public class ClientesRestController {
    @Autowired
    private ClientesService clientesService;
    @Autowired
    private DireccionesService direccionesService;
    @Autowired
    private UsuariosService usuariosService;
    @Autowired
    private PedidosService pedidosService;
    @Autowired
    private RolService rolService;
    @Autowired
    private PasswordEncoder passwordEncoder;

    @PutMapping("/{clienteId}")
    public ResponseEntity<?> actualizarCliente(@PathVariable Long clienteId, @RequestBody Cliente cliente) {
        Cliente clienteExistente = clientesService.findById(clienteId);
        if (clienteExistente == null) {
            return ResponseEntity.notFound().build();
        }

        Usuario usuarioExistente = clienteExistente.getUsuario();
        Usuario usuarioNuevo = cliente.getUsuario();

        if (usuarioExistente != null && usuarioNuevo != null) {
            BeanUtils.copyProperties(usuarioNuevo, usuarioExistente, getNullPropertyNames(usuarioNuevo));
        }
        BeanUtils.copyProperties(cliente, clienteExistente, getNullPropertyNames(cliente));
        clientesService.save(clienteExistente);
        if (usuarioExistente != null) {
            usuariosService.save(usuarioExistente);
        }

        return ResponseEntity.ok(clienteExistente);
    }

    @PostMapping("")
    @PreAuthorize("hasRole('ROLE_ADMIN')")
    public ResponseEntity<?> crearCliente(@RequestBody Cliente cliente) {
        if (cliente.getUsuario() == null) {
            return ResponseEntity.badRequest().body("El cliente debe tener un usuario asociado.");
        }

        Usuario usuario = cliente.getUsuario();
        usuario.setPassword(passwordEncoder.encode(usuario.getPassword()));

        Rol rolCliente = rolService.getByName(RolEnum.ROLE_CLIENTE);
        if (rolCliente == null) {
            return ResponseEntity.badRequest().body("El rol de cliente no existe.");
        }
        usuario.getRoles().add(rolCliente);
        Usuario usuarioGuardado = usuariosService.save(usuario);
        cliente.setUsuario(usuarioGuardado);
        Cliente clienteGuardado = clientesService.save(cliente);

        return ResponseEntity.ok(clienteGuardado);
    }

    private String[] getNullPropertyNames(Object source) {
        final BeanWrapper src = new BeanWrapperImpl(source);
        java.beans.PropertyDescriptor[] pds = src.getPropertyDescriptors();

        Set<String> emptyNames = new HashSet<>();
        for (java.beans.PropertyDescriptor pd : pds) {
            Object srcValue = src.getPropertyValue(pd.getName());
            if (srcValue == null) emptyNames.add(pd.getName());
        }
        String[] result = new String[emptyNames.size()];
        return emptyNames.toArray(result);
    }

    @DeleteMapping("/{clienteId}")
    @PreAuthorize("hasRole('ROLE_ADMIN')")
    public ResponseEntity<?> eliminarCliente(@PathVariable Long clienteId) {
        Cliente cliente = clientesService.findById(clienteId);
        if (cliente == null) {
            return ResponseEntity.notFound().build();
        }
        boolean tienePedidos = !pedidosService.findByCliente(cliente).isEmpty();
        boolean tieneDirecciones = !direccionesService.findByClienteId(clienteId).isEmpty();

        if (tienePedidos || tieneDirecciones) {
            return ResponseEntity.status(409).body("El cliente tiene pedidos o direcciones asociadas y no puede ser eliminado.");
        }
        clientesService.delete(cliente);
        usuariosService.delete(cliente.getUsuario());
        return ResponseEntity.noContent().build();
    }

    @GetMapping("")
    public List<Cliente> getAll() {
        List<Cliente> clientes = clientesService.findAll();
        return clientes;
    }

    @GetMapping("/{clienteId}/direcciones")
    public List<Direccion> getDirecciones(@PathVariable Long clienteId) {
        List<Direccion> direcciones = direccionesService.findByClienteId(clienteId);
        return direcciones;
    }

    @GetMapping("/{clienteId}")
    public Cliente getCliente(@PathVariable Long clienteId) {
        Cliente cliente = clientesService.findById(clienteId);
        return cliente;
    }


}
