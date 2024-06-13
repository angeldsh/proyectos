<%@ page contentType="text/html; charset=UTF-8"%>

<html>

<jsp:include page="../layouts/head.jsp"/>

<body>
<jsp:include page="../layouts/main_menu.jsp"/>
<div class="container">
    <% if (request.getAttribute("mensaje") != null) { %>
    <div id="mensajeConfirmacion" class="alert alert-<%=
    (request.getAttribute("mensaje").equals("Viaje Cliente añadido correctamente") ||
    request.getAttribute("mensaje").equals("Viaje Cliente actualizado correctamente") ||
    request.getAttribute("mensaje").equals("Viaje Cliente eliminado correctamente")) ? "success" : "danger" %>" role="alert">
        <%= request.getAttribute("mensaje") %>
    </div>
    <% } %>
    <h1>Listado de viajes clientes</h1>
    <a class="btn btn-dark" href="viajes-clientes/nuevos" style="float: right; margin-bottom: 10px"><i class="bi bi-plus-lg"></i></a>



    <jsp:include page="tabla.jsp"/>
</div>



<jsp:include page="../layouts/footer.jsp"/>
</body>
</html>
