@props(['id','name', 'label','item', 'readonly' => false])

<div class="w-full">
    @isset($label)
        <label for="{{$id}}" class="text-xs block font-bold text-blue-900 mr-2 p-1">
            {{$label}}</label>
    @endisset

    @if($readonly)
        @if(!empty($item))
            <img src="{{asset($item)}}">
            @else
            <img src="{{asset('images/imagen_no_disponible.png')}}">
        @endif
    @else
        <div class="text-center">
            <input onchange="showPreview(event)" id="{{$id}}" @isset($name) name="{{$name}}" @endisset type="file">
            <img id="preview"
            @if(!empty($item))
                src="{{asset($item)}}"
            @endif
            >
        </div>
    @endif
    @error("$name")
        <div class="block px-2 italic font-s text-left text-red-500 text-xs">
            {!! $message !!} {{--Cuidado con la seguridad aquí--}}
        </div>
        @enderror
</div>
@push('scripts')
        <script>
            function showPreview(event) {
                if (event.target.files.length > 0) {
                    let src = URL.createObjectURL(event.target.files[0]);
                    let preview = document.getElementById('preview');
                    preview.src = src;
                    preview.style.display = "block";
                }
            }
        </script>
@endpush
