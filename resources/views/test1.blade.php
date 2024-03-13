@extends('layouts.main')
@section('title-content')
Liste des présents
@endsection
@section('content')

        <input type="date" id="dateFilter"  name="date"class="form-control">
         
  
<div class="container" >

<h3 class="row justify-content-center" id="filteredDate">
    {{ \Carbon\Carbon::parse($aujourdhui)->format('d-m-Y') }}</h3>
   <div id="employeeContainer">
    @if(count($employees) > 0)
@foreach ($employees as $employee)
<div class="card m-2 d-inline-block" style="width: 20rem; height:auto ">
@if(empty($employee->photo))
    <img src="{{ asset('assetsadmin/img/undraw_profile.svg') }}" class="card-img-top" style="width: 8rem; height:auto" > 
@else
    <img src="{{ asset('uploads/' . $employee->photo) }}"  class="card-img-top" style="width: 8rem; height:auto">
@endif
  <div class="card-body">
    <h5 class="card-title">{{ $employee->prenom }} {{ $employee->nom }}  </h5>
    <p class="card-text">Temps d'entree  {{ $employee->entry_time }}</p>
    <p class="card-text">Temps de sortie {{ $employee->exit_time}}</p>
    @if ($employee->sexe == "femme")
   <a href="#" class="btn btn-success">Présente</a>
    @else
    <a href="#" class="btn btn-success">Présent</a>
    @endif
  </div>
</div>
@endforeach

</div>
<div id="filteredEmployeesContainer">
    <!-- Les employés filtrés seront affichés ici -->
</div>
@else

<h2 class="container m-3">Jusqu'à présent, personne n'a pointé ou signalé sa présence</h2>

@endif
</div>

<script>
  // Fonction pour filtrer les employés par date
  function filterEmployeesByDate() {
    var selectedDate = document.getElementById('dateFilter').value;

    // Effectuer une requête Ajax pour récupérer les employés présents pour la date sélectionnée
    $.ajax({
      url: '/RespRh/ListePresents/filtrer',
      type: 'GET',
      data: { date: selectedDate },
      success: function(data) {
        console.log(data);
        var output = "";
        $.each(data.employee, function(key, employee) {
          var photoUrl = employee.photo ? "{{ asset('uploads') }}/" + employee.photo : "{{ asset('assetsadmin/img/undraw_profile.svg') }}";
          output += '<div class="card m-2 d-inline-block" style="width: 20rem; height:auto">';
          output += '<img src="' + photoUrl + '" class="card-img-top" style="width: 8rem; height:auto">';
          output += '<div class="card-body">';
          output += '<h5 class="card-title">' + employee.prenom + ' ' + employee.nom + '</h5>';
          output += '<p class="card-text">Temps d\'entrée: ' + employee.entry_time + '</p>';
          output += '<p class="card-text">Temps de sortie: ' + employee.exit_time + '</p>';
          output += '<a href="#" class="btn btn-success">' + (employee.sexe === 'femme' ? 'Présente' : 'Présent') + '</a>';
          output += '</div>';
          output += '</div>';
        });

        if (output !== "") {
          $('#filteredEmployeesContainer').html(output);
          $('#filteredDate').html(selectedDate);
        } else {
          // Aucun employé trouvé pour la date sélectionnée
          $('#filteredEmployeesContainer').html('<h3>Aucun employé trouvé pour la date sélectionnée.</h3>');
          $('#filteredDate').html(selectedDate);
        }
      },
      error: function() {
        $('#filteredEmployeesContainer').html('<h3>Une erreur s\'est produite lors de la récupération des employés.</h3>');
        $('#filteredDate').html(selectedDate);
      }
    });
  }

  // Écouteur d'événement pour le changement de valeur du sélecteur de date
  document.getElementById('dateFilter').addEventListener('change', filterEmployeesByDate);


  
</script>

<script>
    // Fonction pour filtrer les employés par date
    function filterEmployeesByDate() {
        var selectedDate = document.getElementById('dateFilter').value;

        if (selectedDate) {
           
            document.getElementById('employeeContainer').style.display = 'none';
        } else {
      
            document.getElementById('employeeContainer').style.display = 'block';
        }
    }

   
    document.getElementById('dateFilter').addEventListener('change', filterEmployeesByDate);
</script>





@endsection





























@extends('layouts.main')
@section('title-content')
Liste des présents
@endsection
@section('content')
<link href="{{asset('css/listepresen.css')}}" rel="stylesheet"> 
        <input type="date" id="dateFilter"  name="date"class="form-control">
