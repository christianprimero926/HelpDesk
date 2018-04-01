<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Category::create([
            'name' => 'General',
            'project_id' => '0'
        ]);
         Category::create([
        	'name' => 'Categoria A1',
        	'project_id' => '1'
        ]);

        Category::create([
        	'name' => 'Categoria A2',
        	'project_id' => '1'
        ]);

        Category::create([
        	'name' => 'Categoria B1',
        	'project_id' => '2'
        ]);

        Category::create([
        	'name' => 'Categoria B2',
        	'project_id' => '2'
        ]);
    }
}
