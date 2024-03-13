@extends('layouts.main')
@section('title-content')
Demandes  de congé
@endsection

@section('content')
<link href="{{asset('css/listepresen.css')}}" rel="stylesheet">  
<link href="{{asset('assets/css/toastr.min.css')}}" rel="stylesheet">  
@if(count($conge) > 0)
<div class="container">
<div class="row card-deck">
  @foreach($conge  as $item)
  <div class="col-lg-4 col-md-6 mb-4 card-deck ">
            <div class="card card-deck" >
              <div class="row ">
                <div class="col-lg-12">
                  <div class="card-body">
                  <h4 class="card-title txt">
                                        {{ $item->prenom }} {{ $item->nom }}
                                        @if($item->type_conge == 'congé annuel')
                                            @php
                                                $solde = DB::table('conge_soldes')
                                                    ->where('id_employer', $item->id_employer)
                                                    ->whereYear('created_at', Carbon\Carbon::now()->year)
                                                    ->value('solde_reel');
                                            @endphp
                                            @if(isset($solde))
                                                <span class="badge badge-primary  ml-4 badge-position" style="background-color:#952D98!important;">{{ $solde }} j</span>
                                            @endif
                                        @endif
                                    </h4>
          <p class="card-text txt">Type congé: {{ $item->type_conge }}</p>
          <p class="card-text txt">Date de début: {{ $item->date_debut }}</p>
          <p class="card-text txt">Date de fin: {{ $item->date_fin }}</p>
       
          <p class="card-text txt"><a href="/RespRh/DemandesConges/{{$item->id_conge}}/view" class="btn vert-button">Afficher</a></p>
        </div>
      </div>
    </div>
    </div>
      </div>
    

  
  @endforeach
</div>
<div class="row alldata mt-2">
  <div class="col-md-12 d-flex justify-content-end">
    <nav aria-label="Page navigation example">
      <ul class="pagination justify-content-end custom-pagination">
        {{ $conge->links() }}
      </ul>
    </nav>
  </div>


</div>

</div>
@else

<h2 class="container m-3">Aucune demande n'a été effectuée  pour le moment. </h2>

@endif
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