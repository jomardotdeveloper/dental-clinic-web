<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
    }
}
