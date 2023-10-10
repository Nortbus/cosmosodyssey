<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Provider;

class ReservationController extends Controller
{ 
    public function store(Request $request, Booking $booking){
        
        $this->validate($request, [
            'firstname' => 'required|max:25',
            'lastname' => 'required||unique:bookings,lastname,NULL,id,firstname,'.$request->firstname.'|max:25',
            ]);
        
        $bookingnr = bin2hex(openssl_random_pseudo_bytes(5));  
        
        Booking::firstOrCreate([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'route' => $request->route,
            'price' => $request->price,
            'traveltime' => $request->traveltime,
            'company' => $request->company,
            'bookingnr' => $bookingnr,
            'listid' => $request->listid,
        ]);
        $request->session()->flash('message', $bookingnr);
        return redirect()->route('routes');
    }

    public function show(Request $request){
        
        $this->validate($request, [
            'bookingnr' => 'required',
            ]);

        $bookingnr = $request->bookingnr;
        $booking = Booking::where('bookingnr', $bookingnr)->first();

        
        return view('bookings', ['booking' => $booking]);
    }

    public function admin(){

        $bookings = Booking::paginate(4);

        return view('adminbookings', ['bookings' => $bookings]);
    }
}
    
