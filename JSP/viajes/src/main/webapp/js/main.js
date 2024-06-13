function cargarViajesEmpleados(empleadoId) {
    // Selecciono el elemento donde voy a introducir el texto con el id 
    let contenedor = document.getElementById("viajesEmpleados");



    // Creo una solicitud AJAX para cargar los detalles de los viajes
    let solicitudAjax = new XMLHttpRequest();

    // Define una función que se ejecutará cuando cambie el estado de la solicitud
    solicitudAjax.onreadystatechange = function() {

        // Comprueba si la solicitud se ha completado (readyState 4) y si el estado es OK (código de estado 200)
        if (solicitudAjax.readyState === 4 && solicitudAjax.status === 200) {
            // Actualizo el contenido del contenedor "viajesEmpleados" con los detalles de los viajes
            contenedor.innerHTML = solicitudAjax.responseText;
        }

    };

    // Configuro la solicitud AJAX (GET) con la URL que incluye el empleadoId 
    solicitudAjax.open("GET", "viajes/listado?empleadoId=" + empleadoId, true);

    // Envía la solicitud AJAX al servidor
    solicitudAjax.send();
}


function cargarViajes() {
    // Obtener el elemento select con el id "selectViaje"
    let selectViaje = document.getElementById("selectViaje");
    // Obtener la opción seleccionada del select con la propiedad "selectedIndex" que devuelve el índice de la opción seleccionada
    let optionSelect = selectViaje.options[selectViaje.selectedIndex];

    // Obtengo el atributo "data-titulo" de la opción seleccionada, que contiene el título del viaje
    let viajeTitulo = optionSelect.getAttribute("data-titulo");

    if (viajeTitulo !== "") {
        // Realizar una solicitud AJAX para cargar la tabla de detalles usando el título del viaje
        let solicitudAjax = new XMLHttpRequest();

        // Configurar la solicitud AJAX (GET) con la URL que incluye el título del viaje
        solicitudAjax.open("GET", "viajes-clientes/listado?viajeTitulo=" + viajeTitulo, true);

        // Definir una función que se ejecutará cuando cambie el estado de la solicitud
        solicitudAjax.onreadystatechange = function () {
            if (solicitudAjax.readyState === 4 && solicitudAjax.status === 200) {
                // Ocultar la tabla inicial y mostrar la tabla filtrada
                let tablaInicial = document.getElementById("tablaInicial");
                tablaInicial.style.display = "none";

                let tablaViajes = document.getElementById("tablaViajes");
                tablaViajes.innerHTML = solicitudAjax.responseText;
            }
        };


        solicitudAjax.send();
    }
}

function cargarViajesClientes(clienteId) {

    let contenedor = document.getElementById("viajesClientes");
    let solicitudAJAX = new XMLHttpRequest();

    solicitudAJAX.onreadystatechange = function() {
        if (solicitudAJAX.readyState === 4 && solicitudAJAX.status === 200) {

            contenedor.innerHTML = solicitudAJAX.responseText;

        }
    };
    solicitudAJAX.open("GET", "clientes/listado?clienteId=" + clienteId, true);
    solicitudAJAX.send();
}
function visibilidadEmpleado() {
    let cont = document.getElementById("viajesEmpleados");
    //Si no está visible, lo muestra, si está visible, lo oculta
    if (cont.style.display !== "block") {
        cont.style.display = "block";
    } else {
        cont.style.display = "none";
    }
}
function visibilidadCliente() {
    let cont = document.getElementById("viajesClientes");
    //Si no está visible, lo muestra, si está visible, lo oculta
    if (cont.style.display !== "block") {
        cont.style.display = "block";
    } else {
        cont.style.display = "none";
    }
}
function visibilidadDescripcion(button) {
    //Encuentra el elemento más cercano al boton que sea un tr
    const descripcion = button.closest("tr").nextElementSibling;

    if (descripcion.style.display === "none") {
        // table-row es un valor de display que muestra la fila correctamente (no me funciona block)
        descripcion.style.display = "table-row";
        // Cambia el icono del boton segun si está visible o no
        button.querySelector("i").classList.remove("bi-arrow-right-circle");
        button.querySelector("i").classList.add("bi-arrow-down-circle");

    } else {
        descripcion.style.display = "none";
        button.querySelector("i").classList.remove("bi-arrow-down-circle");
        button.querySelector("i").classList.add("bi-arrow-right-circle");

    }
}

setTimeout(function() {
    let mensaje = document.getElementById("mensajeConfirmacion");
    if (mensaje) {
        mensaje.style.display = "none";
    }
}, 5000)
function filtro() {

    let contenedor = document.getElementById("viajesInicio");
    let titulo = document.getElementById("titulo").value;
    let descripcion = document.getElementById("descripcion").value;

    let solicitudAJAX = new XMLHttpRequest();

    solicitudAJAX.onreadystatechange = function() {
        if (solicitudAJAX.readyState === 4 && solicitudAJAX.status === 200) {

            contenedor.innerHTML = solicitudAJAX.responseText;

        }
    };
    switch (true) {
        case titulo !== "" && descripcion !== "":
            solicitudAJAX.open("GET", "viajes/listado?titulo=" + titulo + "&descripcion=" + descripcion, true);
            break;
        case titulo !== "":
            solicitudAJAX.open("GET", "viajes/listado?titulo=" + titulo, true);
            break;
        case descripcion !== "":
            solicitudAJAX.open("GET", "viajes/listado?descripcion=" + descripcion, true);
            break;
        default:
            break;
    }


    solicitudAJAX.send();
}
function limpiarFiltro() {
    document.getElementById("titulo").value = "";
    document.getElementById("descripcion").value = "";
}