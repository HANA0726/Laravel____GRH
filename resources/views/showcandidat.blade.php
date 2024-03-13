@extends('layouts.main')
@section('title-content')
Détail Candidat
@endsection
@section('content')
<link href="{{asset('assets/css/toastr.min.css')}}" rel="stylesheet">
<link href="{{asset('css/styleprofil.css')}}" rel="stylesheet"> 
<a href="{{route('RespRh.candidat')}}" ><i class="fa-sharp fa-solid fa-circle-arrow-left fa-2xl" style="color: #000000;"></i></a>
<div class="container">
    <div class="page-content page-container" id="page-content">
        <div class="padding">
            <div class="row container d-flex justify-content-center">
                <div class="col-xl-12 col-md-12">
                    <div class="card user-card-full custom-card-size">
                        <div class="row m-l-0 m-r-0">
                            <div class="col-sm-4 bg-c-lite-green user-profile">
                                <div class="card-block text-center text-white">
                                    <div class="m-b-25">
                                        @if(empty($candidat->photo))
                                            <img src="{{ asset('assetsadmin/img/undraw_profile.svg') }}" class="rounded-circle img-fluid custom-image-size" alt="User-Profile-Image">
                                        @else
                                            <img src="{{ asset('uploads/' . $candidat->photo) }}" class="rounded-circle img-fluid custom-image-size" alt="User-Profile-Image">
                                        @endif
                                    </div>
                                    <h5 class="f-w-600">{{ $candidat['prenom'] }} {{ $candidat['nom'] }}</h5>
                                    <i class="mdi mdi-square-edit-outline feather icon-edit m-t-10 f-16"></i>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="card-block">
                                    <h5 class="m-b-20 p-b-5 b-b-default f-w-600">Informations personnelles</h5>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600"><i class="fa-solid fa-envelope"></i> Email</p>
                                            <h6 class="text-muted f-w-400">{{ $candidat['email'] }}</h6>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600"><i class="fa-solid fa-phone"></i>Téléphone</p>
                                            <h6 class="text-muted f-w-400">{{ $candidat['telephone'] }}</h6>
                                        </div>
                                    </div>
                                    <h5 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600">Informations professionnelles</h5>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Niveau d'étude</p>
                                            <h6 class="text-muted f-w-400">{{ $candidat['formation'] }}</h6>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Poste</p>
                                            <h6 class="text-muted f-w-400">{{ $candidat['poste'] }}</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-sm-6">
                                    <p class="m-b-10 f-w-600">Cv</p>
                                    <h6 class="text-muted f-w-400"><a href="{{ asset('uploads/' . $candidat->cv) }}" download  style="color:#952D98;"> <i class="fa-solid fa-download " style="color:#952D98;"></i> CV.{{ $candidat->nom }}.pdf</a></h6>
                                    </div>
                                    <div class="col-sm-6">
                                    <p class="m-b-10 f-w-600">Lettre de motivation</p>
                                    <h6 class="text-muted f-w-400"><a href="{{ asset('uploads/' . $candidat->lettre_motivation) }}" download style="color:#952D98;"> <i class="fa-solid fa-download " style="color:#952D98;"></i> Lettre.{{ $candidat->nom }}.pdf</a></h6>
                                </div>
                                </div>
                                <h5 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600"></h5>
                                <form method="post" action="/RespRh/candidat/{{$candidat->id_candidat}}/view/sendemail">
                                  @csrf
                                  @method('post')
                                <style>
                                    .btn.disabled {border: 2px solid black;}
                                    .email-sent {
                                        background-color: #F2F2F2;
                                        color: gray;
                                    }
                                </style>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h6 class="text-muted f-w-400">
                                            <input type="submit" name="reponse_email" class="btn move-button email-admission {{ $candidat->status !== null ? 'disabled' : '' }} {{ $candidat->status === true ? 'email-sent' : '' }}" value="{{ $candidat->status == true ? 'Email envoyé' : 'Envoyer un email d\'admission' }}" {{ $candidat->status !== null ? 'disabled' : '' }}>
                                           
                                        </h6>
                                    </div>
                                    <div class="col-sm-6">
                                        <h6 class="text-muted f-w-400">
                                        <input type="submit" name="reponse_email" class="btn vert-button email-refus {{ $candidat->status !== null ? 'disabled' : '' }} {{ $candidat->status === false ? 'email-sent' : '' }}" value="{{ $candidat->status === false ? 'Email envoyé' : 'Envoyer un email de refus' }}" {{ $candidat->status !== null ? 'disabled' : '' }}>

                                        </h6>
                                    </div>
                                </div>

                                </form>
                                </div>
                            </div>
                            </div> </div> </div> </div> </div> </div> </div> 

    
    

  
 
  
 

 

 <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
<script src="{{asset('assets/js/toastr.min.js')}}"></script>
 <script>
    toastr.options = {
        "positionClass": "toast-bottom-right",
        "closeButton": true,
        "timeOut": 10000
    }
    @if (session('success'))
        toastr.success('{{ session('success') }}');
    @endif
</script>
@endsection