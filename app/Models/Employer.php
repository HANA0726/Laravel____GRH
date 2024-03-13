<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Employer extends Model
{
    use HasFactory,Notifiable;
  
    protected $primaryKey='id_employer';
    protected $fillable=['id_employer','nom','prenom','email','telephone','cnss','cin','lieu_naissance','date_naissance','poste','situation_familiale','sexe','photo','type_contrat','date_debut','date_fin'];
   
   
   
    
}
