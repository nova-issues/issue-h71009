<?php

namespace Database\Seeders;

use Database\Factories\ProductFactory;
use Database\Factories\SaleFactory;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);

        $products = ProductFactory::new()->count(10)
                        ->state(new Sequence(
                            ['virtual' => true],
                            ['virtual' => false],
                        ))->create();

        $sales = SaleFactory::new()->times(10)->create();

        foreach ($sales as $index => $sale) {
            $products[$index]->sales()->attach($sale);
        }
    }
}
