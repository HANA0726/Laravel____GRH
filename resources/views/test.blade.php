
@extends('layouts.main')
@section('title-content')
Liste des employés
@endsection
@section('content')

@if (session()->has('success'))
        <div class="alert alert-success container">{{ session()->get('success') }}</div>
    @endif


 <div class="mb-1   mr-5 col-6">
<a href="{{route('admin.ajouter.employe')}}"class="btn btn-primary  ">Ajouter Employé</a> 
</div>
       <form class="d-flex ">
        <input class="form-control m-1 " name="search"  id="search" type="search" placeholder="Search" aria-label="Search">
      </form>
  
      
      <div class="container">
        <div class="alldata">
        @foreach($employe as $item)
        <div class="card col-xl-6 col-md-6 mb-4" style="width: 18rem;">
         @if(empty($item->photo))
            <img src="{{ asset('assetsadmin/img/undraw_profile.svg') }}" class="card-img-top" > 
        @else
            <img src="{{ asset('uploads/' . $item->photo) }}" style="width:100px" class="card-img-top" >
        @endif
          <div class="card-body">
            <p class="card-text">{{$item->prenom}} {{$item->nom}}</p>
            <p class="card-text">{{$item->email}}</p>
            <p class="card-text">{{$item->poste}}</p>
           <p class="card-text"><a href="/RespRh/employe/{{$item->id_employer}}/view">
      <button type="submit" class="btn btn-primary">Voir</button></a>
       <a href="/RespRh/employe/{{$item->id_employer}}/edit"><button type="submit" class="btn btn-success mt-1">Modifier</button></a>
     <a href="/RespRh/employe/{{$item->id_employer}}/delete"><button type="submit" class="btn btn-danger mt-1">Supprimer</button></a> </p> 
      
          </div>
        </div>


       @endforeach
        </div>
        <div id="Content" class="searchdata"> </div>
</div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script type="text/javascript">
  $('#search').on('keyup', function() {
    $value = $(this).val();
    if ($value) {
      $('.alldata').hide();
      $('.searchdata').show();
    } else {
      $('.alldata').show();
      $('.searchdata').hide();
    }
    $.ajax({
      type: 'get',
      url: '{{ URL::to('/admin/ListesEmployes/search') }}',
      data: { 'search': $value },
      success: function(data) {
        console.log(data);
        var output = "";
        $.each(data.employe, function(key, employee) {
          var photoUrl = employee.photo ? "{{ asset('uploads') }}/" + employee.photo : "{{ asset('assetsadmin/img/undraw_profile.svg') }}";
          output += "<div class='card' style='width: 18rem;'>" +
                    "<img src='" + photoUrl + "' class='card-img-top'>" +
                    "<div class='card-body'>" +
                      "<p class='card-text'>" + employee.prenom + " " + employee.nom + "</p>" +
                      "<p class='card-text'>" + employee.email + "</p>" +
                      "<p class='card-text'>" + employee.poste + "</p>" +
                      "<p class='card-text'>" +
                        "<a href='/RespRh/employe/" + employee.id_employer + "/view'>" +
                          "<button type='submit' class='btn btn-primary'>Voir</button>" +
                        "</a>" +
                        "<a href='/RespRh/employe/" + employee.id_employer + "/edit'>" +
                          "<button type='submit' class='btn btn-success mt-1'>Modifier</button>" +
                        "</a>" +
                        "<a href='/RespRh/employe/" + employee.id_employer + "/delete'>" +
                          "<button type='submit' class='btn btn-danger mt-1'>Supprimer</button>" +
                        "</a>" +
                      "</p>" +
                    "</div>" +
                  "</div>";
        });
        $('#Content').html(output);
      }
    });
  });
</script>
@endsection















@extends('layouts.main')
@section('title-content')
Liste des employés
@endsection
@section('content')

@if (session()->has('success'))
        <div class="alert alert-success container">{{ session()->get('success') }}</div>
    @endif
 <div class="mb-1   mr-5 col-6">
