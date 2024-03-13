<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CandidatRequest;
use Notification;
use App\Notifications\CandidatureNotification;
 use Illuminate\Support\Str;


use Autu;
use App\Models\Candidat;

class CandidatController extends Controller
{

   
     public function  store(CandidatRequest $request,Candidat $candidat){
       
        $verif=$request;
        if (Candidat::emailExists($request->email)) {
         return redirect()->route('candidat')->with('error', 'Vous avez déjà effectué une demande.');


        } else {
        if($verif){

           
          if($verif->has('photo')){
            $photo=$request->photo;
            $photo_name=time().'_'.Str::random(5).'_'.$photo->getClientOriginalName();
            $photo->move(public_path('uploads'),$photo_name);    
        } 
    
        if($verif->has('cv')){
            $cv=$request->cv;
            $cv_name= Str::random(10).'_'.time().'_'.$cv->getClientOriginalName();
            $cv->move(public_path('uploads'),$cv_name);    
        } 
        if($verif->has('lt')){
            $lt=$request->lt;
            $lt_name=time().'_'.$lt->getClientOriginalName();
            $lt->move(public_path('uploads'),$lt_name);    
        } 

           Candidat::create([
            'nom' =>$request->nom,
            'prenom' =>$request->prenom,
            'email' =>$request->email,
            'telephone'=>$request->tel,
            'formation'=>$request->formation,
             'cv'=>$cv_name,
             'lettre_motivation'=>$lt_name,
             'poste'=>$request->poste,
            'photo'=>$photo_name
        ]);
         
        $candidat = Candidat::latest()->first();
        Notification::send($candidat, new CandidatureNotification($candidat));

        return redirect()->route('candidat.verifier')->with('success', 'Candidature envoyée avec succès');

        }
        else{
           redirect()->back()->with('error', 'Veuillez vérifier les données saisies');
        }
    }
}

 
}
