<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $fillable =
        [
            'name',
            'user_id',
            'name_inventory',
            'description',
            'stock',
            'condition'
        ];
}
