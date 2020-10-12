<div x-data="{showEmail: true, showPassword: false, showManagerName:false, showOrgname:false}">
    <div class="p-8 mb-4">
        This livewire component assigns a manager to the organisation.

        <li>Check if user email exists in users table, and if it does create the new org with that user as the manager</li>
        <li> If the user does not yet exist then add the email/password to the users table and send a confirmation email</li>
        <li> After email confirmation - return user to continue with the registration page so they can continue with the next steps.</li>
    </div>

    <div class="w-full max-w-lg m-auto">
    @error('email') <span class="text-red-500">{{ $message }} </span>@enderror

        <div x-show="$wire.showEmail">
            <div class="bg-gray-200 p-4 mb-4 ">Account managers email address</div>
            <div class="flex items-center border-b border-teal-500 py-2">
                <input wire:model="email" class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" placeholder="Email address" aria-label="Email address">
            </div>
           
        </div>


        <div x-show="$wire.showManagerName">
            <div class="bg-gray-200 p-4 mb-4">Account managers name</div>
            <div class="flex items-center border-b border-teal-500 py-2">
                <input wire:model="name" class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" placeholder="Account managers name" aria-label="Full name">
            </div>
        </div>


        <div x-show="$wire.showPassword" >
            <div class="bg-gray-200 p-4 mb-4 rounded text-2xl">Enter an account password</div>
            <div class="flex items-center border-b border-teal-500 py-2">
                <input wire:model="password" class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="password" placeholder="Password" aria-label="Password">

            </div>
        </div>

        <div x-show="$wire.showOrganisationName">
            <div class="bg-gray-200 p-4 mb-4 rounded text-2xl">Organisation name</div>
            <div class="flex items-center border-b border-teal-500 py-2">
                <input wire:model="organisationName" class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="password" placeholder="Organisation name" aria-label="Organisation name">

            </div>
        </div>


        <button wire:click="continue()" class="mt-10 flex-shrink-0 bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded">
            Continue
        </button>
    </div>

</div>