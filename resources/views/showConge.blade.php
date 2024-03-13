@extends('layouts.main')
@section('title-content')
Détail congé
@endsection
@section('content')
<link href="{{asset('css/ajouterFor.css')}}" rel="stylesheet">
@if(auth()->user()->role == '3')
<a href="{{ route('employer.MesConges') }}"  id="a" class="mt-0" ><i class="fa-sharp fa-solid fa-circle-arrow-left fa-2xl" style="color: #000000;"></i></a>
@else
@if($conge->status!="en cours")
<a href="{{ route('RespRh.listes.conges') }}"  id="a" class="mt-0" ><i class="fa-sharp fa-solid fa-circle-arrow-left fa-2xl" style="color: #000000;"></i></a>
@else
<a href="{{ route('RespRh.demandes.conges') }}"  id="a"class="mt-0" ><i class="fa-sharp fa-solid fa-circle-arrow-left fa-2xl" style="color: #000000;"></i></a>
@endif

@endif
@if(auth()->user()->role == '3')
@if($conge->status!="en cours")
<button id="btn-print" class="btn btn-link text-right ml-auto mb-2 mr-2">
<i class="fa-solid fa-print fa-xl" style="color: #000000;"></i>
</button>
@endif
@else
<button id="btn-print" class="btn btn-link text-right mb-2 ml-auto mr-2">
<i class="fa-solid fa-print fa-xl" style="color: #000000;"></i>
</button>
@endif


<div class="container mb-2">
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
            Je souhaiterais prendre<span style="font-weight:bold;"> {{$conge->nbre_jours}}</span> jours de congé du <span style="font-weight:bold;">{{$conge->date_debut}} </span>au <span style="font-weight:bold;">{{$conge->date_fin}}</span>.
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
            Je vous informe par la présente que je suis dans l'incapacité de travailler en raison d'une maladie. Je souhaite donc prendre un congé de maladie pour me rétablir. Le congé débutera le <span style="font-weight:bold;">{{$conge->date_debut}}</span> et se terminera le <span style="font-weight:bold;">{{$conge->date_fin}}</span>. <p> Veuillez agréer,Monsieur, l'expression de mes salutations distinguées.</p> 
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
            Je vous informe que je me marie prochainement. Je souhaiterais prendre un congé de mariage pour une durée de <span style="font-weight:bold;">{{$conge->nbre_jours}} </span>jours, du <span style="font-weight:bold;"> {{$conge->date_debut}}</span> au<span style="font-weight:bold;"> {{$conge->date_fin}}</span>.
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
        @case ($conge->type_conge =='congé de maternité')
        <div>                            
        Je vous écris pour vous informer que je suis enceinte et je souhaite prendre un congé de maternité pour m'occuper de mon enfant à naître. Je vous prie donc de bien vouloir accepter ma demande de congé.
        Le congé débutera le<span style="font-weight:bold;"> {{$conge->date_debut}}</span> et se terminera <span style="font-weight:bold;">le {{$conge->date_fin}} </span>.
        Si vous avez des questions ou besoin de plus d'informations, je vous prie de me contacter le plus rapidement possible.
        <p>Je tiens à vous remercier de l'attention que vous porterez à ma demande.</p> 
    </div>
        @break;
        @endswitch
     
      <footer class="">Cordialement,<br>
      <span style="font-weight:bold;">
        {{$conge->prenom}} {{$conge->nom}}</span> </footer>
        <div class="text-right mt-5 mr-5">
        @if($conge->status =="Approuvée")
        <p>Demande approuvée le: {{\Carbon\Carbon::parse($conge->updated_at)->format('d-m-Y')}}</p>
          <img src="{{asset('images/download.png')}}" alt="signature" class="img-fluid" style="max-height: 100px;">
        
          @elseif($conge->status =="Refusée")
          <p>Demande refusée le: {{\Carbon\Carbon::parse($conge->updated_at)->format('d-m-Y')}}</p>
          <img src="{{asset('images/download.png')}}" alt="signature" class="img-fluid" style="max-height: 100px;">
          
        @endif
        </div>
   
  </div>
</div>
</div>
</div>

@if(auth()->user()->role == '3')
<input type="submit" name="status" id="b" value="Approuver" class="btn btn-success  mb-2" style="display: none;">
<input type="submit" name="status" id="c" value="Refuser" class="btn btn-danger mb-2" style="display: none;">
@else
@if($conge->status =="en cours")
<div class="container ">
<form method="POST" action="/RespRh/DemandesConges/{{$conge->id_conge}}/update">
    @csrf
    @method('post')

    <div class="row">
    <div class="col-6 d-flex justify-content-start">
       
            <input type="submit" name="status" id="b" value="Approuver" class="btn vert-button col-12 mb-2">
     
    </div>
    <div class="col-6 d-flex justify-content-end">
       
            <input type="submit" name="status" id="c" value="Refuser" class="btn move-button col-12 mb-2">
     
    </div>
</div>

</form>
</div>
@else
<input type="submit" name="status" id="b" value="Approuver" class="btn vert-button col-12 mb-2" style="display: none;">
<input type="submit" name="status" id="c" value="Refuser" class="btn move-button col-12 mb-2" style="display: none;">

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