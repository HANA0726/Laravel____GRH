<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Employer;
use App\Models\User;
use App\Models\Presence;
use App\Models\Conge;
use App\Models\EFormation;
use App\Models\Prime;
use App\Models\Salaire;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\profilvalidationRequest;

class AdminController extends Controller
{
    public function Dashboard(){

        $user= DB::table('users')->count();
        $RespRh= DB::table('users')->where('role','2')->count();
        $employers= DB::table('users')->where('role','3')->count();
        $admin= DB::table('users')->where('role','1')->count();

        $data = DB::table('employers')
        ->select(DB::raw('type_contrat as type, COUNT(*) as nombre'))
        ->groupBy(DB::raw('type_contrat'))
        ->get();
         
        $type=[];
        $nombre=[];
        foreach($data as $key ){
         $type[] = $key->type;
         $nombre[] = $key->nombre;
            
        }
        $data2 = DB::table('employers')
        ->select(DB::raw('sexe as sexe, COUNT(*) as count'))
        ->groupBy(DB::raw('sexe'))
        ->get();
        $sexe=[];
        $count=[];
        foreach($data2 as $key ){
         $sexe[] = $key->sexe;
         $count[] = $key->count;
            
        }
    
        return view('admin',compact('user','employers','admin','RespRh','type','nombre','count','sexe'));
    }

    public function ListesEmployes(){
        $employe= Employer::orderBy('created_at','desc')->paginate(4);
        return view('AListesEmployes',compact('employe'));
    }

    public function search(Request $request)
    {
        $employe = Employer::where('nom', 'like', '%' . $request->input('search') . '%')
                    ->orWhere('email', 'like', '%' . $request->input('search') . '%')
                    ->get();
        
        return response()->json(['employe' => $employe]);
    }

    public function ajouterEmploye(){
        return view('AjouterEmploye');
        
    
    }
    public function addEmployer(UserRequest $request){
     
         $user = User::where('email',$request->email)->first();

         if($user) 
         { 
            return back()->with('error', 'Veuillez essayer avec une autre adresse e-mail.');
            
        }
        
         else{
            if($request){
        User::create([
            'name' => $request->name,
            'email' => $request->email,
             'role'=> 3,
            'password' => Hash::make($request->password),
        ]);
        return  redirect()->route('admin.data.employe');
        }
        else back()->with('error', 'Veuillez vérifier les données saisies.');}

    
}

       public function addEmployer2(profilvalidationRequest $request){
            $user_id= User::latest()->first()->id;
          if($request){
              if($request->has('photo'))    {
                  $photo=$request->photo;
                  $photo_name=time().'_'.$photo->getClientOriginalName();
                  $photo->move(public_path('uploads'),$photo_name);    
              } 
              else{$photo_name='';}        
              Employer::create([
                  'id_employer'=> $user_id,
                  'nom' =>$request->nom,
                  'prenom' =>$request->prenom,
                  'email' =>$request->email,
                  'telephone'=>$request->tel,
                  'cnss'=>$request->cnss,
                  'cin'=>$request->cin,
                  'lieu_naissance'=>$request->lieu_nai,
                  'date_naissance'=>$request->date_nai,
                  'poste'=>$request->poste,
                  'situation_familiale'=>$request->situation_familiale,
                  'photo'=>$photo_name,
                  'sexe'=>$request->sexe,
                  'type_contrat' =>$request->contrat,
                  'date_debut'=>$request->date_debut,
                  'date_fin'=>$request->date_fin
      
              ]);
              return redirect()->route('admin.employe')->with('success','Compte ajouté avec succès');
          }else 
          back()->with('error', 'Veuillez vérifier les données saisies.');
  
          }
       public function ShowEmployer($id){
            $employer= Employer::where('id_employer',$id)->first();
            return view ('showEmployer',['employe'=>$employer]);
            }
             public function editEmployer($id)
             { $employer= Employer::where('id_employer',$id)->first();
                return view ('AdmineditEmployer',['employe'=>$employer]);}

