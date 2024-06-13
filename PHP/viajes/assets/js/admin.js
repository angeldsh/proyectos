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
