<%@ page contentType="text/html; charset=UTF-8" %>

<html>

<jsp:include page="../layouts/head.jsp"/>

<body>
<jsp:include page="../layouts/main_menu.jsp"/>
<div class="container">
    <h1>Ver Cliente</h1>

    <form method="post" action="clientes/ver">

        <jsp:include page="formulario_cliente.jsp">

            <jsp:param name="titleSubmit" value=""/>

            <jsp:param name="estiloSubmit" value="btn hidden-button"/>

            <jsp:param name="readonly" value="readonly"/>

        </jsp:include>

</div>

<jsp:include page="../layouts/footer.jsp"/>
</body>
</html>