<div class="container" >
<h3 class="row justify-content-center" id="filteredDate">
    {{ \Carbon\Carbon::parse($aujourdhui)->format('d-m-Y') }}</h3>
   <div id="employeeContainer">
    @if(count($employees) > 0)
    @foreach ($employees as $employee)
    <div class="card m-2 d-inline-block" style="width: 20rem; height: auto;">
        <div class="row no-gutters">
            <div class="col-md-4 text-center">
                @if (empty($employee->photo))
                    <img src="{{ asset('assetsadmin/img/undraw_profile.svg') }}" class="card-img-top rounded-circle  mx-auto" style="width: 5rem; height: auto;"> 
                @else
                    <img src="{{ asset('uploads/' . $employee->photo) }}" class="card-img-top rounded-circle  mx-auto" style="width: 5rem; height: auto;">
                @endif
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">{{ $employee->prenom }} {{ $employee->nom }}</h5>
                    <p class="card-text">
                        <strong>Temps d'entrée:</strong> {{ $employee->entry_time }}
                        <br>
                        <strong>Temps de sortie:</strong> {{ $employee->exit_time }}
                    </p>
                    @if ($employee->sexe == "femme")
                        <a href="#" class="btn btn-success">Présente</a>
                    @else
                        <a href="#" class="btn btn-success">Présent</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endforeach


</div>
<div id="filteredEmployeesContainer">
    <!-- Les employés filtrés seront affichés ici -->
</div>
@else

<h2 class="container m-3">Jusqu'à présent, personne n'a pointé ou signalé sa présence</h2>

@endif
</div>

<script>
  // Fonction pour filtrer les employés par date
  function filterEmployeesByDate() {
    var selectedDate = document.getElementById('dateFilter').value;

    // Effectuer une requête Ajax pour récupérer les employés présents pour la date sélectionnée
    $.ajax({
      url: '/RespRh/ListePresents/filtrer',
      type: 'GET',
      data: { date: selectedDate },
      success: function(data) {
        console.log(data);
        var output = "";
        $.each(data.employee, function(key, employee) {
          var photoUrl = employee.photo ? "{{ asset('uploads') }}/" + employee.photo : "{{ asset('assetsadmin/img/undraw_profile.svg') }}";
          output += '<div class="card m-2 d-inline-block" style="width: 20rem; height:auto">';
          output += '<img src="' + photoUrl + '" class="card-img-top" style="width: 8rem; height:auto">';
          output += '<div class="card-body">';
          output += '<h5 class="card-title">' + employee.prenom + ' ' + employee.nom + '</h5>';
          output += '<p class="card-text">Temps d\'entrée: ' + employee.entry_time + '</p>';
          output += '<p class="card-text">Temps de sortie: ' + employee.exit_time + '</p>';
          output += '<a href="#" class="btn btn-success">' + (employee.sexe === 'femme' ? 'Présente' : 'Présent') + '</a>';
          output += '</div>';
          output += '</div>';
        });

        if (output !== "") {
          $('#filteredEmployeesContainer').html(output);
          $('#filteredDate').html(selectedDate);
        } else {
          // Aucun employé trouvé pour la date sélectionnée
          $('#filteredEmployeesContainer').html('<h3>Aucun employé trouvé pour la date sélectionnée.</h3>');
          $('#filteredDate').html(selectedDate);
        }
      },
      error: function() {
        $('#filteredEmployeesContainer').html('<h3>Une erreur s\'est produite lors de la récupération des employés.</h3>');
        $('#filteredDate').html(selectedDate);
      }
    });
  }

  // Écouteur d'événement pour le changement de valeur du sélecteur de date
  document.getElementById('dateFilter').addEventListener('change', filterEmployeesByDate);


  
</script>

<script>
    // Fonction pour filtrer les employés par date
    function filterEmployeesByDate() {
        var selectedDate = document.getElementById('dateFilter').value;

        if (selectedDate) {
           
            document.getElementById('employeeContainer').style.display = 'none';
        } else {
      
            document.getElementById('employeeContainer').style.display = 'block';
        }
    }

   
    document.getElementById('dateFilter').addEventListener('change', filterEmployeesByDate);
</script>





@endsection



























