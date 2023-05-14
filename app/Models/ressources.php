<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\typeRessources;
class ressources extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 
        'image',
        'description'
        ];
        public function typeRessources()
        {
            return $this->belongsTo(typeRessources::class);
        }

        
}
