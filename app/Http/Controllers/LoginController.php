<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function show(){
    
    
    return view('login');
    }
    
    
    public function login(Request $request){

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
          ]);

          if (!auth()->attempt($request->only('email', 'password'))) {
            $request->session()->flash('nope', 'Nope, you are not getting in');
            return back();
          }
          return redirect()->route('admin');
    }

}