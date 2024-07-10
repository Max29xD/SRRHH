<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Empleado;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ContactosEmergencia;
use App\Models\DatosLaborales;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        

       /*  User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]); */
        // User::factory(10)->create();
        Empleado::factory(50)->create();
        DatosLaborales::factory()->count(50)->create();
        ContactosEmergencia::factory()->count(50)->create();


    }
}
