<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Career;

class CareerSeeder extends Seeder
{
    public function run()
    {
        $records = [
            [
                'referrer' => 'Juan Dela Cruz',
                'sub_agent' => 'Maria Santos',
                'broker' => 'Jose Rizal',
                'partner' => 'Emilio Aguinaldo',
                'position' => 'Real Estate Agent',
                'image' => 'agent1.jpg',
            ],
            [
                'referrer' => 'Luzviminda Cruz',
                'sub_agent' => 'Carlos Garcia',
                'broker' => 'Andres Bonifacio',
                'partner' => 'Gabriela Silang',
                'position' => 'Property Manager',
                'image' => 'manager1.jpg',
            ],
            [
                'referrer' => 'Ramon Magsaysay',
                'sub_agent' => 'Corazon Aquino',
                'broker' => 'Ferdinand Marcos',
                'partner' => 'Imelda Marcos',
                'position' => 'Marketing Specialist',
                'image' => 'marketing1.jpg',
            ],
            [
                'referrer' => 'Benigno Aquino',
                'sub_agent' => 'Leni Robredo',
                'broker' => 'Rodrigo Duterte',
                'partner' => 'Sara Duterte',
                'position' => 'Sales Consultant',
                'image' => 'sales1.jpg',
            ],
            [
                'referrer' => 'Isko Moreno',
                'sub_agent' => 'Manny Pacquiao',
                'broker' => 'Bongbong Marcos',
                'partner' => 'Cynthia Villar',
                'position' => 'Leasing Officer',
                'image' => 'leasing1.jpg',
            ],
            [
                'referrer' => 'Antonio Luna',
                'sub_agent' => 'Gregorio Del Pilar',
                'broker' => 'Diego Silang',
                'partner' => 'Melchora Aquino',
                'position' => 'Administrative Officer',
                'image' => 'admin1.jpg',
            ],
        ];

        foreach($records as $record){
            Career::create($record);
        }
    }
}
