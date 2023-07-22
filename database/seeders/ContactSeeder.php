<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = \App\Models\User::create([
            'email' => 'admin@superuser.com',
            'password' => Hash::make('123'),
        ]);

        $contact = \App\Models\Contact::create([
            'user_id' => $user->id,
            'first_name' => 'Super',
            'last_name' => 'User',
            'is_admin' => true,
        ]);
    }
}
