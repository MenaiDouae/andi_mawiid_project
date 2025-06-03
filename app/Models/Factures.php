<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factures extends Model
{
    use HasFactory;
    protected $table = 'factures';
    protected $primaryKey = 'id_facture';
    protected $fillable = [
        'etat',
        'date_facture',
        'type_paiement',
        'id_rendez_vous',
    ];

    public function rendezVous()
    {
        return $this->belongsTo(RendezVous::class, 'id_rendez_vous', 'id_rendez_vous');
    }
    public function traitements()
    {
        return $this->hasMany(Traitements::class, 'id_facture', 'id_facture');
    }
    public function services()
    {
        return $this->hasManyThrough(
            related: Services::class,
            through: Traitements::class, 
            firstKey: 'id_facture', 
            secondKey: 'id_service', 
            localKey: 'id_facture', 
            secondLocalKey: 'id_service');
    }

    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($facture) {
            // Delete associated traitements when a facture is deleted
            $facture->traitements()->delete();
        });
    }
}