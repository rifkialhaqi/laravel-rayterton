<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrderItem extends Model
{
    // Relasi ke PurchaseOrder
    public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrder::class);
    }

    // Relasi ke Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    protected $fillable = [
        'purchase_order_id',
        'product_id',
        'quantity',
        'price',
    ];
}
