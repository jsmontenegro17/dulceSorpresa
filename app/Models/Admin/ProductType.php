<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Product;

class ProductType extends Model
{
    protected $fillable = ['product_type_name'];
    protected $primaryKey = 'product_type_id';
    public $timestamps = ['created_at', 'updated_at'];

    public function products()
    {
    	return $this->hasMany(Product::class, 'product_type_id');
    }

}
