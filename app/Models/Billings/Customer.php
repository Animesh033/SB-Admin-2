<?php

namespace App\Models\Billings;

use App\Models\Billings\Receipt;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    // public function billings()
    // {
    //     return $this->hasMany(Billing::class);
    // }

    /**
     * =============================== Polymorphic One To Many========================
     * */

    // public function billings()
    // {
    //     return $this->morphMany(Billing::class, 'billingable');
    // }

    /**
     * =============================== Polymorphic Many To Many========================
     * */

    /**
     * Get all of the customer's billings.
     */
    public function billings()
    {
        return $this->morphToMany(Billing::class, 'billingable')->withPivot('billing_no');
    }

    public function receipts()
    {
        return $this->hasMany(Receipt::class);
    }

    // public function receiptUrls()
    // {
    //     return $this->hasManyThrough(ReceiptUrl::class, Receipt::class);
    // }
}
