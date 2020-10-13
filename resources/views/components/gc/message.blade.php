@props([
    'type'=>'default'
    ])
<div 
x-data="{show: true}"
x-show="show"
x-init="setTimeout(() => show=false , 2500)"
class="{{ $type == 'error' ? ' bg-red-300 ': ' bg-green-300 ' }} py-4 px-2 text-gray-900">
    {{ $slot }}
</div>