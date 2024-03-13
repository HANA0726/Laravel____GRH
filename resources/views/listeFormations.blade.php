@extends('layouts.main')
@section('title-content')
Liste des formations
@endsection
@section('content')
<link href="{{asset('css/listepresen.css')}}" rel="stylesheet">  
<link href="{{asset('assets/css/toastr.min.css')}}" rel="stylesheet">   
<div class="mb-3 mr-5 col-6">
<a href="{{route('RespRh.ajouter.formation')}}"class="btn vert-button" ><i class="fa-sharp fa-solid fa-plus fa-xl" style="color: #ffffff;"></i> Ajouter Formation</a> 

</div>

<div class="search-container">
  <form class="mr-5" style="text-align: right; margin-left:200px;">
    <input class="form-control m-1" name="search" id="search" type="search" placeholder="Chercher" aria-label="Search">
  </form>
</div>



<div class="container">
@if(count($formation) > 0)
<div class=" row alldata card-deck">
@foreach ($formation as $item)
<div class="col-lg-4 col-md-6 mb-4 card-deck">
            <div class="card">
              <div class="row ">
                <div class="col-lg-12">
                  <div class="card-body">
    <h4 class="card-title txt">{{ $item['titre'] }} </h4>
    <p class="card-text txt"> Date de début: {{ $item['date_debut'] }}</p>
    <p class="card-text txt"> Date de fin: {{ $item['date_fin'] }}</p>
    <p class="card-text txt">Nombre d'employés inscrits: {{ count(DB::table('employers')->join('e_formations', 'e_formations.id_employer', '=', 'employers.id_employer')->where('e_formations.id_formation', '=', $item->id_formation)->get()) }}</p>
    <p> <a href="/RespRh/Formations/{{$item->id_formation}}/view" class="btn move-button m-1"><i class="fa-solid fa-eye  fa-lg" style="color:#ffffff;"></i></a >
    <a href="/RespRh/Formations/{{$item->id_formation}}/edit"  class="btn vert-button m-1"><i class="fa-regular fa-pen-to-square fa-lg" style="color: #ffffff;"></i></a>
    <a href="#"  class="btn move-button m-1" data-toggle="modal" data-target="#confirmDeleteModal{{$item->id_formation}}">
        <i class="fa-solid fa-trash-can fa-xl" style="color: #ffffff;"></i>
    </a>
  </p>
 
</div>
</div>
</div>
</div>
<div class="modal fade" id="confirmDeleteModal{{$item->id_formation}}" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel{{$item->id_formation}}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content"style="color:black;">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel{{$item->id_formation}}">Confirmation de la suppression</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <i class="fa-sharp fa-solid fa-circle-exclamation fa-lg" style="color:red;"></i> Êtes-vous sûr de vouloir supprimer cette formation?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn vert-button" data-dismiss="modal">Annuler</button>
                <a href="/RespRh/Formations/{{$item->id_formation}}/delete" class="btn move-button">Supprimer</a>
            </div>
        </div>
    </div>
</div> 
</div>

@endforeach
</div>
        <div id="Content" class="searchdata row"> </div>
        <div class="row alldata mt-2">
  <div class="col-md-12 d-flex justify-content-end">
    <nav aria-label="Page navigation example">
      <ul class="pagination justify-content-end custom-pagination">
        {{ $formation->links() }}
      </ul>
    </nav>
  </div>


</div>
</div>
@else

