<%@ page contentType="text/html; charset=UTF-8"%>

<html>

<jsp:include page="../layouts/head.jsp"/>

<body>
<jsp:include page="../layouts/main_menu.jsp"/>
<div class="container">
    <h1>Actualizar viaje</h1>

    <form method="post" action="viajes/actualizar">

        <jsp:include page="formulario_viaje.jsp">

            <jsp:param name="titleSubmit" value="Actualizar"/>

            <jsp:param name="estiloSubmit" value="btn btn-dark float-end"/>

            <jsp:param name="readonly" value=""/>

        </jsp:include>

    </form>

    <jsp:include page="tabla_viaje.jsp"/>
</div>



<jsp:include page="../layouts/footer.jsp"/>
</body>
</html>
