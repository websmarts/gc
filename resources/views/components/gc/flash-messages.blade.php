@if (session('flash'))
    <x-message>
        {{ session('flash') }}
    </x-message>
@endif
@if (session('flash-error'))
    <x-message type="error">
        {{ session('flash-error') }}
    </x-message>
@endif