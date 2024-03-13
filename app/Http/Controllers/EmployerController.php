<?php

namespace App\Http\Controllers;
use Autu;
use App\Models\Employer;
use App\Models\User;
use App\Models\Presence;
use App\Models\Formation;
use App\Models\EFormation;
use App\Models\Conge;
use App\Models\CongeSolde;
use App\Models\Salaire;
use App\Models\Prime;
use App\Models\Absence;
use Illuminate\Http\Request;
use App\Http\Requests\profilvalidationRequest;
use App\Http\Requests\AbsenceRequest;
use App\Http\Requests\CongeRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Notification;
use App\Notifications\CongeNotification;
use Illuminate\Support\Facades\Hash;


class EmployerController extends Controller
{  public function Dashboard(){

    $fiche= DB::table('salaires')->where('id_employer',auth()->user()->id)
    ->count();
    $date = Carbon::now()->toDateString();
    $id_employe=auth()->user()->id;
    $formations = DB::table('formations')
    ->select('formations.id_formation', 'formations.titre', 'formations.date_debut', 'formations.description', 'formations.date_fin')
    ->leftJoin('e_formations', function ($join) use ($id_employe) {
        $join->on('formations.id_formation', '=', 'e_formations.id_formation')
             ->where('e_formations.id_employer', '=', $id_employe);})
    ->whereNull('e_formations.id_formation')
    ->where('formations.date_fin', '>', $date)
    ->count();
    $data = DB::table('conges')
    ->select(DB::raw('status as status, COUNT(*) as nombre'))
    ->groupBy(DB::raw('status'))
    ->where('id_employer',auth()->user()->id)
    ->get();
     
    $status=[];
    $nombre=[];
    foreach($data as $key ){
     $status[] = $key->status;
     $nombre[] = $key->nombre;
        
    }

    return view('employer',compact('fiche','formations','status','nombre'));
}
    
    
    public function profil()
    {
           $employer= Employer::where('id_employer',auth()->user()->id)->first();
           return view('profil',['employe'=> $employer]);
    }
       public function  editProfil ()
       {
        $employer= Employer::where('id_employer',auth()->user()->id)->first();
        return view('profilupdate',['employe'=> $employer]);
       }
       public function Updateprofil(profilvalidationRequest $request)
       {
        if($request){
            if($request->has('photo'))    {
                $photo=$request->photo;
                $photo_name=time().'_'.$photo->getClientOriginalName();
                $photo->move(public_path('uploads'),$photo_name);    
            } 
            else{
                $employer= Employer::where('id_employer',auth()->user()->id)->first();
                $photo_name=$employer->photo;} 
            Employer::where('id_employer', auth()->user()->id)->update([
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
            return redirect()->route('employer.profil')->with('success', 'Modification effectuée avec succès.');
            }
       }


   
    public function presence(){
        $presence = Presence::where('id_employer', auth()->user()->id)
        ->whereDate('date', Carbon::today())
        ->first();
       return view('presence', ['presence'=> $presence]);
    }  
   

    public function store(Request $request)
    {
        $employee_id = auth()->user()->id;
        $date = Carbon::now()->toDateString();

        $presence = Presence::where('id_employer', $employee_id)->where('date', $date)->first();

        if ($presence) {
            
            return back()->with('error', 'Vous avez déjà enregistré votre présence pour aujourd\'hui.');
        }

     
        $user_id = auth()->user()->id; 
        $presence = new Presence;
        $presence->id_employer = $user_id; 
        $presence->entry_time = Carbon::now();
        $presence->exit_time = Carbon::now()->setTime(18, 0, 0)->toDateTime();
        $presence->date = Carbon::today()->toDateString(); 
        $presence->save();

      
        return redirect()->route('employer.presence')->with('success', 'Votre présence a été enregistrée avec succès.');
    }

    public function ListeFormations(){
        $date = Carbon::now()->toDateString();
        $id_employe=auth()->user()->id;
    $formations = DB::table('formations')
    ->select('formations.id_formation', 'formations.titre', 'formations.date_debut', 'formations.description', 'formations.date_fin')
    ->leftJoin('e_formations', function ($join) use ($id_employe) {
        $join->on('formations.id_formation', '=', 'e_formations.id_formation')
             ->where('e_formations.id_employer', '=', $id_employe);})
    ->whereNull('e_formations.id_formation')
    ->where('formations.date_fin', '>', $date)
    ->orderBy('formations.created_at', 'desc')->paginate(3);

        return view('ElisteFormations',['formations'=> $formations]);
    }
    

     public function stateFormations($id ,Request $request){
        
       EFormation::create([
        'id_employer'=>auth()->user()->id,
        'status'=> $request->status,
        'id_formation'=>$id
    ]);
    if( $request->status =='Rejeter')
     return redirect()->route('employer.ListeFormations')->with('error', ' la formation  a été rejetée avec succès.');
      
     else
     return redirect()->route('employer.ListeFormations')->with('success', 'Votre inscription à la formation a été validée.');

     }
     public function MesFormations(){
        $date = Carbon::now()->toDateString();
        $employee_id = auth()->user()->id;
        $formations = DB::table('formations')
        ->join('e_formations', 'formations.id_formation', '=', 'e_formations.id_formation') 
        ->where('date_fin', '>', $date)->where('id_employer', $employee_id)
        ->select()->orderBy('formations.created_at', 'desc')->paginate(3);
        return view('MesFormations',['formations'=> $formations]);
     }
     public function viewconge()
     {
         $date = Carbon::now();
         $congeSolde = CongeSolde::where('id_employer', auth()->user()->id)
             ->whereYear('created_at', $date->year)
             ->get()
             ->toArray();
     
         return view('conge', compact('congeSolde'));
     }
     

     public function AjouterConge(CongeRequest $request)
     {        
         $date = Carbon::now()->toDateString();
         $dateDebut = Carbon::parse($request->date_debut); 
         $employer=Employer::where('id_employer',auth()->user()->id)->first();
         $date_embauche = Carbon::parse($employer->date_debut);
         $date_actuelle = Carbon::now();
         $diff_en_mois = $date_actuelle->diffInMonths($date_embauche);
         if ($diff_en_mois >= 6) {
          
            $date_debut = Carbon::parse($request->date_debut);
            $conge_exist = Conge::where('id_employer', auth()->user()->id)
            ->whereYear('date_debut',  $date_debut ->year)
            ->whereMonth('date_debut',  $date_debut ->month)
            ->where('status','!=','Refusée')
            ->where('type_conge','congé annuel')
            ->exists();
             if ($conge_exist) {
            return back()->with('error', 'Vous avez déjà soumis une demande de congé annuel pour ce mois.'); }
                    else{
                        
                       if ($request->type_conge == 'congé annuel') {
                        $congeSolde = CongeSolde::where('id_employer', auth()->user()->id)
                        ->whereYear('created_at', Carbon::now()->year)
                        ->first();
                        if(!$congeSolde){
                       
                         $date_fin = Carbon::parse($request->date_fin);
                         $nmbre_jours =$date_fin->diffInDays($dateDebut);


                         
                         $jours_restants = 20 - $nmbre_jours;

                         $jours_restants_approuvee = 20 -$nmbre_jours;
                        
                         if ($nmbre_jours> $jours_restants) {
                            return back()->with('error','Veuillez vérifier votre solde.');}
                            else{
                         Conge::create([
                             'type_conge' => $request->type_conge,
                             'id_employer' => auth()->user()->id,
                             'date_debut' => $dateDebut,
                             'date_fin' => $date_fin ,
                             'nbre_jours' => $nmbre_jours,
                             'date_envoie' => $date,
                         ]);
                         CongeSolde::create([
                            'id_employer'=>auth()->user()->id,
                            'solde'=>$jours_restants,
                            'solde_reel'=>$jours_restants_approuvee,
                         ]); } 
                         }
                        else{
                            $date_fin = Carbon::parse($request->date_fin);
                            $nmbre_jours =$date_fin->diffInDays($dateDebut);
                            $jours_de_conge = Conge::where('id_employer', auth()->user()->id)
                            ->whereYear('date_debut', $date_actuelle->year)
                            ->whereIn('status', ['Approuvée', 'en cours'])
                            ->where('type_conge','congé annuel')
                            ->sum('nbre_jours');
                            $jours_approuvees= Conge::where('id_employer', auth()->user()->id)
                            ->whereYear('date_debut', $date_actuelle->year)
                            ->where('status','Approuvée')
                            ->where('type_conge','congé annuel')
                            ->sum('nbre_jours');
                            $jours_restants =20-($jours_de_conge + $nmbre_jours);
                            $jours_restants_approuvee =20-$jours_approuvees;
                           
                            if ($nmbre_jours> $jours_restants) {
                               return back()->with('error','Vous avez déjà soumis une demande de congé de maternité pour cette année.Veuillez vérifier votre solde.');}
                               
                               else{
                            Conge::create([
                                'type_conge' => $request->type_conge,
                                'id_employer' => auth()->user()->id,
                                'date_debut' => $dateDebut,
                                'date_fin' => $date_fin ,
                                'nbre_jours' => $nmbre_jours,
                                'date_envoie' => $date,
                            ]);
                            CongeSolde::where('id_employer', auth()->user()->id)
                            ->whereYear('created_at', Carbon::now()->year)->update([
                                'solde' => $jours_restants,
                                'solde_reel' => $jours_restants_approuvee
                            ]); } 
                        }}
                        
                        else{
         
                        if ($request->type_conge == 'congé parental') {
                            $dateFin = $dateDebut->copy()->addDays(3);
                        } elseif ($request->type_conge == 'congé de maternité') {

                            $conge_de_maternite = Conge::where('id_employer', auth()->user()->id)
                            ->whereYear('date_debut', $date_actuelle->year)
                            ->whereIn('status', ['Approuvée', 'en cours'])
                            ->where('type_conge','congé de maternité')
                            ->exists();
                            if($conge_de_maternite){return back()->with('error','Pensez à vérifier votre solde pour ce type de conge ');}
                            else{

                            $dateFin = $dateDebut->copy()->addDays(98);}
                        } elseif ($request->type_conge == 'congé de mariage')
                        {
                           $dateFin = $dateDebut->copy()->addDays(4);
                        }
                        elseif($request->type_conge == 'congé pour raisons de décès')
                       {
                           $dateFin = $dateDebut->copy()->addDays(2);
                       }
                       elseif($request->type_conge == 'congé de maladie')
                       {
                           $dateFin = $dateDebut->copy()->addDays(3);
                       }
                       $nmbre_jours = $dateFin->diffInDays($dateDebut);

         Conge::create([
             'type_conge' => $request->type_conge,
             'id_employer' => auth()->user()->id,
             'date_debut' => $dateDebut,
             'date_fin' => $dateFin,
             'nbre_jours' => $nmbre_jours,
             'date_envoie' => $date,
         ]);}
         $users = User::where('role', 2)->get();
         $conge = Conge::latest()->first();
         Notification::send($users, new CongeNotification($conge));
         return redirect()->route('employer.MesConges')->with('success', 'Votre demande  a été envoyeée  avec succès.');
        
    }
        
      }
      
    
     else{
        return back()->with('error','Désolé, vous devez travailler au moins 6 mois dans l\'entreprise avant de pouvoir faire une demande de congé.');
     }
       
    }
       

     public function MesConges(Conge $conge)
     {
        $conge = Conge::where('id_employer', auth()->user()->id)
        ->orderBy('created_at','desc')->paginate(3);

        return view('MesConges',['conges'=>$conge])->with('success','Congé envoyé avec succès');

     }

     public function detailConge($id)
     {   $conge= DB::table('employers')
        ->join('conges', 'employers.id_employer', '=', 'conges.id_employer') ->where('conges.id_conge', '=', $id)->select()->first();
       
         return view('showConge',['conge'=>$conge]);
}
 public function MakeAsRead( Request $request){
    $userUnreadNotification = auth()->user()->unreadNotifications;
      if($userUnreadNotification)
      {
        $userUnreadNotification->markAsRead();
         return back();
      }}
    
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

      public function FichePaie()
      {   $salaires = DB::table('salaires')
        ->join('employers', 'salaires.id_employer', '=', 'employers.id_employer')
        ->select('salaires.*', 'employers.nom', 'employers.prenom')
        ->where('salaires.id_employer',auth()->user()->id)
        ->orderByDesc('date')->paginate(3);
        return view('MesFiches',compact('salaires'));

      }
      public function showFiche($id)
      {
        
     $salaire = DB::table('salaires')
     ->join('employers', 'salaires.id_employer', '=', 'employers.id_employer')
     ->select('salaires.*', 'employers.*')
     ->where('id_salaire',$id)
     ->first();
  
     $prime = Prime::where('id_salaire', $id)->get();
     $totalPrimes = 0;
     if ($prime) {
         foreach ($prime as $p) {
             $totalPrimes += $p->montant;
         }  
     }
    

     $salaire_brute=$salaire->salaire_brute;
     $cnss=$salaire_brute*0.0448;
     $amo= $salaire_brute*0.0226;
     $anneesAnciennete=0;
     if($salaire->type_contrat=='CDI'){
     $employe_contrat=$salaire->date_debut;
     $dateDebutContrat = Carbon::parse($employe_contrat);
     $dateMoisActuel = Carbon::now()->startOfMonth();
     $anneesAnciennete = $dateDebutContrat->diffInYears($dateMoisActuel);
     if ($anneesAnciennete >= 12) {
        $primeAn = $salaire_brute * 0.15;
    } elseif ($anneesAnciennete >= 5) {
        $primeAn = $salaire_brute * 0.1;
    } elseif ($anneesAnciennete >= 2) {
        $primeAn = $salaire_brute * 0.05;
    } else {
         $primeAn = 0;
    }}
   
    
     return view('ShowFiche',compact('salaire','prime','cnss','amo','anneesAnciennete','primeAn','totalPrimes'));
      

      }

      public function justifierAbsence()
      {
        $absence=Absence::where('id_employer',auth()->user()->id)->where('justifie','false')->orderBy('created_at','desc')->paginate(3);
        return view('DemandeJustification',compact('absence'));
      }
      public function Formjustifier($id)
      {
         return view('FormJustification',compact('id'));

      }
      public function justifier(AbsenceRequest $request,$id)
      {if($request)
        {
            if($request->has('Pj')){
                $Pj=$request->Pj;
                $Pj_name=time().'_'.$Pj->getClientOriginalName();
                $Pj->move(public_path('uploads'),$Pj_name);    
            } 
            
            Absence::where('id_absence',$id)->update([
             'justifie'=>'true',
             'raisons'=>$request->raisons,
             'pieces'=>$Pj_name
            ]);
            return redirect()->route('Employer.JustificationAbsence')->with('success','Votre justificatif  a été envoyeé avec succès');
        }
        else{
            return back()->with('error','Vérifier les données saisies');
        }

      }

     public function LesjustificationAbsence()
     {
        $absence=Absence::where('id_employer',auth()->user()->id)->where('justifie','true')->orderBy('created_at','desc')->paginate(3);
        return view('Mesjustifications',compact('absence'));
     }

     public function detailAbsence($id)
     {
        $absence= DB::table('employers')
        ->join('absences', 'employers.id_employer', '=', 'absences.id_employer') ->where('absences.id_absence', '=', $id)->select()->first();
       
         return view('showAbsence',compact('absence'));
        
    }

}