<?php

use Illuminate\Database\Seeder;
use App\Permit;

class PermitTableSeeder extends Seeder
{
	/**
     * Run the database seeds.
     *
     * @return void
     */
	public function run()
	{
		Permit::create([
			'menu_id' => 1,
			'profile_id' => 1        	
		]);
		Permit::create([
			'menu_id' => 2,
			'profile_id' => 1        	
		]);
		Permit::create([
			'menu_id' => 3,
			'profile_id' => 1        	
		]);
		Permit::create([
			'menu_id' => 4,
			'profile_id' => 1        	
		]);
		Permit::create([
			'menu_id' => 5,
			'profile_id' => 1        	
		]);
		Permit::create([
			'menu_id' => 6,
			'profile_id' => 1        	
		]);
		Permit::create([
			'menu_id' => 7,
			'profile_id' => 1        	
		]);
		Permit::create([
			'menu_id' => 8,
			'profile_id' => 1        	
		]);
		Permit::create([
			'menu_id' => 9,
			'profile_id' => 1        	
		]);
		Permit::create([
			'menu_id' => 10,
			'profile_id' => 1        	
		]);
		Permit::create([
			'menu_id' => 11,
			'profile_id' => 1        	
		]);
	}
}
