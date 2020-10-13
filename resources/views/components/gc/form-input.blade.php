@props(['name'])

<div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
    <label for="{{ $name }}" class="block text-sm font-medium leading-5 text-gray-700 sm:mt-px sm:pt-2">
        {{ $slot }}
    </label>
    <div class="mt-1 sm:mt-0 sm:col-span-2">
        <div class="max-w-lg rounded-md shadow-sm sm:max-w-xs">
            <input id="{{ $name }}" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">
        </div>
    </div>
</div>