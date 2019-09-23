<?php

use Illuminate\Database\Seeder;

class items extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 50; $i++) {
            DB::table('items')->insert([
                'name' => Str::random(10),
                'price' => rand(0, 5),
            ]);
        }

    }
}
