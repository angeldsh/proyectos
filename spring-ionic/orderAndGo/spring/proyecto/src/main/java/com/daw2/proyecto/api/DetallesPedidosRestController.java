package com.daw2.proyecto.api;

import com.daw2.proyecto.model.entity.DetallePedido;
import com.daw2.proyecto.service.DetallesPedidosService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.List;

@CrossOrigin("*")
@RestController
@RequestMapping("/api/pedidos/detalles")
public class DetallesPedidosRestController {
    @Autowired
    private DetallesPedidosService detallesPedidosService;

    @GetMapping("")
    public List<DetallePedido> getAll() {
        List<DetallePedido> detallesPedidos = detallesPedidosService.findAll();
        return detallesPedidos;
    }

    @GetMapping("/{pedidoId}")
    public List<DetallePedido> getDetallesPedidoByPedidoId(@PathVariable Long pedidoId) {
        return detallesPedidosService.findByPedidoId(pedidoId);
    }

    @PostMapping("")
    public ResponseEntity<?> save(@RequestBody List<DetallePedido> detallesPedidos) {
        try {
            detallesPedidosService.saveAll(detallesPedidos);
            return ResponseEntity
                    .status(HttpStatus.OK)
                    .body(detallesPedidos);
        } catch (Exception ex) {
            return ResponseEntity
                    .status(HttpStatus.BAD_REQUEST)
                    .body("Detalles del pedido no guardados");
        }
    }

}
