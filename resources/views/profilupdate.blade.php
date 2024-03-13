@extends('layouts.main')
@section('title-content')
Mon profil
@endsection
@section('content')
<link href="{{asset('css/styleForm.css')}}" rel="stylesheet">   
<div class="container mb-5">
                        
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card emp ">
                <div class="card-body" >
       <form action="{{route('employer.validation')}}" method="post"  enctype ='multipart/form-data'>
       @csrf
       @method('put') 
        <h2 class="inf" style="font-weight:bold;"> Information personnelle</h2> 
        <div class="mb-3">
        @if(empty($employe->photo))
                <p>  <img id="photoPreview" src="{{ asset('images/user-profil.png') }}"  alt="Photo Preview" class="rounded-circle img-thumbnail" style="width:100px;height:100px"></p> 
                                    @else
                                    <p>  <img id="photoPreview" src="{{ asset('uploads/' . $employe->photo) }}" alt="Photo Preview" class="rounded-circle img-thumbnail" style="width:100px;height:100px"></p> 
                                    @endif
   <label for="photo" class="form-label"> Votre image :</label><br>
    <input type="file"  name="photo" id="photo" accept="image/*" onchange="previewPhoto(event)">
    @error('photo')
    <div class="text text-danger mt-1"> {{$message}}</div>
    @enderror
    </div>
        <div class="mb-3">
        <label for="nom" class="form-label">Nom <span style="color: red; fo
        nt-size: 20px;">*</span>:</label>
        <input type="text" class="form-control" id="nom"  value="{{$employe->nom}}" name="nom" >
        @error('nom')
        <div class=" text  text-danger"> {{$message}}</div>
        @enderror
      </div>
      <div class="mb-3">
      <label for="prenom" class="form-label">Prénom <span style="color: red; font-size: 20px;">*</span>:</label>
      <input type="text" class="form-control" id="prenom"   value="{{$employe->prenom}}" name="prenom" >
      @error('prenom')
      <div class=" text  text-danger"> {{$message}}</div>
      @enderror
       </div>
       <div class="mb-3">
    <label for="date_nai" class="form-label">Date de naissance :</label>
    
    <input type="date" class="form-control"   value="{{$employe->date_naissance}}"   name="date_nai" id="date_nai">
  
    </div>
    <div class="mb-3">
    <label for="lieu_nai" class="form-label">Lieu de naissance :</label>
<select id="lieu_nai" class="form-control" name="lieu_nai">
  <option value="">--Choisissez une ville--</option>
  <option value="Casablanca" {{ $employe->lieu_naissance == "Casablanca" ? 'selected' : '' }}>Casablanca</option>
  <option value="Rabat" {{ $employe->lieu_naissance == "Rabat" ? 'selected' : '' }}>Rabat</option>
  <option value="Marrakech" {{ $employe->lieu_naissance == "Marrakech" ? 'selected' : '' }}>Marrakech</option>
  <option value="Fès" {{ $employe->lieu_naissance == "Fès" ? 'selected' : '' }}>Fès</option>
  <option value="Tanger" {{ $employe->lieu_naissance == "Tanger" ? 'selected' : '' }}>Tanger</option>
  <option value="Agadir" {{ $employe->lieu_naissance == "Agadir" ? 'selected' : '' }}>Agadir</option>
  <option value="Essaouira" {{ $employe->lieu_naissance == "Essaouira" ? 'selected' : '' }}>Essaouira</option>
  <option value="Meknès" {{ $employe->lieu_naissance == "Meknès" ? 'selected' : '' }}>Meknès</option>
  <option value="Ouarzazate" {{ $employe->lieu_naissance == "Ouarzazate" ? 'selected' : '' }}>Ouarzazate</option>
</select>

    </div>
    <div class="mb-3">
    <label for="situation_familiale" class="form-label">Situation familiale <span style="color: red; font-size: 20px;">*</span>:</label>
<select id="situation_familiale" class="form-control" name="situation_familiale">
<option value="">--Choisissez une option--</option>
    <option value="Célibataire" {{ $employe->situation_familiale == 'Célibataire' ? 'selected' : '' }}>Célibataire</option>
    <option value="Marié" {{ $employe->situation_familiale == 'Marié' ? 'selected' : '' }}>Marié(e)</option>
    <option value="Divorcé" {{ $employe->situation_familiale == 'Divorcé' ? 'selected' : '' }}>Divorcé(e)</option>
    <option value="Veuf" {{ $employe->situation_familiale == 'Veuf' ? 'selected' : '' }}>Veuf(ve)</option>

</select>

    @error('situation_familiale')
    <div class="text text-danger mt-1"> {{$message}}</div>
    @enderror
    </div>
    <div class="mb-3">
    <label for="sexe"  class="form-label">Sexe <span style="color: red; font-size: 20px;">*</span>:  </label>
<input type="radio"  id="sexe" name="sexe"  value="homme" {{$employe->sexe == 'homme' ? 'checked' : ''}}> Homme
<input type="radio" id="sexe" name="sexe" value="femme"  {{$employe->sexe == 'femme' ? 'checked' : ''}}> Femme
      @error('sexe')
      <div class="text text-danger mt-1"> {{$message}}</div>
      @enderror
