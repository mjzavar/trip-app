<?php

namespace Database\Seeders;

use App\Models\Driver;
use App\Models\Task;
use App\Models\Truck;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Factories\DriverFactory;
use Database\Factories\TaskFactory;
use Database\Factories\TruckFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Truck::factory()->count(10)->create();
        Driver::factory()->count(10)->create();
        Task::factory()->count(50)->create();
    }
}