@extends('layouts.main')
@section('title-content')
Liste des présents
@endsection
@section('content')
<link href="{{asset('css/listepresen.css')}}" rel="stylesheet">  
<h2 class=" container row justify-content-center datepresence mt-0" id="filteredDate">
   Le :{{ \Carbon\Carbon::parse($aujourdhui)->format('d-m-Y') }}
  </h2>
        <input type="date" id="dateFilter"  name="date" class="form-control mb-3">
        <button id="filterButton" class="btn btn-primary">Filtrer</button>
        <div class="container">
  <div id="employeeContainer">
    @if(count($employees) > 0)
      <div class="row">
        @foreach ($employees as $employee)
          <div class="col-lg-3 col-md-6 mb-4">
            <div class="card" >
              <div class="row ">
                <div class="col-lg-12">
                  <div class="card-body">
                    <h4 class="card-title txt">{{ $employee->prenom }} {{ $employee->nom }}</h4>
                    <p class="card-text txt ">Temps d'entrée: {{ \Carbon\Carbon::parse($employee->entry_time)->format('H:i') }}</p>
                    <p class="card-text txt ">Temps de sortie: {{ \Carbon\Carbon::parse($employee->exit_time)->format('H:i') }}</p>
                    @if ($employee->sexe == "femme")
                      <a href="#" class="btn move-button">Présente</a>
                    @else
                      <a href="#" class="btn vert-button">Présent</a>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    @else
      <h2 class="container m-3">Jusqu'à présent, personne n'a pointé ou signalé sa présence</h2>
    @endif
  </div>
  <div class="row" id="filteredEmployeesContainer">
    <!-- Les employés filtrés seront affichés ici -->
  
  </div>
</div>



<scr>
  // Fonction pour filtrer les employés par date
 // Fonction pour filtrer les employés par date
function filterEmployeesByDate() {
  var selectedDate = document.getElementById('dateFilter').value;

  if (selectedDate) {
    // Effectuer une requête Ajax pour récupérer les employés présents pour la date sélectionnée
    $.ajax({
      url: '/RespRh/ListePresents/filtrer',
      type: 'GET',
      data: { date: selectedDate },
      success: function(data) {
        console.log(data);
        var output = "";
        $.each(data.employee, function(key, employee) {
          output += '<div class="col-lg-3 col-md-6 mb-4">';
          output += '<div class="card" >';
          output += '<div class="row ">';
          output += '<div class="col-lg-12">';
          output += '<div class="card-body">';
          output += '<h4 class="card-title txt">' + employee.prenom + ' ' + employee.nom + '</h4>';
          output += '<p class="card-text txt">Temps d\'entrée: ' + employee.entry_time + '</p>';
          output += '<p class="card-text txt">Temps de sortie: ' + employee.exit_time + '</p>';
          output += '<a href="#" class="btn ' + (employee.sexe === 'femme' ? 'btn-success move-button' : 'btn-success vert-button') + '">' + (employee.sexe === 'femme' ? 'Présente' : 'Présent') + '</a>';
          output += '</div>';
          output += '</div>';
          output += '</div>';
          output += '</div>';
          output += '</div>';
        });

        if (output !== "") {
          $('#employeeContainer').hide();
          $('#filteredEmployeesContainer').html(output).show();
          $('#filteredDate').html(selectedDate);
        } else {
          // Aucun employé trouvé pour la date sélectionnée
          $('#employeeContainer').hide();
          $('#filteredEmployeesContainer').html('<h3>Aucun employé trouvé pour la date sélectionnée.</h3>').show();
          $('#filteredDate').html(selectedDate);
        }
      },
      error: function() {
        $('#employeeContainer').hide();
        $('#filteredEmployeesContainer').html('<h3>Une erreur s\'est produite lors de la récupération des employés.</h3>').show();
        $('#filteredDate').html(selectedDate);
      }
    });
  } else {
    // Aucune date sélectionnée, afficher tous les employés
    $('#employeeContainer').show();
    $('#filteredEmployeesContainer').empty();
  }
}


</scr



@endsection















