<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Base;
use App\Models\Admin\BaseImage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\image;
use Illuminate\Support\Facades\Storage;

class BaseImageController extends Controller
{

	public function create(Base $base)
	{
		return view('admin.base-image.create', compact('base'));
	}

	public function store(Request $request)
	{
		$base_images = $request->file('base_image');
		$uploadcount = 0;

		foreach($base_images as $base_image)
        {
        	$image_name = Str::random(50) . '.jpg';
        	$imagen[] = Image::make($base_image)->encode('jpg', 75);
            $images_names[] = $image_name;  

            Storage::disk('public')->put("images/bases/$images_names[$uploadcount]", $imagen[$uploadcount]->stream());

            $request->request->add(['base_image_name' => $images_names[$uploadcount]]);

            BaseImage::create($request->all());

            $uploadcount++;
        }
		return redirect('admin/base')->with('message', 'Imagen agregada con exito'); 
	}

    public function edit($base_image_name)
    {
    	$base = BaseImage::where('base_image_name', $base_image_name)->with('base')->first();
    	return view('admin.base-image.edit', compact('base', 'base_image_name'));
    }

    public function update(Request $request, $base_image_name)
    {
    	if($name_image = BaseImage::setImage($request->base_image, $base_image_name))
        $request->request->add(['base_name_image' => $name_image]);

		BaseImage::where('base_image_name', $base_image_name)
          	->update(['base_image_name' => $name_image]);

        return redirect('admin/base')->with('message', 'Imagen de la base fue cambiada con exito');  	
    }

    public function destroy($base_image_name)
    {
    	$deletedRows = BaseImage::where('base_image_name', $base_image_name)->delete();
    	Storage::disk('public')->delete("images/bases/$base_image_name");
        return redirect('admin/base/')->with('message', 'Imagen de la base eliminada con exito');

    }    
}
