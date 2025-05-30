<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Traitements extends Model
{
    use HasFactory;
    protected $primaryKey = "id_traitement";
    protected $table = 'traitements';
    protected $fillable = [
        'id_service', 
        'id_facture'
       
    ];
    public $timestamps = false;


    public function service()
    {
        return $this->belongsTo(services::class, 'id_service', 'id_service');
    }
    public function facture()
    {
        return $this->belongsTo(Factures::class, 'id_facture', 'id_facture');
    }

    public function patient()
    {
        return $this->hasOneThrough(
            Patients::class,
            Factures::class,
        'id_facture',
        'id_patient',
        'id_facture',
        'id_rendez_vous')->through('rendezVous'); 
    }

    public function scopeWithPatient($query)
    {
        return $query->with('patient','facture','service');
    }
}
