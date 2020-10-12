<html>

<head>


    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    
</head>

<body class="bg-gray-100" x-data="{}">

    <div class="bg-white max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="text-2xl">View Inspector</div>


        @if($data['files'])
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        View file
                                    </th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Layout
                                    </th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Includes
                                    </th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Comonents
                                    </th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Livewire componets
                                    </th>

                                </tr>
                            </thead>
                            <tbody>

                                @foreach($data['files'] as $f => $row)
                                <tr class="{{ $loop->odd ? 'bg-white' : 'bg-blue-50' }}">
                                    <td class="px-6 py-2 whitespace-no-wrap text-sm leading-5 font-medium text-gray-900">
                                        {{ $f }}
                                    </td>
                                    <td class="px-6 py-2 whitespace-no-wrap text-sm leading-5 text-gray-500">
                                        @if(isSet($row['layout']))
                                        {{ $row['layout'] }}
                                        @endif
                                    </td>
                                    <td class="px-6 py-2 whitespace-no-wrap text-sm leading-5 text-gray-500">
                                        @if(isSet($row['includes']))
                                        @foreach($row['includes'] as $c)
                                        {{ $c }}<br />
                                        @endforeach
                                        @endif
                                    </td>

                                    <td class="px-6 py-2 whitespace-no-wrap text-sm leading-5 text-gray-500">
                                        @if(isSet($row['components']))
                                        @foreach($row['components'] as $c)
                                        {{ $c }}<br />
                                        @endforeach
                                        @endif
                                    </td>
                                    <td class="px-6 py-2 whitespace-no-wrap text-sm leading-5 text-gray-500">
                                        @if(isSet($row['livewire-components']))
                                        @foreach($row['livewire-components'] as $c)
                                        {{ $c }}<br />
                                        @endforeach
                                        @endif
                                    </td>

                                </tr>
                                @endforeach



                                <!-- More rows... -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endif

        @if($data['layouts'])
        <div class="flex flex-col mt-5">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Layout
                                    </th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        View file
                                    </th>
                                    

                                </tr>
                            </thead>
                            <tbody>

                                @foreach($data['layouts'] as $layout => $files)
                                <tr class="{{ $loop->odd ? 'bg-white' : 'bg-blue-50' }}">
                                    <td class="px-6 py-2 whitespace-no-wrap text-sm leading-5 font-medium text-gray-900">
                                        {{ $layout }}
                                    </td>
                                    
                                    <td class="px-6 py-2 whitespace-no-wrap text-sm leading-5 text-gray-500">
                                        @if(is_array($files) && count($files))
                                        @foreach($files as $f)
                                        {{ $f }}<br />
                                        @endforeach
                                        @endif
                                    </td>

                                </tr>
                                @endforeach



                                <!-- More rows... -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endif

        @if($data['components'])
        <div class="flex flex-col mt-5">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Component
                                    </th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Files used in
                                    </th>
                                    

                                </tr>
                            </thead>
                            <tbody>

                                @foreach($data['components'] as $component => $files)
                                <tr class="{{ $loop->odd ? 'bg-white' : 'bg-blue-50' }}">
                                    <td class="px-6 py-2 whitespace-no-wrap text-sm leading-5 font-medium text-gray-900">
                                        {{ $component }}
                                    </td>
                                    
                                    <td class="px-6 py-2 whitespace-no-wrap text-sm leading-5 text-gray-500">
                                        @if(is_array($files) && count($files))
                                        @foreach($files as $f)
                                        {{ $f }}<br />
                                        @endforeach
                                        @endif
                                    </td>

                                </tr>
                                @endforeach



                                <!-- More rows... -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endif

        @if($data['components'])
        <div class="flex flex-col mt-5">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Livewire component
                                    </th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Files used in
                                    </th>
                                    

                                </tr>
                            </thead>
                            <tbody>

                                @foreach($data['livewire'] as $component => $files)
                                <tr class={{ $loop->odd ? 'bg-white' : 'bg-blue-50' }}">
                                    <td class="px-6 py-2 whitespace-no-wrap text-sm leading-5 font-medium text-gray-900">
                                        {{ $component }}
                                    </td>
                                    
                                    <td class="px-6 py-2 whitespace-no-wrap text-sm leading-5 text-gray-500">
                                        @if(is_array($files) && count($files))
                                        @foreach($files as $f)
                                        {{ $f }}<br />
                                        @endforeach
                                        @endif
                                    </td>

                                </tr>
                                @endforeach



                                <!-- More rows... -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endif



        @if($data['used_component_source_files'])
        <div class="flex flex-col mt-5">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Component file
                                    </th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Component
                                    </th>
                                    

                                </tr>
                            </thead>
                            <tbody>

                                @foreach($data['used_component_source_files'] as $file => $component)
                                <tr class={{ $loop->odd ? 'bg-white' : 'bg-blue-50' }}">
                                    <td class="px-6 py-2 whitespace-no-wrap text-sm leading-5 font-medium text-gray-900">
                                        {{ $file }}
                                    </td>
                                    
                                    <td class="px-6 py-2 whitespace-no-wrap text-sm leading-5 text-gray-500">
                                        {{ $component }}
                                    </td>

                                </tr>
                                @endforeach



                                <!-- More rows... -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endif


        @if($data['used_livewire_source_files'])
        <div class="flex flex-col mt-5">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Livewire file
                                    </th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Livewire component
                                    </th>
                                    

                                </tr>
                            </thead>
                            <tbody>

                                @foreach($data['used_livewire_source_files'] as $file => $component)
                                <tr class={{ $loop->odd ? 'bg-white' : 'bg-blue-50' }}">
                                    <td class="px-6 py-2 whitespace-no-wrap text-sm leading-5 font-medium text-gray-900">
                                        {{ $file }}
                                    </td>
                                    
                                    <td class="px-6 py-2 whitespace-no-wrap text-sm leading-5 text-gray-500">
                                        {{ $component }}
                                    </td>

                                </tr>
                                @endforeach



                                <!-- More rows... -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endif


        @if($data['included_files'])
        <div class="flex flex-col mt-5">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Included file
                                    </th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Included by
                                    </th>
                                    

                                </tr>
                            </thead>
                            <tbody>

                                @foreach($data['included_files'] as $file => $includedBy)
                                <tr class={{ $loop->odd ? 'bg-white' : 'bg-blue-50' }}">
                                    <td class="px-6 py-2 whitespace-no-wrap text-sm leading-5 font-medium text-gray-900">
                                        {{ $file }}
                                    </td>
                                    
                                    <td class="px-6 py-2 whitespace-no-wrap text-sm leading-5 text-gray-500">
                                        @if(is_array($includedBy) && count($includedBy))
                                        @foreach($includedBy as $f)
                                        {{ $f }}<br />
                                        @endforeach
                                        @endif
                                    </td>

                                </tr>
                                @endforeach



                                <!-- More rows... -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endif




        @if($data['unused_files'])
        <div class="flex flex-col mt-5">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                        Potentially Un-used  - <span class="text-red-700">beware though - they could be standalone view files like view-inspector</span>
                                    </th>
                                   
                                    

                                </tr>
                            </thead>
                            <tbody>

                                @foreach($data['unused_files'] as  $file)
                                <tr class={{ $loop->odd ? 'bg-white' : 'bg-blue-50' }}">
                                    <td class="px-6 py-2 whitespace-no-wrap text-sm leading-5 font-medium text-gray-900">
                                        {{ $file }}
                                    </td>
                                    
                                    

                                </tr>
                                @endforeach



                                <!-- More rows... -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endif








    </div>

</body>

</html>