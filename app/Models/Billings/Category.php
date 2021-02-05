<?php

namespace App\Models\Billings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class Category extends Model
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

    /**
     * Get all of the post's comments.
     */
    // public function billings()
    // {
    //     return $this->morphMany(Billing::class, 'billingable');
    // }

    /**
     * =============================== Polymorphic Many To Many========================
     * */ 
    /**
     * Get all of the categories's billings.
     */
    public function billings()
    {
        return $this->morphToMany(Billing::class, 'billingable')->withPivot('billing_no');
    }


    public function billingsByDate($dateInput=null) {
        $createdAt = isset($dateInput) ? Carbon::createFromFormat('m/d/Y', $dateInput)->format('Y-m-d') : now()->format('Y-m-d');
        return $this->billings()->whereDate('created_at', $createdAt);
    }

    public function hasBillingCount($dateInput=null) {
        return $this->billingsByDate($dateInput)->count() > 0 ? true : false;
    }

    public function getBillings($dateInput=null) {
        return $this->billingsByDate($dateInput)->get();
    }
}