@extends('layouts.main')
@section('title-content')
Liste des présents
@endsection
@section('content')
<link href="{{asset('css/listepresen.css')}}" rel="stylesheet">  
<h2 class=" container row justify-content-center datepresence mt-0" id="filteredDate">
   Le :{{ \Carbon\Carbon::parse($aujourdhui)->format('d-m-Y') }}
  </h2>
        <input type="date" id="dateFilter"  name="date" class="form-control mb-3">
        <button id="filterButton" class="btn btn-primary">Filtrer</button>
        <div class="container">
  <div id="employeeContainer">
    @if(count($employees) > 0)
      <div class="row">
        @foreach ($employees as $employee)
          <div class="col-lg-3 col-md-6 mb-4">
            <div class="card" >
              <div class="row ">
                <div class="col-lg-12">
                  <div class="card-body">
                    <h4 class="card-title txt">{{ $employee->prenom }} {{ $employee->nom }}</h4>
                    <p class="card-text txt ">Temps d'entrée: {{ \Carbon\Carbon::parse($employee->entry_time)->format('H:i') }}</p>
                    <p class="card-text txt ">Temps de sortie: {{ \Carbon\Carbon::parse($employee->exit_time)->format('H:i') }}</p>
                    @if ($employee->sexe == "femme")
                      <a href="#" class="btn move-button">Présente</a>
                    @else
                      <a href="#" class="btn vert-button">Présent</a>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    @else
      <h2 class="container m-3">Jusqu'à présent, personne n'a pointé ou signalé sa présence</h2>
    @endif
  </div>
  <div class="row" id="filteredEmployeesContainer">
    <!-- Les employés filtrés seront affichés ici -->
  
  </div>
</div>



<script>
  // Fonction pour filtrer les employés par date
  function filterEmployeesByDate() {
    var selectedDate = document.getElementById('dateFilter').value;

    // Effectuer une requête Ajax pour récupérer les employés présents pour la date sélectionnée
    $.ajax({
      url: '/RespRh/ListePresents/filtrer',
      type: 'GET',
      data: { date: selectedDate },
      success: function(data) {
        console.log(data);
        var output = "";
        $.each(data.employee, function(key, employee) {
          output += '<div class="col-lg-3 col-md-6 mb-4">';
          output += '<div class="card" >';
          output +=  '<div class="row ">';
          output += '<div class="col-lg-12">';
          output += '<div class="card-body">';
          output += '<h4 class="card-title txt">' + employee.prenom + ' ' + employee.nom + '</h4>';
          output += '<p class="card-text txt">Temps d\'entrée: ' + employee.entry_time + '</p>';
          output += '<p class="card-text txt">Temps de sortie: ' + employee.exit_time + '</p>';
          output += '<a href="#" class="btn ' + (employee.sexe === 'femme' ? 'btn-success move-button' : 'btn-success vert-button') + '">' + (employee.sexe === 'femme' ? 'Présente' : 'Présent') + '</a>';
          output += '</div>';
          output += '</div>';
          output += '</div>';
          output += '</div>';
          output += '</div>';
          
        });

        if (output !== "") {
          $('#filteredEmployeesContainer').html(output);
          $('#filteredDate').html(selectedDate);
        } else {
          // Aucun employé trouvé pour la date sélectionnée
          $('#filteredEmployeesContainer').html('<h3>Aucun employé trouvé pour la date sélectionnée.</h3>');
          $('#filteredDate').html(selectedDate);
        }
      },
      error: function() {
        $('#filteredEmployeesContainer').html('<h3>Une erreur s\'est produite lors de la récupération des employés.</h3>');
        $('#filteredDate').html(selectedDate);
      }
    });
  }

  // Écouteur d'événement pour le changement de valeur du sélecteur de date
  document.getElementById('dateFilter').addEventListener('change', filterEmployeesByDate);


  
</script>

<script>
    // Fonction pour filtrer les employés par date
    function filterEmployeesByDate() {
        var selectedDate = document.getElementById('dateFilter').value;

        if (selectedDate) {
           
            document.getElementById('employeeContainer').style.display = 'none';
        } else {
      
            document.getElementById('employeeContainer').style.display = 'block';
        }
    }

    document.getElementById('filterButton').addEventListener('click', filterEmployeesByDate);
    document.getElementById('dateFilter').addEventListener('change', filterEmployeesByDate);
</script>





@endsection
















@extends('layouts.main')
@section('title-content')
Liste des absents
@endsection


@section('content')
<div class="container">
<link href="{{asset('css/listepresen.css')}}" rel="stylesheet"> 
<h3 class="row justify-content-center">
    {{ \Carbon\Carbon::parse($aujourdhui)->format('d-m-Y') }}</h3>
    </div>
    @if(count($employees) > 0)
@foreach ($employees as $employee)
<div class="card m-1 " style="width: 18rem;height=5rem;">
@if(empty($employee->photo))
    <img src="{{ asset('assetsadmin/img/undraw_profile.svg') }}" class="card-img-top" style="width: 8rem; height:auto" > 
@else
    <img src="{{ asset('uploads/' . $employee->photo) }}"  class="card-img-top" style="width: 8rem; height:auto">
