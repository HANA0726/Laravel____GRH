@extends('layouts.app')
@section('title')
Récupération du mot de passe
@endsection
@section('content')
<link href="{{asset('css/style.css')}}" rel="stylesheet">
<link href="{{asset('css/styleForm.css')}}" rel="stylesheet">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card emp emp1 setting mt-4">
            <h2 class="text-center titleCard p-1 mb-4" style="color:#00ED64;font-weight:bold;">Récupérer <span style="color:#952D98;font-weight:bold;"> votre mot </span> de passe</h2>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="row mb-3">
                            <label for="email" class="form-label">{{ __('Adresse email :') }}</label>

                            
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" placeholder="Saisir votre adresse email" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="form-label">{{ __('Mot de passe :') }}</label>

                         
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  placeholder="Saisir votre nouveau mot de passe"required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        

                        <div class="row mb-3">
                            <label for="password-confirm" class="form-label">{{ __('Confirmation du mot de passe :') }}</label>

                            
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirmer votre mot de passe" required autocomplete="new-password">
                           
                        </div>

                        <div class="row mb-0">
                            
                            <button type="submit" class="btn vert-button mx-auto d-block">
                                    {{ __('Réinitialiser') }}
                                </button>
                          
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
