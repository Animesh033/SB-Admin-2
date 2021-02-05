<?php

namespace App\Models\Billings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
}