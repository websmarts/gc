@props([
    'to' => '#',
    'color'=>'indigo',

    ])

    <a  href="{{ $to }}" 
    
    {{ $attributes->merge(['class' =>"
   
    inline-block
    px-4  py-4
    
    leading-5 
    font-medium  
    bg-".$color."-700
    focus:outline-none
    focus:bg-".$color."-500 
    hover:bg-".$color."-500 
    "])}}>
                    
    {{ $slot }}
    </a>