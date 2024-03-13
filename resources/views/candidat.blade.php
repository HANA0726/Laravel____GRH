
@extends('layouts.app')
@section('title')
Candidater
@endsection
      @section('content')
      <link href="{{asset('css/style.css')}}" rel="stylesheet">
      <link href="{{asset('css/styleForm.css')}}" rel="stylesheet">
      <link href="{{asset('assets/css/toastr.min.css')}}" rel="stylesheet">  
      <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card can ">
                <div class="card-body">

       <form action="{{route('candidat.validation')}}"  enctype="multipart/form-data" method="post">
        @csrf
        @method('post') 
        <h2 class="inf" style="font-weight:bold;"> Informations personnelles</h2>
        <div class="mb-3">
   <p><img id="photoPreview" src="{{asset('images/user-profil.png')}}" alt="Photo Preview" class="rounded-circle img-thumbnail" style="width:100px;height:100px"></p> 
    <label for="photo" class="form-label"> Votre image <span style="color: red; font-size: 20px;">*</span>:</label><br>
    <input type="file"  name="photo" id="photo" accept="image/*" onchange="previewPhoto(event)">
    @error('photo')
    <div class="text text-danger mt-1"> {{$message}}</div>
    @enderror
    </div> 
        <div class="mb-3">
        <label for="nom" class="form-label">Nom <span style="color: red; font-size: 20px;">*</span>:</label>
        <input type="text" class="form-control" id="nom" placeholder="Nom"  value="{{old('nom')}}"name="nom" >
        @error('nom')
        <div class=" text  text-danger"> {{$message}}</div>
        @enderror
      </div>
      <div class="mb-3">
      <label for="prenom" class="form-label">Prénom <span style="color: red; font-size: 20px;">*</span>:</label>
      <input type="text" class="form-control" id="prenom"  placeholder="Prénom"  value="{{old('prenom')}}" name="prenom" >
      @error('prenom')
      <div class=" text  text-danger"> {{$message}}</div>
      @enderror
       </div>
    
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Adresse Email <span style="color: red; font-size: 20px;">*</span>:</label>
    <input type="email" class="form-control" id="exampleInputEmail1"  placeholder="Email"  value="{{old('email')}}"name="email" aria-describedby="emailHelp">
    @error('email')
    <div class="text text-danger"> {{$message}}</div>
     @enderror
  </div>
  <div class="mb-3">
  <label for="tel" class="form-label">Télephone <span style="color: red; font-size: 20px;">*</span>:</label>
  <input type="tel" class="form-control" id="tel"   placeholder="Télephone" value="{{old('tel')}}"name="tel" >
  @error('tel')
  <div class=" text  text-danger"> {{$message}}</div>
  @enderror
   </div>
   <h2 class="inf" style="font-weight:bold;"> Informations professionnelles</h2>
   <div class="mb-3">
    <label for="poste" class="form-label">Poste souhaite <span style="color: red; font-size: 20px;">*</span>:</label>
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
    <label for="formation" class="form-label">Niveau d'etude <span style="color: red; font-size: 20px;">*</span>:</label>
    <select id="formation" name="formation" class="form-control">
    <option value="">--Choisissez une option--</option>
    <option value="Bac+2" {{old('formation') == 'Bac+2' ? 'selected' : ''}}>Bac+2</option>
    <option value="Bac+3" {{old('formation') == 'Bac+3' ? 'selected' : ''}}>Bac+3</option>
    <option value="Bac+5" {{old('formation') == 'Bac+5' ? 'selected' : ''}}>Bac+5</option>
    <option value="Doctorat" {{old('formation') == 'Doctorat' ? 'selected' : ''}}>Doctorat</option>
</select>

    @error('formation')
    <div class="text text-danger mt-1"> {{$message}}</div>
    @enderror
    </div>
  
    <div class="mb-3">
    <label for="cv" class="form-label"> Votre Cv <span style="color: red; font-size: 20px;">*</span>:</label><br>
    <input type="file"   name="cv" id="cv">
    @error('cv')
    <div class="text text-danger mt-1"> {{$message}}</div>
    @enderror
    </div>
    <div class="mb-3">
    <label for="lt" class="form-label"> Votre lettre de motivation <span style="color: red; font-size: 20px;">*</span>:</label><br>
    <input type="file" name="lt" id="lt">
    @error('lt')
    <div class="text text-danger mt-1"> {{$message}}</div>
    @enderror
    </div>
  <button type="submit" class="btn move-button mx-auto d-block " style="width=500px!important;">Valider</button>
</form>
</div>
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

