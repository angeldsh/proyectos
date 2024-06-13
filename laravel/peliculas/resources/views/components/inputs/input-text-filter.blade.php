@props(['name', 'label', 'readonly' => false])
@php($id = 'filtro-'.uniqid())
<div class="w-full relative p-1">
    @isset($label)
        <label for="{{$id}}" class="text-xs block font-bold text-black mr-2 p-1">
            {{$label}}</label>
    @endisset
    <input id="{{$id}}" type="text" name="{{$name}}"
        @if($readonly) readonly @endif
        {{$attributes->merge(['class' => 'w-full px-2 py-1 border border-black focus:border-white
        focus:ring focus:ring-orange-200 rounded'])}}
    >
</div>
