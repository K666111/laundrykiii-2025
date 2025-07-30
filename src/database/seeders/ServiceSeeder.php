<?php

namespace Database\Seeders;

use App\Models\Service;
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
            ['name' => 'Cuci Kering', 'price' => 8000, 'unit' => 'kg'],
            ['name' => 'Cuci Basah', 'price' => 6000, 'unit' => 'kg'],
            ['name' => 'Setrika', 'price' => 7000, 'unit' => 'kg'],
            ['name' => 'Dry Cleaning', 'price' => 15000, 'unit' => 'pcs'],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
