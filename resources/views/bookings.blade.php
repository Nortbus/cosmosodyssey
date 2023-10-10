@extends('overlay.app')
@section('content')
@isset($booking)
<div class="flex justify-center">
     <div class="mt-24 basis-1/3 trigger justify-center p-4 text-white bg-gray-950 hover:bg-gray-900 mb-2 rounded uppercase">
        <p class="mb-6 text-xl text-gray-400">You have a flight coming up!</p>
     <p><span class="text-sm text-gray-400">Passenger:</span> {{$booking->firstname}} {{$booking->lastname}}</p> 
        <p><span class="text-sm text-gray-400">Route:</span>  {{$booking->route}}</p>
        <p><span class="text-sm text-gray-400">Flight dates:</span> {{$booking->traveltime}}</p>
        <p><span class="text-sm text-gray-400">Ticket price:</span> {{$booking->price}}€</p>
        <p><span class="text-sm text-gray-400">Travel company:</span> {{$booking->company}}</p>
        <p><span class="text-sm text-gray-400">Reservation number:</span> {{$booking->bookingnr}}</p>
        </div>
     </div> 
     <div class="flex justify-center p-4">
        <a href="{{ route('routes') }}" class="p-2 text-white rounded-lg bg-gray-950/50 hover:text-blue-300">Back</a>
    </div>   
@else
<div class="flex justify-center">
     <div class="mt-24 basis-1/3 trigger justify-center p-4 text-white mb-2 rounded uppercase">
        <p class="mb-6 text-2xl text-center">We are sorry, but we couldn't find any reservations with that number..</p>
        <div class="flex justify-center p-4">
        <a href="{{ route('routes') }}" class="p-2 text-white rounded-lg bg-gray-950/50 hover:text-blue-300">Back</a>
    </div> 
    </div>
         
@endisset

@endsection 
</body>
</html>