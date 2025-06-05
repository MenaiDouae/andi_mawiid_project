<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patients extends Model
{
    use HasFactory;
    protected $table = 'patients';
    protected $primaryKey = 'id_patient';
    protected $fillable = [
        'nom',
        'prenom',
        'cnie',
        'date_naissance',
        'adresse',
        'num_tel',
        'sexe',
    ];

    public function factures()
    {
        return $this->hasManyThrough(
            related: Factures::class,
            through: RendezVous::class,
            firstKey: 'id_patient',
            secondKey: 'id_rendez_vous',
            localKey: 'id_patient',
            secondLocalKey: 'id_rendez_vous'
        );
    }

    public function rendezVous()
    {
        return $this->hasMany(RendezVous::class, 'id_patient', 'id_patient');
    }

    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(
            function ($patient) {
                // Delete the associated user when a patient is deleted
                if ($patient->user) {
                    $patient->user->delete();
                }

                // Delete all associated rendez-vous
                RendezVous::where('id_patient', $patient->id_patient)->delete();
            }
        );
    }

    public function scopeWithRelations($query)
    { 
        return $query->with([
            'user.roles',
            'rendezVous.factures',
        ]);
    }
}
