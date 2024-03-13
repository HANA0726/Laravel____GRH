<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Employer;
use App\Models\Candidat;
use App\Models\Formation;
use App\Models\Presence;
use App\Models\User;
use App\Models\Conge;
use App\Models\CongeSolde;
use App\Models\Prime;
use App\Models\Salaire;
use App\Models\Absence;
use App\Http\Requests\FormationRequest;
use App\Http\Requests\profilvalidationRequest;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Notification;
use App\Notifications\ReponseCongeNotification;
use App\Notifications\ConfirmationNotification;
use App\Notifications\AbsenceNotification;
use App\Notifications\RefusNotification;
use Illuminate\Support\Facades\Hash;
use Carbon\CarbonImmutable;

class RhController extends Controller
{
    public function listeCandidat(){
        $candidat= Candidat::orderBy('created_at', 'desc')->paginate(4);
        return view('listeCandidats',['candidat'=> $candidat]);
    }


   

    public function listeEmploye(Request $request)
    {
        $employe = Employer::orderBy('created_at', 'desc')->paginate(4);

    
        if ($request->has('search')) {
            $employe = Employer::where('nom', 'like', '%' . $request->input('search') . '%')
                ->orWhere('email', 'like', '%' . $request->input('search') . '%')
                ->get();
        }
    
        return view('listeEmployes', ['employe' => $employe]);
    }
    
 public function AjouterFormation(FormationRequest $request,Formation $formation){
     
    if($request){

        Formation::create([
            'titre'=>$request->titre,
            'date_debut'=>$request->date_debut,
            'description'=>$request->description,
            'date_fin'=>$request->date_fin

        ]);
       
        return redirect()->route('RespRh.formations')->with('success', 'Formation ajoutée avec succès.');
        
         
     }
     else{
        redirect()->back();
     }
    
 }   
       public function listeFormations(){
        $formation=Formation::orderBy('created_at', 'desc')->paginate(3);
        return view('listeFormations',['formation' =>$formation]);
          }


          public function detailFormation($id){
            //jointure on peut utiliser la meme requete
            $formation= Formation::where('id_formation',$id)->first();
            $employer = DB::table('employers')
            ->join('e_formations', 'e_formations.id_employer', '=', 'employers.id_employer') ->where('e_formations.id_formation', '=', $id)->select()->get();
          
            return view ('showFormation',['formation'=>$formation,'employer'=>$employer]); 
        }


          public function editFormation($id){
            $formation= Formation::where('id_formation',$id)->first();
            return view ('editFormation',['formation'=>$formation]);
            
          }

   public function updateFormation(FormationRequest $request,$id){
 
 
    if($request){
        Formation::where('id_formation', $id)->update([
            'titre' => $request->titre,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'description' => $request->description
        ]);
        return redirect()->route('RespRh.formations')->with('success', 'Modification effectuée avec succès.');
        }
         else   redirect()->back();
    

   }  
   
   public function deleteFormation ($id){
  
    Formation::where('id_formation', $id)->delete();

   return redirect()->route('RespRh.formations')->with('success','Modification effectuée avec succès.' );
    
   }

   public function detailCandidat($id){
    $candidat= Candidat::where('id_candidat',$id)->first();
    return view ('showCandidat',['candidat'=>$candidat]);
    }
    public function deleteCandidat ($id){
  
        Candidat::where('id_candidat', $id)->delete();
    
       return redirect()->route('RespRh.candidat')->with('success','Modification effectuée avec succès.' );
        
       }
       public function detailemploye($id){
        $employer= Employer::where('id_employer',$id)->first();
        return view ('showEmployer',['employe'=>$employer]);
        }
        public function deleteemploye ($id){
  
            Employer::where('id_employer', $id)->delete();
          
            Presence::where('id_employer', $id)->delete();
            User::where('id', $id)->delete();

           return redirect()->route('RespRh.employe')->with('success','Modification effectuée avec succès.' );
            
           }
           public function editEmploye($id){
            $employer= Employer::where('id_employer',$id)->first();
           
            return view ('editEmployer',['employe'=>$employer]);
            
          }
          
