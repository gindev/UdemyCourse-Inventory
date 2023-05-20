<?php

namespace App\Models;

use App\Models\Unit;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier_id',
        'category_id',
        'product_id',
        'number',
        'date',
        'description',
        'qty',
        'single_price',
        'total_price',
        'status',
        'created_by',
        'updated_by',
    ];

    public function product(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function supplier(){
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }

    public function unit(){
        return $this->belongsTo(Unit::class, 'unit_id', 'id');
    }

    public function category(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
