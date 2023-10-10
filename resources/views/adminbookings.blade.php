@extends('overlay.app')
@section('content')
@auth

@if($bookings->count())
<div id="start" class="flex justify-center">
     <div class="text-2xl mt-12 hover:drop-shadow-lg p-8 bg-gray-950/50 text-white mb-2 rounded-lg uppercase">
        <strong>Here you can see all reservations:</strong>
        </div>
    </div>
@foreach ($bookings as $booking)
<div class="flex justify-center">
     <div class="mt-2 basis-1/3 trigger justify-center p-4 text-white bg-gray-950 hover:bg-gray-900 rounded uppercase">
     <p><span class="text-sm text-gray-400">Passenger:</span> {{$booking->firstname}} {{$booking->lastname}}</p> 
        <p><span class="text-sm text-gray-400">Route:</span>  {{$booking->route}}</p>
        <p><span class="text-sm text-gray-400">Flight dates:</span> {{$booking->traveltime}}</p>
        <p><span class="text-sm text-gray-400">Ticket price:</span> {{$booking->price}}€</p>
        <p><span class="text-sm text-gray-400">Travel company:</span> {{$booking->company}}</p>
        <p><span class="text-sm text-gray-400">Reservation number:</span> {{$booking->bookingnr}}</p>
        </div>
     </div> 
@endforeach
@else
<div id="start" class="flex justify-center">
     <div class="text-2xl mt-12 hover:drop-shadow-lg p-8 bg-gray-950/50 text-white mb-2 rounded-lg uppercase">
        <strong>There are no reservations yet</strong>
        </div>
    </div>
@endif

{{ $bookings->links() }}  
@endauth
@endsection