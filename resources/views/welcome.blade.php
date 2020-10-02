@extends('layouts.default')

@section('title')
welcome
@endsection

@section('content')


<p class="error">My error class in action</p>

    <x-welcome-info />


<!-- Modals -->

@endsection

@section('modals')
<x-modal name="loginform">
    <livewire:auth.login />
</x-modal>
@endsection