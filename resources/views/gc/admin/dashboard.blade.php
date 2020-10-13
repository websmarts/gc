@extends('gc.layouts.main')

@section('content')

<x-pagename>Admin Dashboard</x-pagename>

<x-forms.edit-manager :user="$user"></x-forms.edit-manager>

@livewire('list-groups')

@endsection