<div class="container m-3 text-center">
  <svg class="mb-3 text-center" xmlns="http://www.w3.org/2000/svg" data-name="Layer 1" width="35%" height="35%" viewBox="0 0 647.63626 632.17383" xmlns:xlink="http://www.w3.org/1999/xlink"><path d="M687.3279,276.08691H512.81813a15.01828,15.01828,0,0,0-15,15v387.85l-2,.61005-42.81006,13.11a8.00676,8.00676,0,0,1-9.98974-5.31L315.678,271.39691a8.00313,8.00313,0,0,1,5.31006-9.99l65.97022-20.2,191.25-58.54,65.96972-20.2a7.98927,7.98927,0,0,1,9.99024,5.3l32.5498,106.32Z" transform="translate(-276.18187 -133.91309)" fill="#f2f2f2"/><path d="M725.408,274.08691l-39.23-128.14a16.99368,16.99368,0,0,0-21.23-11.28l-92.75,28.39L380.95827,221.60693l-92.75,28.4a17.0152,17.0152,0,0,0-11.28028,21.23l134.08008,437.93a17.02661,17.02661,0,0,0,16.26026,12.03,16.78926,16.78926,0,0,0,4.96972-.75l63.58008-19.46,2-.62v-2.09l-2,.61-64.16992,19.65a15.01489,15.01489,0,0,1-18.73-9.95l-134.06983-437.94a14.97935,14.97935,0,0,1,9.94971-18.73l92.75-28.4,191.24024-58.54,92.75-28.4a15.15551,15.15551,0,0,1,4.40966-.66,15.01461,15.01461,0,0,1,14.32032,10.61l39.0498,127.56.62012,2h2.08008Z" transform="translate(-276.18187 -133.91309)" fill="#3f3d56"/><path d="M398.86279,261.73389a9.0157,9.0157,0,0,1-8.61133-6.3667l-12.88037-42.07178a8.99884,8.99884,0,0,1,5.9712-11.24023l175.939-53.86377a9.00867,9.00867,0,0,1,11.24072,5.9707l12.88037,42.07227a9.01029,9.01029,0,0,1-5.9707,11.24072L401.49219,261.33887A8.976,8.976,0,0,1,398.86279,261.73389Z" transform="translate(-276.18187 -133.91309)" fill="#00ed64"/><circle cx="190.15351" cy="24.95465" r="20" fill="#00ed64"/><circle cx="190.15351" cy="24.95465" r="12.66462" fill="#fff"/><path d="M878.81836,716.08691h-338a8.50981,8.50981,0,0,1-8.5-8.5v-405a8.50951,8.50951,0,0,1,8.5-8.5h338a8.50982,8.50982,0,0,1,8.5,8.5v405A8.51013,8.51013,0,0,1,878.81836,716.08691Z" transform="translate(-276.18187 -133.91309)" fill="#e6e6e6"/><path d="M723.31813,274.08691h-210.5a17.02411,17.02411,0,0,0-17,17v407.8l2-.61v-407.19a15.01828,15.01828,0,0,1,15-15H723.93825Zm183.5,0h-394a17.02411,17.02411,0,0,0-17,17v458a17.0241,17.0241,0,0,0,17,17h394a17.0241,17.0241,0,0,0,17-17v-458A17.02411,17.02411,0,0,0,906.81813,274.08691Zm15,475a15.01828,15.01828,0,0,1-15,15h-394a15.01828,15.01828,0,0,1-15-15v-458a15.01828,15.01828,0,0,1,15-15h394a15.01828,15.01828,0,0,1,15,15Z" transform="translate(-276.18187 -133.91309)" fill="#3f3d56"/><path d="M801.81836,318.08691h-184a9.01015,9.01015,0,0,1-9-9v-44a9.01016,9.01016,0,0,1,9-9h184a9.01016,9.01016,0,0,1,9,9v44A9.01015,9.01015,0,0,1,801.81836,318.08691Z" transform="translate(-276.18187 -133.91309)" fill="#952d98"/><circle cx="433.63626" cy="105.17383" r="20" fill="#952d98"/><circle cx="433.63626" cy="105.17383" r="12.18187" fill="#fff"/></svg>

  <h3 class="text-center" style="color:#000000;">
  Jusqu'à présent, aucune formation  n'a été proposée.
  </h3>   
 </div>

@endif
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
      url: '{{ URL::to('/RespRh/Formations/searchFor') }}',
      data: { 'search': $value },
      success: function(data) {
        console.log(data);
        var output = "";
        if (data.formation.length === 0) {
            output = '<div class="container text-center" ><img src="{{asset('images/no-data.png')}}" style="width:30%;"><h3 class="text-center" style="color:#000000;">Aucune formation trouvée </h3><div>';
          } else {
        $.each(data.formation, function(key, formation) {
          var numEmployees = formation.num_employees;
          output += '<div class="col-lg-4 col-md-6 mb-4">';
output += '<div class="card">';
output += '<div class="row">';
output += '<div class="col-lg-12">';
output += '<div class="card-body">';
output += "<h4 class='card-title txt'>" + formation.titre + "</h4>" +
  "<p class='card-text txt'>" + formation.date_debut + "</p>" +
  "<p class='card-text txt'>" + formation.date_fin + "</p>" +
  "<p class='card-text txt'>Nombre d'employés inscrits: <span id='num-employees-" + formation.id_formation + "'>" + numEmployees + "</span></p>" +
  "<p>" +
  "<a href='/RespRh/Formations/" + formation.id_formation + "/view' class='btn move-button m-1'><i class='fa-solid fa-eye fa-lg' style='color:#ffffff;'></i></a>" +
  "<a href='/RespRh/Formations/" + formation.id_formation + "/edit' class='btn vert-button m-1'><i class='fa-regular fa-pen-to-square fa-lg' style='color: #ffffff;'></i></a>" +
  "<a href='#' class='btn move-button m-1' data-toggle='modal' data-target='#confirmDeleteModal1" + formation.id_formation + "'><i class='fa-solid fa-trash-can fa-lg' style='color: #ffffff;'></i></a>" +
  "</p>" +
  "</div>" +
  "</div>" +
  "</div>" +
  "</div>" +
  "</div>";
  output += '<div class="modal fade" id="confirmDeleteModal1' + formation.id_formation + '" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">';
output += '<div class="modal-dialog" role="document">';
output += '<div class="modal-content" style="color:black;">';
output += '<div class="modal-header">';
output += '<h5 class="modal-title" id="confirmDeleteModalLabel">Confirmation de suppression</h5>';
output += '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
output += '<span aria-hidden="true">&times;</span>';
output += '</button>';
output += '</div>';
output += '<div class="modal-body">';
output += '<p><i class="fa-sharp fa-solid fa-circle-exclamation fa-lg" style="color:red;"></i> Êtes-vous sûr de vouloir supprimer cette formation ?</p>';
output += '</div>';
output += '<div class="modal-footer">';
output += '<button type="button" class="btn vert-button" data-dismiss="modal">Annuler</button>';
output += '<a href="/RespRh/Formations/' + formation.id_formation + '/delete" class="btn move-button">Supprimer</a>';
output += '</div>';
output += '</div>';
output += '</div>';
output += '</div>';


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