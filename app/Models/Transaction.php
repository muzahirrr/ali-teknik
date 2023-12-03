<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand',
        'code',
        'option',
        'total_price',
        'user_id',
        'service_id',
        'detail',
        'amount',
        'order_date',
        'price',
        'province_id',
        'city_id',
        'district_id',
        'subdistrict_id',
        'address',
        'phone_number',
        'payment_status',
        'transaction_status'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }
    public function subdistrict(): BelongsTo
    {
        return $this->belongsTo(SubDistrict::class);
    }

}
