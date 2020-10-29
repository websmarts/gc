@if (session('message'))
    <x-message>
        {{ session('message') }}
    </x-message>
@endif
@if (session('error-message'))
    <x-message type="error">
        {{ session('error-message') }}
    </x-message>
@endif