@props([
    'to' => '#',
    'color'=>'teal'
    ])

<a href="{{ $to }}" 
class="
{{ $to == request()->url() ? ' bg-'.$color.'-700 text-white' : ' text-gray-100  hover:text-gray-100 hover:bg-'.$color.'-700' }} 
flex  w-1/4 items-end px-2 py-4" >
<div class="w-full text-center">{{ $slot }}</div>
</a>