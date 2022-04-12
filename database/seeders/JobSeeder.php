<?php

namespace Database\Seeders;

use App\Models\JobDetail;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JobDetail::factory()->count(20)->create();
    }
}
