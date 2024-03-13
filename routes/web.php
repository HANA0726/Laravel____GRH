<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\PresenceController;
use App\Http\Controllers\CandidatController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RhController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/accueil', function () {
    return view('accueil');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


 /*--------------------------Admin--------------------------------- */
 Route::prefix('admin')->group(function(){
Route::get('/',[AdminController::class,'Dashboard'])->name('admin')->middleware('admin');  
Route::get('/AjouterEmploye',[AdminController::class,'ajouterEmploye'])->name('admin.ajouter.employe')->middleware('admin');  
Route::get('/ListesEmployes',[AdminController::class,'ListesEmployes'])->name('admin.employe')->middleware('admin');  
Route::get('/ListesEmployes/search',[AdminController::class,'search'])->name('admin.search')->middleware('admin');  
Route::get('/AjouterEmploye/validation',[AdminController::class,'addEmployer'])->name('admin.AjouterEmploye.validation')->middleware('admin');  
Route::post('/AjouterEmploye/validation',[AdminController::class,'addEmployer'])->name('admin.AjouterEmploye.validation')->middleware('admin');  
Route::get('/AjouterEmploye/validation/data',function(){
    return view('insertDataemployer'); })->name('admin.data.employe')->middleware('admin');
Route::get('/AjouterEmploye/validation/data/profil',[AdminController::class,'addEmployer2'])->name('admin.Employe.validationdata')->middleware('admin');  
Route::post('/AjouterEmploye/validation/data/profil',[AdminController::class,'addEmployer2'])->name('admin.Employe.validationdata')->middleware('admin');  
Route::get('/ListesEmployes/{id}/edit',[AdminController::class,'editEmployer'])->name('admin.employe.edit')->middleware('admin');  
Route::get('/ListesEmployes/{id}/view',[AdminController::class,'ShowEmployer'])->name('admin.employe.show')->middleware('admin');  
Route::get('/ListesEmployes/{id}/delete',[AdminController::class,'deleteEmployer'])->name('admin.employe.delete')->middleware('admin');  
Route::get('/ListesEmployes/{id}/update',[AdminController::class,'updateEmployer'])->name('admin.employe.update')->middleware('admin');  
Route::put('/ListesEmployes/{id}/update',[AdminController::class,'updateEmployer'])->name('admin.employe.update')->middleware('admin');  
Route::get('/Settings',function(){return view('AdminSetting');})->name('admin.settings')->middleware('admin');
Route::post('/Settings/validation',[AdminController::class,'settings'])->name('admin.settings.validation')->middleware('admin');
Route::get('/Settings/validation',[AdminController::class,'settings'])->name('admin.settings.validation')->middleware('admin');
Route::get('/ListesResp',[AdminController::class,'ListesResp'])->name('admin.RespRh')->middleware('admin');  
Route::get('/ListesResp/{id}/delete',[AdminController::class,'deleteResp'])->name('admin.Resp.delete')->middleware('admin');  
Route::get('/ListesResp/search2',[AdminController::class,'search2'])->name('admin.resprh.search2')->middleware('admin');  
Route::get('/ListesResp/ajouterResp',[AdminController::class,'ajouterResp'])->name('admin.ajouterResp')->middleware('admin');  
Route::get('/ListesResp/ajouterResp/validation',[AdminController::class,'addRespRh'])->name('admin.ajouterResp.validation')->middleware('admin');  
Route::post('/ListesResp/ajouterResp/validation',[AdminController::class,'addRespRh'])->name('admin.ajouterResp.validation')->middleware('admin');  

});



  /*--------------------------Responsable---Rh--------------------------------- */
