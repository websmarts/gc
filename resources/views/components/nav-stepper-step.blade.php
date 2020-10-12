@props(['state'=>'todo','linkto'=>'#','islaststep'=>false])

<li class="relative pb-10">
    <!-- Complete Step -->
    @unless($islaststep)
            <div class="-ml-px absolute mt-0.5 top-4 left-4 w-0.5 h-full {{ in_array($state, ['completed','current']) ?' bg-indigo-600' : 'bg-gray-600'}}"></div>
    @endif
    
    <a href="{{ $linkto }}" class="relative flex items-start space-x-4 group focus:outline-none">
        <div class="h-9 flex items-center">

            @if($state == 'completed')
            <span class="relative z-10 w-8 h-8 flex items-center justify-center bg-indigo-600 rounded-full group-hover:bg-indigo-800 group-focus:bg-indigo-800 transition ease-in-out duration-150">
                <!-- Heroicon name: check -->
                <svg class="w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
            </span>
            @elseif($state=='current')
            <span class="relative z-10 w-8 h-8 flex items-center justify-center bg-white border-2 border-indigo-600 rounded-full">
                <span class="h-2.5 w-2.5 bg-indigo-600 rounded-full"></span>
            </span>

            @else
            <span class="relative z-10 w-8 h-8 flex items-center justify-center bg-white border-2 border-gray-300 rounded-full group-hover:border-gray-400 group-focus:border-gray-400 transition ease-in-out duration-150">
                <span class="h-2.5 w-2.5 bg-transparent rounded-full group-hover:bg-gray-300 group-focus:bg-gray-300 transition ease-in-out duration-150"></span>
            </span>

            @endif

        </div>
        <div class="min-w-0">
            <h3 class="text-xs leading-4 font-semibold uppercase tracking-wide {{ $state =='current' ? 'text-indigo-600' : NULL }}">{{ $title }}</h3>
            <p class="text-sm leading-5 text-gray-500">{{ $description }}</p>
        </div>
    </a>
</li>