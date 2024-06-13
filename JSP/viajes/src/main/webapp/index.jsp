<%@ page contentType="text/html; charset=UTF-8" pageEncoding="UTF-8" %>
<!DOCTYPE html>
<html>
<jsp:include page="layouts/head.jsp"/>
<body>
<jsp:include page="layouts/main_menu.jsp"/>
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop"
        onclick="limpiarFiltro();" style="float: right; margin-top: 5px; margin-right: 10px" title="Filtrar viajes">
    Filtrar <i class="bi bi-funnel"></i>
</button>
<h1>Viajes</h1>
<jsp:include page="modal.jsp"/>
<div id="viajesInicio"></div>
<br/>
<jsp:include page="layouts/footer.jsp"/>
</body>
</html>