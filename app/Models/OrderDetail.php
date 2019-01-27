<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    //
	protected $table      = 'order_detail';
	protected $primaryKey = 'order_detail_id';
	public $timestamps    = false;

    protected $fillable = [
        'product_description', 'price','order_id', 'quantity',
    ];

    protected $hidden = [];

	/**
     * Relationships
     */

    //Inverse relationship customer
    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }
}
