<div class="w-full max-w-lg m-auto">
    <div class="bg-gray-200 p-4 mb-4 rounded text-2xl">Update user details</div>

    

    <form method="post" action="{{ route('user.update.name',$user->uuid) }}" class="w-full max-w-lg">
        @csrf
        @method('put')
        <div class="flex items-center border-b border-teal-500 py-2">
            <input 
            class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" 
            type="text" 
            name="name"
            value="{{ $user->name }}"
            placeholder="Full name" 
            aria-label="Full name">

            <button class="flex-shrink-0 bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded" 
            type="submit">
                Update name
            </button> 
        </div>
        @if($errors->has('name'))
            <span class="text-red-500">{{ $errors->first('name') }}</span>
            @endif
    </form>

    <form method="post" action="{{ route('user.update.email',$user->uuid) }}" class="w-full max-w-lg">
        @csrf
        @method('put')
        <div class="flex items-center border-b border-teal-500 py-2">
            <input 
            class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" 
            type="text" 
            name="email"
            value="{{ $user->email }}"
            placeholder="Email address" 
            aria-label="Email address">

            <button class="flex-shrink-0 bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded" 
            type="submit">
                Update email
            </button> 
        </div>
        @if($errors->has('email'))
            <span class="text-red-500">{{ $errors->first('email') }}</span>
            @endif
    </form>

    <form method="post" action="{{ route('user.update.password',$user->uuid) }}" class="w-full max-w-lg">
        @csrf
        @method('put')
        <div class="flex items-center border-b border-teal-500 py-2">
            <input 
            class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" 
            type="text" 
            name="password"
            value=""
            placeholder="Password" 
            aria-label="Password">

            <button class="flex-shrink-0 bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded" 
            type="submit">
                Update password
            </button> 
        </div>
        @if($errors->has('password'))
            <span class="text-red-500">{{ $errors->first('password') }}</span>
            @endif
    </form>


   
</div>