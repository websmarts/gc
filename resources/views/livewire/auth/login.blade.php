

<div class="max-w-sm mx-auto bg-white px-8 py-12">
    <div>Login form </div>
  <form wire:submit.prevent='login' class=" px-8 pt-6 pb-8 mb-4">
    <div class="mb-4">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
        Email
      </label>
      <input wire:model="email" 
        id="email" 
        name="email" 
        type="text" 
        placeholder="email"
        class="form-input"
        autofocus >
      
    </div>
    <div class="mb-6">
      <label class="form-label" for="password">
        Password
      </label>
      <input 
        wire:model="password" 
        id="password" 
        name="password"
        type="password" 
        placeholder="******************"
        class="form-input" 
       >
    </div>
    <div class="error" >&nbsp;{{ $loginfailed }}</div>

    

    <div class="block mt-4 mb-4">
        <label class="flex items-center">
            <input wire:model.defer="remember" type="checkbox" class="form-checkbox" name="remember" value="1">
            <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
        </label>
    </div>

     
           
   
    <div class="flex items-center justify-between">
      <button type="submit" class="btn btn-blue" type="button">
        Login
      </button>

      
    </div>

      
      
  
  </form>
</div>

