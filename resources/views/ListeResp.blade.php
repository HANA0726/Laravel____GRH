
@extends('layouts.main')
@section('title-content')
Liste des responsables
@endsection
@section('content')

<link href="{{asset('assets/css/toastr.min.css')}}" rel="stylesheet">   
<link href="{{asset('css/styleempcar.css')}}" rel="stylesheet">   

 <div class="mb-2  mr-5 col-6">
<a href="{{route('admin.ajouterResp')}}"class="btn vert-button" ><i class="fa-sharp fa-solid fa-plus fa-xl" style="color: #ffffff;"></i> Ajouter responsable</a> 
</div>
<div class="search-container">
  <form class="mr-5" style="text-align: right; margin-left:200px;">
    <input class="form-control m-1" name="search" id="search" type="search" placeholder="Chercher" aria-label="Search">
  </form>
</div>
  
      
         <div class="container mb-5 ">
        <div class="alldata card-deck">
        @foreach($resprh as $item)
        <div class="card  cards col-xl-3 col-md-6 mb-4  m-1 d-inline-block" >
            <div class="card-body">
            <h4 class="card-text txt">{{$item->name}}</h4>
            <p class="card-text txt">{{$item->email}}</p>
           <p class="card-text txt">
           <a href="#"  class="btn move-button m-1" data-toggle="modal" data-target="#confirmDeleteModal{{$item->id}}">
           <i class="fa-solid fa-trash-can" style="color: #ffffff;"></i> Supprimer
    </a>
         </p> 
      
          </div>
    <div class="modal fade" id="confirmDeleteModal{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel{{$item->id}}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content"style="color:black;">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel{{$item->id}}">Confirmation de la suppression</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <i class="fa-sharp fa-solid fa-circle-exclamation fa-lg" style="color:red;"></i> Êtes-vous sûr de vouloir supprimer ce responsable Rh?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn vert-button" data-dismiss="modal">Annuler</button>
                <a href="/admin/ListesResp/{{$item->id}}/delete" class="btn move-button">Supprimer</a>
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
        {{ $resprh->links() }}
      </ul>
    </nav>
  </div>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
<script src="{{asset('assets/js/toastr.min.js')}}"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script type="text/javascript">
  $('#search').on('keyup', function() {
    $value = $(this).val().toLowerCase().trim();
    if ($value.length > 0) {
      $('.alldata').hide();
      $('.searchdata').show();
    } else {
      $('.alldata').show();
      $('.searchdata').hide();
    }
    $.ajax({
      type: 'get',
      url: '{{ URL::to('/admin/ListesResp/search2') }}',
      data: { 'search': $value },
      success: function(data) {
  console.log(data);
  var output = ""; 
  if (data.resprh.length === 0) {
            output = '<div class="container text-center" ><img src="{{asset('images/no-data.png')}}" style="width:30%;"><h3 class="text-center" style="color:#000000;">Aucun employé trouvé </h3><div>';
          } else {
  $.each(data.resprh, function(key, resprh) {
    output += "<div class='card cards col-xl-3 col-md-6 mb-4  m-1 d-inline-block'>"+
             "<div class='card-body'>" +
              "<h4 class='card-text txt'>" + resprh.name  + "</h4>" +
              "<p class='card-text txt'>" + resprh.email + "</p>" +
              "<p class='card-text txt'>" +
              "<a href='#' class='btn move-button m-1' data-toggle='modal' data-target='#confirmDeleteModal1" + resprh.id + "'>" +
                "<i class='fa-solid fa-trash-can' style='color: #ffffff;'></i> Supprimer" +
              "</a>" +
              "</p>" +
            "</div>" +
          "</div>";

output += "<div class='modal fade' id='confirmDeleteModal1" + resprh.id + "' tabindex='-1' role='dialog' aria-labelledby='confirmDeleteModalLabel" + resprh.id + "' aria-hidden='true'>" +
             "<div class='modal-dialog'>" +
               "<div class='modal-content' style='color: black;'>" +
                 "<div class='modal-header'>" +
                   "<h5 class='modal-title' id='confirmDeleteModalLabel" + resprh.id + "'>Confirmation de la suppression</h5>" +
                   "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>" +
                     "<span aria-hidden='true'>&times;</span>" +
                   "</button>" +
                 "</div>" +
                 "<div class='modal-body'>" +
                   "<i class='fa-sharp fa-solid fa-circle-exclamation fa-lg' style='color: red;'></i> Êtes-vous sûr de vouloir supprimer ce responsable RH ?" +
                 "</div>" +
                 "<div class='modal-footer'>" +
                   "<button type='button' class='btn vert-button' data-dismiss='modal'>Annuler</button>" +
                   "<a href='/RespRh/ListesResp/" + resprh.id + "/delete' class='btn move-button'>Supprimer</a>" +
                 "</div>" +
               "</div>" +
             "</div>" 
  });}
  if (output) { 
    $('#Content').html(output);
  } else {
    $('#Content').html("<p></p>"); 
  }
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