@endif
  <div class="card-body">
    <h5 class="card-title">{{ $employee->prenom }} {{ $employee->nom }}  </h5>
    @if (DB::table('conges')->where('id_employer', $employee->id_employer)->whereDate('date_debut', '<=', Carbon\Carbon::today())->whereDate('date_fin', '>=', Carbon\Carbon::today())->count() > 0)
    <a href="#" class="btn btn-success ">En congé</a>
@else
@if ($employee->sexe == "femme")
   <a href="#" class="btn btn-success ">Absente</a>
@else
   <a href="#" class="btn btn-success ">Absent</a>
@endif
@if (DB::table('absences')->where('id_employer', $employee->id_employer)->whereDate('date_absence', Carbon\Carbon::today())->count() > 0)
   <a href="#" class="btn btn-danger disabled">Réclamation envoyée</a>
@else
   <a href="/RespRh/ListeAbsents/{{ $employee->id_employer}} " class="btn btn-primary">Réclamation</a>
@endif

@endif

   
  </div>
</div>
@endforeach
@else
<h2 class="container m-3"> Aucun employé n'est absent.</h2>

@endif

@endsection











@extends('layouts.main')
@section('title-content')
Liste des formations
@endsection
@section('content')

<link href="{{asset('assets/css/toastr.min.css')}}" rel="stylesheet">   
<div class="mb-1 mr-5 col-6">
<a href="{{route('RespRh.ajouter.formation')}}"class="btn btn-primary " class="btn btn-primary">Ajouter Formation</a> 
</div>
<form class="text-right  mr-5 ">
        <input class="form-control m-1 " name="search"  id="search" type="search" placeholder="Search" aria-label="Search">
      </form>

@if(count($formation) > 0)
<div class="container">
<div class="alldata">
@foreach ($formation as $item)
<div class="card m-2 rounded-3  d-inline-block" style="width: 20rem; height:auto ">
  <div class="card-body">
    <h5 class="card-title">{{ $item['titre'] }} </h5>
    <p class="card-text">{{ $item['date_debut'] }}</p>
    <p class="card-text">{{ $item['date_fin'] }}</p>
    <p>Nombre d'employés inscrits: {{ count(DB::table('employers')->join('e_formations', 'e_formations.id_employer', '=', 'employers.id_employer')->where('e_formations.id_formation', '=', $item->id_formation)->get()) }}</p>
    <p> <a href="/RespRh/Formations/{{$item->id_formation}}/view" class="btn btn-primary m-1">Voir</a >
    <a href="/RespRh/Formations/{{$item->id_formation}}/edit"  class="btn btn-success m-1">Modifier</a>
    <a  href="/RespRh/Formations/{{$item->id_formation}}/delete"  class="btn btn-danger m-1">Supprimer</a> </p>
 
</div>
</div>
@endforeach
</div>
        <div id="Content" class="searchdata"> </div>
</div>
@else

<h2 class="container m-3">Jusqu'à présent, aucune formation  n'a été proposée.</h2>

@endif
<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
<script src="{{asset('assets/js/toastr.min.js')}}"></script>
 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script type="text/javascript">
    $('#search').on('keyup', function() {
        $value = $(this).val();
        if($value)
        {
          $('.alldata').hide();
          $('.searchdata').show();
          
        }
        else{
          $('.alldata').show();
          $('.searchdata').hide();
        }
        $.ajax({
      type: 'get',
      url: '{{ URL::to('/RespRh/Formations/searchFor') }}',
      data: { 'search': $value },
      success: function(data) {
        console.log(data);
        var output = "";
        $.each(data.formation, function(key, formation) {
          var numEmployees = formation.num_employees;
          output += "<div class='card m-2 rounded-3  d-inline-block' style='width: 20rem; height:auto '>" +
            "<div class='card-body'>" +
            "<h5 class='card-title'>" + formation.titre + "</h5>" +
            "<p class='card-text'>" + formation.date_debut + "</p>" +
            "<p class='card-text'>" + formation.date_fin + "</p>" +
            "<p>Nombre d'employés inscrits: <span id='num-employees-" + formation.id_formation + "'>" + numEmployees + "</span></p>" +
            "<p>" +
            "<a href='/RespRh/Formations/" + formation.id_formation + "/view' class='btn btn-primary m-1'>Voir</a>" +
            "<a href='/RespRh/Formations/" + formation.id_formation + "/edit' class='btn btn-success m-1'>Modifier</a>" +
            "<a href='/RespRh/Formations/" + formation.id_formation + "/delete' class='btn btn-danger m-1'>Supprimer</a>" +
            "</p>" +
            "</div>" +
            "</div>";
        });
        $('#Content').html(output);
      }
    });
  });
