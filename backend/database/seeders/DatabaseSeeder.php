<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Enums\RoleStateType;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Carbon\Carbon;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->insertUsers();
    }

    private function insertUsers()
    {
        User::insert([
            'name' => 'manager',
            'email' => 'manager@gmail.com',
            'role' => RoleStateType::MANAGERMENT,
            'password' => Hash::make('pass'),
            'created_at' => Carbon::now()->toDateTimeString(),
        ]);
        User::insert([
            'name' => 'saler',
            'email' => 'saler@gmail.com',
            'role' => RoleStateType::SALER,
            'password' => Hash::make('pass'),
            'created_at' => Carbon::now()->toDateTimeString(),
        ]);
    }
}
