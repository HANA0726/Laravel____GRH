<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Candidat extends Model
{
    use HasFactory,Notifiable;
    protected $guarded =['id_candidat'];
    public static function emailExists($email) {
        return self::where('email', $email)->exists();
    }
}
