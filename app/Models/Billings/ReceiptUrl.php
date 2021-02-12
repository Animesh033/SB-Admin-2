<?php

namespace App\Models\Billings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceiptUrl extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getReceiptUrlAttribute($fileName)
    {
        $storagePath = config('billings.receipt.storage_path');
        return  asset($storagePath.$fileName);
    }
}