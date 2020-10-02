
<div class="w-full max-w-xs mx-auto">
    <x-modal-heading>Login form</x-modal-heading>
  <form wire:submit.prevent='login' class="bg-gray-100 shadow-md rounded rounded rounded-t-none px-8 pt-6 pb-8 mb-4">
    <div class="mb-4">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
        Email
      </label>
      <input wire:model="email" 
      id="email" 
      name="email" 
      type="text" 
      placeholder="email"
      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
      >
      
    </div>
    <div class="mb-6">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
        Password
      </label>
      <input 
        wire:model="password" 
        id="password" 
        name="password"
        type="password" 
        placeholder="******************"
        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" 
       >
    </div>

    <div class="block mt-4 mb-4">
        <label class="flex items-center">
            <input wire:model.defer="remember" type="checkbox" class="form-checkbox" name="remember" value="1">
            <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
        </label>
    </div>

     
    
            <span class="text-red-500 {{ $loginfailed ? '' : 'hidden' }}" >Login failed ...</span>
     
   
    <div class="flex items-center justify-between">
      <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
        Login
      </button>

      <div class="block mt-4 mb-4">
        <label class="flex items-center">
            <input wire:model="domain" type="checkbox" class="form-checkbox" name="domain" value="users">
            <span class="ml-2 text-sm text-gray-600">{{ __('User Domain') }}{{ $domain }}</span>
        </label>
    </div>

      
      
    </div>
  </form>
</div>
