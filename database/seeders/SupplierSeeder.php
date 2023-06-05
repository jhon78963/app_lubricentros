<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Supplier;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        $supplier = new Supplier();
        $supplier->business_name = "Zerogroups SAC";
        $supplier->business_representative = "Ing. Carlos Issac Haro Polo";
        $supplier->phone = "923428128";
        $supplier->line_business = "lubricantes";
        $supplier->save();
    }
}