</script>

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







    @php
 $reclamationButtonClass = DB::table('absences')->where('id_employer', $employee->id_employer)->whereDate('date_absence', Carbon\Carbon::today())->exists();
    @endphp
    if( $reclamationButtonClass)
    <a href="/RespRh/ListeAbsents/{{ $employee->id_employer }}" class="btn vert-button disabled">
      Réclamation <i class="fa-regular fa-circle-check fa-lg"></i>
    </a>
    @else
    <a href="/RespRh/ListeAbsents/{{ $employee->id_employer }}" class="btn move-button ">
      Réclamation 
    </a>
    @endif
    @php
    $reclamationExists = DB::table('reclamations')->where('id_employer', $employee->id_employer)->whereDate('date_reclamation', Carbon\Carbon::today())->exists();
@endphp

@if ($reclamationExists)
    <a href="/RespRh/ListeAbsents/{{ $employee->id_employer }}" class="btn vert-button disabled">
        Réclamation <i class="fa-regular fa-circle-check fa-lg"></i>
    </a>
@else
    <a href="/RespRh/ListeAbsents/{{ $employee->id_employer }}" class="btn move-button">
        Réclamation
    </a>
@endif

































@extends('layouts.main')
@section('title-content')
Détail congé
@endsection
@section('content')
<link href="{{asset('css/ajouterFor.css')}}" rel="stylesheet">
@if(auth()->user()->role == '3')
<a href="{{ route('employer.MesConges') }}"  id="a" class="mt-0" ><i class="fa-sharp fa-solid fa-circle-arrow-left fa-2xl" style="color: #000000;"></i></a>
@else
<a href="{{ route('RespRh.demandes.conges') }}"  id="a"class="mt-0" ><i class="fa-sharp fa-solid fa-circle-arrow-left fa-2xl" style="color: #000000;"></i></a>
@endif
<div class="container " >
<div class="row justify-content-center card emp1 setting mb-2" >
  <div class="card-body print-content " id="print-content">
  <h2 class="text-center" style="font-weight:bold;color:#952D98;">Demande de congé</h2>
    <p> Nom : {{$conge->nom}} </p> 
      <p>Prenom: {{$conge->prenom}} </p>
    <p>
    <p>Email: {{$conge->email}} </p>
    <p>
      Objet : Demande de {{$conge->type_conge}}
     </p>
     <p> Monsieur,</p>
    
     @switch ($conge->type_conge) 
    @case ($conge->type_conge =='congé annuel')
        <div>                            
            Je vous écris pour vous informer que je souhaite prendre mes congés annuels pour l'année en cours. Je vous prie donc de bien vouloir accepter ma demande de congé.
            Je souhaiterais prendre {{$conge->nbre_jours}} jours de congé du {{$conge->date_debut}} au {{$conge->date_fin}}.
            Si vous avez des questions, je vous prie de me contacter le plus rapidement possible.
          <p> Je tiens à vous remercier de l'attention que vous porterez à ma demande et je suis 
            @if($conge->sexe=='femme')
                prête 
            @else 
                prêt 
            @endif 
            à vous fournir toute information supplémentaire si nécessaire.</p> 
        </div>
        @break;
    @case  ($conge->type_conge =='congé de maladie')
        <div>                            
            Je vous informe par la présente que je suis dans l'incapacité de travailler en raison d'une maladie. Je souhaite donc prendre un congé de maladie pour me rétablir. Le congé débutera le {{$conge->date_debut}} et se terminera le {{$conge->date_fin}}. <p> Veuillez agréer,Monsieur, l'expression de mes salutations distinguées.</p> 
        </div>
        @break;
        @case  ($conge->type_conge =='congé parental')
        <div>
        Je vous écris pour vous informer que je souhaite prendre un congé parental pour m'occuper de mon enfant. Je vous prie donc de bien vouloir accepter ma demande de congé.                            
        <p> Je tiens à vous remercier de l'attention que vous porterez à ma demande et je suis @if($conge->sexe=='femme')prête @else prêt @endif à vous fournir toute information supplémentaire si nécessaire.</p>
    </div>
        @break;
        @case ($conge->type_conge =='congé de mariage')
        <div>                            
            Je vous informe que je me marie prochainement. Je souhaiterais prendre un congé de mariage pour une durée de {{$conge->nbre_jours}} jours, du {{$conge->date_debut}} au {{$conge->date_fin}}.
            Si vous avez des questions, je vous prie de me contacter le plus rapidement possible.
           <p> Je tiens à vous remercier de l'attention que vous porterez à ma demande et je suis @if($conge->sexe=='femme')prête @else prêt @endif à vous fournir toute information supplémentaire si nécessaire.</p>
        </div>
        @break;
        @case ($conge->type_conge =='congé pour raisons de décès')
        <div>  
        Je vous écris pour vous informer que j'ai subi une perte personnelle difficile. Un membre de ma famille proche est décédé et je dois partir pour assister aux funérailles et soutenir ma famille dans cette période difficile. Je vous prie donc de bien vouloir accepter ma demande de congé.
        <p> Je tiens à vous remercier de l'attention que vous porterez à ma demande et je suis @if($conge->sexe=='femme')prête @else prêt @endif à vous fournir toute information supplémentaire si nécessaire.</p>
        </div>
        @break;
        @endswitch
     
      <footer class="">Cordialement,<br>
        {{$conge->prenom}} {{$conge->nom}} </footer>
        <div class="text-right mt-5 mr-5">
        @if($conge->status =="Approuvée")
        <p>Demande approuvée le: {{\Carbon\Carbon::parse($conge->updated_at)->format('d-m-Y')}}</p>
          <img src="" alt="signature" class="img-fluid" style="max-height: 100px;">
          <i class="fa-thin fa-signature fa-2xl" style="color: #000000;"></i>
          @elseif($conge->status =="Refusée")
          <p>Demande refusée le: {{\Carbon\Carbon::parse($conge->updated_at)->format('d-m-Y')}}</p>
          <img src="" alt="signature" class="img-fluid" style="max-height: 100px;">
          <i class="fa-thin fa-signature fa-2xl" style="color: #000000;"></i>
        @endif
        </div>
   
  </div>
