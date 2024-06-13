<%@ page import="com.daw2.viajes.entity.Viaje" %>
<%@ page import="java.util.List" %>
<%@ page import="com.daw2.viajes.entity.Cliente" %>
<%@ page import="com.daw2.viajes.entity.ViajeCliente" %>
<%@ page contentType="text/html; charset=UTF-8"%>
<%
    List<Cliente> clientes = (List<Cliente>) request.getAttribute("clientes");
    List<Viaje> viajes = (List<Viaje>) request.getAttribute("viajes");



    String readonly = request.getParameter("readonly");


    ViajeCliente viajeCliente= (ViajeCliente) request.getAttribute("viajeCliente");
    if(viajeCliente ==null) {
        viajeCliente= new ViajeCliente();
    }
    String id = viajeCliente.getId() != null ? String.valueOf(viajeCliente.getId()): "";
    Cliente cliente = viajeCliente.getCliente() != null ? viajeCliente.getCliente() : null;
    Viaje viaje = viajeCliente.getViaje() != null ? viajeCliente.getViaje() : null;


    String pagado = viajeCliente.getPagado() != null ? String.valueOf(viajeCliente.getPagado()): "";

%>

    <input type="hidden" name="id" value="<%=id%>">
    <div class="card m-2">
        <div class="card-header text-center fw-bold">
            Viaje
        </div>
        <div class="card-body bg-light-subtle">
            <div class="row mb-3">

                <div class="col-12 col-md-4 form-floating">
                    <select name="viaje" id="selectViaje" class="form-select" onchange="cargarViajes()" value="<%=readonly%>">
                        <%
                            if (!readonly.equals("readonly") && viajes != null) {
                        %>
                        <option value="" data-titulo=""><%= (viaje != null) ? viaje.getTitulo() : "Selecciona un viaje"%></option>
                        <%
                            for (Viaje viajeSelect : viajes) {
                        %>
                        <option value="<%= viajeSelect.getId() %>" data-titulo="<%= viajeSelect.getTitulo() %>"><%= viajeSelect.getTitulo() %></option>
                        <%
                            }
                        } else { %>
                        <option value="" data-titulo=""><%= (viaje != null) ? viaje.getTitulo() : "" %></option>
                        <% }%>
                    </select>


                </div>
                <div class="col-12 col-md-4 form-floating">
                    <select name="cliente" class="form-select" value="<%=readonly%>">

                        <%
                            if (!readonly.equals("readonly") && clientes != null) {
                        %>
                        <option value=""><%= (cliente != null) ? cliente.getNombre() : "Selecciona un cliente"%></option>
                        <%
                            for (Cliente clienteSelect : clientes) {
                        %>
                        <option value="<%= clienteSelect.getId() %>"><%= clienteSelect.getNombre() + ' ' + clienteSelect.getApellido1() %></option>
                        <%
                            }
                            }else{ %>
                        <option value=""><%= (cliente != null) ? cliente.getNombre() : "" %></option>

                        <% }%>

                    </select>

                </div>
                <div class="col-12 col-md-4 form-floating">
                    <input type="number" class="form-control" id="pagado" name="pagado" placeholder="Introduce cuanto has pagado del viaje"
                           value="<%=pagado%>" <%=readonly%>>
                    <label for="pagado">Pagado</label>
                </div>

            </div>

            <div class="card-footer">

                <input class="<%=request.getParameter("estiloSubmit")%>" name="btGuardar" type="submit"  value="<%=request.getParameter("titleSubmit")%>"/><br>
            </div>

        </div>
        </div>

        <div id="tablaInicial">
            <jsp:include page="tabla.jsp"/>
        </div>

        <div id="tablaViajes"></div>