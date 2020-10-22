<?php

namespace Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = [
        'status',
        'customer_id',
        'tour_id',
        'organizer_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_data',
        'tour_title',
        'payment_desc',
        'organizer_name',
        'category',
        'address',
        'street',
        'house',
        'region',
        'city',
        'country',
        'latitude',
        'longitude',
        'img',
        'deposit',
        'price_variant',
        'date_start_variant',
        'date_end_variant',
        'text_variant',
        'created_at',
        'updated_at',
    ];
}
