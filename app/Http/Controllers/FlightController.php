<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Route;
use App\Models\Provider;

class FlightController extends Controller
{
    public function routes(Request $request){
        
        $location = $request->query('location'); 

        $routes =  Route::where('from', $location)->latest()->get()->unique('to'); 
        $options = Route::select('from')->distinct()->get();
        return view('index', ['routes' => $routes, 'options' => $options, 'location' => $location]);
        }
        
    public function providers(Request $request, $routeid){
            
        $providers = Provider::where('routeid', $routeid);
        $provlists = Provider::where('routeid', $routeid)->select('company')->distinct()->get(); 
        $route = Route::where('routeid', $routeid)->first();  
        $search = $request->query('filter');

        if ($search == 'price'){
          $providers = Provider::where('routeid', $routeid)->orderBy('price', 'asc')->paginate(4);
          return view('providers', ['providers' => $providers, 
                                    'route' => $route, 
                                    'provlists' => $provlists,
                                    'search' => $search]);  
        }
        if ($search == 'time'){
            
            $providers = Provider::where('routeid', $routeid)->orderBy('flighttime', 'asc')->paginate(4);
            return view('providers', ['providers' => $providers, 
                                    'route' => $route, 
                                    'provlists' => $provlists,
                                    'search' => $search]);  
          }
        if ($search){
            $providers = Provider::where('routeid', $routeid)->where('company', $search)->paginate(4);
            return view('providers', ['providers' => $providers, 
                                    'route' => $route, 
                                    'provlists' => $provlists,
                                    'search' => $search]);  
          }
        
        return view('providers', ['providers' => $providers->paginate(4), 
                                    'route' => $route, 
                                    'provlists' => $provlists,
                                    'search' => $search]);
        
    }

    public function book(Provider $provider){

        $route =  Route::where('routeid', $provider->routeid)->first();
        
        return view('bookingform', ['provider' => $provider, 'route' => $route]);

    }
}