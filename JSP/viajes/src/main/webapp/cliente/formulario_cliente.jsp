<%@ page import="com.daw2.viajes.entity.Cliente" %>
<%@ page contentType="text/html; charset=UTF-8"%>

<%
    String readonly = request.getParameter("readonly");
    Cliente cliente = (Cliente) request.getAttribute("cliente");
    if(cliente ==null) {
        cliente = new Cliente();
    }
    String id = cliente.getId() != null ? String.valueOf(cliente.getId()): "";
    String email = cliente.getEmail() != null ? cliente.getEmail() : "";
    String nif = cliente.getNif() != null ? cliente.getNif() : "";
    String nombre = cliente.getNombre() != null ? cliente.getNombre() : "";
    String apellido1 = cliente.getApellido1() != null ? cliente.getApellido1() : "";
    String apellido2 = cliente.getApellido2() != null ? cliente.getApellido2() : "";

%>
<link href="../asset/main.css" rel="stylesheet">
<input type="hidden" name="id" value="<%=id%>">

<div class="card m-2">
    <div class="card-header text-center fw-bold">
        Encuesta
    </div>
    <div class="card-body bg-light-subtle">
        <div class="row mb-3">
            <div class="col-12 col-md-6 form-floating">
                <input type="email" class="form-control" id="email" name="email" placeholder="introduce el email"
                       value="<%=email%>" <%=readonly%>>
                <label for="email">Email</label>
            </div>
            <div class="col-12 col-md-6 form-floating">
                <input type=nif" class="form-control" id="nif" name="nif" placeholder="introduce el nif"
                       value="<%=nif%>" <%=readonly%>>
                <label for="nif">Nif</label>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-12 col-md-4 form-floating">
                <input type="nombre" class="form-control" id="nombre" name="nombre" placeholder="introduce el nombre"
                       value="<%=nombre%>" <%=readonly%>>
                <label for="nombre">Nombre</label>
            </div>
            <div class="col-12 col-md-4 form-floating">
                <input type=apellido1" class="form-control" id="apellido1" name="apellido1" placeholder="introduce el apellido1"
                       value="<%=apellido1%>" <%=readonly%>>
                <label for="apellido1">Apellido 1º</label>
            </div>
            <div class="col-12 col-md-4 form-floating">
                <input type=apellido2" class="form-control" id="apellido2" name="apellido2" placeholder="introduce el apellido2"
                       value="<%=apellido2%>" <%=readonly%>>
                <label for="apellido2">Apellido 2º</label>
            </div>
        </div>

    </div>

    <div class="card-footer">
        <input class="<%=request.getParameter("estiloSubmit")%>" name="btGuardar" type="submit"  value="<%=request.getParameter("titleSubmit")%>"/><br>
    </div>
</div>
