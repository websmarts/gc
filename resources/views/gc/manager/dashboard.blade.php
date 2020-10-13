@extends('gc.layouts.main')

@section('content')
<x-pagename>Organisation Manager Dashboard</x-pagename>

    @foreach($organisations as $organisation)

    <div>{{ $organisation->name  }}</div>


    @endforeach
@endsection