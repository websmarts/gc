@props([
    'to' => '#'
    ])

<a class="
        {{ $to == request()->url() ? ' bg-gray-200 text-gray-900 ' : ' text-gray-100 ' }} 
        flex 
        items-center 
        py-4 px-6 
        block 
        border-b-2
        border-gray-300

        hover:bg-teal-200 
        hover:bg-opacity-25
        hover:text-gray-100" 
        href="{{ $to }}"> 
            
    <span class="mx-4">{{ $slot }}</span>
</a>
