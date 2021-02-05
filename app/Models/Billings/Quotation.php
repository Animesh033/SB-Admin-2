<?php

namespace App\Models\Billings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Quotation extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getQuotationUrlAttribute($fileName)
    {
        return  asset('storage/pdf/'.$fileName);
    }

    public function getCreatedAtAttribute($createdAt)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $createdAt)->format('d-m-Y');
    }
}
