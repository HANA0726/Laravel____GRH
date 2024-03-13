@extends('layouts.main')
@section('title-content')
Profil insert
@endsection
@section('content')
       <form action="{{route('employer.validation')}}" method="post"  enctype ='multipart/form-data'>
        @csrf
        @method('post')  
        <div class="mb-3">
        <label for="nom" class="form-label">Nom</label>
        <input type="text" class="form-control" id="nom"  value="{{old('nom')}}"name="nom" >
        @error('nom')
        <div class=" text  text-danger"> {{$message}}</div>
        @enderror
      </div>
      <div class="mb-3">
      <label for="prenom" class="form-label">Prénom</label>
      <input type="text" class="form-control" id="prenom"  value="{{old('prenom')}}"name="prenom" >
      @error('prenom')
      <div class=" text  text-danger"> {{$message}}</div>
      @enderror
       </div>
       <div class="mb-3">
    <label for="date_nai" class="form-label">Date de naissance </label>
    
    <input type="date" class="form-control"  value="{{old('date_nai')}}"   name="date_nai" id="date_nai">
  
    </div>
    <div class="mb-3">
    <label for="lieu_nai" class="form-label">lieu de naissance </label>
   <select id="lieu_nai"  class="form-control"   value="{{old('lieu_nai')}}" name="lieu_nai">
    <option value="">--Choisissez une ville--</option>
    <option value="Casablanca">Casablanca</option>
    <option value="Rabat">Rabat</option>
    <option value="Marrakech">Marrakech</option>
    <option value="Fès">Fès</option>
    <option value="Tanger">Tanger</option>
    <option value="Agadir">Agadir</option>
    <option value="Essaouira">Essaouira</option>
    <option value="Meknès">Meknès</option>
    <option value="Ouarzazate">Ouarzazate</option>
    </select>
    </div>
    <div class="mb-3">
    <label for="situation_familiale"  class="form-label">Situation familiale </label>
   <select id="situation_familiale" class="form-control"  name="situation_familiale">
   <option value="">--Choisissez une option--</option>
    <option value="celibataire">Célibataire</option>
    <option value="marie">Marié(e)</option>
    <option value="divorce">Divorcé(e)</option>
    <option value="veuf">Veuf(ve)</option>
    </select>
    @error('situation-fam')
    <div class="text text-danger mt-1"> {{$message}}</div>
    @enderror
    </div>
    <div class="mb-3">
    <label for="sexe"  class="form-label">Sexe  </label>
<input type="radio"  id="sexe" name="sexe"  value="homme"> Homme
<input type="radio" id="sexe" name="sexe" value="femme"> Femme
    </div>
  
    <div class="mb-3">
      <label for="cin" class="form-label">CIN</label>
      <input type="text" class="form-control"   value="{{old('cin')}}" name="cin" id="cin">
      @error('CIN')
      <div class="text text-danger mt-1"> {{$message}}</div>
      @enderror
      </div>
      <div class="mb-3">
      <label for="cnss" class="form-label">CNSS</label>
      <input type="number" class="form-control"   value="{{old('cnss')}}" name="cnss" id="cnss">
      @error('Cnss')
      <div class="text text-danger mt-1"> {{$message}}</div>
      @enderror
      </div>   
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email</label>
    <input type="email" class="form-control" id="exampleInputEmail1"  value="{{old('email')}}"name="email" aria-describedby="emailHelp">
    @error('email')
    <div class="text text-danger"> {{$message}}</div>
     @enderror
  </div>
   
  <div class="mb-3">
  <label for="tel" class="form-label">Télephone</label>
  <input type="tel" class="form-control" id="tel"  value="{{old('tel')}}"name="tel" >
   </div>
 
      <div class="mb-3">
    <label for="poste" class="form-label">Poste occupé</label>
    <select id="poste" name="poste" class="form-control"value="{{old('post')}}">
    <option value="">--Choisissez une option--</option>
   <option value="developpeur_web">Développeur web</option>
   <option value="designer_graphique">Designer graphique / Web designer</option>
   <option value="chef_de_projet">Chef de projet / Scrum Master</option>
   <option value="testeur">Testeur / Quality assurance</option>
   <option value="specialiste_seo">Spécialiste SEO / Marketing digital</option>
   <option value="developpeur_mobile">Développeur mobile</option>
   <option value="developpeur_logiciel">Développeur de logiciels</option>
   <option value="administrateur_systeme">Administrateur système / DevOps</option>
   <option value="analyste_cybersecurite">Analyste en cybersécurité</option>
   <option value="analyste_donnees">Analyste en données / Data Scientist</option>
  </select>

    @error('poste')
    <div class="text text-danger mt-1"> {{$message}}</div>
    @enderror
    </div>
      <div class="mb-3">  
  <label for="select">Contrat</label>
  <select id="select"  class="form-control"  name="contrat"onchange="afficherInputs()">
    <option value="">--Choisissez une option--</option>
    <option value="CDI">CDI</option>
    <option value="CDD">CDD</option>
  </select>
  @error('contrat')
    <div class="text text-danger mt-1"> {{$message}}</div>
    @enderror
</div >

  <div id="inputs" style="display:none;">
    
  <div class="mb-3">
    <label for="date_debut" class="form-label">Date de début</label>
    <input type="date" class="form-control"  value="{{old('date_debut')}}"   name="date_debut" id="date_debut">
    </div>
    <div class="mb-3">
    <label for="date_fin" class="form-label">Date de fin</label>
    <input type="date" class="form-control"      value="{{old('date_fin')}}"  name="date_fin" id="date_fin">
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
    
    <div class="mb-3">
    <label for="photo" class="form-label">Photo</label>
    <input type="file" class="form-control" name="photo" id="photo">
    @error('photo')
    <div class="text text-danger mt-1"> {{$message}}</div>
    @enderror
    </div>
    
 
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection






































