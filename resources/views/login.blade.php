@extends('overlay.app')
@section('content')
<form method="POST" action="{{ route('login') }}">
    {!! csrf_field() !!}
 
    <div id="form" class="mt-36 relative inset-0 flex max-h-screen items-center justify-start">
    <div class="bg-gray-950  text-white rounded mx-auto w-full max-w-lg p-4 drop-shadow-lg">
    <div>
      <a href="javascript:history.back()">
        <svg id="close" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="hover:text-blue-300 w-6 h-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </a>
    </div>
    <h1 class="text-4xl font-medium mb-12">Login</h1>

      <div class="grid gap-6 sm:grid-cols-2">
        <div class="relative z-0">
          <input type="text" name="email" class="peer block w-full appearance-none border-0 border-b border-gray-500 bg-transparent py-2.5 px-0 text-sm text-white" placeholder=" " />
          <label class="absolute top-0.5 -z-10 origin-[0] -translate-y-6 scale-75 transform text-sm text-gray-500 duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:left-0 peer-focus:-translate-y-6 peer-focus:scale-75 peer-focus:text-white">Email</label>
        </div>
        <div class="relative z-0">
          <input type="password" name="password" class="peer block w-full appearance-none border-0 border-b border-gray-500 bg-transparent py-2.5 px-0 text-sm text-white" placeholder=" " />
          <label class="absolute top-0.5 -z-10 origin-[0] -translate-y-6 scale-75 transform text-sm text-gray-500 duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:left-0 peer-focus:-translate-y-6 peer-focus:scale-75 peer-focus:text-white">Password</label>
        </div>
        @error('email')
              <div class="text-red-400 text-sm">
                  Please enter a valid email
              </div>
        @enderror
        @error('password')
              <div class="text-red-400 text-sm">
                  You need to enter a password to get in
              </div>
        @enderror
        @if (session()->has('nope'))
        <div class="text-red-400 text-sm">
            {{ session('nope') }}
              </div>
        @endif
      </div>
      <button type="submit" class="mt-12 rounded-md bg-gray-100 px-10 py-2 text-black">Login</button>
  </div>
</div>
</form>
@endsection