<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
	protected $table      = 'product';
	protected $primaryKey = 'product_id';
	public $timestamps    = false;

    protected $fillable = [
        'name', 'product_description','price',
    ];

    protected $hidden = ['pivot'];

    /**
     * Relationships
     */
    //Get Customers
    public function customers()
    {
        return $this->belongsToMany('App\Models\Customer', 'customer_product', 'product_id', 'customer_id');
    }
}
