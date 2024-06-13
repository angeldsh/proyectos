function visibilidadDescripcion(button) {
    //Encuentra el elemento más cercano al boton que sea un tr
    const descripcion = button.closest("tr").nextElementSibling;

    if (descripcion.style.display === "none") {
        // table-row es un valor de display que muestra la fila correctamente
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

/**
 * Función asíncrona para cargar los viajes-clientes en el select de contrata.
 */
async function cargarViajes() {
    const selectViaje = document.getElementById("selectViaje");
    const optionSelect = selectViaje.options[selectViaje.selectedIndex];
    const viajeTitulo = optionSelect.getAttribute("data-titulo");

    if (viajeTitulo !== "") {
        try {
            const response = await fetch(`http://localhost:8080/viajes/viajes-clientes/filtro?titulo=${viajeTitulo}`, {
                method: 'GET'
            });

            if (response.ok) {
                const tablaViajes = document.getElementById("tablaViajes");
                tablaViajes.innerHTML = await response.text();
            } else {
                throw new Error('Error en la solicitud');
            }
        } catch (error) {
            console.error('Error:', error);
        }
    }
}


/**
 * Función asíncrona para filtrar los viajes por título y/o descripción.
 */
async function filtro() {
    const contenedor = document.getElementById("galeriaFiltrada");
    const titulo = document.getElementById("titulo").value;
    const descripcion = document.getElementById("descripcion").value;

    let url = "http://localhost:8080/viajes/viajes/filtro?";
    if (titulo !== "") {
        url += `titulo=${titulo}`;
        if (descripcion !== "") {
            url += `&descripcion=${descripcion}`;
        }
    } else if (descripcion !== "") {
        url += `descripcion=${descripcion}`;
    }

    try {
        const response = await fetch(url, {
            method: 'GET',
        });


        if (response.ok) {
            const galeriaInicial = document.getElementById("galeriaInicial");
            if (galeriaInicial) {
                galeriaInicial.style.display = "none";
            }
            // Obtener los datos de la respuesta como texto
            const data = await response.text();

            // Mostrar los datos en el contenedor
            contenedor.innerHTML = data;
        } else {
            throw new Error('Error en la solicitud');
        }
    } catch (error) {
        console.error('Error:', error);
    }
}

function limpiarFiltro() {
    document.getElementById("titulo").value = "";
    document.getElementById("descripcion").value = "";
}