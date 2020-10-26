<div class="{{ $organisations->count() ? '' :'hidden'}}">
    <x-input.select placeholder="select an organisation ..." wire:model="selectedOrganisation.uuid">
                @foreach($organisations as $organisation)
                <option value="{{$organisation->uuid}}">{{$organisation->name}}</option>
                @endforeach
    </x-input.select>
</div>