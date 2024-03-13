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
            <div class="card emp emp1 setting mt-5">
                <h2 class="text-center titleCard p-1 mb-4" style="color:#00ED64;font-weight:bold;">Récupérer <span style="color:#952D98;font-weight:bold;"> votre mot </span> de passe</h2>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="form-label">{{ __('Adresse email :') }}</label>

                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"  placeholder="Saisir votre adresse email"name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        

                        <div class="row mb-0">
                            
                                <button type="submit" class="btn vert-button mx-auto d-block">
                                    {{ __('Recevoir le lien de récuperation') }}
                                </button>
                           
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
