@extends('layouts.main')
@section('title-content')
Justifer l'absence
@endsection
@section('content')

<link href="{{asset('css/ajouterFor.css')}}" rel="stylesheet">   
<link href="{{asset('assets/css/toastr.min.css')}}" rel="stylesheet" > 
<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card emp1 setting">
            <h2 class="text-center txt" style="color:#952D98;">Justifer votre absence</h2>
                <div class="card-body">
                <form method="POST" action="/employer/DemandeAbsence/{{$id}}/justifier/validation"  enctype ='multipart/form-data'>
                        @csrf
                 <div class="mb-3">
                 <label for="floatingTextarea2" class="form-label">Raisons d'absence <span style="color: red; font-size: 20px;">*</span>: </label>
                 
                 <textarea class="form-control" placeholder="Saisir vos raisons"  class="form-control" name="raisons" id="floatingTextarea2" style="height: 100px"  autofocus></textarea>
                 @error('raisons')
                               <div class=" text  text-danger"> {{$message}}</div>
                               @enderror
                     
                     

                        </div>            

                        <div class="mb-3">
                        <label for="name" class="form-label">{{ __('Pièce jointe') }}<span style="color: red; font-size: 20px;">*</span>: </label>
                            
                                <input id="name" type="file" class="form-control " name="Pj" value="{{ old('Pj') }}"  >
                                @error('Pj')
                               <div class=" text  text-danger"> {{$message}}</div>
                               @enderror
                               
                           
                        </div>
                        <button type="submit" class="btn move-button mx-auto d-block">
                                    {{ __('Envoyer') }}
                                </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
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
