package com.daw2.proyecto.model.repository;


import com.daw2.proyecto.model.entity.DetallePedido;
import com.daw2.proyecto.model.entity.Producto;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

import java.util.List;

@Repository
public interface DetallePedidoRepository extends JpaRepository<DetallePedido, Long> {

    List<DetallePedido> findByPedidoId(Long pedidoId);

    Long deleteDetallesByPedidoId(Long id);

    DetallePedido findByProducto(Producto producto);
}
