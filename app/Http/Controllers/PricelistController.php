<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pricelist;
use App\Models\Route;
use App\Models\Provider;
use App\Models\Booking;
use Illuminate\Support\Facades\Http;

class PricelistController extends Controller
{
    function store(){
        $listraw = Http::get('https://cosmos-odyssey.azurewebsites.net/api/v1.0/TravelPrices');
        $lists = Http::get('https://cosmos-odyssey.azurewebsites.net/api/v1.0/TravelPrices')['legs'];
        
        Pricelist::firstOrCreate([
            'listid' => $listraw['id'],
            'validuntil' => $listraw['validUntil']
        
        ]);
        foreach ($lists as $list){
            Route::firstOrCreate([           
                'listid' => $listraw['id'],
                'routeid' => $list['id'],
                'routeid2' => $list['routeInfo']['id'],
                'fromid' => $list['routeInfo']['from']['id'],
                'from' => $list['routeInfo']['from']['name'],
                'toid' => $list['routeInfo']['to']['id'],
                'to' => $list['routeInfo']['to']['name'],
                'distance' => $list['routeInfo']['distance'],
                
            ]);}
            
        
    
        foreach ($lists as $list){
            $providers = $list['providers'];
            $listrawid = $listraw;
            foreach ($providers as $provider){
                $startDateinput = $provider['flightStart'];
                $startDate = strtotime($startDateinput);
                $start = date('ymd', $startDate);
                $endDateinput = $provider['flightEnd'];
                $endDate = strtotime($endDateinput);
                $end = date('ymd', $endDate);
                $flighttime = $end - $start;
                Provider::firstOrCreate([           
                    'listid' => $listrawid['id'],
                    'routeid' => $list['id'],
                    'providersid' => $provider['id'],
                    'companyid' => $provider['company']['id'],
                    'company' => $provider['company']['name'],
                    'price' => $provider['price'],
                    'flightstart' => $provider['flightStart'],
                    'flightend' => $provider['flightEnd'],
                    'flighttime' => $flighttime,
                    
                ]);}
        }
        
        $count = Pricelist::count();

        $deleteUs = Pricelist::latest()->take($count)->skip(15)->get();

        foreach($deleteUs as $deleteMe){
            Pricelist::where('listid',$deleteMe->listid)->delete();
            Route::where('listid',$deleteMe->listid)->delete();
            Provider::where('listid',$deleteMe->listid)->delete();
            Booking::where('listid',$deleteMe->listid)->delete();
        }

        return response()->json(['success'=> "What's Up(time)?"]);
    }
    
}
