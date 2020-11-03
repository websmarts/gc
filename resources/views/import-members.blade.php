<x-app-layout>


    <x-slot name="pagetitle">Import Members Test</x-slot>
    <form method="post" action="uploadfile" enctype="multipart/form-data">
        @csrf

        <x-input.group for="spreadsheet" label="Spreadsheet">
            <input type="file" id="spreadsheet" name="spreadsheet"/>
                
                <x-input.error for="spreadsheet" />
        </x-input.group>


        <div class="p-4">
            <input type="submit" name="b">Upload file</input>
        </div>

    </form>



</x-app-layout>