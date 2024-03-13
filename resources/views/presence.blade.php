@extends('layouts.main')
@section('title-content')
Présence
@endsection
@section('content')
<link href="{{asset('css/presence.css')}}" rel="stylesheet">
<link href="{{asset('assets/css/toastr.min.css')}}" rel="stylesheet"> 
    <div class="container mb-5 mt-0">
                <div class="row justify-content-center mb-2  mt-0">
              <div class="col-auto d-flex align-items-center">
              <i class="fa-solid fa-clock fa-2xl" style="color: #000000;"></i>
                <div id="horloge" class="ml-2"></div>
              </div>
            </div>
        <div class="row justify-content-center">            
            <div class="col-md-7">
                <div class="card cards">
                @if (!$presence)
                              <h2 class="text-center">Enregistrer votre présence</h2>
                            @endif

                            <div class="card-body">
                            @if ($presence)
                                  <div class="text-center">
                                    <h5>Vous avez déjà enregistré votre présence pour aujourd'hui.</h5>
                                    <h5 class="mb-0">Heure d'enregistrement : <span>{{ \Carbon\Carbon::parse($presence->entry_time)->timezone('Africa/Casablanca')->format('H:i:s') }}</span></h5>
                                  </div>
                                @endif
                      
                        <form action="{{ route('employer.presence.store') }}" method="POST">
                        <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                @csrf
         <button type="submit" onclick="this.disabled=true;this.form.submit();" class="btn vert-button text-center "{{ $presence ? ' disabled' : '' }}>Pointer ma présence</button>
         </div>
         </div> 
       
        </form>
      
                               
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
<script src="{{asset('assets/js/toastr.min.js')}}"></script>
    <script>
  function mettreAJourHorloge() {
    // Obtenir la date et l'heure actuelles
    var date = new Date();
    var heures = date.getHours();
    var minutes = date.getMinutes();
    var secondes = date.getSeconds();
    
    // Formater l'heure pour afficher toujours deux chiffres (par ex. 09:05:02)
    heures = (heures < 10) ? '0' + heures : heures;
    minutes = (minutes < 10) ? '0' + minutes : minutes;
    secondes = (secondes < 10) ? '0' + secondes : secondes;
    
    // Construire l'horloge au format souhaité (par ex. 09:05:02)
    var horloge = heures + ':' + minutes + ':' + secondes;
    
    // Mettre à jour l'élément HTML avec l'horloge
    document.getElementById('horloge').textContent = horloge;
  }
  
  // Mettre à jour l'horloge immédiatement
  mettreAJourHorloge();
  
  // Mettre à jour l'horloge toutes les secondes
  setInterval(mettreAJourHorloge, 1000);
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
