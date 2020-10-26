<x-app-layout>


    <x-slot name="pagetitle">Register an organisation </x-slot>

    <nav>
  <ul class="border border-gray-300 rounded-md divide-y divide-gray-300 md:flex md:divide-y-0">
    <li class="relative md:flex-1 md:flex">
      <!-- Completed Step -->
      <a href="#" class="group flex items-center w-full">
        <div class="px-6 py-4 flex items-center text-sm leading-5 font-medium space-x-4">
          <div class="flex-shrink-0 w-10 h-10 flex items-center justify-center bg-indigo-600 rounded-full group-hover:bg-indigo-800 transition ease-in-out duration-150">
            <!-- Heroicon name: check -->
            <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
            </svg>
          </div>
          <p class="text-sm leading-5 font-medium text-gray-900">Organisation details</p>
        </div>
      </a>

      <div class="hidden md:block absolute top-0 right-0 h-full w-5">
        <svg class="h-full w-full text-gray-300" viewBox="0 0 22 80" fill="none" preserveAspectRatio="none">
          <path d="M0 -2L20 40L0 82" vector-effect="non-scaling-stroke" stroke="currentcolor" stroke-linejoin="round" />
        </svg>
      </div>
    </li>

    <li class="relative md:flex-1 md:flex">
      <!-- Current Step -->
      <div class="px-6 py-4 flex items-center text-sm leading-5 font-medium space-x-4">
        <div class="flex-shrink-0 w-10 h-10 flex items-center justify-center border-2 border-indigo-600 rounded-full">
          <p class="text-indigo-600">02</p>
        </div>
        <p class="text-sm leading-5 font-medium text-indigo-600">Create Membership Options</p>
      </div>

      <div class="hidden md:block absolute top-0 right-0 h-full w-5">
        <svg class="h-full w-full text-gray-300" viewBox="0 0 22 80" fill="none" preserveAspectRatio="none">
          <path d="M0 -2L20 40L0 82" vector-effect="non-scaling-stroke" stroke="currentcolor" stroke-linejoin="round" />
        </svg>
      </div>
    </li>

    <li class="relative md:flex-1 md:flex">
      <!-- Upcoming Step -->
      <a href="#" class="group flex items-center">
        <div class="px-6 py-4 flex items-center text-sm leading-5 font-medium space-x-4">
          <div class="flex-shrink-0 w-10 h-10 flex items-center justify-center border-2 border-gray-300 rounded-full group-hover:border-gray-400 transition ease-in-out duration-150">
            <span class="text-gray-500 group-hover:text-gray-900 transition ease-in-out duration-150">03</span>
          </div>
          <p class="text-sm leading-5 font-medium text-gray-500 group-hover:text-gray-900 transition ease-in-out duration-150">Add Members</p>
        </div>
      </a>
    </li>
  </ul>
</nav>

    <livewire:register-organisation />
       

</x-app-layout>