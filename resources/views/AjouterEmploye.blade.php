@extends('layouts.main')
@section('title-content')
Ajouter Employé
@endsection
@section('content')
<link href="{{asset('css/styleForm.css')}}" rel="stylesheet">
<link href="{{asset('assets/css/toastr.min.css')}}" rel="stylesheet" > 
<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card emp emp1 setting">
            

                <div class="card-body">
                <form method="POST" action="{{ auth()->user()->role=='1' ? route('admin.AjouterEmploye.validation'): route('RespRh.Employe.validation')}}">
                <h2 class="inf text-center">{{ __('Informations du compte') }}</h2>
                        @csrf

                        <div class="mb-1">
                        <label for="nom" class="form-label">Nom <span style="color: red; font-size: 20px;">*</span>:</label>
                        <input type="text" class="form-control" id="name" placeholder="Nom"  value="{{old('name')}}"name="name" >
                        @error('name')
                        <div class=" text  text-danger"> {{$message}}</div>
                        @enderror
                         </div>
                         
                        <div class="mb-1">
                        <label for="email" class="form-label">Adresse Email <span style="color: red; font-size: 20px;">*</span>:</label>
                        <input type="text" class="form-control" id="email" placeholder="Email"  value="{{old('email')}}" name="email" required autocomplete="email">
                        @error('email')
                        <div class=" text  text-danger"> {{$message}}</div>
                        @enderror
                         </div>
                        <div class="mb-1">
                            <label for="password" class="form-label ">Mot de passe <span style="color: red; font-size: 20px;">*</span>:</label>
                                <input id="password" type="password" class="form-control" placeholder="mot de passe" name="password" required autocomplete="new-password">
                                @error('password')
                               <div class=" text  text-danger"> {{$message}}</div>
                               @enderror
                          
                        </div>

                        <div class="mb-2">
                            <label for="password-confirm" class="form-label">Confimation de mot de passe <span style="color: red; font-size: 20px;">*</span>:</label>
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
<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
<script src="{{asset('assets/js/toastr.min.js')}}"></script>
<script>

toastr.options = {
        "positionClass": "toast-bottom-right",
        "closeButton": true,
        "timeOut": 10000
    }
    @if (session('error'))
        toastr.error('{{ session('error') }}');
    @elseif(session('success'))
        toastr.success('{{ session('success') }}');
    @endif
</script>


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
     
    }
  });

</script>

@endsection