</div>
  
    <div class="mb-3">
      <label for="cin" class="form-label">CIN <span style="color: red; font-size: 20px;">*</span>:</label>
      <input type="text" class="form-control"     value="{{$employe->cin}}" name="cin" id="cin">
      @error('cin')
      <div class="text text-danger mt-1"> {{$message}}</div>
      @enderror
      </div>
      <div class="mb-3">
      <label for="cnss" class="form-label">CNSS <span style="color: red; font-size: 20px;">*</span>:</label>
      <input type="number" class="form-control"   value="{{$employe->cnss}}" name="cnss" id="cnss">
      @error('cnss')
      <div class="text text-danger mt-1"> {{$message}}</div>
      @enderror
      </div>   
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email <span style="color: red; font-size: 20px;">*</span>:</label>
    <input type="email" class="form-control" id="exampleInputEmail1"   value="{{$employe->email}}"name="email" aria-describedby="emailHelp">
    @error('email')
    <div class="text text-danger"> {{$message}}</div>
     @enderror
  </div>
  <h2 class="inf" style="font-weight:bold;"> Information professionnelle</h2> 
  <div class="mb-3">
  <label for="tel" class="form-label">Télephone <span style="color: red; font-size: 20px;">*</span>:</label>
  <input type="tel" class="form-control" id="tel"  value="{{$employe->telephone}}" name="tel" >
   </div>
 
      <div class="mb-3">
    <label for="poste" class="form-label">Poste occupé <span style="color: red; font-size: 20px;">*</span>:</label>
    <select id="poste" name="poste" class="form-control">
    <option value="">--Choisissez une option--</option>
    <option value="Développeur web" {{ $employe->poste == 'Développeur web' ? 'selected' : '' }}>Développeur web</option>
    <option value="Designer graphique" {{ $employe->poste == 'Designer graphique' ? 'selected' : '' }}>Designer graphique / Web designer</option>
    <option value="Chef de projet" {{ $employe->poste == 'Chef de projet' ? 'selected' : '' }}>Chef de projet / Scrum Master</option>
    <option value="Testeur" {{ $employe->poste == 'testeur' ? 'Testeur' : '' }}>Testeur / Quality assurance</option>
    <option value="Spécialiste SEO" {{ $employe->poste == 'Spécialiste SEO' ? 'selected' : '' }}>Spécialiste SEO / Marketing digital</option>
    <option value="Développeur mobile" {{ $employe->poste == 'Développeur mobile' ? 'selected' : '' }}>Développeur mobile</option>
    <option value="Développeur de logiciels" {{ $employe->poste == 'Développeur de logiciels' ? 'selected' : '' }}>Développeur de logiciels</option>
    <option value="Administrateur système" {{ $employe->poste == 'Administrateur système' ? 'selected' : '' }}>Administrateur système / DevOps</option>
    <option value="Analyste en cybersécurité" {{ $employe->poste == 'Analyste en cybersécurité' ? 'selected' : '' }}>Analyste en cybersécurité</option>
    <option value="Analyste en données" {{ $employe->poste == 'Analyste en données' ? 'selected' : '' }}>Analyste en données / Data Scientist</option>
</select>

    @error('poste')
    <div class="text text-danger mt-1"> {{$message}}</div>
    @enderror
    </div>
      <div class="mb-3">  
  <label for="select">Contrat <span style="color: red; font-size: 20px;">*</span>:</label>
  <select id="select"  class="form-control"  name="contrat" onchange="afficherInputs()" >
    <option value="">--Choisissez une option--</option>
    <option value="CDI" {{ $employe->type_contrat == "CDI" ? 'selected' : '' }}>CDI</option>
    <option value="CDD" {{ $employe->type_contrat == "CDD" ? 'selected' : '' }}>CDD</option>
  </select>
  @error('contrat')
    <div class="text text-danger mt-1">{{$message}}</div>
    @enderror
</div >
  <div class="mb-3">
    <label for="date_debut" class="form-label">Date de début <span style="color: red; font-size: 20px;">*</span>:</label>
    <input type="date" class="form-control"   value="{{$employe->date_debut}}" name="date_debut" id="date_debut">
    @error('date_debut')
    <div class="text text-danger mt-1"> {{$message}}</div>
    @enderror 
  </div>
    <div id="inputs" style="display:none;">
    <div class="mb-3">
    <label for="date_fin" class="form-label">Date de fin <span style="color: red; font-size: 20px;">*</span>:</label>
    <input type="date" class="form-control"      value="{{$employe->date_fin}}"   name="date_fin" id="date_fin">
    </div>
  </div>

  <script>
    function afficherInputs() {
      var select = document.getElementById("select");
      var inputs = document.getElementById("inputs");

      if (select.value == "CDD" ) {
        inputs.style.display = "block";
      } else {
        inputs.style.display = "none";
      }
    }
  </script>
    
    <button type="submit" class="btn move-button mx-auto d-block" >Modifier</button>
</form>
</div>
        </div>
    </div>
</div>

<script>
  function previewPhoto(event) {
    var input = event.target;
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        document.getElementById('photoPreview').src = e.target.result;
      }
      reader.readAsDataURL(input.files[0]);
    } else {
      document.getElementById('photoPreview').src = "/chemin/vers/image-par-defaut.jpg";
    }
  }


</script>
@endsection






































