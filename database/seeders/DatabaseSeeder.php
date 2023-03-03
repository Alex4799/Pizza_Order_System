<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
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

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
           'name'=>'Admin',
           'email'=>'admin@gmail.com',
           'phone'=>'09980730638',
           'address'=>'Yangon',
           'gender'=>'male',
           'role'=>'admin',
           'password'=>Hash::make('admin1234')
        ]);

        User::create([
            'name'=>'User',
            'email'=>'user@gmail.com',
            'phone'=>'09757589796',
            'address'=>'Yangon',
            'gender'=>'male',
            'role'=>'user',
            'password'=>Hash::make('user1234')
         ]);
    }
}
