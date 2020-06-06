<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ValidationCombo;
use App\Models\Admin\Product;
use App\Models\Admin\Combo;
use App\Models\Admin\ComboProduct;
use App\Models\Admin\ComboType;
use App\Models\Admin\Base;
use Illuminate\Support\Str;
use Intervention\Image\Facades\image;
use Illuminate\Support\Facades\Storage;




class ComboController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $count = 1;
        $combos = Combo::orderBy('created_at', 'DESC')->with('comboImages','comboType','base','products')->get();
        return view('admin.combo.index', compact('combos', 'count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $combo_types = ComboType::orderBy('created_at', 'DESC')->get();
        $products = Product::where('product_state', 'active')->orderBy('created_at', 'DESC')->with('productType')->get();
        $bases = Base::orderBy('created_at', 'DESC')->get();
        return view('admin.combo.create', compact('combo_types','products','bases'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidationCombo $request)
    {

        if(isset($request->state)){
            $request->request->add(['combo_state' => 'active']);
            
        }else{
            $request->request->add(['combo_state' => 'desactive']);
        }


        $manyToMany = array();
        for ( $i=0 ; $i< count($request->product_id); $i++ )
        {
            $manyToMany[ $request->product_id[$i] ] = ['units' => $request->units[$request->product_id[$i]]];
        }

        $combo = Combo::create($request->all());
        $combo->products()->sync($manyToMany);

        $combos = Base::all()->last();
        $combo_id = $combos->combo_id;
        
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
    public function show(Combo $combo)
    {

        return view('admin.combo.show', compact('combo'));
        
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

    public function state($combo_id)
    {
       if($_GET['combo_state'] == 'active'){

            $combo = combo::find($combo_id);
            $combo->combo_state = 'desactive';
            $combo->save();
            return redirect('admin/combo/')->with('message', 'combo desactivado correctamente');

       }else{

            $combo = combo::find($combo_id);
            $combo->combo_state = 'active';
            $combo->save();   
            return redirect('admin/combo/')->with('message', 'combo activado correctamente');    

       }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($combo_id)
    {
        $combo =  Combo::findOrFail($combo_id);
        combo::destroy($combo_id);
        
        foreach ($combo->comboImages as $combo_image) {
            Storage::disk('public')->delete("images/combos/$combo_image->combo_image_name");  
        }

        
        return redirect('admin/combo/')->with('message', 'combo eliminado correctamente');
    }
}
