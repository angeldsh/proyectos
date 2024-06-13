<%@ page contentType="text/html; charset=UTF-8" %>

<html>

<jsp:include page="../layouts/head.jsp"/>

<body>
<jsp:include page="../layouts/main_menu.jsp"/>
<div class="container">
    <h1>Actualizar Cliente</h1>

    <form method="post" action="clientes/actualizar">

        <jsp:include page="formulario_cliente.jsp">

            <jsp:param name="titleSubmit" value="Actualizar"/>

            <jsp:param name="estiloSubmit" value="btn btn-dark float-end"/>

            <jsp:param name="readonly" value=""/>

        </jsp:include>

        <jsp:include page="tabla_cliente.jsp"/>
</div>


<jsp:include page="../layouts/footer.jsp"/>
</body>
</html>
