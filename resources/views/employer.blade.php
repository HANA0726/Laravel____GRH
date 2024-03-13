@extends('layouts.main')
@section('title-content')
Tableau de bord 
@endsection
@section('content')

<div class="col-xl-6 col-md-6 mb-4">
<a class="text-decoration-none" href="{{route('Employer.paiement')}}"> 
    <div class="card shadow h-100 py-2" style="border-left: 5px solid #952D98">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold  text-uppercase mb-1" style="color:#952D98">
                    Mes fiches de paiement</div>
                    <div class="h5 mb-0 font-weight-bold text-black-800"  style="color:#000000">{{$fiche}}</div>
                </div>
                <div class="col-auto">
                <i class="fa-solid fa-file-invoice-dollar fa-2x text-300" style="color:#000000"></i>
                </div>
            </div>
        </div>
    </div>
    </a>
</div>
<div class="col-xl-6 col-md-6 mb-4">
<a class="text-decoration-none" href="{{route('employer.ListeFormations')}}">
    <div class="card shadow h-100 py-2" style="border-left: 5px solid #00ED64">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold  text-uppercase mb-1" style="color:#00ED64">
                    Les formations disponibles  </div>
                    <div class="h5 mb-0 font-weight-bold text-800" style="color:#000000">{{$formations}}</div>
                </div>
                <div class="col-auto">
                <i class="fa-solid fa-laptop-file fa-2x text-300" style="color:#000000"></i>
                </div>
            </div>
        </div>
    </div>
    </a>
</div>

<div class="col-xl-6 col-md-6 mb-4 mx-auto">
    <div class="card shadow h-100 py-2" >
        <div class="card-body">
            <div class="row no-gutters align-items-center">
            <canvas id="chart-conge"  style="width:50%;"></canvas>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
<script>
    
    let status = {!! json_encode($status) !!};
    let nombre = {!! json_encode($nombre) !!};

   
    let chartConge = new Chart(document.getElementById('chart-conge'), {
        type: 'pie',
        data: {
            labels: ['Approuvée','En cours','Refusée'],
            datasets: [{
                label: 'Mes congés',
                data: nombre,
                backgroundColor: ['#952D98', '#00ED64','#ff729d']
            }]
        },
        options: {
  responsive: true,
  title: {
    display: true,
    text: 'Mes congés',
    fontSize: 20,
    fontColor: 'black'
  }
}

    });
    
 
    </script>

@endsection
