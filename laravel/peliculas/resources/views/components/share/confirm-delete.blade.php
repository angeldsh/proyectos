@props((['id'=>'delete-'.uniqid(),'url']))

<span>
    <a onclick="muestraDialogoDelete('{{$id}}')">
        <x-buttons.button-table action="delete"/>
    </a>
    <form id="{{$id}}" action="{{$url}}" method="post">
        @csrf
        @method('DELETE')
    </form>
</span>
@pushonce('scripts')
<script>
    function muestraDialogoDelete(formId){
        Swal.fire({
            title: "¿Seguro que desea borrar el registro?",
            text: "No podrá deshacer el borrado ;)",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Eliminar",
            cancelButtonText:"Salir",
        }).then((result) => {
            if (result.isConfirmed) {
               document.getElementById(formId).submit();
            }
        });
    }
</script>
@endpushonce
