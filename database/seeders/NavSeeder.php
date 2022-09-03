<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NavSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('navigation_bars')->insert([
            'name' => "Apps",
            'url' => "#Apps",
            'status' => "active",
        ]);
        DB::table('navigation_bars')->insert([
            'name' => "Pricing",
            'url' => "#Price",
            'status' => "active",
        ]);
        DB::table('navigation_bars')->insert([
            'name' => "Support",
            'url' => "#Support",
            'status' => "active",
        ]);
        DB::table('navigation_bars')->insert([
            'name' => "FAQS",
            'url' => "#FAQ",
            'status' => "active",
        ]);
        DB::table('navigation_bars')->insert([
            'name' => "Our Policy",
            'url' => "#OurPolicy",
            'status' => "active",
        ]);
    }
}
