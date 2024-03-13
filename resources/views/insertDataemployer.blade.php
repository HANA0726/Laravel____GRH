@extends('layouts.main')
@section('title-content')
Ajouter Employé
@endsection
@section('content')
<link href="{{asset('css/styleForm.css')}}" rel="stylesheet">
<link href="{{asset('assets/css/toastr.min.css')}}" rel="stylesheet">  
<div class="container mb-5">
                          @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                          @endif
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card emp">
                <div class="card-body">

<form action="{{ auth()->user()->role=='2' ? route('RespRh.Employe.validationdata') : route('admin.Employe.validationdata') }}" method="post"  enctype ='multipart/form-data'>
        @csrf
        @method('post')  
        <h2 class="inf" style="font-weight:bold;"> Information personnelle</h2>
        <div class="mb-3">
   <p><img id="photoPreview" src="{{asset('images/user-profil.png')}}" alt="Photo Preview" class="rounded-circle img-thumbnail" style="width:100px;height:100px"></p> 
    <label for="photo" class="form-label"> Votre image :</label><br>
    <input type="file"  name="photo" id="photo" accept="image/*" onchange="previewPhoto(event)">
    @error('photo')
    <div class="text text-danger mt-1"> {{$message}}</div>
    @enderror
    </div>
        <div class="mb-3">
        <label for="nom" class="form-label">Nom <span style="color: red; font-size: 20px;">*</span>:</label>
        <input type="text" class="form-control" id="nom" placeholder="Nom"  value="{{old('nom')}}" name="nom" >
        @error('nom')
        <div class=" text  text-danger"> {{$message}}</div>
        @enderror
      </div>
      <div class="mb-3">
      <label for="prenom" class="form-label">Prénom <span style="color: red; font-size: 20px;">*</span>:</label>
      <input type="text" class="form-control" id="prenom"  placeholder="Prénom" value="{{old('prenom')}}"name="prenom" >
      @error('prenom')
      <div class=" text  text-danger"> {{$message}}</div>
      @enderror
       </div>
       <div class="mb-3">
    <label for="date_nai" class="form-label">Date de naissance :</label>
    
    <input type="date" class="form-control"  value="{{old('date_nai')}}"    name="date_nai" id="date_nai">
  
    </div>
    <div class="mb-3">
    <label for="lieu_nai" class="form-label">Lieu de naissance :</label>
    <select id="lieu_nai" name="lieu_nai" class="form-control">
    <option value="">--Choisissez une ville--</option>
    <option value="Casablanca" {{ old('lieu_nai') == "Casablanca" ? 'selected' : '' }}>Casablanca</option>
    <option value="Rabat" {{ old('lieu_nai') == "Rabat" ? 'selected' : '' }}>Rabat</option>
    <option value="Marrakech" {{ old('lieu_nai') == "Marrakech" ? 'selected' : '' }}>Marrakech</option>
    <option value="Fès" {{ old('lieu_nai') == "Fès" ? 'selected' : '' }}>Fès</option>
    <option value="Tanger" {{ old('lieu_nai') == "Tanger" ? 'selected' : '' }}>Tanger</option>
    <option value="Agadir" {{ old('lieu_nai') == "Agadir" ? 'selected' : '' }}>Agadir</option>
    <option value="Essaouira" {{ old('lieu_nai') == "Essaouira" ? 'selected' : '' }}>Essaouira</option>
    <option value="Meknès" {{ old('lieu_nai') == "Meknès" ? 'selected' : '' }}>Meknès</option>
    <option value="Ouarzazate" {{ old('lieu_nai') == "Ouarzazate" ? 'selected' : '' }}>Ouarzazate</option>
</select>

    </div>
    <div class="mb-3">
    <label for="situation_familiale"  class="form-label">Situation familiale <span style="color: red; font-size: 20px;">*</span>:</label>
    <select id="situation_familiale" class="form-control" name="situation_familiale">
   <option value="">--Choisissez une option--</option>
   <option value="célibataire" {{ old('situation_familiale') == "celibataire" ? 'selected' : '' }}>Célibataire</option>
   <option value="marié" {{ old('situation_familiale') == "marie" ? 'selected' : '' }}>Marié(e)</option>
   <option value="divorcé" {{ old('situation_familiale') == "divorce" ? 'selected' : '' }}>Divorcé(e)</option>
   <option value="veuf" {{ old('situation_familiale') == "veuf" ? 'selected' : '' }}>Veuf(ve)</option>
</select>

    @error('situation_familiale')
    <div class="text text-danger mt-1"> {{$message}}</div>
    @enderror
    </div>
    <div class="mb-3">
    <label for="sexe"  class="form-label">Sexe <span style="color: red; font-size: 20px;">*</span>: </label>
    <input type="radio" id="sexe_homme" name="sexe" value="homme" {{ old('sexe') == 'homme' ? 'checked' : '' }}>
    <label for="sexe_homme" >Homme</label>
    <input type="radio" id="sexe_femme" name="sexe" value="femme" {{ old('sexe') == 'femme' ? 'checked' : '' }}>
    <label for="sexe_femme">Femme</label>
    @error('sexe')
    <div class="text text-danger mt-1"> {{$message}}</div>
    @enderror 