                public function updateEmployer($id,profilvalidationRequest $request)
                {
                    if($request){

                        if($request->has('photo'))    {
                            $photo=$request->photo;
                            $photo_name=time().'_'.$photo->getClientOriginalName();
                            $photo->move(public_path('uploads'),$photo_name);    
                        } 
                        else{
                            $employer= Employer::where('id_employer',$id)->first();
                            $photo_name=$employer->photo;} 

                        Employer::where('id_employer', $id)->update([
                            'nom' =>$request->nom,
                            'prenom' =>$request->prenom,
                            'email' =>$request->email,
                            'telephone'=>$request->tel,
                            'cnss'=>$request->cnss,
                            'cin'=>$request->cin,
                            'lieu_naissance'=>$request->lieu_nai,
                            'date_naissance'=>$request->date_nai,
                            'poste'=>$request->poste,
                            'situation_familiale'=>$request->situation_familiale,
                            'sexe'=>$request->sexe,
                            'type_contrat' =>$request->contrat,
                            'date_debut'=>$request->date_debut,
                            'date_fin'=>$request->date_fin,
                            'photo'=>$photo_name
                        ]);
                        return redirect()->route('admin.employe')->with('success', 'Modification effectuée avec succès.');
                        }
                         else   redirect()->back();
                }
                public function deleteEmployer($id)
                {
                    $user=User::where('id',$id)->delete();
                    return redirect()->route('admin.employe')->with('success', 'Suppression effectuée avec succès.');
                       
                }
      

                public function settings(Request $request)
                {
                 $request->validate([
                     'password_old'=>'required|min:8',
                     'password'=>'required|min:8|confirmed',
                 ], [
                     'password_old.required' => 'L\'ancien mot de passe est requis.',
                     'password_old.min' => 'L\'ancien mot de passe doit contenir au moins 8 caractères.',
                     'password.required' => 'Veuillez saisir le nouveau mot de passe.',
                     'password.min' => 'Le nouveau mot de passe doit contenir au moins 8 caractères.',
                     'password.confirmed' => 'Les deux mots de passe doivent correspondre.',
                 ]);
                 if(!Hash::check($request->password_old,auth()->user()->password)){
                     return back()->with('error','Le mot de passe actuel ne correspond pas à votre mot de passe enregistré.');
                  }
                  if(Hash::check($request->password,auth()->user()->password))
                  {
                     return back()->with('error','Le nouvel mot de passe doit être différent de l\'ancien mot de passe.');
                  }
                 User::whereId(auth()->user()->id)->update([
                     'password'=>Hash::make($request->password)
                 ]);
                 return back()->with('success','Le mot de passe modifie avec succès');
             
                }

                public function ListesResp()
                {
                    $resprh=User::where('role','2')->orderBy('created_at','desc')->paginate(4);
                    return view('ListeResp',compact('resprh'));
                }


                
                    public function search2(Request $request)
                        {
                            $resprh = User::where(function($query) use ($request) {
                                $query->where('name', 'like', '%' . $request->input('search') . '%')
                                    ->orWhere('email', 'like', '%' . $request->input('search') . '%');
                                })
                                ->where('role', 2)
                                ->get();

                            return response()->json(['resprh' => $resprh]);
                        }

        
                
                public function deleteResp($id)
                {
                    $user=User::where('id',$id)->delete();
                    return redirect()->route('admin.RespRh')->with('success', 'Suppression effectuée avec succès.');
                       
                }
                public function ajouterResp()
                {
                    return view('ajouterResp');

                }
                public function addRespRh(UserRequest $request){
     
                        $user = User::where('email',$request->email)->first();
               
                        if($user) 
                        { 
                           return back()->with('error', 'Veuillez essayer avec une autre adresse e-mail.');
                           
                       }
                       
                        else{
                           if($request){
                       User::create([
                           'name' => $request->name,
                           'email' => $request->email,
                            'role'=> 2,
                           'password' => Hash::make($request->password),
                       ]);
                       return  redirect()->route('admin.RespRh')->with('success','Compte ajouté avec succès');
                       }
                       else back()->with('error', 'Veuillez vérifier les données saisies.');}
                }
}