<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $services = [
            'Dental Checkup',
            'Dental Cleaning',
            'Dental Filling',
            'Dental Extraction',
            'Dental Crown',
            'Dental Bridge',
            'Dental Implant',
            'Dentures',
            'Root Canal Treatment',
        ];

        foreach ($services as $service) {
            \App\Models\Service::create([
                'name' => $service,
            ]);
        }

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
