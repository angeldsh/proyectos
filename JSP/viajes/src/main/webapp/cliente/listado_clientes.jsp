<%@ page contentType="text/html; charset=UTF-8" %>

<html>

<jsp:include page="../layouts/head.jsp"/>

<body>
<jsp:include page="../layouts/main_menu.jsp"/>
<div class="container">
    <% if (request.getAttribute("mensaje") != null) { %>
    <div id="mensajeConfirmacion" class="alert alert-<%=
    (request.getAttribute("mensaje").equals("Cliente añadido correctamente") ||
    request.getAttribute("mensaje").equals("Cliente actualizado correctamente") ||
    request.getAttribute("mensaje").equals("Cliente eliminado correctamente")) ? "success" : "danger" %>" role="alert">
        <%= request.getAttribute("mensaje") %>
    </div>
    <% } %>

    <h1>Listado de clientes</h1>
    <a class="btn btn-dark" href="clientes/nuevos" style="float: right; margin-bottom: 10px"><i class="bi bi-plus-lg"></i></a>

    <jsp:include page="tabla_cliente.jsp"/>

</div>


<jsp:include page="../layouts/footer.jsp"/>
</body>
</html>
