<?php

namespace App\Models;
use App\Models\Ressources;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class typeressources extends Model
{
    use HasFactory;
    protected $fillable=[ 
        'nom',
        'quantites'
    ];

    public function ressources()
    {
        return $this->hasMany(Ressources::class);
    }
}
