@extends('layouts.main')
@section('title-content')
Liste des candidats
@endsection
@section('content')
<link href="{{asset('css/styleempcar.css')}}" rel="stylesheet">   
<link href="{{asset('assets/css/toastr.min.css')}}" rel="stylesheet">  
<div class="search-container">
  <form class="mr-5" style="text-align: center; margin-left:800px;">
    <input class="form-control m-1" name="search" id="search" type="search" placeholder="Chercher" aria-label="Search">
  </form>
</div>
  
     @if(count($candidat)>0) 
      <div class="container mb-3">
        <div class="alldata card-deck">
        @foreach($candidat as $item)
        <div class="card cards col-lg-3 col-md-6 mb-4">
         <img src="{{ asset('uploads/' . $item->photo) }}" class="img"> 
          <div class="card-body">
            <h4 class="card-text">{{$item->prenom}} {{$item->nom}}</h4>
            <p class="card-text" style="font-size: 14px;">{{$item->email}}</p>
            <p class="card-text"> <a href="{{ asset('uploads/' . $item->cv) }}" download style=" color:#952D98;" ><i class="fa-solid fa-download " style="color: #952D98;"></i>  CV.{{$item->nom}}.pdf </a></p>
            <p class="card-text"><a href="{{ asset('uploads/' . $item->lettre_motivation) }}" download style=" color:#952D98;"> <i class="fa-solid fa-download " style="color:#952D98;"></i> Lettre.{{$item->nom}}.pdf </a></p>
            <p class="card-text social-media"><a href="/RespRh/candidat/{{$item->id_candidat}}/view" ><i class="fa-solid fa-eye  fa-xl" style="color:#952D98;"></i></a>
        
<a href="#" class="ml-2" data-toggle="modal" data-target="#confirmDeleteModal{{$item->id_candidat}}">
    <i class="fa-solid fa-trash-can fa-xl" style="color: #00ed64;"></i>
</a>
</p> 
      
          </div>
        
<div class="modal fade" id="confirmDeleteModal{{$item->id_candidat}}" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel{{$item->id_candidat}}" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content" style="color:black;">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel{{$item->id_candidat}}">Confirmation de suppression</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p> <i class="fa-sharp fa-solid fa-circle-exclamation fa-lg" style="color:red;"></i> Êtes-vous sûr de vouloir supprimer le candidat {{$item->prenom}} {{$item->nom}} ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn vert-button" data-dismiss="modal">Annuler</button>
                <a href="/RespRh/candidat/{{$item->id_candidat}}/delete" class="btn move-button">Supprimer</a>
            </div>
        </div>
    </div>
</div>

        </div>
       @endforeach
     
        </div>
        <div id="Content" class="searchdata card-deck"> </div>
        <div class="row alldata mt-2">
  <div class="col-md-12 d-flex justify-content-end">
    <nav aria-label="Page navigation example">
      <ul class="pagination justify-content-end custom-pagination">
        {{ $candidat->links() }}
      </ul>
    </nav>
  </div>


</div>
</div>
@else
<p>
        Aucune candidature trouvée.
</p>
@endif
<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
<script src="{{asset('assets/js/toastr.min.js')}}"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<script type="text/javascript">
  $('#search').on('keyup', function() {
    $value = $(this).val();
    if ($value) {
      $('.alldata').hide();
      $('.searchdata').show();
    } else {
      $('.alldata').show();
      $('.searchdata').hide();
    }
    $.ajax({
      type: 'get',
      url: '{{ URL::to('/RespRh/candidat/searchCan') }}',
      data: { 'search': $value },
      success: function(data) {
        console.log(data);
        var output = "";
        if (data.candidat.length === 0) {
            output = '<div class="container text-center" ><img src="{{asset('images/no-data.png')}}" style="width:30%;"><h3 class="text-center" style="color:#000000;">Aucun candidat trouvé </h3><div>';
          } else {
        $.each(data.candidat, function(key, candidat) {
          var photoUrl = "{{ asset('uploads') }}/" + candidat.photo;
          output +="<div class='card cards col-lg-3 col-md-6 mb-1'>"+
                "<img src='" + photoUrl + "'   class='img'>" +
                    "<div class='card-body'>" +
                      "<h4 class='card-text' >" + candidat.prenom + " " + candidat.nom + "</h4>" +
                      "<p class='card-text' style='font-size: 14px;'>"  + candidat.email + "</p>" +
                     
                      "<p class='card-text'> <a href='{{ asset('uploads/') }}" + candidat.cv + "' download style='color:#952D98;'><i class='fa-solid fa-download' style='color: #952D98;'></i>CV." + candidat.nom + ".pdf</a></p>" +
                      "<p class='card-text'> <a href='{{ asset('uploads/') }}" + candidat.lettre_motivation + "' download style='color:#952D98;'><i class='fa-solid fa-download' style='color: #952D98;'></i> Lettre." + candidat.nom + ".pdf</a></p>" +

                      "<p class='card-text'>" +
                        "<a href='/RespRh/candidat/" + candidat.id_candidat + "/view'>" +
                          "<i class='fa-solid fa-eye  fa-xl' style='color:#952D98;'></i>" +
                        "</a>" +
                        "<a href='#' class='ml-2' data-toggle='modal' data-target='#confirmDeleteModal1" + candidat.id_candidat + "'>" +
                  "<i class='fa-solid fa-trash-can fa-xl' style='color: #00ed64;'></i>" +
                "</a>" +
              "</p>" +
            "</div>" +
          "</div>";
          output +="<div class='modal fade' id='confirmDeleteModal1" + candidat.id_candidat + "' tabindex='-1' role='dialog' aria-labelledby='confirmDeleteModalLabel' aria-hidden='true'>" +
  "<div class='modal-dialog' role='document'>" +
    "<div class='modal-content'style='color:black;'>" +
      "<div class='modal-header'>" +
        "<h5 class='modal-title' id='confirmDeleteModalLabel'>Confirmation de suppression</h5>" +
        "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>" +
          "<span aria-hidden='true'>&times;</span>" +
        "</button>" +
      "</div>" +
      "<div class='modal-body'>" +
        "<p> <i class='fa-sharp fa-solid fa-circle-exclamation fa-lg' style='color:red;'></i> Êtes-vous sûr de vouloir supprimer le candidat " + candidat.prenom + " " + candidat.nom + " ?</p>" +
      "</div>" +
      "<div class='modal-footer'>" +
        "<button type='button' class='btn vert-button' data-dismiss='modal'>Annuler</button>" +
        "<a href='/RespRh/candidat/" + candidat.id_candidat + "/delete' class='btn move-button'>Supprimer</a>" +
      "</div>" +
    "</div>" +
  "</div>" +
"</div>";

        });}
        $('#Content').html(output);
      }
    });
  });
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