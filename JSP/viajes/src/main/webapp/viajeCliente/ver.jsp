<%@ page contentType="text/html; charset=UTF-8"%>

<html>

<jsp:include page="../layouts/head.jsp"/>

<body>
<jsp:include page="../layouts/main_menu.jsp"/>
<div class="container">
    <h1>Ver viaje</h1>

    <form method="post" action="viajes-clientes/ver">

        <jsp:include page="formulario.jsp">

            <jsp:param name="titleSubmit" value=""/>

            <jsp:param name="estiloSubmit" value="btn hidden-button"/>

            <jsp:param name="readonly" value="readonly"/>

        </jsp:include>

</div>


</div>



<jsp:include page="../layouts/footer.jsp"/>
</body>
</html>