<a href="{{route('admin.ajouter.employe')}}"class="btn btn-primary  ">Ajouter Employé</a> 
</div>
       <form class="d-flex ">
        <input class="form-control m-1 " name="search"  id="search" type="search" placeholder="Search" aria-label="Search">
      </form>
  
   
  <div class="alldata">
    @foreach($employe as $item)
    <div class="col-xl-3 col-md-6 mb-4  d-inline-block">
    <div class="card shadow h-100 py-2" >
        <div class="card-body">
            <div class="row no-gutters align-items-center">
            @if(empty($item->photo))
              <img src="{{ asset('assetsadmin/img/undraw_profile.svg') }}" class="card-img-top" > 
            @else
              <img src="{{ asset('uploads/' . $item->photo) }}" style="width:100px" class="card-img-top" >
            @endif
            <p class="card-text">{{$item->prenom}} {{$item->nom}}</p>
            <p class="card-text">{{$item->email}}</p>
            <p class="card-text">{{$item->poste}}</p> 
            <p class="card-text">
              <a href="/RespRh/employe/{{$item->id_employer}}/view">
                <button type="submit" class="btn btn-primary">Voir</button>
              </a>
              <a href="/RespRh/employe/{{$item->id_employer}}/edit">
                <button type="submit" class="btn btn-success mt-1">Modifier</button>
              </a>
              <a href="/RespRh/employe/{{$item->id_employer}}/delete">
                <button type="submit" class="btn btn-danger mt-1">Supprimer</button>
              </a>
            </p> 
          </div>
        </div>
      </div>
      </div>
    @endforeach
     <div class="col-xl-3 col-md-6 mb-4  d-inline-block">
    <div class="card shadow h-100 py-2" >
        <div class="card-body">
            <div class="row no-gutters align-items-center">
            @if(empty($item->photo))
              <img src="{{ asset('assetsadmin/img/undraw_profile.svg') }}" class="card-img-top" > 
            @else
              <img src="{{ asset('uploads/' . $item->photo) }}" style="width:100px" class="card-img-top" >
            @endif
            <p class="card-text">{{$item->prenom}} {{$item->nom}}</p>
            <p class="card-text">{{$item->email}}</p>
            <p class="card-text">{{$item->poste}}</p> 
            <p class="card-text">
              <a href="/RespRh/employe/{{$item->id_employer}}/view">
                <button type="submit" class="btn btn-primary">Voir</button>
              </a>
              <a href="/RespRh/employe/{{$item->id_employer}}/edit">
                <button type="submit" class="btn btn-success mt-1">Modifier</button>
              </a>
              <a href="/RespRh/employe/{{$item->id_employer}}/delete">
                <button type="submit" class="btn btn-danger mt-1">Supprimer</button>
              </a>
            </p> 
          </div>
        </div>
      </div>
      </div>
    </div>    
 
        
    
  <div id="Content" class="searchdata"> </div>

 

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script type="text/javascript">
  $('#search').on('keyup', function() {
    $value = $(this).val();
    if ($value) {
      $('.alldata').hide();
      $('.searchdata').show();
    } else {
      $('.alldata').show();
      $('.searchdata').hide();
    }
    $.ajax({
      type: 'get',
      url: '{{ URL::to('/admin/ListesEmployes/search') }}',
      data: { 'search': $value },
      success: function(data) {
        console.log(data);
        var output = "";
        $.each(data.employe, function(key, employee) {
          var photoUrl = employee.photo ? "{{ asset('uploads') }}/" + employee.photo : "{{ asset('assetsadmin/img/undraw_profile.svg') }}";
          output +="<div class='col-xl-3 col-md-6 mb-4 d-inline-block'>" +
  "<div class='card shadow h-100 py-2' >" +
    "<div class='card-body'>" +
      "<img src='" + photoUrl + "' class='card-img-top'>" +
      "<p class='card-text'>" + employee.prenom + " " + employee.nom + "</p>" +
      "<p class='card-text'>" + employee.email + "</p>" +
      "<p class='card-text'>" + employee.poste + "</p>" +
      "<p class='card-text'>" +
        "<a href='/RespRh/employe/" + employee.id_employer + "/view'>" +
          "<button type='submit' class='btn btn-primary'>Voir</button>" +
        "</a>" +
        "<a href='/RespRh/employe/" + employee.id_employer + "/edit'>" +
          "<button type='submit' class='btn btn-success mt-1'>Modifier</button>" +
        "</a>" +
        "<a href='/RespRh/employe/" + employee.id_employer + "/delete'>" +
          "<button type='submit' class='btn btn-danger mt-1'>Supprimer</button>" +
        "</a>" +
      "</p>" +
    "</div>" +
  "</div>" +
"</div>";

        });
        $('#Content').html(output);
      }
    });
  });
</script>
@endsection