 @extends('layouts.main')
@section('title-content')

Modifier la fiche de paiement

@endsection

@section('content')

<link href="{{asset('css/ajouterFor.css')}}" rel="stylesheet">  
<link href="{{asset('assets/css/toastr.min.css')}}" rel="stylesheet"> 
<div class="container mt-0 mb-3">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card emp setting">
            <h2 class="text-center txt" style="color:#952D98;">{{ date('F', strtotime($salaire->date)) }}</h2>
          
                <div class="card-body">
                    <form method="POST" action="/RespRh/FichesPaiement/{{$salaire->id_salaire}}/update">
                        @csrf
                        <div class="row mb-3">
                        <label for="employe" class="form-label col-md-4 col-form-label text-md-end"> Employé  <span style="color: red; font-size: 20px;">*</span>:</label>
                        <div class="col-md-6">    
                        <select id="employe" name="employe" class="form-control" >
                        <option value=""> Choisissez un employé</option>   
                        <option value="{{$salaire->id_employer}}"> {{$salaire->prenom}} {{$salaire->nom}}</option>
                               
                    </select>
                    @error('employe')
                               <div class=" text  text-danger"> {{$message}}</div>
                    @enderror
                    </div>
                        </div>
                        <div class="row mb-3">
                            <label for="salaire" class="col-md-4 col-form-label text-md-end">Salaire Brute <span style="color: red; font-size: 20px;">*</span>:</label>

                            <div class="col-md-6">
                                <input id="salaire" type="number" class="form-control " name="salaire_brute" value="{{$salaire->salaire_brute}}" required >

                                @error('salaire_brute')
                               <div class=" text  text-danger"> {{$message}}</div>
                               @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="jours_f" class="col-md-4 col-form-label text-md-end">{{ __('Jours fériés') }}</label>

                            <div class="col-md-6">
                                <input id="jours_f" type="number" class="form-control " name="jours_f" value="{{$salaire->jours_feriees}}" >

                               
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
            @foreach($prime as $p)
            <tr>
                    <td > <input id="jours_f" type="text" class="form-control " name="libelle[]" value="{{$p->designation}}" ></td>
                    <td > <input id="jours_f" type="number" class="form-control " name="montant[]" value="{{$p->montant}}" ></td>
                </tr>
                @endforeach
            </tbody>
        </table>
      
</div>
</div>                       
<button type="submit" class="btn  move-button mx-auto d-block" >Modifier</button>
                           
                           
               
                           
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

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