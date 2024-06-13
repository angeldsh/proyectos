<%@ page contentType="text/html; charset=UTF-8" %>

<html>

<jsp:include page="../layouts/head.jsp"/>

<body>
<jsp:include page="../layouts/main_menu.jsp"/>
<div class="container">
    <% if (request.getAttribute("mensaje") != null) { %>
    <div id="mensajeConfirmacion" class="alert alert-<%=
    (request.getAttribute("mensaje").equals("Empleado añadido correctamente") ||
    request.getAttribute("mensaje").equals("Empleado actualizado correctamente") ||
    request.getAttribute("mensaje").equals("Empleado eliminado correctamente")) ? "success" : "danger" %>" role="alert">
        <%= request.getAttribute("mensaje") %>
    </div>

    <% } %>

    <h1>Listado de empleados</h1>
    <a class="btn btn-dark" href="empleados/nuevos" style="float: right; margin-bottom: 10px"><i class="bi bi-plus-lg"></i></a>


    <jsp:include page="tabla_empleado.jsp"/>

</div>


<jsp:include page="../layouts/footer.jsp"/>
</body>
</html>
