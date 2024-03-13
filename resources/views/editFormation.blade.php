@extends('layouts.main')
@section('title-content')
Modifier Formation
@endsection
@section('content')
<link href="{{asset('css/ajouterFor.css')}}" rel="stylesheet">    
<div class="container mt-0 mb-3">
<div class="row justify-content-center">             
        <div class="col-md-8">
            <div class="card  emp1 setting">
            <h2 class="text-center txt"> Modifier votre <span> formation</span></h2>
            <div class="card-body">
<form action="/RespRh/Formations/{{$formation->id_formation}}/update" method="post"  class="container " enctype ='multipart/form-data'>
        @csrf
        @method('put')  
        <div class="mb-3">
        <label for="titre1" class="form-label">Thème formation <span style="color: red; font-size: 20px;">*</span>:  </label>
        <input type="text" class="form-control" id="titre1"  value="{{$formation['titre']}}" name="titre" >
        @error('titre')
        <div class=" text  text-danger"> {{$message}}</div>
        @enderror
      </div>
    
    <div class="mb-3">
    <label for="date_debut" class="form-label">Date de  début <span style="color: red; font-size: 20px;">*</span>:  </label>
    <input type="date" class="form-control" value="{{$formation['date_debut']}}"  name="date_debut" id="date_debut">
    @error('date_debut')
        <div class=" text  text-danger"> {{$message}}</div>
        @enderror   
   </div>
    <div class="mb-3">
    <label for="date_fin" class="form-label">Date de fin <span style="color: red; font-size: 20px;">*</span>: </label>
    
    <input type="date" class="form-control"  value="{{$formation['date_fin']}}"  name="date_fin" id="date_fin">
    @error('date_fin')
        <div class=" text  text-danger"> {{$message}}</div>
        @enderror
    </div>
    <div class="mb-3">
    <div class="form-floating mb-1 ">
    <label for="floatingTextarea2">Simple description</label>
     <textarea class="form-control" placeholder="Saisir une description "  name="description" id="floatingTextarea2" style="height: 100px" name="description">{{ $formation['description'] }}</textarea>
 
   </div>
   </div>
   <button type="submit" class="btn  vert-button mx-auto d-block" >Modifier</button>
</form>
</div>   </div>   </div>   </div>   </div>   

@endsection