</div>

@if(auth()->user()->role == '3')
@if($conge->status!="en cours")
<button  id="btn-print"  class="btn btn-primary mb-2">Imprimer</button>
@endif
<input type="submit" name="status" id="b" value="Approuver" class="btn btn-success mb-2" style="display: none;">
<input type="submit" name="status" id="c" value="Refuser" class="btn btn-danger mb-2" style="display: none;">
  
@else
<button  id="btn-print"  class="btn btn-primary mb-2">Imprimer</button>
@if($conge->status =="en cours")
<form method="POST" action="/RespRh/DemandesConges/{{$conge->id_conge}}/update">
    @csrf
    @method('post')
    <input type="submit" name="status"  id="b" value="Approuver" class="btn btn-success mb-">
    <input type="submit" name="status" id="c" value="Refuser" class="btn btn-danger mb-2">
</form>
@endif

@endif




<script>
  var printButton = document.getElementById('btn-print');

// Ajouter un écouteur d'événement de clic sur le bouton d'impression
printButton.addEventListener('click', function() {
  // Récupérer l'élément qui contient toute la layout
var layoutElement = document.getElementById('accordionSidebar');
var layoutElement2 = document.getElementById('btn-print');
var layoutElement3 = document.getElementById('a');
var layoutElement4 = document.getElementById('b');
var layoutElement5 = document.getElementById('c');
var layoutElement6 = document.getElementById('titre');
var layoutElement7 = document.getElementById('foot');
// Masquer l'élément lors de l'impression
var css = "<style>@media print {#accordionSidebar{display:none;}}</style>";
var css2 = "<style>@media print {#btn-print{display:none;}}</style>";
var css3 = "<style>@media print {#a{display:none;}}</style>";
var css4 = "<style>@media print {#b{display:none;}}</style>";
var css5 = "<style>@media print {#c{display:none;}}</style>";
var css6 = "<style>@media print {#titre{display:none;}}</style>";
var css7 = "<style>@media print {#foot{display:none;}}</style>";
layoutElement.innerHTML += css;
layoutElement2.innerHTML += css2;
layoutElement3.innerHTML += css3;
layoutElement4.innerHTML += css4;
layoutElement5.innerHTML += css5;
layoutElement6.innerHTML += css6;
layoutElement7.innerHTML += css7;
// Imprimer la page
window.print();
});
</script>
</div>
@endsection



@extends('layouts.main')
@section('title-content')
Les demandes de congés traitées
@endsection
@section('content')
<link href="{{asset('assets/css/toastr.min.css')}}" rel="stylesheet">  
@if(count($conge) > 0)
<div class="container">

