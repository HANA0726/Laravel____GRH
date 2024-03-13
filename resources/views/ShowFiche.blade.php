
@extends('layouts.main')

@section('title-content')
 Fiche de paiement
@endsection

@section('content')
<link href="{{asset('css/ajouterFor.css')}}" rel="stylesheet">
<style>
    #print-content{
        color:black !important;
    }
    table{
  border-collapse: collapse;
  width: 100%;
  margin-bottom: 20px;
}
.t1{
  table-layout: fixed;
}
 th{
    background-color:#952D98;
 }
th, td{
  border: 1px solid black;
  padding: 10px;
}
</style>
@if(auth()->user()->role=='2')
<a href="{{route('RespRh.FichesPaiement')}}"  id="a" class="mt-0"><i class="fa-sharp fa-solid fa-circle-arrow-left fa-2xl" style="color: #000000;"></i></a>
@endif
@if(auth()->user()->role=='3')
<a href="{{route('Employer.paiement')}}"  id="a" class="mt-0"><i class="fa-sharp fa-solid fa-circle-arrow-left fa-2xl" style="color: #000000;"></i></a>
@endif
<button id="btn-print" class="btn btn-link text-right ml-auto mb-2 mr-2">
<i class="fa-solid fa-print fa-xl" style="color: #000000;"></i>
</button>
<div class="container  mb-3" >
<div class="row justify-content-center card  card emp1 setting mb-2" >
  <div class="card-body print-content" id="print-content">
  <h2 class="text-center" style="font-weight:bold;color:#952D98;">BULLTIN DE PAIE </h2>
  @if($salaire->sexe=='femme')
  <p > Mlle  {{$salaire->prenom}} {{$salaire->nom}} </p> 
   @else
  <p>Monsieur{{$salaire->prenom}}{{$salaire->nom}} </p>
  @endif
  <p>Date d'embauche: {{$salaire->date_debut}} </p>
  <p>Numéro CNSS: {{$salaire->cnss}}</p>
  <p>Matricule: {{$salaire->cin}}</p>
  <p> Ancienneté en année:{{$anneesAnciennete}}</p>
  <p> Emploie: {{$salaire->poste}}</p>

  <table class="t1 ">
  <tr>
    <th>Designation</th>
    <th>Nombre/taux</th>
    <th>Base</th>
    <th>A payer</th>
    <th>A retenir</th>
  </tr>
  <tr>
    <td>Salaire de base </td>
    <td></td>
    <td>{{$salaire->salaire_brute}}</td>
    <td></td>
    <td>{{$salaire->salaire_brute}}</td>
  </tr>
  @if($salaire->type_contrat=='CDI')
  <tr>
    <td>Prime d'ancienneté</td>
    @if ($anneesAnciennete >= 12)
    <td>15%</td>
    <td> {{$primeAn}}</td>
    @elseif ($anneesAnciennete >= 5) 
        <td>10%</td>
        <td> {{$primeAn}}</td>
    @elseif ($anneesAnciennete >= 2) 
    <td>5%</td>
    <td> {{$primeAn}}</td>
             @else 
     <td>0%</td>
     <td> {{$primeAn}}</td>
    @endif
    <td>{{$primeAn}}</td>  
    <td></td>
  </tr>
  @endif
  @foreach($prime as $p)
  <tr>
  <td>{{$p->designation}}</td>
    <td></td>
    <td></td>
    <td>{{ number_format($p->montant, 2, ',', ' ') }}</td>
    <td></td>
  </tr>
  @endforeach
  <tr>
    <td>Salaire brute</td>
    <td></td>
    <td>{{ number_format($salaire->salaire_brute + $primeAn + $totalPrimes, 2, ',', ' ') }}</td>
    <td>{{ number_format($salaire->salaire_brute + $primeAn + $totalPrimes, 2, ',', ' ') }}</td>
    <td></td>
  </tr>
  <tr>
    <td>Cotisation CNSS</td>
    <td>4.48%</td>
    <td>{{ number_format($salaire->salaire_brute + $primeAn + $totalPrimes, 2, ',', ' ') }}</td>
    <td></td>
    <td>{{$cnss}}</td>
  </tr>
  <tr>
    <td>Cotisation AMO</td>
    <td>2.26%</td>
    <td>{{ number_format($salaire->salaire_brute + $primeAn + $totalPrimes, 2, ',', ' ') }}</td>
    <td></td>
    <td>{{$amo}}</td>
  </tr>
  <tr>
  <td>Salaire net</td>
    <td></td>
    <td></td>
    <td></td>
    <td>{{$salaire->salaire_net}}</td>
    </tr>
    <tr>
  <td colspan="4"  class="border-0"></td>
  <td ><h5>{{$salaire->salaire_net}}</h5></td>
</tr>

</table>
<p>Payé par virement bancaire le {{ date('d/m/Y', strtotime('first day of next month')) }}</p>

<h6 class="text-center text-danger" >Pour vous aider à faire valoir vos droits, conservez ce bulletin de paie sans limitation de durée.</h6>

</div>
</div>


</div>
<script>
  var printButton = document.getElementById('btn-print');

// Ajouter un écouteur d'événement de clic sur le bouton d'impression
printButton.addEventListener('click', function() {
  // Récupérer l'élément qui contient toute la layout
var layoutElement = document.getElementById('accordionSidebar');
var layoutElement2 = document.getElementById('btn-print');
var layoutElement3 = document.getElementById('a');
var layoutElement4 = document.getElementById('foot');
var layoutElement5 = document.getElementById('titre');
var layoutElement6 = document.getElementById('print-content');
// Masquer l'élément lors de l'impression
var css = "<style>@media print {#accordionSidebar{display:none;}}</style>";
var css2 = "<style>@media print {#btn-print{display:none;}}</style>";
var css3 = "<style>@media print {#a{display:none;}}</style>";
var css4 = "<style>@media print {#foot{display:none;}}</style>";
var css5 = "<style>@media print {#titre{display:none;}}</style>";

layoutElement.innerHTML += css;
layoutElement2.innerHTML += css2;
layoutElement3.innerHTML += css3;
layoutElement4.innerHTML += css4;
layoutElement5.innerHTML += css5;

// Imprimer la page
window.print();
});
</script>
@endsection