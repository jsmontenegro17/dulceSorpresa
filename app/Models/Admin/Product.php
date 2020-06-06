<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Intervention\Image\Facades\image;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin\ProductType;
use App\Models\Admin\Combo;



class Product extends Model
{
    protected $fillable = ['product_name', 'product_price', 'product_trademark', 'product_description', 'product_image_name', 'product_state', 'product_type_id'];
    protected $primaryKey = 'product_id';

    public function productType()
    {
        return $this->belongsTo(ProductType::class, 'product_type_id');
    }

    public function combos()
    {
        return $this->belongsToMany(Combo::class, 'combo_products', 'product_id', 'combo_id' );
    }

    public static function setImage($product_image, $actual = false)
    {
        if ($product_image) {
            if ($actual) {
                Storage::disk('public')->delete("images/products/$actual");
            }
            $imageName = Str::random(20) . '.jpg';

            $imagen = Image::make($product_image)->encode('jpg', 75);
            // $imagen->resize(65, 65, function ($constraint) {
            //     $constraint->upsize();
            // });

            Storage::disk('public')->put("images/products/$imageName", $imagen->stream());
            return $imageName;
        } else {
            return false;
        } 
    }
}
