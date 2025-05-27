<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personnel extends Model
{
    use HasFactory;

    protected $table = 'personnels';
    protected $primaryKey = 'id_personnel';

    protected $fillable = [
        'nom',
        'prenom',
        'cnie',
        'adresse',
        'num_tel',
        'sexe',
    ];

    /**
     * Relations possibles
     */
    public function user()
    {
        return $this->morphOne(User::class, 'id_personnel', 'id_personnel');
    }
}
