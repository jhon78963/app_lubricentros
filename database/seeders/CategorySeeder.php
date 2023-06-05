<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $category = new Category();
        $category->name = "servicio";
        $category->save();

        $category = new Category();
        $category->name = "lubricante";
        $category->save();
    }
}
