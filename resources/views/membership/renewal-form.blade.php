<x-guest-layout>

    <script src="https://www.paypal.com/sdk/js?client-id=AR_xRpQCuoq2b_n8sgoF3CCg7usHjAHMQwxJjSL6rdb2KNi8yU36F63lVl7jWiExxLW_jXOw5fgI9fdI&buyer-country=AU&locale=en_AU&currency=AUD" data-order-id="9236543">
        // Required. Replace SB_CLIENT_ID with your sandbox client ID.
    </script>

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
                <div class="absolute inset-0 h-1/2 bg-gray-100"></div>
                <div class="relative max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="max-w-lg mx-auto rounded-lg shadow-lg overflow-hidden lg:max-w-none lg:flex">
                        <div class="flex-1 bg-white px-6 py-8 lg:p-12">
                            <h3 class="text-2xl leading-8 font-extrabold text-gray-900 sm:text-3xl sm:leading-9">
                                {{ $membership->name }}
                            </h3>
                            <p class="mt-6 text-base leading-6 text-gray-500">
                                {{ $membership->membershipType->organisation->name }} membership subscriptions are now due for the 12 months period starting 01-07-2020 and ending on 30-06-2021
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

                            <!-- <div class="mt-6">
              <div class="rounded-md shadow">
                <a href="#" class="flex items-center justify-center px-5 py-3 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-gray-900 hover:bg-gray-800 focus:outline-none focus:shadow-outline transition duration-150 ease-in-out">
                  Renew now
                </a>
              </div>
            </div> -->

                        </div>
                    </div>

                    <div class="pt-4 max-w-lg mx-auto overflow-hidden lg:max-w-full lg:flex">
                        <div class="flex-grow p-4"> Membership payment options. Note: If you would like to cancel your membership <a href="{{ route('cancel-membership',['membership'=>$membership->idHash]) }}">click here</a>
                            <div class="flex-grow lg:flex  justify-between ">
                                <div class="md:w-1/3 m-2 rounded-lg shadow-sm overflow-hidden bg-teal-50 px-2 py-4">
                                    <div class="flex">
                                        <div class="flex-shrink-0 ml-1">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </div>

                                        <div class="ml-10">Securely pay online via PayPal.<br>
                                            PayPal provides options to pay using a major credit card or via your own PayPal account if you have one setup.


                                        </div>
                                    </div>
                                    <div id="processingMessage" class="text-lg">processing ...</div>
                                    <div class="mt-4 ml-4 mr-4">
                                        <div id="paypal-button-container"></div>
                                    </div>

                                </div>
                                <div class="md:w-1/3 flex p-10 m-2 rounded-lg shadow-sm overflow-hidden bg-teal-50 px-2 py-4 ">
                                    <div class="flex-shrink-0 ml-1">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-10">Direct debit into the {{ $membership->membershipType->organisation->name }} bank account.
                                        <p>Bank account details:<br>
                                            {{ $membership->membershipType->organisation->bank_account_details }}
                                        </p>
                                    </div>

                                </div>
                                <div class="md:w-1/3 flex p-10 m-2 rounded-lg shadow-sm overflow-hidden bg-teal-50 px-2 py-4">
                                    <div class="flex-shrink-0 ml-1">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-10">To pay by cheque make out your cheque to {{ $membership->membershipType->organisation->name }} and send it to:
                                        <p class="font-bold py-2">
                                            {{ $membership->membershipType->organisation->name }}<br>{{ $membership->membershipType->organisation->address->fullAddress }}
                                        </p>
                                    </div>
                                </div>


                            </div>
                        </div>


                    </div>


                </div>
            </div>
        </div>
    </div>


    <script>
        var processingMessage = document.getElementById('processingMessage');
        processingMessage.style.display = 'none';

        
        paypal.Buttons({

            createOrder: function() {
                processingMessage.style.display = 'block';
                return axios('{{ route("membership-renewal-payment",["membership"=>$membership->idHash]) }}', {
                    method: 'post',
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                        // "X-Requested-With": "XMLHttpRequest",
                        // "X-CSRF-Token": "{{ csrf_token() }}",
                    },
                }).then(function(res) {
                    //console.log(res.data);
                    //return res.json(); // fetch
                    return res.data; // axios
                }).then(function(data) {
                    //console.log(data.orderID);
                    return data.orderID; // Use the same key name for order ID on the client and server
                })
            },
            onCancel: function(data){
                console.log('onCancel',data);
            },
            onReturn: function(data){
                console.log('onCancel',data);
            },

            onApprove: function(data) {
                //console.log('onApprove');
                //console.log(data);
                return axios('{{ route("capture-paypal-transaction") }}', {
                    method: 'post',
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                        // "X-Requested-With": "XMLHttpRequest",
                        // "X-CSRF-Token": "{{ csrf_token() }}",
                    },
                    data: {
                        orderID: data.orderID
                    }
                    // fetch sends data via body see below
                    // body: JSON.stringify({
                    //     orderID: data.orderID
                    // })
                }).then(function(res) {
                    //console.log(res);
                    //return res.json(); // fetch
                    return res.data; //axios
                }).then(function(details) {
                    //console.log(details);

                    // Redirect to payment received conformation page
                    
                    alert('Transaction funds captured from ' + details.payer.name.given_name + ' ' + details.payer.name.surname);

                })
            }
        }).render('#paypal-button-container');
    </script>

</x-guest-layout>