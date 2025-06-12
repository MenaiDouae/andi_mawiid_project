<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Villes extends Model
{
    use HasFactory;
    protected $table='villes';
    protected $primaryKey='id_ville';
    protected $fillable=['ville','id_region'];
    public $timestamps=false;

    public function region(){
        return $this->belongsTo(Regions::class,'id_region','id_region');
    }
    public function cabinets(){
        return $this->hasMany(Cabinets::class,'id_ville','id_ville');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($ville) {
        // Delete associated cabinets when a ville is deleted
        foreach ($ville->cabinets as $cabinet) { 
        $cabinet->delete();
        }
        });
    }
    public function scopeWithRelations($query)
    {
        return $query->with(['region', 'cabinets']);
    }
}
