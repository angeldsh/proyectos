<%@ page import="java.util.List" %>
<%@ page import="com.daw2.viajes.entity.Cliente" %>
<%@ page import="com.daw2.viajes.dao.impl.ClienteDaoImpl" %>

<%@ page contentType="text/html; charset=UTF-8"%>

<%
  List <Cliente> clientes = (List<Cliente>) request.getAttribute("clientes");
  ClienteDaoImpl clienteDao = new ClienteDaoImpl();
%>



<table class="table table-secondary table-hover">
  <thead>
  <tr>
    <td class="bg-dark text-white">Nif</td>
    <td class="bg-dark text-white">Nombre</td>
    <td class="bg-dark text-white">Apellido 1º</td>
    <td class="bg-dark text-white">Apellido 2º</td>
    <td class="bg-dark text-white">Email</td>
    <td class="bg-dark text-white" style="width: 170px;"></td>


  </tr>
  </thead>
  <tbody>
  <%
    boolean primeraFila = true;
    for(Cliente cliente: clientes){
    String estiloFila = (primeraFila) ? "table-primary" : "";
  %>
  <tr class="<%=estiloFila%>">
    <td><%=cliente.getNif()%></td>
    <td><%=cliente.getNombre()%></td>
    <td><%=cliente.getApellido1()%></td>
    <td><%=cliente.getApellido2()%></td>
    <td><%=cliente.getEmail()%></td>



    <td>
      <a href="clientes/borrar?id=<%=cliente.getId()%>" class="btn btn-danger btn-sm me-1" title="Borrar el cliente <%=cliente.getNombre()%>">
        <i class="bi bi-trash"></i>
      </a>
      <a href="clientes/ver?id=<%=cliente.getId()%>" class="btn btn-primary btn-sm me-1" title="Consultar el cliente <%=cliente.getNombre()%>">
        <i class="bi bi-eye"></i>
      </a>
      <a href="clientes/actualizar?id=<%=cliente.getId()%>" class="btn btn-success btn-sm" title="Actualizar el cliente <%=cliente.getNombre()%>" >
        <i class="bi bi-pen"></i>
      </a>
      <button class="btn btn-warning btn-sm"
              <% if (clienteDao.clienteTieneViaje(cliente.getId())){ %>
              onclick="cargarViajesClientes(<%=cliente.getId()%>); visibilidadCliente()"
              <% }%>
              title="Ver viajes de el cliente <%=cliente.getNombre()%>">
        <i class="bi bi-airplane"></i>
      </button>
    </td>

  </tr>
  <%
    primeraFila = false;
    }%>
  </tbody>
</table>
<div id="viajesClientes"></div>