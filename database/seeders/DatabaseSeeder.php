<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Service;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(['email' => 'admin@etheriabeauty.test'], [
            'name' => 'Etheria Beauty Admin',
            'password' => Hash::make(env('ETHERIA_ADMIN_PASSWORD', 'change-this-password')),
            'is_admin' => true,
        ]);

        foreach ([
            ['name' => 'Brow Bomber Luxe', 'price' => 125000],
            ['name' => 'Lashlift Luxe', 'price' => 100000],
            ['name' => 'Medium Soft', 'price' => 130000],
        ] as $service) {
            Service::updateOrCreate(['name' => $service['name']], $service + [
                'description' => '[SERVICE DESCRIPTION WILL BE PROVIDED.]',
            ]);
        }

        for ($day = 1; $day <= 14; $day++) {
            $date = Carbon::today()->addDays($day);
            if ($date->isWeekend()) {
                continue;
            }
            foreach (['10:00', '13:00', '16:00'] as $time) {
                Schedule::firstOrCreate(['available_date' => $date->toDateString(), 'available_time' => $time]);
            }
        }
    }
}