@foreach($conge as $item)
<div class="card col-xl-4 col-md-6 mb-4  m-1 d-inline-block" style="width:20rem;">
  <div class="card-body">
    <h5 class="card-title"> {{ $item->prenom }} {{ $item->nom }} </h5>
    <p class="card-text">Type congé : {{ $item->type_conge}}</p>
    <p class="card-text">Date de début : {{ $item->date_debut }}</p>
    <p class="card-text"> Date de fin : {{ $item->date_fin }}</p>
    <p class="card-text"> Etat : {{ $item->status }}</p>
    <p class="card-text"> Nombre de jours : {{ $item->nbre_jours }}</p>   
       <p> <a href="/RespRh/DemandesConges/{{$item->id_conge}}/view" class="btn btn-primary">Afficher</a>
       </p>
</div>
</div>
@endforeach
</div>
@else

<h2 class="container m-3">Aucune demande n'a été traitée  pour le moment. </h2>

@endif<script>
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
















@extends('layouts.main')
@section('title-content')
Formations disponibles 
@endsection
@section('content')
<link href="{{asset('assets/css/toastr.min.css')}}" rel="stylesheet">  

 @if(isset($formations) && count($formations) > 0)
  <table class="table">
    <thead>
      <tr>
        <th scope="col">Thème formation </th>
        <th scope="col">Date de début</th>
        <th scope="col">Date de Fin</th>
       
        <th scope="col" colspan="2">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($formations as $item)
        <tr>
          <td>{{ $item->titre }}</td>
          <td>{{ $item->date_debut }}</td>
          <td>{{ $item->date_fin }}</td>
          <td>
          <form method="POST" action="/employer/ListeFormations/{{$item->id_formation}}">
    @csrf
    @method('post')
    <input type="submit" name="status" value="s'inscrire" class="btn btn-primary">
    <input type="submit" name="status" value="rejeter" class="btn btn-danger">
</form>

            </td>
        </tr>
      @endforeach
    </tbody>
  </table>
@else
  <h2>Aucune formation disponible pour le moment. </h2>
@endif
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



@extends('layouts.main')
@section('title-content')
 Mes fiches de paiement
@endsection
@section('content')
<link href="{{asset('assets/css/toastr.min.css')}}" rel="stylesheet"> 
    @if(count($salaires) > 0)
@foreach ($salaires as $salaire)
<div class="card m-2 rounded-3 " style="width: 20rem; height:auto ">
  <div class="card-body">
    <h5 class="card-title">{{ $salaire->prenom }} {{ $salaire->nom }} </h5>
    <p class="card-text">Salaire brute: {{ $salaire->salaire_brute }} Dh</p>
    <p class="card-text">Salaire net: {{ $salaire->salaire_net}} Dh</p>
    <p class="card-text">Mois : {{ date('F', strtotime($salaire->date)) }}</p>
    <p> <a href="/employer/Paiement/{{$salaire->id_salaire}}/view" class="btn btn-primary m-1">Voir</a >
    </p>
</div>
</div>
@endforeach
@else

<h2 class="container m-3">Votre fiche est en cours de traitement.</h2>

@endif
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






@extends('layouts.main')
@section('title-content')
Les  justifications d'absences effectuées
@endsection
@section('content')
   @if(count($absence)>0)
      <div class="container">
          @foreach($absence as $item)
        <div class="card col-xl-4 col-md-6 mb-4  m-1 d-inline-block" style="width:20rem;">
            <div class="card-body">
              @if(auth()->user()->role=='2')
              <p class="card-text">{{$item->prenom}} {{$item->nom}}</p>
              @endif
            <p class="card-text"> Pour le jour : {{$item->date_absence}}</p>
            <p class="card-text"> Justifie le: {{$item->updated_at}}</p>
            @if(auth()->user()->role=='3') 
           <p class="card-text"><a href="/employer/JustificationAbsence/{{$item->id_absence}}/view" class="btn btn-danger mt-1">Voir</a>
           <a href="/employer/DemandeAbsence/{{$item->id_absence}}/justifier" class="btn btn-info mt-1">Modifier</a>
             @endif</p> 
             <p class="card-text"><a href="/RespRh/DemandesAbsences/{{$item->id_absence}}/view"  class="btn btn-danger mt-1">Voir</a><p>
      
          </div>
        </div>
       @endforeach     
</div>
@else
<h2>Aucune Justification n'a été  effectuée  pour le moment. </h2>
@endif
@endsection