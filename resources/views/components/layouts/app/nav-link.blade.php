@props([
    'to' => '#',
    'color'=>'teal'
    ])

    <a  href="{{ $to }}" class="
    {{ $to == request()->url() ? ' bg-'.$color.'-800 text-white' : ' text-gray-100  hover:text-white hover:bg-'.$color.'-700' }} 
    group flex items-center px-4  py-4
    text-sm leading-5 
    font-medium  
    focus:outline-none focus:bg-{{$color}}-700 
    transition ease-in-out duration-150">
                    
    {{ $slot }}
    </a>

    


