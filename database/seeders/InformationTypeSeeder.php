<?php

namespace Database\Seeders;

use App\Models\InformationType;
use Illuminate\Database\Seeder;

class InformationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        InformationType::create(["name" => "email"]);
        InformationType::create(["name" => "telefone fixo"]);
        InformationType::create(["name" => "celular"]);
        InformationType::create(["name" => "facebook"]);
        InformationType::create(["name" => "instagram"]);
        InformationType::create(["name" => "linkedin"]);
    }
}
