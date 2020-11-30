<div>
    <div class="py-12 flex flex-col items-center justify-center ">
        <div class="flex items-center space-x-2 text-xl">
            <x-icon.upload class="text-cool-gray-400 h-8 w-8" />
            <x-input.file-upload wire:model="upload" id="upload"><span class="text-cool-gray-500 font-bold">XSLX File</span></x-input.file-upload>
        </div>
        @error('upload') <div class="mt-3 text-red-500 text-sm">{{ $message }}</div> @enderror
    </div>
</div>