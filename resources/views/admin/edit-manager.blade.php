@extends('layouts.main')

@section('content')
<x-pagename>Edit Manager</x-pagename>

<x-forms.edit-manager :user="$user"></x-forms.edit-manager>

@endsection