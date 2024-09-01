<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        User::truncate();
        Schema::enableForeignKeyConstraints();

        User::insert([
            'username' => 'admin',
            'password' => Hash::make('12345'),
            'active' => true,
            'fullname' => 'Administrator',
            'role' => UserRole::SUPER_ADMINISTRATOR,
        ]);
        User::insert([
            'username' => 'operator',
            'password' => Hash::make('12345'),
            'active' => true,
            'fullname' => 'Operator',
            'role' => UserRole::OPERATOR,
        ]);

        $faker = \Faker\Factory::create('id_ID');
        DB::beginTransaction();
        $pw = Hash::make('12345');
        for ($i = 3; $i <= 100; $i++) {
            User::insert([
                'id' => $i,
                'username' => 'user' . $i,
                'password' => $pw,
                'active' => rand(0, 1),
                'fullname' => $faker->name(),
                'role' => rand(2, 3),
            ]);
        }
        DB::commit();
    }
}
