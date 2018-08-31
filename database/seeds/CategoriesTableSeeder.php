<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('categories')->delete();
        for ($i=0; $i < 10; $i++) {
            \App\Model\Category::create([
                'name'=> str_random('10')
            ]);
        }
    }
}
