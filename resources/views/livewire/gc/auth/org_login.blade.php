

<div class="w-full max-w-xs mx-auto">
<x-modal-heading>GroupCare Login</x-modal-heading>
  <form name="{{$formname}}" wire:submit.prevent='login' class="bg-gray-100 shadow-md rounded rounded-t-none px-8 pt-6 pb-8 mb-4">
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
      >
      
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
      <button type="submit" class="bg-blue-700 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
        Login
      </button>

      <button type="cancel" @click="showModal = false; " class="bg-gray-200 hover:bg-gray-100 text-gray-600 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
        Cancel
      </button>
    </div>

      
      
    </div>
  </form>
</div>
