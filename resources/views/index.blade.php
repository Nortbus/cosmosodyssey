@extends('overlay.app')
@section('content')


@if (session()->has('message'))
        
        @endif
  <div>
@if ($routes->count())
    <div id="start" class="flex justify-center">
     <div class="text-2xl mt-12 hover:drop-shadow-lg p-8 bg-gray-950/50 text-white mb-2 rounded-lg uppercase">
        <strong>Where would you like to go?</strong>
        </div>
    </div>

    <div class="text-white flex justify-center uppercase">your current location:</div>
    <div class="mt-2 mb-4 flex justify-center">
    <form action="{{ route('routes') }}" type="get">
    <label for="underline_select" class="sr-only">Underline select</label>
    <select id="countries" style="cursor: pointer" name="location" onchange="this.form.submit()" id="location_select" class="block  px-2 text-xl text-white bg-transparent border-0 border-b-2 border-gray-200 appearance-none focus:outline-none focus:ring-0 focus:border-gray-200 peer">
    <option class="text-gray-300">Choose your location</option>
    @foreach($options as $option)
    <option class="text-black" value="{{$option->from}}" {{$location == $option->from ? 'selected' : ''}}>{{$option->from}}</option>
    @endforeach
    </select>
    </form>
    </div>

    @foreach($routes as $route)
     <div class="flex justify-center">
     <div class="hover:drop-shadow-lg p-4 hover:bg-gray-900 text-white bg-gray-950 mb-2 rounded uppercase" onclick="location.href='{{ route('providers', $route->routeid) }}'" style="cursor: pointer">
         Fly to 
        <strong>{{$route->to}}</strong>
        <p class="text-gray-400"">it's only {{$route->distance}} km away</p>
        </div>
     </div>

    @endforeach
    </div>
@elseif (session()->has('message'))
<div class="flex justify-center">
            <div class="grid grid-cols-1 rounded bg-gray-950 p-6 mt-4">
                <div class="place-self-center text-white text-2xl">Your reservation was succesful!</div>
                <div class="place-self-center text-gray-400 text-xl">Don't forget to write down your reservation number:</div>
                <div class="place-self-center text-white text-2xl">{{ session('message') }}</div>
            </div>
        </div>
        <div class="mt-2 flex justify-center">
        <a href="." class="flex justify-center p-2 text-white rounded-lg bg-gray-950/50 hover:text-blue-300">Back</a>
        </div>
@else
    <div class="flex justify-center">
     <div class="text-2xl mt-12 hover:drop-shadow-lg p-8 bg-gray-950/50 text-white mb-2 rounded-lg uppercase">
        <strong>Start your journey today!</strong>
        </div>
    </div>
     <div class="mt-24 mb-4 flex justify-center">
        <form action="{{ route('routes') }}" type="get">
        <label for="location" class="sr-only">Underline select</label>
        <select id="location" style="cursor: pointer" name="location" onchange="this.form.submit()" id="location_select" class="block py-2.5 px-2 text-xl text-white bg-transparent border-0 border-b-2 border-gray-200 appearance-none focus:outline-none focus:ring-0 focus:border-gray-200 peer">
        <option class="text-gray-300">Choose your location</option>
    @foreach($options as $option)
        <option class="text-black" value="{{$option->from}}" {{$location == $option->from ? 'selected' : ''}}>{{$option->from}}</option>
    @endforeach
        </select>
        </form>
    </div>
@endif


@endsection
</div>
</body>
</html>