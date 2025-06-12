<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cabinets extends Model
{
    use HasFactory;
    protected $table='cabinets';
    protected $primaryKey='id_cabinet';
    protected $fillable=[
        'adresse',
        'fixe',
        'mobile',
        'email',
        'id_ville',
        'id_specialite'
    ];
    public $timestamps=false;
    public function specialite()
    {
        return $this->belongsTo(Specialities::class, 'id_specialite', 'id_specialite');
    }
    public function ville()
    {
        return $this->belongsTo(Villes::class, 'id_ville', 'id_ville');
    }
    public function personnels()
    {
        return $this->hasMany(Personnel::class, 'id_cabinet', 'id_cabinet');
    }
    public function rendezVous()
    {
        return $this->hasMany(RendezVous::class, 'id_cabinet', 'id_cabinet');
    }
    public function traitements()
    {
        return $this->hasMany(Traitements::class, 'id_cabinet', 'id_cabinet');
    }
    public function patients()
    {
    return $this->hasManyThrough(
        Patients::class,
        RendezVous::class,
        'id_cabinet',
        'id_patient', 
        'id_cabinet',   
        'id_patient'
    );
    }
    public function services()
    {
    return $this->belongsToMany(
        Services::class,
        'traitements',
        'id_cabinet',
        'Id_Service'
    );
    }
    // public function scopeWithRelations($query)
    // {
    //     return $query->with(['specialite', 'ville','personnels','rendezVous','traitements','patients','services']);
    // }

    // protected static function boot()
    // {
    //     parent::boot();
    
    //     static::deleting(function ($cabinet) {
    //         // Delete associated relations when a cabinet is deleted
    //         $cabinet->RendezVous()->delete();
    //         $cabinet->personnels()->delete();
    //         $cabinet->traitements()->delete();
    //     });
    // }
}
