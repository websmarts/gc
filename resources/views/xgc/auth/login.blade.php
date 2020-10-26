@extends('gc.layouts.guest')

@section('pagetitle')
GroupCare login
@endsection

@section('content')

<livewire:auth.login />
<x-gc.alert />
<x-gc.wally-alert />
@endsection