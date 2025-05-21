<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    use HasFactory;
    protected $primaryKey = "id_service";
    protected $table = 'services';
    protected $fillable = [
        'service_name',
        'prix'
    ];
    public $timestamps = false;

    public function rendezVous() 
    {
        return $this->hasMany(RendezVous::class, 'id_service', 'id_service');
    }
}
