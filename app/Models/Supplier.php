<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
            'name',
            'mobile_number',
            'email',
            'address',
            'status',
            'created_by',
            'updated_by',
    ];
}