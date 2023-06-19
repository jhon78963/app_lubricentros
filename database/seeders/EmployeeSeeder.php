<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Employee;

class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        $employee = new Employee();
        $employee->dni = "12345678";
        $employee->name = "Victor Tiburonsin Enrique";
        $employee->lastname = "León Paz";
        $employee->email = "vleon@unitru.edu.pe";
        $employee->save();

    }
}