   public function updateEmploye(profilvalidationRequest $request,$id){
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
        return redirect()->route('RespRh.employe')->with('success', 'Modification effectuée avec succès.');
        }
         else   redirect()->back();
          

   }

 public function ListePresents(){
    $aujourdhui = Carbon::now();
    $employees = DB::table('employers')
    ->join('presences', 'employers.id_employer', '=', 'presences.id_employer') ->whereDate('presences.date', '=', $aujourdhui)->select()->get();
    
    return view('ListePresents',['employees'=> $employees ,'aujourdhui' => $aujourdhui]);}

   
        public function ListeAbsents()
        {
            $aujourdhui = date('Y-m-d');

            $employees = DB::table('employers')
                ->leftJoin('presences', function ($join) use ($aujourdhui) {
                    $join->on('employers.id_employer', '=', 'presences.id_employer')
                         ->whereDate('presences.date', '=', $aujourdhui);
                })
                ->whereNull('presences.id_presence')
                ->select('employers.*')
                ->paginate(8);
               
        
            return view('ListeAbsents', ['employees' => $employees, 'aujourdhui' => $aujourdhui]);
        }
        public function DemandesConges()
        {
          
            $conge= DB::table('employers')
            ->join('conges', 'employers.id_employer', '=', 'conges.id_employer')
            ->where('status','en cours')
            ->select('employers.nom', 'employers.prenom','conges.*')
            ->orderBy('created_at', 'desc')->paginate(3);
            
        
            return view('DemandesConges', ['conge' => $conge]);
        }
        public function ListesConges()
        {
          
            $conge= DB::table('employers')
            ->join('conges', 'employers.id_employer', '=', 'conges.id_employer')
            ->where('status', '!=', 'en cours')
            ->select('employers.nom', 'employers.prenom','conges.*')
            ->orderBy('created_at', 'desc')->paginate(3);
            
        
            return view('ListesConges', ['conge' => $conge]);
        }

        public function detailConge($id)
        { 
        
            $conge= DB::table('employers')
            ->join('conges', 'employers.id_employer', '=', 'conges.id_employer') ->where('conges.id_conge', '=', $id)->select()->first();
       
            return view('showConge',['conge'=>$conge]);
             
              
        }
         public function UpdateConge($id,Request $request ){
            $congeS=Conge::where('id_conge',$id)->first();
            $date_actuelle = Carbon::now();
           if($request->status =="Approuver")
              $status='Approuvée';
              else
              $status='Refusée';
              if($request){
                Conge::where('id_conge', $id)->update([
                       'status'=>$status,
                   ]);
              if($congeS->type_conge == 'congé annuel')
              {
                $jours_de_conge = Conge::where('id_employer',$congeS->id_employer)
                ->whereYear('date_debut', $date_actuelle->year)
                ->whereIn('status', ['Approuvée', 'en cours'])
                ->where('type_conge','congé annuel')
                ->sum('nbre_jours');
                $jours_approuvees= Conge::where('id_employer',$congeS->id_employer)
                ->whereYear('date_debut', $date_actuelle->year)
                ->where('status','Approuvée')
                ->where('type_conge','congé annuel')
                ->sum('nbre_jours');
                $jours_restants =20-($jours_de_conge);
                $jours_restants_approuvee =20-$jours_approuvees;
                CongeSolde::where('id_employer',$congeS->id_employer)
                ->whereYear('created_at', Carbon::now()->year)->update([
                    'solde' => $jours_restants,
                    'solde_reel' => $jours_restants_approuvee
                ]);

              }
            
        $id_employer = Conge::where('id_conge', $id)->value('id_employer');
         $user = User::where('id',$id_employer )->first();
         $conge = Conge::where('id_conge', $id)->first();
         Notification::send($user, new ReponseCongeNotification($conge));
         return redirect()->route('RespRh.demandes.conges')->with('success', 'Modification effectuée avec succès.'); 
         }
         else   redirect()->back();
        
    }

    public function deleteconge($id)
    { Conge::where('id_conge', $id)->delete();
    
        return redirect()->route('RespRh.listes.conges')->with('success','Suppression effectuée avec succès.' );
    }
    public function MakeAsRead( Request $request){
        $userUnreadNotification = auth()->user()->unreadNotifications;
          if($userUnreadNotification)
          {
            $userUnreadNotification->markAsRead();
             return back()->with('essaye avec un autre email ');
          }}

      public function ajouterEmploye(UserRequest $request)
      { 
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
        return  redirect()->route('RespRh.data.employe');
        }
        else back()->with('error', 'Veuillez vérifier les données saisies.');}

      }
      public function ajouterEmploye2(profilvalidationRequest $request){
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
            return redirect()->route('RespRh.employe')->with('success','Compte ajouté avec succès');
        }else 
        back()->with('error', 'Veuillez vérifier les données saisies.');

        }
        public function search(Request $request)
        {
            $employe = Employer::where('nom', 'like', '%' . $request->input('search') . '%')
                        ->orWhere('email', 'like', '%' . $request->input('search') . '%')
                        ->orWhere('prenom', 'like', '%' . $request->input('search') . '%')
                        ->get();
            
            return response()->json(['employe' => $employe]);
        }
        public function sendemail($id,Request $request)
        { 
            $candidat = Candidat::where('id_candidat',$id)->first();
           
            if($request->reponse_email == "Envoyer un email d'admission")
            {
            Notification::send($candidat, new ConfirmationNotification($candidat));
          Candidat::where('id_candidat', $id)->update([
            'status'=>'true',]);
          
            }
            else{
            Notification::send($candidat, new RefusNotification($candidat));
            Candidat::where('id_candidat', $id)->update([
                'status'=>'false',]);
            
            }
            return back()->with('success','Email a été envoyé avec succès' );

      }
       public function Reclamation($id)
       {
        $date = Carbon::now();
        $employer = User::where('id',$id)->first();
          Absence::create([
            'id_employer'=>$id,
            'date_absence'=>$date,
          ]);
          $absence =Absence::latest()->first();
          
          Notification::send($employer, new AbsenceNotification($absence));
     
          return back()->with('success','Demande de justification a été envoyée avec succès' );

       }
       public function Dashboard(){
        $month = date('m');
        $year = date('Y');
        $days_in_month = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        
        
        $results = DB::table('presences')
        ->select(DB::raw('DAY(date) as day, COUNT(*) as count'))
        ->whereRaw('MONTH(date) = MONTH(CURDATE())')
        ->groupBy(DB::raw('DAY(date)'))
        ->orderBy(DB::raw('DAY(date)'))
        ->get();
                $labels=[];
                $data=[];
              
           for ($day = 1; $day <= $days_in_month; $day++)
           {
            $label = date('d', strtotime($year . '-' . $month . '-' . $day));
            $count=0;
            
            foreach($results as $result){
                 if($result->day==$day)
                 {
                    $count=$result->count;
                    break;
                 }
            }
           array_push($labels,$label);
           array_push($data,$count);
           
          
       }
       
       $datasets = [
           [
               'label' => 'Présences',
               'data' => $data,
               'backgroundColor' => '#00ED64'
            
           ]
       ];



       $data = DB::table('employers')
       ->select(DB::raw('sexe as sexe, COUNT(*) as nombre'))
       ->groupBy(DB::raw('sexe'))
       ->get();
       $sexe=[];
       $nombre=[];
       foreach($data as $key ){
        $sexe[] = $key->sexe;
        $nombre[] = $key->nombre;
           
       }
       $employer= DB::table('employers')->count();
       $candidat = DB::table('candidats')
       ->whereMonth('created_at', $month)
       ->whereYear('created_at', $year)
       ->count();

        $demande_conge = DB::table('conges')
           ->whereMonth('created_at', $month)
           ->whereYear('created_at', $year)
           ->where('status','en cours')
           ->count();
           $fiche = DB::table('salaires')
           ->whereMonth('created_at', $month)
           ->whereYear('created_at', $year)
           ->count();
         return view('RespRh',compact('datasets','labels','sexe','nombre','employer','candidat','demande_conge','fiche'));
       
       }
       public function Reglerpaie(){
        //puis je selectionne que les employes n'ayont pas une fiche de paiement 
      
        
$aujourdhui = Carbon::now();
        $employer = DB::table('employers')
        ->leftJoin('salaires', function ($join) use ($aujourdhui) {
        $join->on('employers.id_employer', '=', 'salaires.id_employer')
        ->whereYear('salaires.date', '=', $aujourdhui->year)
        ->whereMonth('salaires.date', '=', $aujourdhui->month);
            
    })
    ->select('employers.*')
    ->whereNull('salaires.id_salaire')
    ->get();
    
      
                 
                $mois = $aujourdhui->format('F');
               
         return view('fichePaie',compact('employer','mois'));
       }


       public function calculerSalaire(Request $request)
       {
        $request->validate([
            'employe'=>'required|',
            'salaire_brute'=>'required|',
        ], [
            'employe.required' => 'Veuillez sélectionner un employé, pour qu\'on puisse calculer le salaire.',
          
            'salaire_brute.required' => 'Le salaire brute est requis.',
        ]);
        if($request){
        $salire_brute=$request->salaire_brute;
        $id_employer=$request->employe;
        $moisActuel = date('Y-m');
        if (empty($request->jours_f)) {
            $jours_feries = 0;
        } else {
            $jours_feries = $request->jours_f;
        }
        
        $congeApprouve = Conge::where('id_employer', $id_employer)
        ->where('status', 'Approuvée')
        ->whereRaw("DATE_FORMAT(date_debut, '%Y-%m') = ?", [$moisActuel])
        ->where('type_conge', 'congé annuel')
        ->first(); 
    
    if ($congeApprouve) {
        $date_fin_conge = Carbon::parse($congeApprouve->date_fin);
        $date_debut_conge = Carbon::parse($congeApprouve->date_debut);
        $fin_mois_actuel = Carbon::now()->endOfMonth();
        if ($date_fin_conge->greaterThanOrEqualTo($fin_mois_actuel)) {
            // le congé se termine après la fin du mois actuel
            // calculer les jours de congé restants jusqu'à la fin du mois actuel
            $jours_conges_consommes = $date_debut_conge->diffInDays($fin_mois_actuel) + 1;
        } else {
            // le congé se termine avant la fin du mois actuel
            $jours_conges_consommes = $congeApprouve->nmbre_jours;
        }
    } else {
        // aucun congé n'a été approuvé pour le mois actuel
        $jours_conges_consommes = 0;
    }
    
    $congeApprouveMaternite = Conge::where('id_employer', $id_employer)
    ->where('status', 'Approuvée')
    ->whereRaw("DATE_FORMAT(date_debut, '%Y-%m') = ?", [$moisActuel])
    ->where('type_conge', 'congé de maternité')
    ->first();
    if ($congeApprouveMaternite) {
        $date_fin_conge = Carbon::parse($congeApprouveMaternite->date_fin);
        $date_debut_conge = Carbon::parse($congeApprouveMaternite->date_debut);
        $fin_mois_actuel = Carbon::now()->endOfMonth();
        if ($date_fin_conge->greaterThanOrEqualTo($fin_mois_actuel)) {
            // le congé se termine après la fin du mois actuel
            // calculer les jours de congé restants jusqu'à la fin du mois actuel
            $jours_conges_consommesM = $date_debut_conge->diffInDays($fin_mois_actuel) + 1;
        } else {
            // le congé se termine avant la fin du mois actuel
            $jours_conges_consommesM =$congeApprouveMaternite->nmbre_jours;
        }
    } else {
        // aucun congé n'a été approuvé pour le mois actuel
        $jours_conges_consommesM = 0;
    }

           
             
            $nombreDePresences = DB::table('presences')
                        ->where('id_employer', $id_employer)
                        ->whereRaw("DATE_FORMAT(date, '%Y-%m') = ?", [$moisActuel])
                        ->count();
                        $totalPrimes = 0;
                        if(request()->has('montant')){
                            $primes = request('montant');
                            foreach($primes as $prime){
                                $totalPrimes += $prime;
                            }  }
                            /*
                        $nombreDeAbsences = DB::table('absences')
                        ->where('employe_id', $employeId)
                        ->whereRaw("DATE_FORMAT(date_debut, '%Y-%m') = ?", [$moisActuel])
                        ->where('justifiee', true)
                        ->count();*/
             $cnss=$salire_brute*0.0448;
             $amo= $salire_brute*0.0226;
             
             $employe_contrat= Employer::where('id_employer',$id_employer)->select()->first();
             $anneesAnciennete = 0;
             if($employe_contrat->type_contrat =='CDI')
           { $dateDebutContrat = Carbon::parse($employe_contrat->date_debut);
             $dateMoisActuel = Carbon::now()->startOfMonth();
             
             $anneesAnciennete = $dateDebutContrat->diffInYears($dateMoisActuel);
            
             if ($anneesAnciennete >= 12) {
                $primeAn = $salire_brute * 0.15;
            } elseif ($anneesAnciennete >= 5) {
                $primeAn = $salire_brute * 0.1;
            } elseif ($anneesAnciennete >= 2) {
                $primeAn = $salire_brute * 0.05;
            } else {
                $primeAn = 0;
            }}
            else{ $primeAn = 0;
               
            }

             /* $congeAnnuel = Conge::where('id_employer', $id_employer)
                                    ->where('status', 'Approuvée')
                                    ->whereRaw("DATE_FORMAT(date_debut, '%Y-%m') = ?", [$moisActuel])
                                   ->where('type_conge', 'congé annuel')
                                    ->exists(); */

                                    $nombreDeAbsences = DB::table('absences')
                                    ->where('id_employer', $id_employer)
                                    ->whereRaw("DATE_FORMAT(date_absence, '%Y-%m') = ?", [$moisActuel])
                                    ->where('justifie','true')
                                    ->count();
                                    
 
 $salaire_net=(($salire_brute/20)*( $nombreDePresences+$jours_conges_consommes+$jours_feries+$nombreDeAbsences+$jours_conges_consommesM )+$primeAn+$totalPrimes-($cnss+$amo));
  
    $date = Carbon::now();
    Salaire::create([
      'salaire_brute'=>$salire_brute,
      'salaire_net'=>$salaire_net,
      'jours_feriees'=>$jours_feries,
      'id_employer'=>$id_employer,
      'date'=>$date,
    ]);
    $id_salaire = DB::table('salaires')->latest('id_salaire')->value('id_salaire');

    if ($request->has('libelle') && $request->has('montant')) {
        $libelles = $request->input('libelle');
        $montants = $request->input('montant');
        foreach ($libelles as $key => $libelle) {
            $prime = new Prime;
            $prime->designation = $libelle;
            $prime->montant = $montants[$key];
            $prime->id_employer = $id_employer;
            $prime->id_salaire = $id_salaire;
            $prime->date =$date;
            $prime->save();
        }
    }
   
 
    return redirect()->route('RespRh.FichesPaiement')->with('success','Fiche de paiement a été  realisée avec succès');
    
    }
    


         else{
            return back()->with('error','Vérifiez les données saisies.');
         }

       }
       public function FichesPaiement(){
        $salaires = DB::table('salaires')
        ->join('employers', 'salaires.id_employer', '=', 'employers.id_employer')
        ->select('salaires.*', 'employers.nom', 'employers.prenom')
        ->orderByDesc('date')->paginate(3);
        return view('FichesPaiement',compact('salaires'));
       }
       public function detailFiche($id){
   
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
     if($salaire->type_contrat =='CDI')
     {$employe_contrat=$salaire->date_debut;
  
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
    else{
        $primeAn = 0;
    }
   
    
     return view('ShowFiche',compact('salaire','prime','cnss','amo','anneesAnciennete','primeAn','totalPrimes'));
      
    }
      


       public function editFiche($id){
         
        $salaire = DB::table('salaires')
        ->join('employers', 'salaires.id_employer', '=', 'employers.id_employer')
        ->select('salaires.*', 'employers.nom', 'employers.prenom','employers.id_employer')
        ->where('id_salaire',$id)
         ->first();
        $prime = Prime::where('id_salaire', $id)->get();


        return view('editFiche',compact('salaire','prime'));
       }

       public function UpdateFiche($id,Request $request){
       


        $request->validate([
            'employe'=>'required|',
            'salaire_brute'=>'required|',
        ], [
            'employe.required' => 'Veuillez sélectionner un employé, pour qu\'on puisse calculer le salaire.',
          
            'salaire_brute.required' => 'Le salaire brute est requis.',
        ]);
        if($request){
        $salire_brute=$request->salaire_brute;
        $id_employer=$request->employe;
        $moisActuel = date('Y-m');
        if (empty($request->jours_f)) {
            $jours_feries = 0;
        } else {
            $jours_feries = $request->jours_f;
        }
        
            $congeApprouve = Conge::where('id_employer', $id_employer)
                                    ->where('status', 'Approuvée')
                                    ->whereRaw("DATE_FORMAT(date_debut, '%Y-%m') = ?", [$moisActuel])
                                     ->where('type_conge', '!=', 'congé annuel')
                                    ->exists();

            if ($congeApprouve) {$conge=1; } 
            else                {$conge=0;}
           
             
            $nombreDePresences = DB::table('presences')
                        ->where('id_employer', $id_employer)
                        ->whereRaw("DATE_FORMAT(date, '%Y-%m') = ?", [$moisActuel])
                        ->count();
                        $totalPrimes = 0;
                        if(request()->has('montant')){
                            $primes = request('montant');
                            foreach($primes as $prime){
                                $totalPrimes += $prime;
                            }  }
                            $nombreDeAbsences = DB::table('absences')
                            ->where('id_employer', $id_employer)
                            ->whereRaw("DATE_FORMAT(date_absence, '%Y-%m') = ?", [$moisActuel])
                            ->where('justifie','true')
                            ->count();
                           
                       
             $cnss=$salire_brute*0.0448;
             $amo= $salire_brute*0.0226;
             
             $employe_contrat= Employer::where('id_employer',$id_employer)->select()->first();
            
           if($employe_contrat->type_contrat =='CDI')
         {$dateDebutContrat = Carbon::parse($employe_contrat->date_debut);
             $dateMoisActuel = Carbon::now()->startOfMonth();
             
             $anneesAnciennete = $dateDebutContrat->diffInYears($dateMoisActuel);
            
             if ($anneesAnciennete >= 12) {
                $primeAn = $salire_brute * 0.15;
            } elseif ($anneesAnciennete >= 5) {
                $primeAn = $salire_brute * 0.1;
            } elseif ($anneesAnciennete >= 2) {
                $primeAn = $salire_brute * 0.05;
            } else {
                $primeAn = 0;
            }
        }
        else{
            $primeAn = 0;
        }
                  
        $congeApprouve = Conge::where('id_employer', $id_employer)
        ->where('status', 'Approuvée')
        ->whereRaw("DATE_FORMAT(date_debut, '%Y-%m') = ?", [$moisActuel])
        ->where('type_conge', 'congé annuel')
        ->first(); 
    
    if ($congeApprouve) {
        $date_fin_conge = Carbon::parse($congeApprouve->date_fin);
        $date_debut_conge = Carbon::parse($congeApprouve->date_debut);
        $fin_mois_actuel = Carbon::now()->endOfMonth();
        if ($date_fin_conge->greaterThanOrEqualTo($fin_mois_actuel)) {
            // le congé se termine après la fin du mois actuel
            // calculer les jours de congé restants jusqu'à la fin du mois actuel
            $jours_conges_consommes = $date_debut_conge->diffInDays($fin_mois_actuel) + 1;
        } else {
            // le congé se termine avant la fin du mois actuel
            $jours_conges_consommes = $congeApprouve->nmbre_jours;
        }
    } else {
        // aucun congé n'a été approuvé pour le mois actuel
        $jours_conges_consommes = 0;
    }
    
    $congeApprouveMaternite = Conge::where('id_employer', $id_employer)
    ->where('status', 'Approuvée')
    ->whereRaw("DATE_FORMAT(date_debut, '%Y-%m') = ?", [$moisActuel])
    ->where('type_conge', 'congé de maternité')
    ->first();
    if ($congeApprouveMaternite) {
        $date_fin_conge = Carbon::parse($congeApprouveMaternite->date_fin);
        $date_debut_conge = Carbon::parse($congeApprouveMaternite->date_debut);
        $fin_mois_actuel = Carbon::now()->endOfMonth();
        if ($date_fin_conge->greaterThanOrEqualTo($fin_mois_actuel)) {
            // le congé se termine après la fin du mois actuel
            // calculer les jours de congé restants jusqu'à la fin du mois actuel
            $jours_conges_consommesM = $date_debut_conge->diffInDays($fin_mois_actuel) + 1;
        } else {
            // le congé se termine avant la fin du mois actuel
            $jours_conges_consommesM =$congeApprouveMaternite->nmbre_jours;
        }
    } else {
        // aucun congé n'a été approuvé pour le mois actuel
        $jours_conges_consommesM = 0;
    }

 
     $salaire_net=(($salire_brute/20)*( $nombreDePresences+$conge+$jours_feries+$nombreDeAbsences+$jours_conges_consommes+$jours_conges_consommesM)+ $primeAn+$totalPrimes-($cnss+$amo));

     Salaire::where('id_salaire', $id)->update([
      'salaire_brute'=>$salire_brute,
      'salaire_net'=>$salaire_net,
      'jours_feriees'=>$jours_feries,
      'id_employer'=>$id_employer,
    ]);
  

    if ($request->has('libelle') && $request->has('montant')) {
        $libelles = $request->input('libelle');
        $montants = $request->input('montant');
        foreach ($libelles as $key => $libelle) {
            Prime::where('id_salaire', $id)
                ->where('designation', $libelle)
                ->update(['montant' => $montants[$key]]);
        }
    }
    
   
 
    return redirect()->route('RespRh.FichesPaiement')->with('success','Modification a été  effectée avec succès');
    
    }
    


         else{
            return back()->with('error','Vérifiez les données saisies.');
         }


       }
     
        public function deleteFiche($id){
                Prime::where('id_salaire', $id)->delete();
                Salaire::where('id_salaire', $id)->delete();

                return redirect()->route('RespRh.FichesPaiement')->with('success','La suppression  a été  effectée avec succès');
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
        
        public function DemandesAbsences()
        {
        $absence=DB::table('employers')
        ->join('absences', 'absences.id_employer', '=', 'employers.id_employer') ->where('justifie','true')->select()->paginate(3);
    
        return view('Mesjustifications',compact('absence'));
      
        }
        public function detailAbsence($id)
        {
            $absence= DB::table('employers')
            ->join('absences', 'employers.id_employer', '=', 'absences.id_employer') ->where('absences.id_absence', '=', $id)->select()->first();
           
             return view('showAbsence',compact('absence'));

        }

        
         public function searchCan(Request $request)
         {
             $candidat = Candidat::where('nom', 'like', '%' . $request->input('search') . '%')
                         ->orWhere('email', 'like', '%' . $request->input('search') . '%')
                         ->orWhere('prenom', 'like', '%' . $request->input('search') . '%')
                         ->get();
             return response()->json(['candidat' => $candidat]);

    }
   
    public function searchFor(Request $request)
    {
        $formation = DB::table('formations')
        ->select('formations.*', DB::raw('(SELECT COUNT(*) FROM e_formations WHERE e_formations.id_formation = formations.id_formation) as num_employees'))
        ->where('formations.titre', 'like', '%' . $request->input('search') . '%')
        ->get();

        return response()->json(['formation' => $formation]);

} 
public function filtrerEmployes(Request $request)
{
    // Récupérer les employés filtrés en fonction de la date
    $filteredEmployees = [];
    
    if ($request->has('date')) {
        $filteredEmployees = DB::table('employers')
            ->join('presences', 'employers.id_employer', '=', 'presences.id_employer')
            ->whereDate('presences.date', '=', $request->date)
            ->get();
    }

    // Retourner les employés filtrés en format JSON
    return response()->json(['employee' =>$filteredEmployees]);
}


public function filtrerFiche(Request $request)
{
    $filteredPayments = [];

if ($request->has('date')) {
    $filteredPayments = DB::table('salaires')
    ->join('employers', 'salaires.id_employer', '=', 'employers.id_employer')
        ->select('salaires.*', 'employers.nom', 'employers.prenom')
        ->whereDate('date', '=', $request->date)
        ->orderByDesc('date')
        ->get();
}

return response()->json(['salaires' => $filteredPayments]);
}





}
 

    

