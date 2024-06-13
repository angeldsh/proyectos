<%@ page import="java.util.List" %>


<%@ page import="com.daw2.viajes.entity.ViajeCliente" %>

<%@ page contentType="text/html; charset=UTF-8" %>

<%
    List<ViajeCliente> viajesClientes = (List<ViajeCliente>) request.getAttribute("viajesClientes");
%>


<table class="table table-secondary table-hover">
    <thead>
    <tr class="text-center">

        <td class="bg-dark text-white">Viaje</td>

        <td class="bg-dark text-white">Cliente</td>
        <td class="bg-dark text-white">Pagado</td>


        <td class="bg-dark text-white" style="width: 150px;"></td>
    </tr>
    </thead>
    <tbody>
    <% if (viajesClientes != null) {%>
    <%
        boolean primeraFila = true;
        for (ViajeCliente viajeCliente : viajesClientes) {
            String estiloFila = (primeraFila) ? "table-primary" : "";
    %>
    <tr class="text-center <%=estiloFila%>">
        <td><%=(viajeCliente.getViaje() != null) ? viajeCliente.getViaje().getTitulo() : ""%>
        </td>
        <td><%=(viajeCliente.getCliente() != null) ? viajeCliente.getCliente().getNombre() : ""%>
        </td>
        <td><%=viajeCliente.getPagado()%>
        </td>

        <td>
            <a href="viajes-clientes/borrar?id=<%=viajeCliente.getId()%>" class="btn btn-danger btn-sm me-1" title="Borrar el viaje cliente
            <%=(viajeCliente.getCliente()!=null && viajeCliente.getViaje() !=null) ? viajeCliente.getCliente().getNombre() + ' ' + viajeCliente.getViaje().getTitulo(): ""%>">
                <i class="bi bi-trash"></i>
            </a>
            <a href="viajes-clientes/ver?id=<%=viajeCliente.getId()%>" class="btn btn-primary btn-sm me-1" title="Consultar el viaje cliente
            <%=(viajeCliente.getCliente()!=null && viajeCliente.getViaje() !=null) ? viajeCliente.getCliente().getNombre() + ' ' + viajeCliente.getViaje().getTitulo(): ""%>">
                <i class="bi bi-eye"></i>
            </a>
            <a href="viajes-clientes/actualizar?id=<%=viajeCliente.getId()%>" class="btn btn-success btn-sm" title="actualizar el viaje cliente
            <%=(viajeCliente.getCliente()!=null && viajeCliente.getViaje() !=null) ? viajeCliente.getCliente().getNombre() + ' ' + viajeCliente.getViaje().getTitulo(): ""%>">
                <i class="bi bi-pen"></i>
            </a>
        </td>


    </tr>
    <%
            primeraFila = false;
        }%>
    <%}%>
    </tbody>
</table>
