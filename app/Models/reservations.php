<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Ressources;
class reservations extends Model
{
    use HasFactory;
    protected $fillable = [
        
      
        'datedebut',
        'datefin',
        'demandeur',
       'ressource'
       
    ];

   
   /* public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function ressources()
    {
        return $this->hasMany(Ressources::class);
    }*/
}
