<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ContactTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        $users = [];
        for ($i = 1; $i <= 3; $i++) {
            $users[] = [
                'name' => "Anhlv{$i}",
                'email' => "anhlv{$i}@gmail.com",
                'password' => bcrypt("anhlv{$i}")
            ];
        }
        DB::table('users')->insert($users);
        DB::table('contacts')->truncate();
        $faker = Faker::create();
        $contacts = [];
        foreach (range(1, 20) as $index) {
            $contacts[] = [
                'name' => $faker->name,
                'email' => $faker->email,
                'phone' => $faker->phoneNumber,
                'address' => "{$faker->streetName} {$faker->postcode} {$faker->city}",
                'company' => $faker->company,
                'group_id' => rand(1, 3),
                'user_id' => rand(1, 3),
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()

            ];
        }
        DB::table('contacts')->insert($contacts);
    }
}
