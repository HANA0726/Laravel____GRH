@extends('layouts.main')
@section('title-content')
Demande de congé 
@endsection
@section('content')


<link href="{{asset('assets/css/toastr.min.css')}}" rel="stylesheet"> 
<link href="{{asset('css/style.css')}}" rel="stylesheet">
<div class="container mt-0">
<h3 class="text-center text-dark" style="color:black!important;font-weight:bold;">Votre solde</h3>
<table class="table" style="color:black!important">
  <thead  style="background-color:#00ED64;!important">
    <tr>
      <th scope="col" class="text-center">Type de congé</th>
      <th scope="col" class="text-center">Solde</th>
      <th scope="col" class="text-center">Jours consommés</th>
      <th scope="col" class="text-center">Jours restants</th>
      <th scope="col" class="text-center">Jours demandés</th>
    </tr>
  </thead>
  <tbody >
  @if(!empty($congeSolde) && count($congeSolde) > 0)
<tr>
  <th class="text-center">Congé annuel</th>
  <td class="text-center">20 jours</td>
  <td class="text-center">{{ 20 - $congeSolde[0]['solde_reel'] }} jours</td>
  <td class="text-center">{{$congeSolde[0]['solde_reel'] }} jours</td>
  <td class="text-center">{{ abs($congeSolde[0]['solde'] - $congeSolde[0]['solde_reel']) }} jours</td>
</tr>
@else
<tr>
  <th class="text-center">Congé annuel</th>
  <td class="text-center">20 jours</td>
  <td class="text-center">0 jours</td>
  <td class="text-center">0 jours</td>
  <td class="text-center">0 jours</td>
</tr>

@endif
@php
  use App\Models\Employer;
  use App\Models\Conge;
  use Carbon\Carbon;

  $employee = Employer::where('id_employer', auth()->user()->id)
                        ->where('sexe', 'femme')
                        ->first();

  $joursConsommes = 0;
  $joursDemandes = 0;
  $soldeCongeMaternite = 98;

  if ($employee) {
    $date_actuelle = Carbon::now();
    $conge_de_maternite = Conge::where('id_employer', auth()->user()->id)
                                ->whereYear('date_debut', $date_actuelle->year)
                                ->where('type_conge', 'congé de maternité')
                                ->first();

    if ($conge_de_maternite) {
      if ($conge_de_maternite->status == "Refusée") {
        $joursConsommes = 0;
        $joursDemandes = 0;
        $joursrestants = 98;
      } elseif ($conge_de_maternite->status == "Approuvée") {
        $joursConsommes = 98;
        $joursDemandes = 0;
        $joursrestants = 0;
      } elseif ($conge_de_maternite->status == "en cours") {
        $joursConsommes = 0;
        $joursDemandes = 98;
        $joursrestants = 98;
      }
    } else {
      $joursConsommes = 0;
      $joursDemandes = 0;
      $joursrestants = 98;
    }
  }
@endphp

@if ($employee)
  @if ($conge_de_maternite)
    @if ($conge_de_maternite->status == "Approuvée")
    <tr>
      <th class="text-center">Congé de maternité</th>
      <td class="text-center">{{ $soldeCongeMaternite}} jours</td>
      <td class="text-center">{{ $joursConsommes }} jours</td>
      <td class="text-center">{{ $joursrestants }} jours</td>
      <td class="text-center">0 jours</td>
    </tr>
    @elseif ($conge_de_maternite->status == "en cours")
    <tr>
      <th class="text-center">Congé de maternité</th>
      <td class="text-center">{{ $soldeCongeMaternite }} jours</td>
      <td class="text-center">0 jours</td>
      <td class="text-center">{{ $joursrestants }} jours</td>
      <td class="text-center">{{ $joursDemandes }} jours</td>
    </tr>
    @elseif ($conge_de_maternite->status == "Refusée")
    <tr>
      <th class="text-center">Congé de maternité</th>
      <td class="text-center">{{ $soldeCongeMaternite }} jours</td>
      <td class="text-center">0 jours</td>
      <td class="text-center">{{ $joursrestants }} jours</td>
      <td class="text-center">0 jours</td>
    </tr>
    @endif
   
  @else
  <tr>
    <th class="text-center">Congé de maternité</th>
    <td class="text-center">98 jours</td>
    <td class="text-center">0 jours</td>
    <td class="text-center">98 jours</td>
    <td class="text-center">0 jours</td>
  </tr>
  @endif
@endif


  </tbody>
</table>
<link href="{{asset('css/ajouterFor.css')}}" rel="stylesheet">    
<div class="container mt-0 mb-5">
<div class="row justify-content-center">             
        <div class="col-md-8">
            <div class="card  emp1 setting">
            <h2 class="text-center txt">Nouvelle Demande de congé</h2>
                <div class="card-body">
<form action="{{route('employer.Conge.validation')}}" method="post"  class="container " enctype ='multipart/form-data'>
        @csrf
        @method('post')  
        <div class="mb-3">
        <label for="type_conge" class="form-label">Type congé <span style="color: red; font-size: 20px;">*</span>: </label>
   <select id="type_conge" name="type_conge" class="form-control" onchange="afficherInputs()">
   <option value="">Sélectionnez un type de congé</option>
   <option value="congé annuel" {{ old('type_conge') == 'congé annuel' ? 'selected' : '' }}>Congé annuel</option>
   <option value="congé de maladie" {{ old('type_conge') == 'congé de maladie' ? 'selected' : '' }}>Congé de maladie</option>
   <option value="congé parental" {{ old('type_conge') == 'congé parental' ? 'selected' : '' }}>Congé parental</option>
   <option value="congé de mariage" {{ old('type_conge') == 'congé de mariage' ? 'selected' : '' }}>Congé de mariage</option>
   <option value="congé pour raisons de décès" {{ old('type_conge') == 'congé pour raisons de décès' ? 'selected' : '' }}>Congé pour raisons de décès</option>
   <option value="congé de maternité" {{ old('type_conge') == 'congé de maternité' ? 'selected' : '' }}>Congé de maternité</option>

</select>

        @error('type_conge')
        <div class=" text  text-danger"> {{$message}}</div>
        @enderror
      </div>
    
    <div class="mb-3">
    <label for="date_debut" class="form-label">Date de  début <span style="color: red; font-size: 20px;">*</span>: </label>
    <input type="date" class="form-control"  value="{{old('date_debut')}}"   name="date_debut" id="date_debut">
    @error('date_debut')
        <div class=" text  text-danger"> {{$message}}</div>
        @enderror   
   </div>
   <div class="mb-3" id="input" style="{{ old('type_conge') == 'congé annuel' ? 'display:block;' : 'display:none;' }}">
    <label for="date_fin" class="form-label">Date de fin <span style="color: red; font-size: 20px;">*</span>:</label>
    <input type="date" class="form-control" value="{{old('date_fin')}}" name="date_fin" id="date_fin">
    @error('date_fin')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
<button type="submit" class="btn  vert-button mx-auto d-block" >Valider</button>
</form>
</div>


</div>
</div>
        </div>
    </div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
<script src="{{asset('assets/js/toastr.min.js')}}"></script>
 
<script>

function afficherInputs() {
      var select = document.getElementById("type_conge");
      var inputs = document.getElementById("input");
     

      if (select.value == "congé annuel" ) {
        inputs.style.display = "block";
      } else {
        inputs.style.display = "none";
      }
    }
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