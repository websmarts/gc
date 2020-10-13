@props([
    'to' => '#'
    ])

    <a  href="{{ $to }}" class="
    {{ $to == request()->url() ? ' bg-indigo-800 text-white' : ' text-indigo-300  hover:text-white hover:bg-indigo-700' }} 
    group flex items-center px-2 py-2 
    text-sm leading-5 
    font-medium  rounded-md 
    focus:outline-none focus:bg-indigo-700 
    transition ease-in-out duration-150">
                    
    {{ $slot }}
    </a>

    


