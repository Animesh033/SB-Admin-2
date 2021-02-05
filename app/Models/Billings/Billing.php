<?php

namespace App\Models\Billings;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Billing extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    // public function category()
    // {
    //     return $this->belongsTo(Category::class, 'category_id', 'id');
    // }

    // public function customer()
    // {
    //     return $this->belongsTo(Customer::class, 'customer_id', 'id');
    // }

    /**
     * =============================== Polymorphic One To Many========================
     * */ 

    /**
     * Get the parent billingable model (Category or Customer).
     */
    // public function billingable()
    // {
    //     return $this->morphTo();
    // }

    /**
     * =============================== Polymorphic Many To Many========================
     * */ 
    /**
     * Get all of the categories that are assigned this billing.
     */
    public function categories()
    {
        return $this->morphedByMany(Category::class, 'billingable');
    }

    /**
     * Get all of the customers that are assigned this billing.
     */
    public function customers()
    {
        return $this->morphedByMany(Customer::class, 'billingable');
    }

    /**
     * =============================== Polymorphic Many To Many========================
     * */ 

    public function getCreatedAtAttribute($createdAt)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $createdAt)->format('d-m-Y');
    }

    public function setFirstNameAttribute($value)
    {
        $this->attributes['first_name'] = strtolower($value);
    }

    public function scopeAmount($query)
    {
        return $query->where('amount', '>', 1000); //just for demo
    }


   public function demo() {
        return $this->amount()->orderBy('created_at')->get();
    }

    public function getQuotationPDFUrl(String $billingNo) : String
    {
        $url = '';
        $quotation = Quotation::whereQuotationNo($billingNo)->first();
        if ($quotation) {
            $url = $quotation->quotation_url;
        }
        return $url;
    }
}