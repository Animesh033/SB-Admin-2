<?php

namespace App\Models\Billings;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Receipt extends Model
{
    use HasFactory;

    protected $fillable = ['description', 'hsn_code', 'qty', 'rate', 'taxable_value', 'customer_id', 'receipt_no'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function getReceiptUrl(String $receiptNo) : String
    {
        $url = '';
        $receipt = ReceiptUrl::whereReceiptNo($receiptNo)->first();
        if ($receipt) {
            $url = $receipt->receipt_url;
        }
        return $url;
    }
}