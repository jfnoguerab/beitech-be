<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
	protected $table      = 'order';
	protected $primaryKey = 'order_id';
	public $timestamps    = false;

    protected $fillable = [
        'customer_id', 'creation_date','delivery_address', 'total',
    ];

    protected $hidden = [];

    // override the toArray function (called by toJson)
    public function toArray() {
        // get the original array to be displayed
        $data = parent::toArray();

        // change the value of the 'orderDetails' key
        if ($this->orderDetails) {
            $data['order_details'] = $this->orderDetails;
        } else {
            $data['order_details'] = null;
        }

        return $data;
    }

    /**
     * Relationships
     */

    //Get Order details
    public function orderDetails()
    {
        return $this->hasMany('App\Models\OrderDetail', 'order_id');
    }

    //Inverse relationship customer
    public function customer()
    {
        return $this->belongsTo('App\Models\Customer', 'customer_id');
    }
}
