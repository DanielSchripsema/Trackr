
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard / Outgoing packages') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
		@if (count($packages) > 0)

		<form method="POST" action="print-lables">
			@csrf
		<x-button value="submit" style="margin: 10px; margin-right: 5px;">
			Print labels
		</x-button>
		<x-button type="button" style="margin: 10px; margin-left: 5px;" onclick="
			var checkboxes = document.getElementsByName('package[]');
			for (var checkbox of checkboxes){
				checkbox.checked = true;
			}">
			Select all
		</x-button>

		<br>
		<hr>

		@foreach ($packages as $package)
			
			<br>			
		        <h3 class="font-semibold text-xl text-gray-800 leading-tight">
			    {{ __('Package') }}
			</h3>
			<div style="float: right">
			     Print label: 
			     <input type="checkbox" name="package[]" value="{{ $package->id }}">
			</div>

			Status: {{ $package->status}} <br>
			Sender: {{ $package->Sender->name }}  <br>
			Sharable link: <span style="background-color: lightgray; color: black">
			{{ $package->guest_link }}	
			</span><br>
			@if ($package->review != NULL)
			Recipient feedback: 
				@if ($package->review->text != NULL) <q>{{ $package->review->text }}</q> @endif 
				@for ($i = 0; $i < $package->review->stars; $i++) &#9733 @endfor /
				@for ($i = 0; $i < 5; $i++) &#9733 @endfor
			@endif
			
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
			<div style="margin: 5px; margin-left: 30px">
			Barcode:<br>
			{!! $package->barcode !!}
			{{ $package->barcode_str }} 
			</div>
			</div>
		
			<hr>
		@endforeach
		<x-button value="submit" style="margin: 10px;">
			Print labels
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
