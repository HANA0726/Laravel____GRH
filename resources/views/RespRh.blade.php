@extends('layouts.main')
@section('title-content')
Tableau de bord
@endsection
@section('content')
<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
<a class="text-decoration-none" href="{{route('RespRh.employe')}}">
    <div class="card shadow h-100 py-2" style="border-left: 5px solid #952D98">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold  text-uppercase mb-1" style="color:#952D98">
                    les employés</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$employer}}</div>
                </div>
                <div class="col-auto">
                <i class="fa-solid fa-users fa-2x text-300" style="color:#000000"></i>
                </div>
            </div>
        </div>
    </div>
</a>
</div>


<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
<a class="text-decoration-none" href="{{route('RespRh.candidat')}}">
    <div class="card  shadow h-100 py-2" style="border-left: 5px solid #00ED64">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold  text-uppercase mb-1" style="color:#00ED64">
                        Les Candidats</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$candidat}}</div>
                </div>
                <div class="col-auto">
                <i class="fa-solid fa-user-graduate fa-2x text-300" style="color:#000000"></i>
                </div>
            </div>
        </div>
    </div>
    </a>
</div>

<!-- Earnings (Monthly) Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
<a class="text-decoration-none" href="{{route('RespRh.demandes.conges')}}">
    <div class="card shadow h-100 py-2"  style="border-left: 5px solid #952D98">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold  text-uppercase mb-1" style="color:#952D98">Demande de congés
                    </div>
                    <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                            <div class="h5 mb-0 mr-3 font-weight-bold text-800" style="color:#952D98">{{$demande_conge}}</div>
                        </div>
                        
                    </div>
                </div>
                <div class="col-auto">
                <i class="fa-sharp fa-solid fa-file fa-2x text-300" style="color:#000000"></i>
                </div>
            </div>
        </div>
    </div>
    </a>
</div>

<!-- Pending Requests Card Example -->
<div class="col-xl-3 col-md-6 mb-4">
<a class="text-decoration-none" href="{{route('RespRh.FichesPaiement')}}">
    <div class="card  shadow h-100 py-2"  style="border-left: 5px solid #00ED64">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold  text-uppercase mb-1" style="color:#00ED64">
                        Fiches de paiement</div>
                    <div class="h5 mb-0 font-weight-bold text-800"  style="color:#00ED64">{{$fiche}}</div>
                </div>
                <div class="col-auto">
                    <i class="fa-solid fa-file-invoice-dollar fa-2x text-300" style="color:#000000"></i>
                </div>
            </div>
        </div>
    </div>
    </a>
</div>

<div class="card  m-1 mb-5" style="width:610px;">
    <div class="card-body d-flex justify-content-center align-items-center">
    <canvas id="chart" ></canvas>
    </div>
</div>

<div class="card m-1 mb-5" >
    <div class="card-body p-1 d-flex justify-content-center align-items-center" style="width:420px;">
        <canvas id="chart-sexe"  style="width:50%;"></canvas>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
<script>
    
    let sexe = {!! json_encode($sexe) !!};
    let nombre = {!! json_encode($nombre) !!};

   
    let chartSeXe = new Chart(document.getElementById('chart-sexe'), {
    type: 'pie',
    data: {
        labels: ['Femmes', 'Hommes'],
        datasets: [{
            label: 'Nombre d\'employés par sexe',
            data: nombre,
            backgroundColor: ['#952D98', '#00ED64']
        }]
    },
    options: {
        responsive: true,
        title: {
            display: true,
            text: 'Répartition des employés par sexe',
            fontSize: 20,
            fontColor: 'black',
        }
    }
});

var data = {
    labels: {!! json_encode($labels) !!},
    datasets: {!! json_encode($datasets) !!}
};

var options = {
    title: {
        display: true,
        text: 'Présence des employés par mois',
        fontSize: 20,
        fontColor: 'black'
    },
    scales: {
        yAxes: [{
            ticks: {
                beginAtZero: true
            }
        }]
    }
};

var ctx = document.getElementById('chart').getContext('2d');
var chart = new Chart(ctx, {
    type: 'bar',
    data: data,
    options: options
});

    </script>

@endsection


