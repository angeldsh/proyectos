@props(['action'=>''])
@switch($action)
    @case('show')
        <button class="bg-cyan-400 hover:bg-cyan-100  w-8 h-8 rounded">
            <i class="fa-solid fa-eye text-white"></i>
        </button>
        @break
    @case('update')
        <button class="bg-indigo-600 hover:bg-indigo-400  w-8 h-8  rounded">
            <i class="fa-solid fa-pen-to-square"></i>
        </button>
        @break
    @case('delete')
        <button class="bg-red-600 hover:bg-red-400 w-8 h-8  rounded">
            <i class="fa-solid fa-trash"></i>
        </button>
        @break
    @case('rent')
        <button class="bg-green-600 hover:bg-green-400 w-8 h-8 rounded">
            <i class="fa-solid fa-cart-plus"></i>
        </button>
        @break
    @case('rate')
        <button class="bg-yellow-600 hover:bg-yellow-400 w-8 h-8 rounded">
            <i class="fa-solid fa-star"></i>
        </button>
        @break

@endswitch