</div>

    <div class="mb-3">
      <label for="cin" class="form-label">CIN <span style="color: red; font-size: 20px;">*</span>:</label>
      <input type="text" class="form-control"   value="{{old('cin')}}" placeholder="Code Cin" name="cin" id="cin">
      @error('cin')
      <div class="text text-danger mt-1"> {{$message}}</div>
      @enderror
      </div>
      <div class="mb-3">
      <label for="cnss" class="form-label">CNSS <span style="color: red; font-size: 20px;">*</span>:</label>
      <input type="number" class="form-control"   value="{{old('cnss')}}" name="cnss" placeholder="Code Cnss" id="cnss">
      @error('cnss')
      <div class="text text-danger mt-1"> {{$message}}</div>
      @enderror
      </div>   
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email <span style="color: red; font-size: 20px;">*</span>:</label>
    <input type="email" class="form-control" id="exampleInputEmail1"  value="{{old('email')}}"name="email" placeholder="Email" aria-describedby="emailHelp">
    @error('email')
    <div class="text text-danger"> {{$message}}</div>
     @enderror
  </div>
  <div class="mb-3">
  <label for="tel" class="form-label">Télephone <span style="color: red; font-size: 20px;">*</span>:</label>
  <input type="tel" class="form-control" id="tel"  value="{{old('tel')}}" placeholder="Télephone" name="tel" >
      @error('tel')
    <div class="text text-danger"> {{$message}}</div>
     @enderror
   </div>
   <h2 class="inf" style="font-weight:bold;">Information professionnelle</h2>
      <div class="mb-3">
    <label for="poste" class="form-label">Poste occupé <span style="color: red; font-size: 20px;">*</span>:</label>
    <select id="poste" name="poste" class="form-control">
    <option value="">--Choisissez une option--</option>
    <option value="Développeur web" {{ old('poste') == 'Développeur web' ? 'selected' : '' }}>Développeur web</option>
    <option value="Designer graphique" {{ old('poste') == 'Designer graphique' ? 'selected' : '' }}>Designer graphique / Web designer</option>
    <option value="chef de projet" {{ old('poste') == 'Chef de projet ' ? 'selected' : '' }}>Chef de projet / Scrum Master</option>
    <option value="Testeur" {{ old('poste') == 'Testeur' ? 'selected' : '' }}>Testeur / Quality assurance</option>
    <option value="Spécialiste SEO" {{ old('poste') == 'Spécialiste SEO' ? 'selected' : '' }}>Spécialiste SEO / Marketing digital</option>
    <option value="Développeur mobile" {{ old('poste') == 'Développeur mobile' ? 'selected' : '' }}>Développeur mobile</option>
    <option value="Développeur de logiciels" {{ old('poste') == 'Développeur de logiciels' ? 'selected' : '' }}>Développeur de logiciels</option>
    <option value="Administrateur système " {{ old('poste') == 'Administrateur système ' ? 'selected' : '' }}>Administrateur système / DevOps</option>
    <option value="Analyste en cybersécurité" {{ old('poste') == 'Analyste en cybersécurité' ? 'selected' : '' }}>Analyste en cybersécurité</option>
    <option value="Analyste en données " {{ old('poste') == 'Analyste en données ' ? 'selected' : '' }}>Analyste en données / Data Scientist</option>
</select>


    @error('poste')
    <div class="text text-danger mt-1"> {{$message}}</div>
    @enderror
    </div>
      <div class="mb-3">  
  <label for="select">Contrat <span style="color: red; font-size: 20px;">*</span>:</label>
  <select id="select"  class="form-control"  name="contrat" onchange="afficherInputs()">
    <option value="">--Choisissez une option--</option>
    <option value="CDI">CDI</option>
    <option value="CDD">CDD</option>
  </select>
  @error('contrat')
    <div class="text text-danger mt-1"> {{$message}}</div>
    @enderror
</div >
   
  <div class="mb-3">
    <label for="date_debut" class="form-label">Date de début <span style="color: red; font-size: 20px;">*</span>:</label>
    <input type="date" class="form-control"  value="{{old('date_debut')}}"   name="date_debut" id="date_debut">
    @error('date_debut')
    <div class="text text-danger mt-1"> {{$message}}</div>
    @enderror 
  </div>
    <div id="inputs" style="display:none;">
    <div class="mb-3">
    <label for="date_fin" class="form-label">Date de fin :</label>
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
    
  <button type="submit" class="btn move-button mx-auto d-block" >Valider</button>
</form>

</div>
  </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
<script src="{{asset('assets/js/toastr.min.js')}}"></script>
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






































