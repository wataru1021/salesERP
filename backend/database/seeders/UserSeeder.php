<?php

namespace Database\Seeders;

use App\Enums\RoleStateType;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Str;



class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        /*  insert users   */
        for ($i = 0; $i < 10; $i++) {
            User::insert([
                'name' => $faker->name(),
                'email' => $faker->unique()->safeEmail(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'reset_password_token' => Str::random(10),
                'remember_token' => Str::random(10),
                'role_id' => RoleStateType::SALER,
                'company_id' => 1,
                'last_login_at' => Carbon::now()->toDateTimeString(),
                'created_at' => Carbon::now()->toDateTimeString(),
            ]);
        }
        /*  insert admin   */
        for ($i = 0; $i < 10; $i++) {
            User::insert([
                'name' => $faker->name(),
                'email' => $faker->unique()->safeEmail(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'reset_password_token' => Str::random(10),
                'remember_token' => Str::random(10),
                'role_id' => RoleStateType::MANAGERMENT,
                'company_id' => 1,
                'last_login_at' => Carbon::now()->toDateTimeString(),
                'created_at' => Carbon::now()->toDateTimeString(),
            ]);
        }
    }
}
