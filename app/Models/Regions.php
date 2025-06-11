<?php

namespace App\Models;

use App\Models\Villes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Regions extends Model
{
    use HasFactory;
    protected $table="regions";
    protected $primaryKey="id_region";
    protected $fillable = ['region'];
    public $timestamps = false;

    public function villes(){
        return $this->hasMany(Villes::class,'id_region','id_region');
    }

    protected static function boot()
    {
        parent::boot();
    
        static::deleting(function ($region) {
            // Delete associated villes when a region is deleted
            $region->villes->delete();
        });
    }
}
