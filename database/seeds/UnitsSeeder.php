<?php

use Illuminate\Database\Seeder;

class UnitsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('unity')->insert([
            // Separado por regiões, região 5 é o norte, como não existe dados para o norte, o sistema vem em branco.
            ['region_id' => '1', 'title' => 'Porto Alegre', 'created_at' => Carbon\Carbon::now(), 'updated_at' => Carbon\Carbon::now()],
            ['region_id' => '1', 'title' => 'Curitiba', 'created_at' => Carbon\Carbon::now(), 'updated_at' => Carbon\Carbon::now()],

            ['region_id' => '2', 'title' => 'São Paulo', 'created_at' => Carbon\Carbon::now(), 'updated_at' => Carbon\Carbon::now()],
            ['region_id' => '2', 'title' => 'Rio de Janeiro', 'created_at' => Carbon\Carbon::now(), 'updated_at' => Carbon\Carbon::now()],
            ['region_id' => '2', 'title' => 'Belo Horizonte', 'created_at' => Carbon\Carbon::now(), 'updated_at' => Carbon\Carbon::now()],

            ['region_id' => '3', 'title' => 'Brasília', 'created_at' => Carbon\Carbon::now(), 'updated_at' => Carbon\Carbon::now()],

            ['region_id' => '4', 'title' => 'Salvador', 'created_at' => Carbon\Carbon::now(), 'updated_at' => Carbon\Carbon::now()],
            ['region_id' => '4', 'title' => 'Recife', 'created_at' => Carbon\Carbon::now(), 'updated_at' => Carbon\Carbon::now()],


        ]);
    }
}
