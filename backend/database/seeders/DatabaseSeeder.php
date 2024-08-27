<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;


use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call(UserSeeder::class);
        $this->call(PersonaSeeder::class);
        $this->call(AdministrativoSeeder::class);
        $this->call(EspecialidadSeeder::class);
        $this->call(GradoSeeder::class);
        $this->call(DocenteSeeder::class);
        $this->call(EstudianteSeeder::class);
        $this->call(PadreSeeder::class);
        $this->call(MateriaSeeder::class);
        $this->call(ParaleloSeeder::class);
       

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
