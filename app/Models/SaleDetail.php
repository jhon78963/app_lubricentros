<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleDetail extends Model
{
    use HasFactory;

    protected $table = "sale_details";

    protected $primaryKey = 'sale_id';

    protected $guarded = [''];
}
