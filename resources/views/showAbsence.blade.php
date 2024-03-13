@extends('layouts.main')
@section('title-content')
Justificatif d'absence
@endsection
@section('content')
<link href="{{asset('css/ajouterFor.css')}}" rel="stylesheet">
@if(auth()->user()->role == '3')
<a href="{{ route('Employer.JustificationAbsence') }}"  id="a" class="mt-0" ><i class="fa-sharp fa-solid fa-circle-arrow-left fa-2xl" style="color: #000000;"></i></a>
@else
<a href="{{ route('RespRh.DemandesAbsences') }}"  id="a" class="mt-0" ><i class="fa-sharp fa-solid fa-circle-arrow-left fa-2xl" style="color: #000000;"></i></a>
@endif
<button id="btn-print" class="btn btn-link text-right ml-auto mb-2 mr-2">
<i class="fa-solid fa-print fa-xl" style="color: #000000;"></i>
</button>
<div class="container mb-2">
<div class="row justify-content-center card emp1 setting mb-2" >
  <div class="card-body print-content " id="print-content">
  <h2 class="text-center" style="font-weight:bold;color:#952D98;">Justificatif d'absence</h2>
    <p> Nom : {{$absence->nom}} </p> 
      <p>prénom: {{$absence->prenom}} </p>
    <p>
    <p>Email: {{$absence->email}} </p>
    <p>
      Objet : Justificatif d'absence
     </p>
     <p> Monsieur,</p>
    
        <div>                            
        Je vous écris en réponse à votre demande de justification d'absence.Je tiens à m'excuser pour mon absence le <span style="font-weight:bold;"> {{$absence->date_absence}} </span>qui a été causée par les raisons suivantes<span style="font-weight:bold;"> {{$absence->raisons}}</span>.
<p>
Je tiens à vous assurer que je prendrai toutes les mesures nécessaires pour m'assurer que les projets en cours sont gérés de manière professionnelle et efficace, même en mon absence. Si vous avez des questions ou des préoccupations supplémentaires, n'hésitez pas à me contacter pour discuter de la situation plus en détail.
</p>
<p>
 Je vous remercie pour votre compréhension et votre soutien dans cette situation.
</p>      </div>
    
     
      <footer class="">Cordialement,<br>
      <span style="font-weight:bold;">{{$absence->prenom}} {{$absence->nom}}</span> </footer>
   
        <p> Pièces jointes: <a href="{{ asset('uploads/' . $absence->pieces) }}" download style="color:#952D98;"><i class="fa-solid fa-download " style="color: #952D98;"></i> Certificat.{{$absence->nom}}.pdf </a></p> 
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
var layoutElement6 = document.getElementById('titre');
var layoutElement7 = document.getElementById('foot');

// Masquer l'élément lors de l'impression
var css = "<style>@media print {#accordionSidebar{display:none;}}</style>";
var css2 = "<style>@media print {#btn-print{display:none;}}</style>";
var css3 = "<style>@media print {#a{display:none;}}</style>";
var css6 = "<style>@media print {#titre{display:none;}}</style>";
var css7 = "<style>@media print {#foot{display:none;}}</style>";
layoutElement.innerHTML += css;
layoutElement2.innerHTML += css2;
layoutElement3.innerHTML += css3;
layoutElement6.innerHTML += css6;
layoutElement7.innerHTML += css7;
// Imprimer la page
window.print();
});
</script>
</div>
@endsection