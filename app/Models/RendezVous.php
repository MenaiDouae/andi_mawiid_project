<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RendezVous extends Model
{
    use HasFactory;
    protected $primaryKey = "id_rendez_vous";
    protected $table = 'rendez_vous';
    protected $fillable = [
        'date_rendez_vous',
        'heure_rendez_vous',
        'etat',
        'id_patient',
        'id_service',
        'id_cabinet',
        'commentaire'
    ];
    
    public function service()
    {
        return $this->belongsTo(Services::class , 'id_service','id_service');
    }
    public function patient()
    {
        return $this->belongsTo(Patients::class , 'id_patient', 'id_patient');
    }
    public function factures()
    {
    return $this->hasMany(Factures::class, 'id_rendez_vous', 'id_rendez_vous');
    }   
    public function cabinet()
    {
        return $this->belongsTo(Cabinets::class, 'id_cabinet', 'id_cabinet');
    }

    public function scopeWithRelations($query)
    {
        return $query->with(['service', 'patient', 'cabinet']);
    }

    protected static function boot()
    {
        parent::boot();
    
        static::deleting(function ($rendezVous) {
            // Delete associated factures when a rendez-vous is deleted
            $rendezVous->factures()->delete();
        });
    }
}
