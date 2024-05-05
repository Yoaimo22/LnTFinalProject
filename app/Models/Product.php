<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
        'price',
        'amount',
        'image'
    ];
    

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function customer(){
        return $this->belongsToMany(Customer::class);
    }
    public function purchases(){
        return $this->belongsToMany(Purchase::class, 'cart_items')->withPivot('amount');
    }
}