<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
	protected $table      = 'customer';
	protected $primaryKey = 'customer_id';
	public $timestamps    = false;

    protected $fillable = [
        'name', 'email',
    ];

    protected $hidden = [];

    /**
     * Relationships
     */
    //Get Orders
    public function orders()
    {
        return $this->hasMany('App\Models\Order','customer_id');
    }
    //Get Products
    public function products()
    {
        return $this->belongsToMany('App\Models\Product', 'customer_product', 'customer_id', 'product_id');
    }
}
