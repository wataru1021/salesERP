<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Enums\RoleStateType;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
class InitUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::insert([
            'name' => "manager",
            'email' => "manager@gmail.com",
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'reset_password_token' => Str::random(10),
            'remember_token' => Str::random(10),
            'role_id' => RoleStateType::MANAGERMENT,
            'company_id' => 1,
            'last_login_at' => Carbon::now()->toDateTimeString(),
            'created_at' => Carbon::now()->toDateTimeString(),
        ]);


        User::insert([
            'name' => "saler",
            'email' => "sales@gmail.com",
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'reset_password_token' => Str::random(10),
            'remember_token' => Str::random(10),
            'role_id' => RoleStateType::SALER,
            'company_id' => 1,
            'last_login_at' => Carbon::now()->toDateTimeString(),
            'created_at' => Carbon::now()->toDateTimeString(),
        ]);


    }
}
