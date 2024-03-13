@extends('layouts.main')

@section('title-content')
    Détail Employé
@endsection

@section('content')
<link href="{{asset('css/styleprofil.css')}}" rel="stylesheet"> 
@if(auth()->user()->role=='2')
        <a href="{{ route('RespRh.employe') }}" ><i class="fa-sharp fa-solid fa-circle-arrow-left fa-2xl" style="color: #000000;"></i></a>
        @else
        <a href="{{ route('admin.employe') }}" ><i class="fa-sharp fa-solid fa-circle-arrow-left fa-2xl" style="color: #000000;"></i></a>
        @endif
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
                                    @if(empty($employe->photo))
                                        <img src="{{ asset('images/user-profil.png') }}" class="rounded-circle img-fluid custom-image-size" alt="User-Profile-Image">
                                    @else
                                        <img src="{{ asset('uploads/' . $employe->photo) }}" class="rounded-circle img-fluid custom-image-size" alt="User-Profile-Image">
                                    @endif
                                  </div>
                                    <h5 class="f-w-600" >{{ $employe->prenom }} {{ $employe->nom }}</h5>
                                    <h5 >{{ $employe->poste }}</h5>
                                    <i class="mdi mdi-square-edit-outline feather icon-edit m-t-10 f-16"></i>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="card-block">
                                    <h5 class="m-b-20 p-b-5 b-b-default f-w-600">Informations personnelles</h5>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600"> <i class="fa-solid fa-envelope"></i> Email </p>
                                            <h6 class="text-muted f-w-400">{{ $employe->email }}</h6>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600"> <i class="fa-solid fa-phone"></i>Téléphone</p>
                                            <h6 class="text-muted f-w-400">{{ $employe->telephone }}</h6>
                                        </div>
                                    </div>
                                     <div class="row">
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Cnss</p>
                                            <h6 class="text-muted f-w-400">{{ $employe->cnss }}</h6>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Cin</p>
                                            <h6 class="text-muted f-w-400">{{ $employe->cin }}</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600"><i class="fa-solid fa-house" style="color: #000000;"></i> Lieu de naissance</p>
                                            <h6 class="text-muted f-w-400">{{ $employe->lieu_naissance }}</h6>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600"><i class="fa-solid fa-calendar" style="color: #000000;"></i> Date de naissance</p>
                                            <h6 class="text-muted f-w-400">{{ $employe->date_naissance }}</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Situation familiale</p>
                                    <h6 class="text-muted f-w-400">{{ $employe->situation_familiale }}</h6>
                                    </div>
</div> 
                                    <h5 class="m-b-20 p-b-5 b-b-default f-w-600">Informations professionnelles</h5>
                                        <div class="row">
                                         <div class="col-sm-6">
                                         <p class="m-b-10 f-w-600">Contrat</p>
                                        <h6 class="text-muted f-w-400">{{ $employe->type_contrat }}</h6>                         
                                        </div>
                                        <div class="col-sm-6">
                                         <p class="m-b-10 f-w-600">Date de debut</p>
                                        <h6 class="text-muted f-w-400">{{ $employe->date_debut }}</h6>                         
                                        </div>
                                        </div>
                                        @if($employe->type_contrat == 'CDD')
                                        <div class="row">
                                        <div class="col-sm-6">
                                         <p class="m-b-10 f-w-600">Date de fin</p>
                                        <h6 class="text-muted f-w-400">{{ $employe->date_fin }}</h6> 
                                            </div>
                                            </div>
                                           @endif
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>                               


@endsection
