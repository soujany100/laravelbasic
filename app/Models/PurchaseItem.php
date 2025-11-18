<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseItem extends Model
{
    protected $guarded = [];

    public function purchase() {
        return $this->hasMany(Purchase::class,'purchase_id');
    }

    public function product() {
        return $this->hasMany(Product::class,'product_id');
    }
}
