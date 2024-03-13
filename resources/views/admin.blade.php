@extends('layouts.main')
@section('title-content')
Tableau de bord 
@endsection

@section('content')
<div class="col-xl-3 col-md-6 mb-4">
  
    <div class="card shadow h-100 py-2" style="border-left: 5px solid #952D98">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold  text-uppercase mb-1" style="color:#952D98">
                    Utilisateurs</div>
                    <div class="h5 mb-0 font-weight-bold text-800" style="color:#000000">{{$user}}</div>
                </div>
                <div class="col-auto">
               
                    <i class="fa-solid fa-users fa-2x text-300" style="color:#000000"></i>
                </div>
            </div>
        </div>
    </div>
  
</div>

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
<a href="{{route('admin.RespRh')}}" class="text-decoration-none">
    <div class="card  shadow h-100 py-2" style="border-left: 5px solid #00ED64">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold  text-uppercase mb-1" style="color:#00ED64">
                       Les responsable Rh</div>
                    <div class="h5 mb-0 font-weight-bold text-black-800" style="color:#000000">{{$RespRh}}</div>
                </div>
                <div class="col-auto">
                <i class="fa-solid fa-user fa-2x text-300" style="color:#000000"></i>
                
                </div>
            </div>
        </div>
    </div>
    </a>
</div>

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
<a href="{{route('admin.employe')}}" class="text-decoration-none">
    <div class="card shadow h-100 py-2"  style="border-left: 5px solid #952D98">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold  text-uppercase mb-1" style="color:#952D98">Employés
                    </div>
                    <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                            <div class="h5 mb-0 mr-3 font-weight-bold text-800" style="color:#000000" >{{$employers}}</div>
                        </div>
                        
                    </div>
                </div>
                <div class="col-auto">
                <i class="fa-solid fa-users fa-2x text-300" style="color:#000000"></i>
                </div>
            </div>
        </div>
    </div>
    </a>
</div>

<!-- Pending Requests Card Example -->
<div class="col-xl-3 col-md-6 mb-4">

    <div class="card  shadow h-100 py-2"  style="border-left: 5px solid #00ED64">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold  text-uppercase mb-1" style="color:#00ED64">
                        Administrateurs</div>
                    <div class="h5 mb-0 font-weight-bold text-800"  style="color:#000000">{{$admin}}</div>
                </div>
                <div class="col-auto">
                <i class="fa-solid fa-user fa-2x text-300" style="color:#000000"></i>
                </div>
            </div>
        </div>
    </div>
  
</div>
<div class="col-xl-6 col-md-6 mb-4 ">
    <div class="card shadow h-100 py-2" >
        <div class="card-body">
            <div class="row no-gutters align-items-center">
            <canvas id="chart-contrat"  style="width:50%;"></canvas>
            </div>
        </div>
    </div>
</div>
<div class="col-xl-6 col-md-6 mb-4 ">
    <div class="card shadow h-100 py-2" >
        <div class="card-body">
            <div class="row no-gutters align-items-center">
            <canvas id="chart-sexe"  style="width:50%;"></canvas>
            </div>
        </div>
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
<script>
    
    let type = {!! json_encode($type) !!};
    let nombre = {!! json_encode($nombre) !!};

   
    let chartContrat = new Chart(document.getElementById('chart-contrat'), {
        type: 'pie',
        data: {
            labels: ['CDD','CDI'],
            datasets: [{
                label: 'Les employés par type de contrat',
                data: nombre,
                backgroundColor: ['#952D98', '#00ED64']
            }]
        },
        options: {
  responsive: true,
  title: {
    display: true,
    text: 'Les employés par type de contrat',
    fontSize: 20,
    fontColor: 'black'
  }
}

    });


    let sexe = {!! json_encode($sexe) !!};
    let count = {!! json_encode($count) !!};

    let chartSexe = new Chart(document.getElementById('chart-sexe'), {
        type: 'pie',
        data: {
            labels: ['Femme','Homme'],
            datasets: [{
                label: 'Les employés par type de contrat',
                data: count,
                backgroundColor: ['#952D98', '#00ED64']
            }]
        },
        options: {
  responsive: true,
  title: {
    display: true,
    text: 'Les employés par sexe',
    fontSize: 20,
    fontColor: 'black'
  }
}

    });
    
 
    </script>
@endsection 