@extends('layouts.main')
@section('title-content')

Régler fiche de paiement

@endsection

@section('content')
<link href="{{asset('css/ajouterFor.css')}}" rel="stylesheet">  
<link href="{{asset('assets/css/toastr.min.css')}}" rel="stylesheet"> 
<div class="container mt-0 mb-3">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card emp1 setting">
            <h2 class="text-center txt" style="color:#952D98;"> {{$mois}}</h2>
                <div class="card-body">
                    <form method="POST" action="{{ route('RespRh.salaire') }}">
                        @csrf
                        <div class="row mb-3">
                        <label for="employe" class="form-label col-md-4 col-form-label text-md-end"> Employé  <span style="color: red; font-size: 20px;">*</span>:</label>
                        <div class="col-md-6">    
                        <select id="employe" name="employe" class="form-control"value="{{old('employe')}}">
                        <option value=""> Choisissez un employé</option>   
                        @foreach($employer as $data)
                        <option value="{{$data->id_employer}}"> {{$data->prenom}} {{$data->nom}}</option>
                         @endforeach          
                    </select>
                    @error('employe')
                               <div class=" text  text-danger"> {{$message}}</div>
                    @enderror
                    </div>
                        </div>
                        <div class="row mb-3">
                            <label for="salaire" class="col-md-4 col-form-label text-md-end">Salaire Brut <span style="color: red; font-size: 20px;">*</span>:</label>

                            <div class="col-md-6">
                                <input id="salaire" type="number" class="form-control " name="salaire_brute" placeholder="Salaire brut" value="{{ old('salaire_brute') }}" required >

                                @error('salaire_brute')
                               <div class=" text  text-danger"> {{$message}}</div>
                               @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="jours_f" class="col-md-4 col-form-label text-md-end">{{ __('Jours fériés') }}</label>

                            <div class="col-md-6">
                                <input id="jours_f" type="number" class="form-control "  placeholder="Jours fériés" name="jours_f" value="{{ old('jours_f') }}" >

                               
                            </div>
                        </div>
                        
                        <div class="row mb-3" id="primes-section">
                        <label for="salaire" class="col-md-4 col-form-label text-md-end">{{ __('Primes:') }}</label>
                        <div class="col-md-6">
   
        <table class="table" style="color:#000000;">
            <thead>
                <tr>
                    <th scope="col">Designation</th>
                    <th scope="col">Montant</th>
                </tr>
            </thead>
            <tbody id="primes-table">
                
            </tbody>
        </table>
        <button id="ajouter-prime"  class="btn btn-link btnt" type="button" ><i class="fa-solid fa-plus fa-lg"></i></button>
      
   
</div>
</div> 
 <button type="submit" class="btn  move-button mx-auto d-block" >Valider</button>
                           
                           
               
                           
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Fonction pour ajouter une case de prime
function ajouterCasePrime() {
    var primesTable = document.getElementById("primes-table");
    var newRow = document.createElement("tr");

    // Créer une case pour le libellé
    var libelleCell = document.createElement("td");
    var libelleInput = document.createElement("input");
    libelleInput.setAttribute("type", "text");
    libelleInput.setAttribute("name", "libelle[]");
    libelleInput.classList.add("form-control");
    libelleCell.appendChild(libelleInput);
    newRow.appendChild(libelleCell);

    // Créer une case pour le montant
    var montantCell = document.createElement("td");
    var montantInput = document.createElement("input");
    montantInput.setAttribute("type", "number");
    montantInput.setAttribute("step", "0.01");
    montantInput.setAttribute("name", "montant[]"); 
    montantInput.classList.add("form-control");
    montantCell.appendChild(montantInput);
    newRow.appendChild(montantCell);

    // Ajouter la nouvelle ligne à la table
    primesTable.appendChild(newRow);
}

// Ajouter un gestionnaire d'événement pour le bouton "Ajouter"
var ajouterPrimeBtn = document.getElementById("ajouter-prime");
ajouterPrimeBtn.addEventListener("click", ajouterCasePrime);
</script>
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