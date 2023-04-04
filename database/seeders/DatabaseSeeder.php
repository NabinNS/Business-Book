<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Nabin Shrestha',
            'location' => 'thimi',
            'email' => 'nabinshrestha348@gmail.com',
            'phone_number' => 9869064300,
            'password'=> Hash::make('nabin'),
            'role'=>'admin',
        ]);
    }
}
