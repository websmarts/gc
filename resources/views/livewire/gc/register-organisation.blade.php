<div>

    <x-gc.nav-stepper>
        <x-gc.nav-stepper-step :state="$registrationSteps[1]" linkto="{{ route('register.setup.account') }}">
            <x-slot name="title">Create an account</x-slot>
            <x-slot name="description">
                To setup an account we need the name of the organisation plus the name and email address of the person setting the account up.
            </x-slot>
        </x-gc.nav-stepper-step>

        <x-gc.nav-stepper-step :state="$registrationSteps[2]">
            <x-slot name="title">Organisation profile</x-slot>
            <x-slot name="description">
                Provide information about the organisation
            </x-slot>
        </x-gc.nav-stepper-step>

        <x-gc.nav-stepper-step :state="$registrationSteps[3]">
            <x-slot name="title">Configure Membership Types</x-slot>
            <x-slot name="description">
                Setup support for the types of memberships your organisation offers. eg individual, family
            </x-slot>
        </x-gc.nav-stepper-step>

        <x-gc.nav-stepper-step :state="$registrationSteps[4]" islaststep="true">
            <x-slot name="title">Update member register</x-slot>
            <x-slot name="description">
                Update the members register to reflect the organisations current member list. Organisations with a large number of members may wish to import their members using a spreadsheet.
            </x-slot>
        </x-gc.nav-stepper-step>




    </x-gc.nav-stepper>







    <!-- end registration steps display -->



    <!-- Registration form -->
    <!--
  Tailwind UI components require Tailwind CSS v1.8 and the @tailwindcss/ui plugin.
  Read the documentation to get started: https://tailwindui.com/documentation
-->
    <form>
        <div>

            <div class="mt-8 border-t border-gray-200 pt-8 sm:mt-5 sm:pt-10">
                <div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        Complete the following information
                    </h3>
                    <p class="mt-1 max-w-2xl text-sm leading-5 text-gray-500">
                        Use a permanent address where the organisation can receive mail.
                    </p>
                </div>

                <div class="mt-6 sm:mt-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                    <label for="organisation" class="block text-sm font-medium leading-5 text-gray-700 sm:mt-px sm:pt-2">
                        Organisation name
                    </label>
                    <div class="mt-1 sm:mt-0 sm:col-span-2">
                        <div class="max-w-lg rounded-md shadow-sm sm:max-w-xs">
                            <input id="organisation" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                        </div>
                    </div>
                </div>

                <div class="mt-6 sm:mt-5">

                    <x-gc.form-input name="organisation_name">Organisation name</x-gc.form-input>

                    <x-gc.form-input name="contact_name">Contact name</x-gc.form-input>

                    <x-gc.form-input name="contact_email">Contact email address</x-gc.form-input>

                    <x-gc.form-input name="contact_name">Contact name</x-gc.form-input>






                    <div class="mt-6 sm:mt-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                        <label for="street_address" class="block text-sm font-medium leading-5 text-gray-700 sm:mt-px sm:pt-2">
                            Street address
                        </label>
                        <div class="mt-1 sm:mt-0 sm:col-span-2">
                            <div class="max-w-lg rounded-md shadow-sm sm:max-w-xs">
                                <input id="street_address" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 sm:mt-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                        <label for="city" class="block text-sm font-medium leading-5 text-gray-700 sm:mt-px sm:pt-2">
                            City
                        </label>
                        <div class="mt-1 sm:mt-0 sm:col-span-2">
                            <div class="max-w-lg rounded-md shadow-sm sm:max-w-xs">
                                <input id="city" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 sm:mt-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                        <label for="state" class="block text-sm font-medium leading-5 text-gray-700 sm:mt-px sm:pt-2">
                            State
                        </label>
                        <div class="mt-1 sm:mt-0 sm:col-span-2">
                            <div class="max-w-lg rounded-md shadow-sm sm:max-w-xs">
                                <select id="state" name="state" class="block form-select w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                                    <option>Victoria</option>
                                    <option>New South Wales</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 sm:mt-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                        <label for="postcode" class="block text-sm font-medium leading-5 text-gray-700 sm:mt-px sm:pt-2">
                            Postcode
                        </label>
                        <div class="mt-1 sm:mt-0 sm:col-span-2">
                            <div class="max-w-lg rounded-md shadow-sm sm:max-w-xs">
                                <input id="postcode" name="postcode" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-8 border-t border-gray-200 pt-8 sm:mt-5 sm:pt-10">
                <div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        Notifications
                    </h3>
                    <p class="mt-1 max-w-2xl text-sm leading-5 text-gray-500">
                        We'll always let you know about important changes, but you pick what else you want to hear about.
                    </p>
                </div>
                <div class="mt-6 sm:mt-5">
                    <div class="sm:border-t sm:border-gray-200 sm:pt-5">
                        <div role="group" aria-labelledby="label-email">
                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-baseline">
                                <div>
                                    <div class="text-base leading-6 font-medium text-gray-900 sm:text-sm sm:leading-5 sm:text-gray-700" id="label-email">
                                        By Email
                                    </div>
                                </div>
                                <div class="mt-4 sm:mt-0 sm:col-span-2">
                                    <div class="max-w-lg">
                                        <div class="relative flex items-start">
                                            <div class="flex items-center h-5">
                                                <input id="comments" type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out">
                                            </div>
                                            <div class="ml-3 text-sm leading-5">
                                                <label for="comments" class="font-medium text-gray-700">Comments</label>
                                                <p class="text-gray-500">Get notified when someones posts a comment on a posting.</p>
                                            </div>
                                        </div>
                                        <div class="mt-4">
                                            <div class="relative flex items-start">
                                                <div class="flex items-center h-5">
                                                    <input id="candidates" type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out">
                                                </div>
                                                <div class="ml-3 text-sm leading-5">
                                                    <label for="candidates" class="font-medium text-gray-700">Candidates</label>
                                                    <p class="text-gray-500">Get notified when a candidate applies for a job.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-4">
                                            <div class="relative flex items-start">
                                                <div class="flex items-center h-5">
                                                    <input id="offers" type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out">
                                                </div>
                                                <div class="ml-3 text-sm leading-5">
                                                    <label for="offers" class="font-medium text-gray-700">Offers</label>
                                                    <p class="text-gray-500">Get notified when a candidate accepts or rejects an offer.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="mt-8 border-t border-gray-200 pt-5">
            <div class="flex justify-end">
                <span class="inline-flex rounded-md shadow-sm">
                    <button type="button" class="py-2 px-4 border border-gray-300 rounded-md text-sm leading-5 font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out">
                        Cancel
                    </button>
                </span>
                <span class="ml-3 inline-flex rounded-md shadow-sm">
                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
                        Save
                    </button>
                </span>
            </div>
        </div>
    </form>


</div>