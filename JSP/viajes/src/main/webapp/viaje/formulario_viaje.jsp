<%@ page import="com.daw2.viajes.entity.Viaje" %>
<%@ page import="java.text.SimpleDateFormat" %>
<%@ page import="com.daw2.viajes.entity.Empleado" %>
<%@ page import="java.util.List" %>
<%@ page import="java.util.ArrayList" %>
<%@ page import="java.util.Objects" %>
<%@ page contentType="text/html; charset=UTF-8" %>
<%
    List<Empleado> empleados = (List<Empleado>) request.getAttribute("empleados");

    String readonly = request.getParameter("readonly");

    Viaje viaje = (Viaje) request.getAttribute("viaje");
    if (viaje == null) {
        viaje = new Viaje();
    }
    String id = viaje.getId() != null ? String.valueOf(viaje.getId()) : "";
    String codigo = viaje.getCodigo() != null ? viaje.getCodigo() : "";
    String titulo = viaje.getTitulo() != null ? viaje.getTitulo() : "";
    Empleado empleado = viaje.getEmpleado() != null ? viaje.getEmpleado() : null;
    String descripcion = viaje.getDescripcion() != null ? viaje.getDescripcion() : "";
    String numParticipantes = viaje.getNumParticipantes() != null ? String.valueOf(viaje.getNumParticipantes()) : "";
    String salida = viaje.getSalida() != null ? new SimpleDateFormat("yyyy-MM-dd").format(viaje.getSalida()) : "";
    String llegada = viaje.getLlegada() != null ? new SimpleDateFormat("yyyy-MM-dd").format(viaje.getLlegada()) : "";
    String precio = viaje.getPrecio() != null ? String.valueOf(viaje.getPrecio()) : "";

%>

<link href="../asset/main.css" rel="stylesheet">

<input type="hidden" name="id" value="<%=id%>">
<div class="card m-2">
    <div class="card-header text-center fw-bold">
        Nuevo Viaje
    </div>
    <div class="card-body bg-light-subtle">
        <div class="row mb-3">
            <div class="col-12 col-md-4 form-floating">
                <input type="text" class="form-control" id="codigo" name="codigo"
                       placeholder="Introduce el código del viaje"
                       value="<%=codigo%>" <%=readonly%>>
                <label for="codigo">Código</label>
            </div>
            <div class="col-12 col-md-4 form-floating">
                <input type="text" class="form-control" id="titulo" name="titulo"
                       placeholder="Introduce el titulo del viaje"
                       value="<%=titulo%>" <%=readonly%>>
                <label for="titulo">Titulo</label>
            </div>
            <div class="col-12 col-md-4 form-floating">
                <select name="empleado" class="form-select" value="<%=readonly%>">

                    <%
                        if (!readonly.equals("readonly") && empleados != null) {
                    %>
                    <option value=""><%= (empleado != null) ? empleado.getNombre() : "Selecciona un empleado"%></option>
                    <%
                        for (Empleado empleadoSelect : empleados) {
                    %>
                    <option value="<%= empleadoSelect.getId() %>"><%= empleadoSelect.getNombre() + ' ' + empleadoSelect.getApellido1() %>
                    </option>
                    <%
                        }
                    } else { %>
                    <option value=""><%= (empleado != null) ? empleado.getNombre() : "" %>
                    </option>
                    <% }%>
                </select>

            </div>

        </div>
        <div class="row mb-3">
            <div class="col-12 col-md-12 form-floating">
                <textarea id="descripcion" name="descripcion" placeholder="Introduce la descripción del viaje"
                          class="form-control" rows="4" <%=readonly%>><%=descripcion%></textarea>
                <label for="descripcion">Descripcion</label>

            </div>
        </div>

        <div class="row mb-3">
            <div class="col-12 col-md-4 form-floating">
                <input type="date" class="form-control" id="salida" name="salida"
                       placeholder="Selecciona la fecha de salida"
                       value="<%=salida%>" <%=readonly%>>
                <label for="salida">Fecha de Salida</label>
            </div>
            <div class="col-12 col-md-4 form-floating">
                <input type="date" class="form-control" id="llegada" name="llegada"
                       placeholder="Selecciona la fecha de llegada"
                       value="<%=llegada%>" <%=readonly%>>
                <label for="llegada">Fecha de Llegada</label>
            </div>
            <div class="col-12 col-md-2 form-floating">
                <input type="number" class="form-control" id="precio" name="precio"
                       placeholder="Introduce el precio del viaje"
                       value="<%=precio%>" <%=readonly%>>
                <label for="precio">Precio</label>
            </div>
            <div class="col-12 col-md-2 form-floating">
                <input type="number" class="form-control" id="numParticipantes" name="numParticipantes"
                       placeholder="Introduce el numero de participantes"
                       value="<%=numParticipantes%>" <%=readonly%>>
                <label for="numParticipantes">Plazas</label>
            </div>

        </div>
        <div class="card-footer">

            <input class="<%=request.getParameter("estiloSubmit")%>" name="btGuardar" type="submit"
                   value="<%=request.getParameter("titleSubmit")%>"/><br>
        </div>
    </div>
</div>