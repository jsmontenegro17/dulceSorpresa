<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Combo;
use Illuminate\Support\Str;
use Intervention\Image\Facades\image;
use Illuminate\Support\Facades\Storage;

class ComboImage extends Model
{
    protected $fillable = ['combo_image_name', 'combo_id'];
    protected $primaryKey = 'combo_image_id';

    public function combo()
    {
        return $this->belongsTo(combo::class, 'combo_id');
    }

    public static function setImage($combo_image, $actual = false)
    {
        if ($combo_image) {
            if ($actual) {
                Storage::disk('public')->delete("images/combos/$actual");
            }
            $imageName = Str::random(20) . '.jpg';

            $imagen = Image::make($combo_image)->encode('jpg', 75);
            // $imagen->resize(65, 65, function ($constraint) {
            //     $constraint->upsize();
            // });

            Storage::disk('public')->put("images/combos/$imageName", $imagen->stream());
            return $imageName;
        } else {
            return false;
        } 
    }  
}
