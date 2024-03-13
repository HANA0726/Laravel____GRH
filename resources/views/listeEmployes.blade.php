@extends('layouts.main')
@section('title-content')
Liste des employés
@endsection
@section('content')


<link href="{{asset('css/styleempcar.css')}}" rel="stylesheet">   
<link href="{{asset('assets/css/toastr.min.css')}}" rel="stylesheet">   
 <div class="mb-1   mr-5 col-6">
<a href="{{route('RespRh.ajouter.employe')}}"class="btn vert-button"> <i class="fa-sharp fa-solid fa-plus fa-xl" style="color: #ffffff;"></i> Ajouter Employé</a> 
</div>
 
<div class="search-container">
  <form class="mr-5" style="text-align: right; margin-left:200px;">
    <input class="form-control m-1" name="search" id="search" type="search" placeholder="Chercher" aria-label="Search">
  </form>
</div>
      
      <div class="container mb-5 ">
        <div class="alldata card-deck">
        @foreach($employe as $item)
        <div class=" card  cards col-lg-3 col-md-6 mb-1" >
         @if(empty($item->photo))
            <img  class="img" src="{{ asset('images/user-profil.png') }}"  > 
        @else
            <img  class="img" src="{{ asset('uploads/' . $item->photo) }}"  >
        @endif
            <h4 class="card-text">{{$item->prenom}} {{$item->nom}}</h4>
            <p class="p-0" style="font-size: 16px;">{{$item->email}}</p>
            <p class="card-text poste">{{$item->poste}}</p>
            <p class="card-text social-media">
    <a href="/RespRh/employe/{{$item->id_employer}}/view" class="ml-2">
        <i class="fa-solid fa-eye fa-xl" style="color:#952D98;"></i>
    </a>
    <a href="/RespRh/employe/{{$item->id_employer}}/edit" class="ml-2">
        <i class="fa-regular fa-pen-to-square fa-xl" style="color: #00ed64;"></i>
    </a>
    <a href="#" class="ml-2" data-toggle="modal" data-target="#confirmDeleteModal{{$item->id_employer}}">
        <i class="fa-solid fa-trash-can fa-xl" style="color: #000000;"></i>
    </a>
</p>

<div class="modal fade" id="confirmDeleteModal{{$item->id_employer}}" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel{{$item->id_employer}}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content"style="color:black;">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel{{$item->id_employer}}">Confirmation de la suppression</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <i class="fa-sharp fa-solid fa-circle-exclamation fa-lg" style="color:red;"></i> Êtes-vous sûr de vouloir supprimer cet employé ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn vert-button" data-dismiss="modal">Annuler</button>
                <a href="/RespRh/employe/{{$item->id_employer}}/delete" class="btn move-button">Supprimer</a>
            </div>
        </div>
    </div>
</div> 
      
       
        </div>
       @endforeach
  
        </div>
        <div id="Content" class="searchdata "> </div>
        <div class="row alldata mt-2">
  <div class="col-md-12 d-flex justify-content-end">
    <nav aria-label="Page navigation example">
      <ul class="pagination justify-content-end custom-pagination">
        {{ $employe->links() }}
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
        $value = $(this).val();
        if($value)
        {
          $('.alldata').hide();
          $('.searchdata').show();
          
        }
        else{
          $('.alldata').show();
          $('.searchdata').hide();
        }
        $.ajax({
            type: 'get',
            url: '{{ URL::to('/RespRh/employe/search') }}',
            data: { 'search': $value },
            success: function(data) {
              console.log(data);
        var output = "";
        if (data.employe.length === 0) {
            output = '<div class="container text-center" ><img src="{{asset('images/no-data.png')}}" style="width:30%;"><h3 class="text-center" style="color:#000000;">Aucun employé trouvé </h3><div>';
          } else {
        $.each(data.employe, function(key, employee) {
          var photoUrl = employee.photo ? "{{ asset('uploads') }}/" + employee.photo : "{{ asset('images/user-profil.png') }}";
          output +="<div class='card  cards col-lg-3 col-md-6 mb-1' >"+
                "<img src='" + photoUrl + "' class='img'>" +
                    "<div class='card-body'>" +
                      "<h4 class='card-text'>" + employee.prenom + " " + employee.nom + "</h4>" +
                      "<p class='card-text'>" + employee.email + "</p>" +
                      "<p class='card-text poste'>" + employee.poste + "</p>" +
                      "<p class='card-text social-media'>" +
                        "<a href='/RespRh/employe/" + employee.id_employer + "/view' class=' ml-2'>" +
                          "<i class='fa-solid fa-eye  fa-xl' style='color:#952D98;'></i>" +
                        "</a>" +
                        "<a href='/RespRh/employe/" + employee.id_employer + "/edit' class=' ml-2'>" +
                          "<i class='fa-regular fa-pen-to-square fa-xl' style='color: #00ed64;'></i>" +
                        "</a>" +
                        "<a href='#' class='ml-2' data-toggle='modal' data-target='#confirmDeleteModal1" + employee.id_employer + "'>" +
                    "<i class='fa-solid fa-trash-can fa-xl' style='color: #000000;'></i>" +
                    "</a>" +
                    "</p>" +
                    "</div>" +
                    "</div>";

                    output += "<div class='modal fade' id='confirmDeleteModal1" + employee.id_employer + "' tabindex='-1' role='dialog' aria-labelledby='confirmDeleteModalLabel" + employee.id_employer + "' aria-hidden='true'>" +
    "<div class='modal-dialog'>" +
    "<div class='modal-content' style='color:black;'>" +
    "<div class='modal-header'>" +
    "<h5 class='modal-title' id='confirmDeleteModalLabel" + employee.id_employer + "'>Confirmation de la suppression</h5>" +
    "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>" +
    "<span aria-hidden='true'>&times;</span>" +
    "</button>" +
    "</div>" +
    "<div class='modal-body'>" +
    "<i class='fa-sharp fa-solid fa-circle-exclamation fa-lg' style='color:red;'></i> Êtes-vous sûr de vouloir supprimer cet employé ?" +
    "</div>" +
    "<div class='modal-footer'>" +
    "<button type='button' class='btn vert-button' data-dismiss='modal'>Annuler</button>" +
    "<a href='/RespRh/employe/" + employee.id_employer + "/delete' class='btn move-button'>Supprimer</a>" +
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