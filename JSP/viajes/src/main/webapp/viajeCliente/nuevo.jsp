<%@ page contentType="text/html; charset=UTF-8"%>

<html>

<jsp:include page="../layouts/head.jsp"/>

<body>
<jsp:include page="../layouts/main_menu.jsp"/>
<div class="container">
    <h1>Nuevo viaje cliente</h1>

    <form method="post" action="viajes-clientes/nuevos">

        <jsp:include page="formulario.jsp">
            <jsp:param name="titleSubmit" value="Guardar"/>
            <jsp:param name="estiloSubmit" value="btn btn-dark float-end"/>
            <jsp:param name="readonly" value=""/>
        </jsp:include>

    </form>
</div>



<jsp:include page="../layouts/footer.jsp"/>
</body>
</html>
