@props([
        'bg' => 'bg-blue-500',
        'hover' => 'bg-blue-700',
        'text'=> 'text-white',
        'weight'=>'font-bold'
    ])


<button {{ $attributes }} class="
{{ $bg }}
{{ $hover ? 'hover:'.$hover :'' }}
{{ $text }}
{{ $weight }}
py-2 px-4 rounded">
  {{ $slot }}
</button>