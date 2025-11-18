<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Purchase extends Model
{
    protected $guarded = [];

    public function purchaseItems() {
        return $this->hasMany(PurchaseItem::class,'purchase_id');
    }

    public function supplier() {
        return $this->belongsTo(Supplier::class, 'purchase_id');
    }

    public function warehouse() {
        return $this->belongsTo(Supplier::class, 'warehouse_id');
    }

    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
