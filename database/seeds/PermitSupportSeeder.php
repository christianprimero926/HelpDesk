<?php

use Illuminate\Database\Seeder;
use App\Permit;

class PermitSupportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permit::create([
			'menu_id' => 2,
			'profile_id' => 2        	
		]);
		Permit::create([
			'menu_id' => 10,
			'profile_id' => 2        	
		]);
		Permit::create([
			'menu_id' => 11,
			'profile_id' => 2        	
		]);
		Permit::create([
			'menu_id' => 12,
			'profile_id' => 2        	
		]);
		Permit::create([
			'menu_id' => 13,
			'profile_id' => 2        	
		]);
		Permit::create([
			'menu_id' => 14,
			'profile_id' => 2        	
		]);
		Permit::create([
			'menu_id' => 15,
			'profile_id' => 2        	
		]);
		Permit::create([
			'menu_id' => 16,
			'profile_id' => 2        	
		]);
		Permit::create([
			'menu_id' => 17,
			'profile_id' => 2        	
		]);
		Permit::create([
			'menu_id' => 18,
			'profile_id' => 2        	
		]);
		Permit::create([
			'menu_id' => 19,
			'profile_id' => 2        	
		]);
		Permit::create([
			'menu_id' => 20,
			'profile_id' => 2        	
		]);
		Permit::create([
			'menu_id' => 21,
			'profile_id' => 2        	
		]);
		Permit::create([
			'menu_id' => 22,
			'profile_id' => 2        	
		]);
	}
}
