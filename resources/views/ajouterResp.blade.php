@extends('layouts.main')
@section('title-content')
Ajouter Responsable
@endsection
@section('content')
<div class="container mb-5">
<link href="{{asset('css/styleForm.css')}}" rel="stylesheet">
    <div class="row justify-content-center">
    @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
        <div class="col-md-6">
            <div class="card emp emp1 setting">
                <div class="card-body">
                <form method="POST" action="{{route('admin.ajouterResp.validation')}}">
                <h2 class="inf">{{ __('Informations du compte') }}</h2>
                        @csrf
                        <div class="mb-1">
                        <label for="nom" class="form-label">Nom :</label>
                        <input type="text" class="form-control" id="name" placeholder="Nom"  value="{{old('name')}}"name="name" >
                        @error('name')
                        <div class=" text  text-danger"> {{$message}}</div>
                        @enderror
                         </div>
                         
                        <div class="mb-1">
                        <label for="email" class="form-label">Adresse Email :</label>
                        <input type="text" class="form-control" id="email" placeholder="Email"  value="{{old('email')}}" name="email" required autocomplete="email">
                        @error('email')
                        <div class=" text  text-danger"> {{$message}}</div>
                        @enderror
                         </div>
                        <div class="mb-1">
                            <label for="password" class="form-label ">{{ __('Mot de passe :') }}</label>
                                <input id="password" type="password" class="form-control" placeholder="mot de passe" name="password" required autocomplete="new-password">
                                @error('password')
                               <div class=" text  text-danger"> {{$message}}</div>
                               @enderror
                          
                        </div>

                        <div class="mb-2">
                            <label for="password-confirm" class="form-label">{{ __('Confimation de mot de passe :') }}</label>
                                <input id="password-confirm" type="password" class="form-control" placeholder=" Confirmation mot de passe" name="password_confirmation" required autocomplete="new-password">
                           
                        </div>

                       
                                <button type="submit" class="btn move-button mx-auto d-block">
                                    {{ __('Valider') }}
                                </button>
                         
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
  const passwordInput = document.getElementById('password');
  const confirmPasswordInput = document.getElementById('password-confirm');
  const form = document.querySelector('form');

  function validatePasswords() {
    if (passwordInput.value !== confirmPasswordInput.value) {
      confirmPasswordInput.setCustomValidity("Les mots de passe ne correspondent pas.");
    } else {
      confirmPasswordInput.setCustomValidity("");
    }
  }

  passwordInput.addEventListener("change", validatePasswords);
  confirmPasswordInput.addEventListener("keyup", validatePasswords);
  
  form.addEventListener('submit', function(event) {
    if (!form.checkValidity()) {
      event.preventDefault();
      // Afficher un message d'erreur ou effectuer une autre action en cas de validation invalide.
    }
  });
</script>

@endsection
