<%@ page import="java.util.List" %>
<%@ page import="com.daw2.viajes.entity.Empleado" %>
<%@ page import="com.daw2.viajes.dao.impl.EmpleadoDaoImpl" %>

<%@ page contentType="text/html; charset=UTF-8" %>

<%
    List<Empleado> empleados = (List<Empleado>) request.getAttribute("empleados");
    EmpleadoDaoImpl empleadoDao = new EmpleadoDaoImpl();
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
        for (Empleado empleado : empleados) {
        String estiloFila = (primeraFila) ? "table-primary" : "";

    %>
    <tr class="<%=estiloFila%>">
        <td><%=empleado.getNif()%>
        </td>
        <td><%=empleado.getNombre()%>
        </td>
        <td><%=empleado.getApellido1()%>
        </td>
        <td><%=empleado.getApellido2()%>
        </td>
        <td><%=empleado.getEmail()%>
        </td>

        <td>
            <a href="empleados/borrar?id=<%=empleado.getId()%>" class="btn btn-danger btn-sm me-1"
               title="Borrar el empleado <%=empleado.getNombre()%>">
                <i class="bi bi-trash"></i>
            </a>
            <a href="empleados/ver?id=<%=empleado.getId()%>" class="btn btn-primary btn-sm me-1"
               title="Consultar el empleado <%=empleado.getNombre()%>">
                <i class="bi bi-eye"></i>

            </a>
            <a href="empleados/actualizar?id=<%=empleado.getId()%>" class="btn btn-success btn-sm"
               title="Actualizar el empleado <%=empleado.getNombre()%>">
                <i class="bi bi-pen"></i>
            </a>

            <button class="btn btn-warning btn-sm"
                    <% if (empleadoDao.empleadoTieneViaje(empleado.getId())) { %>
                    onclick="cargarViajesEmpleados(<%=empleado.getId()%>); visibilidadEmpleado()"
                    <% }%>
                    title="Ver viajes de el empleado <%=empleado.getNombre()%>">
                <i class="bi bi-airplane"></i>
            </button>
        </td>


    </tr>
    <%
        primeraFila = false;
        }%>
    </tbody>
</table>
<div id="viajesEmpleados"></div>
