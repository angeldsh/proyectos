<%@ page contentType="text/html; charset=UTF-8"%>

<html>

<jsp:include page="../layouts/head.jsp"/>

<body>
<jsp:include page="../layouts/main_menu.jsp"/>
<div class="container">

    <% if (request.getAttribute("mensaje") != null) { %>
    <div id="mensajeConfirmacion" class="alert alert-<%=
    (request.getAttribute("mensaje").equals("Viaje añadido correctamente") ||
    request.getAttribute("mensaje").equals("Viaje actualizado correctamente") ||
    request.getAttribute("mensaje").equals("Viaje eliminado correctamente")) ? "success" : "danger" %>" role="alert">
        <%= request.getAttribute("mensaje") %>
    </div>
    <% } %>

    <h1>Listado de viajes</h1>
    <a class="btn btn-dark" href="viajes/nuevos" style="float: right; margin-bottom: 10px"><i class="bi bi-plus-lg"></i></a>


    <jsp:include page="tabla_viaje.jsp"/>

</div>



<jsp:include page="../layouts/footer.jsp"/>
</body>
</html>
