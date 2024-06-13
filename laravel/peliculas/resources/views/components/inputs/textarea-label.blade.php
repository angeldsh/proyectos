@props(['id','name', 'label','item', 'readonly' => false])

<div class="w-full">
    @isset($label)
        <label for="{{$id}}" class="text-xs block font-bold text-violet-900 mr-2 p-1">
            {{$label}}</label>
    @endisset
    <textarea id="{{$id}}" @isset($name) name="{{$name}}" @endisset
        @if($readonly) readonly @endif
        {{$attributes->merge(['class' => 'w-full px-2 py-1 border border-violet-400 focus:border-black
        focus:ring focus:ring-orange-200 rounded'])}}
    >{{old("$name", $item)}}</textarea>
    @error("$name")
        <div class="block px-2 italic font-s text-left text-red-500 text-xs">
            {!! $message !!} {{--Cuidado con la seguridad aquí--}}
        </div>
        @enderror
</div>
