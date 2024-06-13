package com.daw2.proyecto.api;

import com.daw2.proyecto.model.entity.Direccion;
import com.daw2.proyecto.model.entity.Pedido;
import com.daw2.proyecto.service.DireccionesService;
import com.daw2.proyecto.service.PedidosService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.List;

@CrossOrigin("*")
@RestController
@RequestMapping("/api/direcciones")
public class DireccionesRestController {
    @Autowired
    private DireccionesService direccionService;

    @Autowired
    private PedidosService pedidosService;

    @PostMapping("")
    public ResponseEntity<?> postDireccion(@RequestBody Direccion direccion) {
        try {
            return ResponseEntity.ok(direccionService.save(direccion));
        } catch (Exception e) {
            return ResponseEntity.status(HttpStatus.INTERNAL_SERVER_ERROR).body("Error al guardar la direccion");
        }
    }

    @PutMapping("")
    public ResponseEntity<?> putDireccion(@RequestBody Direccion direccion) {
        try {
            return ResponseEntity.ok(direccionService.save(direccion));
        } catch (Exception e) {
            return ResponseEntity.status(HttpStatus.INTERNAL_SERVER_ERROR).body("Error al guardar la direccion");
        }
    }

    @DeleteMapping("/{direccionId}")
    public ResponseEntity<?> deleteDireccion(@PathVariable Long direccionId) {
        try {
            Direccion direccion = direccionService.findById(direccionId);
            List<Pedido> pedido = pedidosService.findByDireccion(direccion);
            if (!pedido.isEmpty()) {
                return ResponseEntity.status(HttpStatus.CONFLICT).body("No se puede eliminar la direccion porque tiene pedidos asociados");
            }

            direccionService.deleteById(direccionId);
            return ResponseEntity.ok().build();
        } catch (Exception e) {
            return ResponseEntity.status(HttpStatus.INTERNAL_SERVER_ERROR).body("Error al eliminar la direccion");
        }
    }


}
