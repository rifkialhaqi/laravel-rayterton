<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    // Relasi ke PurchaseOrderItem
    public function items()
    {
        return $this->hasMany(PurchaseOrderItem::class);
    }

    protected $guarded = [];
}
