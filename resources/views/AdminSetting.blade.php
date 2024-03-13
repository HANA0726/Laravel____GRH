@extends('layouts.main')
@section('title-content')
Modifier le mot de passe
@endsection
@section('content')
<link href="{{asset('assets/css/toastr.min.css')}}" rel="stylesheet">  
<link href="{{asset('css/ajouterFor.css')}}" rel="stylesheet">    
<div class="container " >
    <div class="row justify-content-center">             
        <div class="col-md-6">
            <div class="card emp1 setting" >
              
                <div class="card-body">
                    <form method="POST" action="{{route('admin.settings.validation')}}">
                    @csrf
                        <h2 class="text-center txt"> Saisir vos mots de passe</h2> 
                        <div class="mb-1">
                            <label for="password_old" class="form-label">Mot de passe actuel <span style="color: red; font-size: 20px;">*</span>: </label>
                                <input id="password_old" type="password" class="form-control" name="password_old" placeholder="mot de passe actuel" required autocomplete="old_password">

                                @error('password_old')
                               <div class=" text  text-danger"> {{$message}}</div>
                               @enderror
                        </div>

                        <div class="mb-1">
                            <label for="password" class="form-label">Nouveau mot de passe <span style="color: red; font-size: 20px;">*</span>:  </label>
                                <input id="password" type="password" class="form-control" name="password"  placeholder="nouveau mot de passe"required autocomplete="new-password">
                                @error('password')
                               <div class=" text  text-danger"> {{$message}}</div>
                               @enderror
                            
                        </div>

                        <div class="mb-2">
                            <label for="password-confirm" class="form-label">Confimation de mot de passe <span style="color: red; font-size: 20px;">*</span>: </label>

                            
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder=" Confirmation mot de passe" required autocomplete="new-password">
                          
</div>
<button type="submit" class="btn vert-button mx-auto d-block" >Modifier</button>
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





@endsection
