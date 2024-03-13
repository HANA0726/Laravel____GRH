@extends('layouts.main')
@section('title-content')
Détail formation
@endsection
@section('content')
<link href="{{asset('css/listepresen.css')}}" rel="stylesheet">  
<a href="{{route('RespRh.formations')}}"><i class="fa-sharp fa-solid fa-circle-arrow-left fa-2xl" style="color: #000000;"></i></a>
<div class="container mt-0 mb-3">
<div class="row justify-content-center">             
        <div class="col-md-8">
  <div class="card">
  <div class="card-body">
  <h3 class="card-title txt  text-center"  >{{ $formation['titre'] }}</h3>
    <h5 class="card-text  text-center txt"> Du {{ $formation['date_debut'] }} à {{ $formation['date_fin'] }}</h5>
    <p class="card-text  text-center txt">{{ $formation['description'] }}</p>
  </div>
 </div>
</div>
</div>
</div>
 @if(count($employer)>0)

 <h1 class="container" style="color:#000000!important; color:black; font-size:35px;">Les employés inscrits à la formation</h1>
 <div class="container mt-1 mb-5 ">
  <div class=" row card-deck ">
 @foreach($employer as $item)
    <div class="card  move-button col-xl-3 col-md-6 mb-4  m-2 d-inline-block">
    <div class="card-body ">
    <h4 class="card-title text-center" style="font-weight:bold;font-size:20px;">{{ $item->prenom }} {{ $item->nom }}</h4>
    <p class="card-text" style="font-size:15px;">{{ $item->email }}</p>
   
    </div>
    </div>
    @endforeach
    </div>
    </div>

@endif




@endsection