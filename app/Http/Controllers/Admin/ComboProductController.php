<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Combo;
use App\Models\Admin\ComboType;
use App\Models\Admin\ComboProduct;
use App\Models\Admin\ComboImage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\image;
use Illuminate\Support\Facades\Storage;


class ComboProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $combo_id)
    {

/////////////////////////////////////////////////////////////////////////////////////////

// SE ACTUALIZA LOS CAMPOS QUE HACE FALTA DE LA TABLA COMBO

        if(isset($request->state)){
            $request->request->add(['combo_state' => 'active']);
            
        }else{
            $request->request->add(['combo_state' => 'desactive']);
        }

        Combo::findOrFail($combo_id)->update($request->all());

/////////////////////////////////////////////////////////////////////////////////////////

// REGISTRO DE PRODUCTO A LA TABLA RELACIONADA CON COMBO (combo_product)

        $products = $request->product;
        $units = $request->units;
        $count = count($products);

        for ($i=0; $i < $count ; $i++) { 
            
            ComboProduct::create([
                'combo_id' => $combo_id,
                'product_id' => $products[$i],
                'units' => $units[$i]
            ]);

        }
/////////////////////////////////////////////////////////////////////////////////////////

// REGISTRO DE LAS IMAGENES DEL COMBO A LA TABLA COMBO_IMAGE
        // dd($request);

        
        $combo_images = $request->file('combo_image');

        if ($combo_images==NULL) {
            
        }else{

            $uploadcount = 0;

            foreach($combo_images as $combo_image)
            {
                $image_name = Str::random(50) . '.jpg';
                $imagen[] = Image::make($combo_image)->encode('jpg', 75);
                $images_names[] = $image_name;  

                Storage::disk('public')->put("images/combos/$images_names[$uploadcount]", $imagen[$uploadcount]->stream());

                $request->request->add(['combo_image_name' => $images_names[$uploadcount]]);
                $request->request->add(['combo_id' => $combo_id]);

                ComboImage::create($request->all());

                $uploadcount++;
            }
        }


        return redirect('admin/combo')->with('message', 'Combo creado con exito');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