Route::prefix('RespRh')->group(function(){
Route::get('/',[RhController::class,'Dashboard'])->name('RespRh')->middleware('RespRh');  
   Route::get('/candidat',[RhController::class,'listeCandidat'])->name('RespRh.candidat')->middleware('RespRh');  
   Route::get('/candidat/searchCan',[RhController::class,'searchCan'])->name('RespRh.search.candidat')->middleware('RespRh');  
    Route::get('/candidat/{id}/view/sendemail',[RhController::class,'sendemail'])->name('sendemail.candidat')->middleware('RespRh'); 
   Route::post('/candidat/{id}/view/sendemail',[RhController::class,'sendemail'])->name('sendemail.candidat')->middleware('RespRh'); 
   Route::get('/candidat/{id}/view',[RhController::class,'detailCandidat'])->name('detail.candidat')->middleware('RespRh'); 
   Route::get('/candidat/{id}/delete',[RhController::class,'deleteCandidat'])->name('delete.candidat')->middleware('RespRh');         
   Route::get('/employe/search',[RhController::class,'search'])->name('search.employer')->middleware('RespRh');         
   Route::get('/employe',[RhController::class,'listeEmploye'])->name('RespRh.employe')->middleware('RespRh'); 
   Route::get('/employe/{id}/view',[RhController::class,'detailemploye'])->name('RespRh.detail.employer')->middleware('RespRh'); 
   Route::get('/employe/{id}/delete',[RhController::class,'deleteemploye'])->name('RespRh.delete.employer')->middleware('RespRh');
   Route::get('/employe/{id}/edit',[RhController::class,'editEmploye'])->name('RespRh.edit.employer')->middleware('RespRh');  
   Route::get('/employe/{id}/update',[RhController::class,'updateEmploye'])->name('RespRh.update.employer')->middleware('RespRh'); 
   Route::put('/employe/{id}/update',[RhController::class,'updateEmploye'])->name('RespRh.update.employer')->middleware('RespRh');   
   Route::get('/ajouterEmploye',function(){
    return view('AjouterEmploye'); })->name('RespRh.ajouter.employe')->middleware('RespRh');  
   Route::get('/ajouterFormation',function(){
    return view('AjouterFormation'); })->name('RespRh.ajouter.formation')->middleware('RespRh');  
    Route::get('/ajouterEmploye',function(){
        return view('AjouterEmploye'); })->name('RespRh.ajouter.employe')->middleware('RespRh'); 
    Route::post('/AjouterEmploye/validation',[RhController::class,'ajouterEmploye'])->name('RespRh.Employe.validation')->middleware('RespRh');
    Route::get('/AjouterEmploye/validation',[RhController::class,'ajouterEmploye'])->name('RespRh.Employe.validation')->middleware('RespRh');  
    Route::get('/ajouterEmploye/validation/data',function(){
        return view('insertDataemployer'); })->name('RespRh.data.employe')->middleware('RespRh');
    Route::post('/AjouterEmploye/validation/data/profil',[RhController::class,'ajouterEmploye2'])->name('RespRh.Employe.validationdata')->middleware('RespRh');
    Route::get('/AjouterEmploye/validation/data/profil',[RhController::class,'ajouterEmploye2'])->name('RespRh.Employe.validationdata')->middleware('RespRh');      
    Route::post('/AjouterFormation/validation',[RhController::class,'ajouterFormation'])->name('RespRh.formation.validation')->middleware('RespRh');
    Route::get('/AjouterFormation/validation',[RhController::class,'ajouterFormation'])->name('RespRh.formation.validation')->middleware('RespRh');    
    Route::get('/Formations',[RhController::class,'listeFormations'])->name('RespRh.formations')->middleware('RespRh');     
    Route::get('/Formations/searchFor',[RhController::class,'searchFor'])->name('RespRh.searchFor')->middleware('RespRh');     
 
    Route::get('/Formations/{id}/view',[RhController::class,'detailFormation'])->name('RespRh.detail.formation')->middleware('RespRh');     
    Route::get('/Formations/{id}/edit',[RhController::class,'editFormation'])->name('RespRh.edit.formation')->middleware('RespRh'); 
   
    Route::put('/Formations/{id}/update',[RhController::class,'updateFormation'])->name('RespRh.formation.update')->middleware('RespRh');
    Route::get('/Formations/{id}/update',[RhController::class,'updateFormation'])->name('RespRh.formation.update')->middleware('RespRh');
            
    Route::get('/Formations/{id}/delete',[RhController::class,'deleteFormation'])->name('RespRh.formation.delete')->middleware('RespRh');
    Route::get('/Formations/{id}/delete',[RhController::class,'deleteFormation'])->name('RespRh.formation.delete')->middleware('RespRh');
    Route::get('/ListeAbsents',[RhController::class,'ListeAbsents'])->name('RespRh.ListeAbsents')->middleware('RespRh');
    Route::get('/ListePresents',[RhController::class,'ListePresents'])->name('RespRh.ListePresents')->middleware('RespRh');
    Route::get('/ListeAbsents/{id}',[RhController::class,'Reclamation'])->name('RespRh.reclamation')->middleware('RespRh');
    Route::get('/DemandesAbsences',[RhController::class,'DemandesAbsences'])->name('RespRh.DemandesAbsences')->middleware('RespRh');
    Route::get('/DemandesAbsences/{id}/view',[RhController::class,'detailAbsence'])->name('RespRh.detailAbsence')->middleware('RespRh');
    Route::get('/ListePresents/filtrer',[RhController::class,'filtrerEmployes'])->name('RespRh.ListePresents.filter')->middleware('RespRh');
   
    /*--------------------------  Conges--------------------------------- */
     Route::get('/DemandesConges',[RhController::class,'DemandesConges'])->name('RespRh.demandes.conges')->middleware('RespRh');
     Route::get('/ListesConges',[RhController::class,'ListesConges'])->name('RespRh.listes.conges')->middleware('RespRh');
     Route::get('/DemandesConges/{id}/view',[RhController::class,'detailConge'])->name('RespRh.conge.detail')->middleware('RespRh');     
     Route::post('/DemandesConges/{id}/update',[RhController::class,'UpdateConge'])->name('RespRh.conge.detail')->middleware('RespRh');     
    
     Route::get('/DemandesConges/{id}/update',[RhController::class,'UpdateConge'])->name('RespRh.update.conge')->middleware('RespRh');  
     Route::get('/DemandesConges/{id}/delete',[RhController::class,'deleteConge'])->name('RespRh.delete.conge')->middleware('RespRh');        
    
     Route::get('/MakeAsRead',[RhController::class,'MakeAsRead'])->name('RespRh.notification')->middleware('RespRh'); 
 /*-------------------------- Paiement--------------------------------- */    
 Route::get('/Paiement',[RhController::class,'ReglerPaie'])->name('RespRh.paie')->middleware('RespRh'); 
 Route::get('/Paiement/validation',[RhController::class,'calculerSalaire'])->name('RespRh.salaire')->middleware('RespRh'); 
 Route::post('/Paiement/validation',[RhController::class,'calculerSalaire'])->name('RespRh.salaire')->middleware('RespRh'); 
 Route::get('/FichesPaiement/{id}/edit',[RhController::class,'editFiche'])->name('RespRh.editFiche')->middleware('RespRh'); 
 Route::get('/FichesPaiement',[RhController::class,'FichesPaiement'])->name('RespRh.FichesPaiement')->middleware('RespRh'); 
 Route::get('/FichesPaiement/{id}/update',[RhController::class,'UpdateFiche'])->name('RespRh.UpdateFiche')->middleware('RespRh'); 
 Route::post('/FichesPaiement/{id}/update',[RhController::class,'UpdateFiche'])->name('RespRh.UpdateFiche')->middleware('RespRh'); 
 Route::get('/FichesPaiement/{id}/view',[RhController::class,'detailFiche'])->name('RespRh.detailFiche')->middleware('RespRh'); 
 Route::get('/FichesPaiement/{id}/delete',[RhController::class,'deleteFiche'])->name('RespRh.deleteFiche')->middleware('RespRh'); 

 Route::get('/FichesPaiement/filtrer',[RhController::class,'filtrerFiche'])->name('RespRh.filterFiche')->middleware('RespRh'); 


 Route::get('/Settings',function(){return view('RespRhSetting');})->name('RespRh.settings')->middleware('RespRh');});
 Route::post('/Settings/validation',[RhController::class,'settings'])->name('RespRh.settings.validation')->middleware('RespRh');
     Route::get('/Settings/validation',[RhController::class,'settings'])->name('RespRh.settings.validation')->middleware('RespRh');
    

  /*--------------------------Employe--------------------------------- */

