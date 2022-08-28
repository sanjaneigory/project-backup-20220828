<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //DB::table('plans')->truncate();

        DB::table('plans')->insert([
            'plan_name' => 'Mega Promo Plan 1',
            'plan_price' => '499',
            'plan_deposit' => '2994',
            'plan_cib' => '15000',
            'plan_services' => '500 Main account, 500 MB, 500 SMS, 500 Bonus',
            'plan_type' => 'HYBRID',
        ]);

        DB::table('plans')->insert([
            'plan_name' => 'Mega Promo Plan 2',
            'plan_price' => '299',
            'plan_deposit' => '1994',
            'plan_cib' => '10000',
            'plan_services' => '300 Main account, 300 MB, 300 SMS, 300 Bonus',
            'plan_type' => 'HYBRID',
        ]);

        DB::table('plans')->insert([
            'plan_name' => 'Mega Promo Plan 3',
            'plan_price' => '199',
            'plan_deposit' => '994',
            'plan_cib' => '5000',
            'plan_services' => '200 Main account, 200 MB, 200 SMS, 200 Bonus',
            'plan_type' => 'HYBRID',
        ]);
    }
}
