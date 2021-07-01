
<div class="w-full block mt-8">
    <div class="flex flex-wrap sm:flex-no-wrap justify-between">
        <div class="w-full sm:max-w-sm bg-gray-200 text-center border border-gray-300 rounded px-8 py-6 my-4 sm:my-0">
            <h3 class="text-gray-700 uppercase font-bold">
                <span class="text-4xl">{{ sprintf("%02d", $contacts->count()) }}</span>
                <span class="leading-tight">Messages de L'Adiministration</span>
            </h3>
        </div>
    </div>
</div>

<div class="w-full block mt-4 sm:mt-8">
    <div class="flow-root">
        @foreach ($contacts as $key => $contact)
            <div
                class="w-full bg-gray-200 text-center border border-gray-300 rounded px-8 py-6 mb-4 {{ ($key>=1) ? 'ml-0 sm:ml-2' : '' }}">
                <div class="text-gray-700 font-bold">
                    <div class="mb-6">
                        <div class="text-lg uppercase">{{ $contact->user->name }}</div>
                        <div class="text-sm lowercase leading-tight">{{ $contact->user->email }}</div>
                    </div>

                    <div class="flex items-center justify-center">
                        <div class=" text-left">{{ $contact->subject }}</div>
                    </div>

                    <div class="flex items-center justify-center mt-5">
                        <div class=" text-left">Message :</div>
                        <div class=" text-sm text-left ml-2">{{ $contact->message }}</div>
                    </div>

                </div>
            </div>
        @endforeach  
    </div>
</div><!-- ./END ENSEIGNANT -->

<div class="w-full block mt-8">
    <div class="flex flex-wrap sm:flex-no-wrap justify-between">
        <div class="w-full sm:max-w-sm bg-gray-200 text-center border border-gray-300 rounded px-8 py-6 my-4 sm:my-0">
            <h3 class="text-gray-700 uppercase font-bold">
                <span class="text-4xl">{{ sprintf("%02d", $tcontacts->count()) }}</span>
                <span class="leading-tight">Messages de L'enseigants</span>
            </h3>
        </div>
    </div>
</div>

<div class="w-full block mt-4 sm:mt-8">
    <div class="flow-root">
        @foreach ($tcontacts as $key => $tcontact)
            <div
                class="w-full bg-gray-200 text-center border border-gray-300 rounded px-8 py-6 mb-4 {{ ($key>=1) ? 'ml-0 sm:ml-2' : '' }}">
                <div class="text-gray-700 font-bold">
                    <div class="mb-6">
                        <div class="text-lg uppercase">{{ $tcontact->user->name }}</div>
                        <div class="text-sm lowercase leading-tight">{{ $tcontact->user->email }}</div>
                    </div>

                    <div class="flex items-center justify-center">
                        <div class=" text-left">{{ $tcontact->subject }}</div>
                    </div>

                    <div class="flex items-center justify-center mt-5">
                        <div class=" text-left">Message :</div>
                        <div class=" text-sm text-left ml-2">{{ $tcontact->message }}</div>
                    </div>

                </div>
            </div>
        @endforeach  
    </div>
</div><!-- ./END ENSEIGNANT -->

