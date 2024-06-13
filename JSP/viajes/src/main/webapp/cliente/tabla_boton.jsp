<%@ page import="java.util.List" %>


<%@ page import="com.daw2.viajes.entity.ViajeCliente" %>

<%@ page contentType="text/html; charset=UTF-8" %>

<%
    List<ViajeCliente> viajesClientes = (List<ViajeCliente>) request.getAttribute("viajesClientes");
    double totalPagado = 0;
    double totalFaltaPorPagar = 0;
%>
<h1>Viajes contratados por el cliente
    <%= viajesClientes.get(0).getCliente().getNombre() + ' '+
    viajesClientes.get(0).getCliente().getApellido1() + ' '+
    viajesClientes.get(0).getCliente().getApellido2()%></h1>
<table class="table table-secondary table-hover">
    <thead>
    <tr class="text-center">

        <td class="bg-dark text-white">Viaje</td>

        <td class="bg-dark text-white">Pagado</td>

        <td class="bg-dark text-white">A pagar</td>

    </tr>
    </thead>
    <tbody>
    <% if (viajesClientes != null) {%>
    <%
        boolean primeraFila = true;
        for (ViajeCliente viajeCliente : viajesClientes) {
        double pagado = viajeCliente.getPagado();
        double precio = viajeCliente.getViaje().getPrecio();
        String estiloFila = (primeraFila) ? "table-primary" : "";


        totalPagado += pagado;
        totalFaltaPorPagar += (precio - pagado);
    %>
    <tr class="text-center <%=estiloFila%>">
        <td><%=(viajeCliente.getViaje() != null) ? viajeCliente.getViaje().getTitulo() : ""%>
        </td>

        <td><%=viajeCliente.getPagado()%> €</td>

        <td><%=viajeCliente.getViaje().getPrecio() - viajeCliente.getPagado()%> €</td>

    </tr>
    <%
        primeraFila = false;
        }%>
    <%}%>
    </tbody>
    <tfoot>
    <tr class="text-center">
        <td class="bg-dark text-white">Total</td>
        <td class="bg-dark text-white"><%= totalPagado %> €</td>
        <td class="bg-dark text-white"><%= totalFaltaPorPagar %> €</td>
    </tfoot>
</table>
