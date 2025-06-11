<?php

namespace Database\Seeders;

use App\Models\Regions;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RegionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $regions=[
            "Beni Mellal-Khenifra","Casablanca-Settat","Dakhla-Oued Eddahab","Draa-Tafilalet",
            "Fes-Meknes","Guelmim-Oued Noun","L'Oriental ","Laayoune-Sakia El Hamra","Marrakech-Safi",
            "Rabat-Sale-Kenitra","Souss-Massa","Tanger-Tetouan-Al Hoceima"
        ];
        foreach ($regions as $region){
            Regions::firstOrCreate(['region' => $region]);
        }
    }
}
