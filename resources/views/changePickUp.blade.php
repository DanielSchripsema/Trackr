<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            change pick up
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3>At least 1 day in advance before 15:00.</h3>
                    @if (count(array($packages)) > 0)

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="GET" action="ConfirmPickUpChange">
                            @csrf
                            <x-button value="submit" style="margin: 10px; margin-right: 5px;">
                                change pick up
                            </x-button>


                            <div class="form-group">
                                <label for="formGroupExampleInput">Country:</label>
                                <input type="text" class="form-control" name="Country"  placeholder="Country input">
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput">Srteet name:</label>
                                <input type="text" class="form-control" name="Srteetname" placeholder="Srteet name input">
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput">house number:</label>
                                <input type="number" class="form-control" name="housenumber" placeholder="house number input">
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput">postal code:</label>
                                <input type="text" class="form-control" name="postalcode" placeholder="postal code input">
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput">City:</label>
                                <input type="text" class="form-control" name="City" placeholder="City input">
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput">Date:</label>
                                <input type="datetime-local" class="form-control" name="Date" >
                            </div>




                            <br>
                            <hr>

                            @foreach ($packages as $package)

                                <br>
                                <h3 class="font-semibold text-xl text-gray-800 leading-tight">
                                    {{ __('Package') }}
                                </h3>
                                <input type="hidden" name="package[]" value="{{ $package->id }}">

                                Aangemeld sinds: {{ $package->created_at}} <br>
                                Status: {{ $package->status}} <br>
                                Sender: {{ $package->Sender->name }}  <br>
                                Sharable link: <span style="background-color: lightgray; color: black">
			{{ $package->guest_link }}
			</span><br>

                                <div style="display: flex; padding: 5px">
                                    <div style="margin: 5px">
                                        Sender Addresss:<br>
                                        {{ $package->SenderAddress->firstname }}
                                        {{ $package->SenderAddress->lastname}} <br>
                                        {{ $package->SenderAddress->street_name}}
                                        {{ $package->SenderAddress->house_number}} <br>
                                        {{ $package->SenderAddress->postal_code}}
                                        {{ $package->SenderAddress->city}}<br>
                                        {{ $package->SenderAddress->country}} <br>
                                    </div>
                                    <div style="margin: 5px; margin-left: 30px">
                                        Recipient Address:<br>
                                        {{ $package->RecipientAddress->firstname }}
                                        {{ $package->RecipientAddress->lastname}} <br>
                                        {{ $package->RecipientAddress->street_name}}
                                        {{ $package->RecipientAddress->house_number}} <br>
                                        {{ $package->RecipientAddress->postal_code}}
                                        {{ $package->RecipientAddress->city}}<br>
                                        {{ $package->RecipientAddress->country}} <br>
                                    </div>

                                </div>

                                <hr>
                            @endforeach
                            <x-button value="submit" style="margin: 10px;">
                                change pick up
                            </x-button>

                        </form>
                    @else
                        No packages fround
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

