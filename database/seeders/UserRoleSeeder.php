<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserRole;

class UserRoleSeeder extends Seeder
{
    public function run(): void
    {
        $user_role = new UserRole();
        $user_role->user_id = 1;
        $user_role->role_id = 1;
        $user_role->save();
    }
}
