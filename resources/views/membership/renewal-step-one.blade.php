<x-guest-layout>

    @if(env('PAYPAL_USE_SANDBOX'))
    <script src="https://www.paypal.com/sdk/js?client-id={{env('PAYPAL_SANDBOX_CLIENT_ID')}}&currency=AUD" data-order-id="{{$membership->idHash}}"></script>
    @else
    <script src="https://www.paypal.com/sdk/js?client-id={{env('PAYPAL_LIVE_CLIENT_ID')}}&currency=AUD" data-order-id="{{$membership->idHash}}"></script>
    @endif

    <div class="bg-gray-100">
        <div class="pt-12 sm:pt-16 lg:pt-20">
            <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h2 class="text-3xl leading-9 font-extrabold text-gray-900 sm:text-4xl sm:leading-10 lg:text-5xl lg:leading-none">
                        Membership Renewal
                    </h2>
                    <p class="mt-4 text-xl leading-7 text-gray-600">
                        {{ $membership->membershipType->organisation->name }}
                    </p>
                </div>
            </div>
        </div>
        <div class="mt-8 bg-white pb-16 sm:mt-12 sm:pb-20 lg:pb-28">
            <div class="relative">
                <div class="absolute inset-0 "></div>
                <div class="relative max-w-screen-xl mx-auto px-4 py-8 sm:px-6 lg:px-8">
                    <div class="max-w-lg mx-auto rounded-lg shadow-lg overflow-hidden lg:max-w-none lg:flex">
                        <div class="flex-1 bg-white px-6 py-8 lg:p-12">
                            <h3 class="text-2xl leading-8 font-extrabold text-gray-900 sm:text-3xl sm:leading-9">
                                {{ $membership->name }}
                            </h3>
                            <p class="mt-6 text-base leading-6 text-gray-500">
                                {{ $membership->membershipType->organisation->name }} membership subscriptions are now due for the 12 months period starting
                                {{ $membership->membershipType->currentSubscriptionPeriod()->start_date->format('d-m-Y') }}
                                and ending on {{ $membership->membershipType->currentSubscriptionPeriod()->end_date->addDay(-1)->format('d-m-Y')}}
                                <div class="mt-8">
                                    <div class="flex items-center">
                                        <h4 class="flex-shrink-0 pr-4 bg-white text-sm leading-5 tracking-wider font-semibold uppercase text-indigo-600">
                                            Member benefits
                                        </h4>
                                        <div class="flex-1 border-t-2 border-gray-200"></div>
                                    </div>
                                    <ul class="mt-8 lg:grid lg:grid-cols-2 lg:gap-x-8 lg:gap-y-5">
                                        <li class="flex items-start lg:col-span-1">
                                            <div class="flex-shrink-0">
                                                <!-- Heroicon name: check-circle -->
                                                <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <p class="ml-3 text-sm leading-5 text-gray-700">
                                                Advice on how to get started with your own land care project
                                            </p>
                                        </li>
                                        <li class="mt-5 flex items-start lg:col-span-1 lg:mt-0">
                                            <div class="flex-shrink-0">
                                                <!-- Heroicon name: check-circle -->
                                                <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <p class="ml-3 text-sm leading-5 text-gray-700">
                                                Loan equipment to assist with planting and weed spraying
                                            </p>
                                        </li>
                                        <li class="mt-5 flex items-start lg:col-span-1 lg:mt-0">
                                            <div class="flex-shrink-0">
                                                <!-- Heroicon name: check-circle -->
                                                <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <p class="ml-3 text-sm leading-5 text-gray-700">
                                                Learn about a wide range of topics through Field Days and workshops with
                                                expert speakers;
                                            </p>
                                        </li>
                                        <li class="mt-5 flex items-start lg:col-span-1 lg:mt-0">
                                            <div class="flex-shrink-0">
                                                <!-- Heroicon name: check-circle -->
                                                <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <p class="ml-3 text-sm leading-5 text-gray-700">
                                                The opportunity to meet with friendly like-minded people
                                            </p>
                                        </li>
                                    </ul>
                                </div>
                        </div>
                        <div class="py-8 px-6 text-center bg-gray-50 lg:flex-shrink-0 lg:flex lg:flex-col lg:justify-center lg:p-12">
                            <p class="text-lg leading-6 font-medium text-gray-900">
                                Annual membership fee
                            </p>
                            <p>for {{ $membership->membershipType->name }} membership</p>
                            <div class="mt-4 flex items-center justify-center text-5xl leading-none font-extrabold text-gray-900">
                                <span>
                                    ${{ $membership->membershipType->membershipFeeAsDollars }}
                                </span>
                                <span class="ml-3 text-xl leading-7 font-medium text-gray-500">
                                    inc GST
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class=" max-w-lg lg:max-w-full mx-auto overflow-hidden bg-teal-50 mt-8">
                        <div class=" text-2xl font-black text-gray-600 px-4 "> Payment options</div>


                        <div class="pt-4 max-w-lg mx-auto overflow-hidden lg:max-w-full lg:flex ">


                            <div class="flex-grow lg:flex  justify-between ">

                                <div class="lg:w-1/2 m-4 rounded-lg shadow-sm overflow-hidden bg-teal-100 px-2 py-4 ">


                                    <div class="ml-4 mr-4  text-center">Securely pay online via PayPal.<br>
                                        PayPal provides options to pay using a major credit card or via your own PayPal account if you already have one setup.
                                    </div>
                                    <div class="flex justify-around">
                                        <span class="inline-flex rounded-md shadow-sm">
                                        <button type="button" id="processing_indicator" style="display:none" class="inline-flex items-center px-4 py-2 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-indigo-600 hover:bg-rose-500 focus:border-rose-700 active:bg-rose-700 transition ease-in-out duration-150 cursor-not-allowed" disabled>
                                            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                            </svg>
                                            Processing
                                        </button>
                                        </span>
                                    </div>
                                    
                                    <div class="mt-4 ml-4 mr-4">
                                        <div id="paypal-button-container" ></div>
                                    </div>

                                </div>


                                <div class="lg:w-1/2  p-10  m-4 rounded-lg shadow-sm overflow-hidden bg-teal-100 px-2 py-4 ">



                                    <div class="ml-4 mr-4 text-center">Pay your membership using alternative means including:

                                        Direct debit into the {{ $membership->membershipType->organisation->name }} bank account<br>
                                        or pay by cheque.

                                    </div>
                                    <div class="text-center mt-8 mb-8">
                                        <x-link.button to="{{ route('membership-renew-offline',['membershipIdHash'=>$membership->idHash]) }}" class="text-white">Pay using offline options</span></x-link.button>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class=" p-4 text-center">If you would wish to cancel your membership <a class="font-extrabold" href="{{ route('cancel-membership',['membershipIdHash'=>$membership->idHash]) }}">click here</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script>
        var processing_indicator = document.getElementById('processing_indicator');
        var client_hash = '{{$membership->idHash}}';

        var address_line_1 = '';
        var address_line_2 = '';
        var city ='';
        var state='';
        var postcode ='';
    @if($membership->primaryContact()->address)

        address_line_1 = '{{$membership->primaryContact()->address->address1 ? $membership->primaryContact()->address->address1 : ""}}';
        address_line_2 = '{{$membership->primaryContact()->address->address2 ? $membership->primaryContact()->address->address2 : ""}}';
        city ='{{$membership->primaryContact()->address->city ? $membership->primaryContact()->address->city : ""}}';
        postcode ='{{$membership->primaryContact()->address->postcode ? $membership->primaryContact()->address->postcode : ""}}';
        state = '{{$membership->primaryContact()->address->state ? $membership->primaryContact()->address->state->code : ""}}';

    @endif

        
        paypal.Buttons({
            enableStandardCardFields: true,
            createOrder: function(data, actions) {
                //console.log(data);
               
                processing_indicator.style.display='none';
                // set opcaity of payment buttons
                
                return actions.order.create({
                    intent: 'CAPTURE',
                    payer: {

                        address: {
                            address_line_1: address_line_1,
                            address_line_2: address_line_2,
                            admin_area_2: city,
                            admin_area_1: state,
                            postal_code: postcode,
                            country_code: 'AU'
                        },
                        email_address: '{{$membership->primaryContact()->email}}',

                    },
                    purchase_units: [{
                        amount: {
                            value: '{{$membership->membershipType->membershipFeeAsDollars}}',
                            currency_code: 'AUD'
                        },
                        description: 'membership renewal',
                        custom_id: client_hash,

                    }]
                });
            },
        
            onError: function(err){
                processing_indicator.style.display='none';

            },
            onCancel: function(){
                processing_indicator.style.display='none';
            },
            onApprove: function(data, actions) {
                // This function captures the funds from the transaction.
                processing_indicator.style.display=''; // show passifier
                document.getElementById('paypal-button-container').classList.add('opacity-25');
                
                return actions.order.capture().then(function(details) {
                    // This function shows a transaction success message to your buyer.
                    //console.log(details,client_hash);
                    //  alert('Transaction completed by ' + details.payer.name.given_name);
                    

                    // make ajax call to record completed transaction 
                    return axios('{{ route("payment-complete",["membershipIdHash"=>$membership->idHash]) }}', {
                    method: 'post',
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                        // "X-Requested-With": "XMLHttpRequest",
                        // "X-CSRF-Token": "{{ csrf_token() }}",
                    },
                    data: {
                        details: details
                    }
                }).then(function(res) {
                     //console.log(res);
                     
                    window.location.replace("{{route('membership-renewal-confirm',['membershipIdHash'=>$membership->idHash])}}");
                    // redirect to all-done
                })

                   
                });
            }
        }).render("#paypal-button-container");
    </script>


</x-guest-layout>