<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Pelanggan;

class PelangganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        for($i = 1; $i <= 10; $i++)
        {
            Pelanggan::insert([
                'pelanggan_nama'    => $faker->name(),
                'pelanggan_hp'      => $faker->phoneNumber(),
                'pelanggan_alamat'  => $faker->address(),
            ]);
        }
    }
}