Route::prefix('employer')->group(function(){
    Route::get('/',[EmployerController::class,'Dashboard'])->name('employer')->middleware('employer');
        /*--------------------------profil--------------------------------- */
    Route::get('/profil',[EmployerController::class,'profil'])->name('employer.profil')->middleware('employer');
    Route::get('/profil/edit',[EmployerController::class,'editProfil'])->name('employer.edit.profil')->middleware('employer');
    Route::get('/profil/edit/validation',[EmployerController::class,'Updateprofil'])->name('employer.validation')->middleware('employer');
     Route::put('/profil/edit/validation',[EmployerController::class,'Updateprofil'])->name('employer.validation')->middleware('employer');
     
     Route::get('/Settings',function(){
        return view('EmployerSettings');
     })->name('employer.settings')->middleware('employer');
     Route::post('/Settings/validation',[EmployerController::class,'settings'])->name('employer.settings.validation')->middleware('employer');
     Route::get('/Settings/validation',[EmployerController::class,'settings'])->name('employer.settings.validation')->middleware('employer');
     /*--------------------------presence--------------------------------- */
     Route::get('/presence',[EmployerController::class,'presence'])->name('employer.presence')->middleware('employer');
    Route::get('/presence/store',[EmployerController::class,'store']) ->name('employer.presence.store')->middleware('employer');
    Route::post('/presence/store',[EmployerController::class,'store']) ->name('employer.presence.store')->middleware('employer');
 /*--------------------------formation--------------------------------- */
 Route::get('/ListeFormations',[EmployerController::class,'ListeFormations'])->name('employer.ListeFormations')->middleware('employer');
 Route::get('/MesFormations',[EmployerController::class,'MesFormations'])->name('employer.Mesformations')->middleware('employer');  
 Route::get('/ListeFormations/{id}',[EmployerController::class,'stateFormations'])->name('employer.ListeFormations.state')->middleware('employer');
 Route::post('/ListeFormations/{id}',[EmployerController::class,'stateFormations'])->name('employer.ListeFormations.state')->middleware('employer');
  /*--------------------------Conge--------------------------------- */
Route::get('/conge',[EmployerController::class,'viewconge'])->name('employer.conge')->middleware('employer');
Route::post('/conge/validation',[EmployerController::class,'AjouterConge'])->name('employer.Conge.validation')->middleware('employer');
Route::get('/conge/validation',[EmployerController::class,'AjouterConge'])->name('employer.Conge.validation')->middleware('employer');
Route::get('/MesConges',[EmployerController::class,'MesConges'])->name('employer.MesConges')->middleware('employer');
Route::get('/MesConges/{id}/view',[EmployerController::class,'detailConge'])->name('Employer.conge.detail')->middleware('employer');     
 /*--------------------------Notification--------------------------------- */
 Route::get('/MakeAsRead',[EmployerController::class,'MakeAsRead'])->name('Employer.notification')->middleware('employer');     
  /*--------------------------Conge--------------------------------- */
Route::get('/Paiement',[EmployerController::class,'FichePaie'])->name('Employer.paiement')->middleware('employer');     
Route::get('/Paiement/{id}/view',[EmployerController::class,'showFiche'])->name('Employer.detail.fiche')->middleware('employer');     
Route::get('/DemandeAbsence',[EmployerController::class,'justifierAbsence'])->name('Employer.DemandesAbsences')->middleware('employer'); 
Route::get('/JustificationAbsence',[EmployerController::class,'LesjustificationAbsence'])->name('Employer.JustificationAbsence')->middleware('employer'); 
Route::get('/DemandeAbsence/{id}/justifier',[EmployerController::class,'Formjustifier'])->name('Employer.justifier')->middleware('employer'); 
Route::get('/DemandeAbsence/{id}/justifier/validation',[EmployerController::class,'justifier'])->name('Employer.justifier.validation')->middleware('employer'); 
Route::post('/DemandeAbsence/{id}/justifier/validation',[EmployerController::class,'justifier'])->name('Employer.justifier.validation')->middleware('employer'); 

Route::get('/JustificationAbsence/{id}/view',[EmployerController::class,'detailAbsence'])->name('Employer.detailAbsence')->middleware('employer'); 

});
 /*--------------------------candidat--------------------------------- */
Route::get('/candidat',function(){
    return view('candidat');
}) ->name('candidat');

Route::post('/candidat/validation',[CandidatController::class,'store'])->name('candidat.validation')->middleware('guest');
Route::get('/candidat/validation',[CandidatController::class,'store'])->name('candidat.validation')->middleware('guest');

Route::get('/candidat/verifier',function(){
    return view('CandidatureVerifie');
}) ->name('candidat.verifier');
