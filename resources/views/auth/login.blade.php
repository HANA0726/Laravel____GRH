@extends('layouts.app')
@section('title')
Se connceter
@endsection
@section('content')
<link href="{{asset('css/style.css')}}" rel="stylesheet">
<link href="{{asset('css/styleForm.css')}}" rel="stylesheet">
<div class="container mt-1">
    <div class="row ">
    <div class="col-md-6">
            <img src="{{asset('/images/image1.png')}}"  style="width:500px;"alt="">
        </div>   
    <div class="col-md-6">
            <div class="card  emp emp1 setting mt-4">
               
                <h2 class="text-center titleCard p-1" style="color:#00ED64;font-weight:bold;">Se Co<span style="color:#952D98;font-weight:bold;">nn</span>ecter </h2>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="form-label">{{ __('Adresse email :') }}</label>

                            
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder=" Saisir votre email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        

                        <div class="row mb-3">
                            <label for="password" class="form-label">{{ __('Mot de passe : ') }}</label>

                           
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder=" Saisir votre  mot de passe" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                       

            
                        <div class="row mb-2">
                          
                            <button type="submit" class="btn vert-button mx-auto d-block">
                                    {{ __('Valider') }}
                                </button>
                         

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}" style="color:#000000;font-weight:bold;">
                                        {{ __('Mot de passe oublié?') }}
                                    </a>
                                @endif
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
      
    </div>
</div>
@endsection
