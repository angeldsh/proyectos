<%@ page import="java.util.List" %>
<%@ page import="com.daw2.viajes.entity.Viaje" %>
<%@ page import="com.daw2.viajes.entity.ViajeCliente" %>

<%@ page contentType="text/html; charset=UTF-8" %>

<%
    List<Viaje> viajes = (List<Viaje>) request.getAttribute("viajes");

    if (viajes != null) {
%>

<table class="table table-secondary table-hover">
    <thead>
    <tr class="text-center">
        <td class="bg-dark text-white">Ref</td>
        <td class="bg-dark text-white">Título</td>
        <td class="bg-dark text-white">NºParticipantes</td>
        <td class="bg-dark text-white">Precio</td>
        <td class="bg-dark text-white">Empleado</td>
        <td class="bg-dark text-white">Ingresado</td>
        <td class="bg-dark text-white">A ingresar</td>
        <td class="bg-dark text-white" style="width: 170px;"></td>
    </tr>
    </thead>
    <tbody>
    <%
        boolean primeraFila = true;
        for (Viaje viaje : viajes) {
            List<ViajeCliente> viajesClientes = (List<ViajeCliente>) request.getAttribute("viajesClientes");
            String estiloFila = (primeraFila) ? "table-primary" : "";
            double totalIngresado = 0;
            double totalIngresar = 0;
            if (viajesClientes != null) {
                for (ViajeCliente viajeCliente : viajesClientes) {
                    if (viajeCliente.getViaje().getId().equals(viaje.getId())) {
                        double pagado = viajeCliente.getPagado();
                        double precio = viaje.getPrecio();
                        totalIngresado += pagado;
                        totalIngresar += (precio - pagado);
                    }
                }
            }
    %>
    <tr class="text-center <%=estiloFila%>">
        <td><%= viaje.getCodigo() %>
        </td>
        <td><%= viaje.getTitulo() %>
        </td>
        <td><%= viaje.getNumParticipantes() %>
        </td>
        <td><%= viaje.getPrecio() %>
        </td>
        <td><%= (viaje.getEmpleado() != null) ? viaje.getEmpleado().getNombre() : "" %>
        </td>
        <td><%= totalIngresado %> €</td>
        <td><%= totalIngresar %> €</td>
        <td>
            <a href="viajes/borrar?id=<%= viaje.getId() %>" class="btn btn-danger btn-sm me-1"
               title="Borrar el viaje <%= viaje.getTitulo() %>">
                <i class="bi bi-trash"></i>
            </a>
            <a href="viajes/ver?id=<%= viaje.getId() %>" class="btn btn-primary btn-sm me-1"
               title="Consultar el viaje <%= viaje.getTitulo() %>">
                <i class="bi bi-eye"></i>
            </a>
            <a href="viajes/actualizar?id=<%= viaje.getId() %>" class="btn btn-success btn-sm"
               title="actualizar el viaje <%= viaje.getTitulo() %>">
                <i class="bi bi-pen"></i>
            </a>
            <button class="btn btn-sm" onclick="visibilidadDescripcion(this)"
                    title="Ver descripcion del viaje <%= viaje.getTitulo() %>">
                <i class="bi bi-arrow-right-circle"></i>
            </button>
        </td>

    </tr>
    <tr style="display: none;">
        <td colspan="8" style="background-color: #f8efc2;">
            <div><b>Descripción:</b> <br>
                <%= viaje.getDescripcion() %>
            </div>
        </td>
    </tr>

    <%
                primeraFila = false;
            }
        }
    %>
    </tbody>
</table>
