<x-guest-layout>

{{-- dump($membership) --}}
<p class="text-2xl font-bold">Your membership has been renewed for another year</p>

<p class="mb-4 mt-2">Please review the your current membership details below and contact us if any changes are required</p>

<div class="bg-white shadow overflow-hidden sm:rounded-lg">
  <div class="px-4 py-5 sm:px-6">
    <h3 class="text-lg leading-6 font-medium text-gray-900">
      Current Membership Information
    </h3>
    
  </div>
  <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
    <dl class="sm:divide-y sm:divide-gray-200">
      <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
        <dt class="text-sm font-medium text-gray-500">
          Membership name
        </dt>
        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
          {{ $membership->name}}
        </dd>
      </div>
      <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
        <dt class="text-sm font-medium text-gray-500">
          Currently financial
        </dt>
        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
          From: &nbsp;{{ $membership->membershipType->currentSubscriptionPeriod()->start_date->format('d-m-Y') }}<br />

          Until: &nbsp;{{ $membership->membershipType->currentSubscriptionPeriod()->end_date->format('d-m-Y') }}
        </dd>
      </div>
      <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
        <dt class="text-sm font-medium text-gray-500">
          Member details (* primary contact)
        </dt>
        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
          
        </dd>
      </div>
      @foreach($membership->members as $member)
      <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
        <dt class="text-sm font-medium text-gray-500">
          {{ $member->name }} {{ $member->pivot->is_primary_contact ? "*" : "" }}
        </dt>
        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
          Ph: {{ $member->phone }}<br />
          Address: @if($member->address){{ $member->address->full_address}}@endif
        </dd>
      </div>
      @endforeach
      
      
    </dl>
  </div>
</div>

</x-guest-layout>