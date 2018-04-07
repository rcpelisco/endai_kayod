<?php

use Illuminate\Database\Seeder;

class GuardianTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $limit = 33;

        for ($i = 0; $i < $limit; $i++) {
            DB::table('guardians')->insert([
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'contact_number' => '09123456789',
                'address' => $faker->address,
            ]);
        }
    }
}
