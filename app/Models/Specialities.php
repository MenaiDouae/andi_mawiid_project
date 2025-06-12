<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialities extends Model
{
    use HasFactory;
    protected $table='specialites';
    protected $primaryKey='id_specialite';
    protected $fillable=['designation'];

    public $timestamps=false;
    public function cabinets(){
        return $this->hasMany(Cabinets::class,'id_specialite','id_specialite');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($specialite) {
        // Delete associated cabinets when a specialite is deleted
        foreach ($specialite->cabinets as $cabinet) { 
        $cabinet->delete();
        }
        });
    }
    public function scopeWithRelations($query)
    {
        return $query->with(['cabinets']);
    }
}
