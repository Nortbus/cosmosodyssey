@extends('overlay.app')
@section('content')
    <div class="flex justify-center p-2">
        <a href="{{ route('routes') }}" class="text-blue-200 hover:text-blue-300">Back</a>
    </div>
    <div class="flex justify-center mb-4 text-white text-xl uppercase">Find the best deal for you!</div>
    <div class="flex justify-center">
    <form action="{{ route('providers', $route->routeid) }}" type="get">
        <select style="cursor: pointer" name="filter" onchange="this.form.submit()" id="location_select" class="block  px-2 text-xl text-white bg-transparent border-0 border-b-2 border-gray-200 appearance-none focus:outline-none focus:ring-0 focus:border-gray-200 peer">     
            <option class="text-gray-400">Filter</option>
            <option value="time" class="text-black" @if($search == 'time') selected @endif>Shortest trip</option>
            <option value="price" class="text-black" @if($search == 'price') selected @endif>Best price</option>
            <optgroup class="text-black" label="Companies">
            @foreach($provlists as $provlist)
            <option value="{{$provlist->company}}" {{$search == $provlist->company ? 'selected' : ''}} class="text-black">{{$provlist->company}}</option>
            @endforeach
            </optgroup>
        </select>
    </form>
    </div>
    @foreach($providers as $provider)
    <?php
    $startDateinput = $provider->flightstart;
    $startDate = strtotime($startDateinput);
    ?>
     <div class="flex justify-center">
     <div class="mobile trigger justify-center p-4 text-white bg-gray-950 hover:bg-gray-900 mb-2 rounded uppercase" onclick="location.href='{{ route('book', $provider) }}'" style="cursor: pointer;">
        <strong><span class="text-gray-400">Travel company:</span> {{$provider->company}}</strong>
        <p><span class="text-gray-400">Route:</span> {{$route->from}} to {{$route->to}}</p> 
        <p><span class="text-gray-400">Price:</span> {{$provider->price}}€</p>
        <p><span class="text-gray-400">Take off:</span> {{date('d/M/y', $startDate)}}</p>
        <p><span class="text-gray-400">Travel time:</span> {{$provider->flighttime}} @if ($provider->flighttime == '1') day @else days @endif</p>
        </div>
     </div>
   
    @endforeach
    {{ $providers->appends(request()->query())->links() }}
@endsection    
</body>
</html>