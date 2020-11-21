<div class="w-full max-w-xs mx-auto">
  <form wire:submit.prevent='register' class="bg-gray-100 shadow-md rounded px-8 pt-6 pb-8 mb-4">
    <div class="mb-4">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
        Email
      </label>
      <input wire:model="email" id="email" name="email" type="text" placeholder="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
      
    </div>
    <div class="mb-6">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
        Password
      </label>
      <input wire:model="password" id="password" name="password" type="password" placeholder="******************" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline">
      <p class="text-teal-500 text-xs italic">Choose a password with at least six characters.</p>
      @error('password') <span class="text-red-500">{{ $message }} </span>@enderror

    </div>
    <div class="mb-6">
      <label class="block text-gray-700 text-sm font-bold mb-2" for="passwordConfirm">
        Password confirm
      </label>
      <input wire:model="passwordConfirm" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="passwordConfirm" name="passwordConfirm" type="password" placeholder="**** confirm ******">
      <p class="text-teal-500 text-xs italic">Confirm password.</p>
    </div>
    <div class="flex items-center justify-between">
      <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
        Register
      </button>

    </div>
  </form>
</div>