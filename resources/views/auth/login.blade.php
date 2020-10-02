@extends('layouts.default')

@section('content')

<div class="w-full max-w-sm m-auto">
    <div class="bg-gray-200 p-4 mb-4 rounded text-2xl">Groupcare login</div>
    <form method="post" action="{{ route('login') }}" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                Email
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
            id="email"
            name="email" 
            type="text" 
            placeholder="email">
            
            @if($errors->has('email'))
            <div class="text-red-500">{{ $errors->first('email') }}</div>
            @endif
        </div>
        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                Password
            </label>
            <input 
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" 
            id="password"
            name="password" 
            type="password" 
            placeholder="******************">

            @if($errors->has('password'))
            <div class="error">{{ $errors->first('password') }}</div>
            @endif
            
        </div>
        <div class="flex items-center justify-between">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                Login
            </button>
            <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="#">
                Forgot Password?
            </a>
        </div>
    </form>
    <p class="text-center text-gray-500 text-xs">
        &copy;2020 Groupcare. All rights reserved.
    </p>
</div>

@endsection