@props([
    'to' => '#',
    ])

    <a  href="{{ $to }}" 
    {{ $attributes->merge(['class' =>"
    inline-block
    underline
    hover:no-underline
    font-medium  
    "])}}>{{ $slot }}</a>