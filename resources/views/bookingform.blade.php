@extends('overlay.app')
@section('content')
<?php
    $startDateinput = $provider->flightstart;
    $startDate = strtotime($startDateinput);
    $endDateinput = $provider->flightend;
    $endDate = strtotime($endDateinput);
    ?>
<div id="form" class="mt-36 relative inset-0 flex max-h-screen items-center justify-start">
    <div class="bg-gray-950  text-white rounded mx-auto w-full max-w-lg p-4 drop-shadow-lg">
    <div>
      <a href="javascript:history.back()">
        <svg id="close" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="hover:text-blue-300 w-6 h-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </a>
    </div>
    <h1 class="text-4xl font-medium">Get your booking now</h1>
    <p class="mt-3">Reserve a seat on flight with {{$provider->company}}</p>

    <form action="{{ route('store', $provider) }}" method="post" class="mt-10">
    @csrf
      <div class="grid gap-6 sm:grid-cols-2">
        <div class="relative z-0">
          <input type="text" name="firstname" class="peer block w-full appearance-none border-0 border-b border-gray-500 bg-transparent py-2.5 px-0 text-sm text-white" placeholder=" " />
          <label class="absolute top-0.5 -z-10 origin-[0] -translate-y-6 scale-75 transform text-sm text-gray-500 duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:left-0 peer-focus:-translate-y-6 peer-focus:scale-75 peer-focus:text-white">First name</label>
        </div>
        <div class="relative z-0">
          <input type="text" name="lastname" class="peer block w-full appearance-none border-0 border-b border-gray-500 bg-transparent py-2.5 px-0 text-sm text-white" placeholder=" " />
          <label class="absolute top-0.5 -z-10 origin-[0] -translate-y-6 scale-75 transform text-sm text-gray-500 duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:left-0 peer-focus:-translate-y-6 peer-focus:scale-75 peer-focus:text-white">Last name</label>
        </div>
        @error('firstname')
              <div class="text-red-400 text-sm">
                  Please enter your first name
              </div>
        @enderror
        @error('lastname')
              <div class="text-red-400 text-sm">
                  You didn't enter your last name or you might already have a reservation!
              </div>
        @enderror
        <div class="relative z-0 col-span-2">
          <p class="text-sm mb-2 text-gray-500">Flight details:</p>
          <p class="text-xs mb-1 text-gray-500">Route | <span class="text-xs text-white">{{$route->from}} to {{$route->to}}</span></p>
          <p class="text-xs mb-1 text-gray-500">Price | <span class="text-xs text-white">{{$provider->price}}€</span></p>
          <p class="text-xs mb-1 text-gray-500">Travel time | <span class="text-xs text-white">{{date('d/M/Y | h:i', $startDate)}} - {{date('d/M/Y | h:i', $endDate)}}</span></p>
          <p class="text-xs mb-1 text-gray-500">Company | <span class="text-xs text-white">{{$provider->company}}</span></p>
          <input class="hidden" name="route" value="{{$route->from}} to {{$route->to}}"/>
          <input class="hidden" name="price" value="{{$provider->price}}"/>
          <input class="hidden" name="traveltime" value="{{date('d/M/Y | h:i', $startDate)}} - {{date('d/M/Y | h:i', $endDate)}}"/>
          <input class="hidden" name="company" value="{{$provider->company}}"/>
          <input class="hidden" name="listid" value="{{$provider->listid}}"/>
        </div>
      </div>
      <button type="submit" class="mt-5 rounded-md bg-gray-100 px-10 py-2 text-black">Confirm</button>
    </form>
  </div>
</div>
@endsection 
</body>
</html>