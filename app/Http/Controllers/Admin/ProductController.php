<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Product;
use App\Models\Admin\ProductType;
use App\Http\Requests\ValidationProduct;
use Illuminate\Support\Facades\Storage;



class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $count = 1;
        $products = Product::orderBy('created_at', 'DESC')->with('productType')->get();
        return view('admin.product.index', compact('products', 'count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product_types=  ProductType::orderBy('product_type_id')->get();
        return view('admin.product.create', compact('product_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidationProduct $request)
    {
        
        if($request->product_image ==null){

        }else{

            if($name_image = Product::setImage($request->product_image))
            $request->request->add(['product_image_name' => $name_image]);
        }

        if(isset($request->state)){
            $request->request->add(['product_state' => 'active']);
            
        }else{
            $request->request->add(['product_state' => 'desactive']);
        }

        Product::create($request->all());
        return redirect('admin/product/create')->with('message', 'Producto creado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('admin.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($product_id)
    {

        $product = Product::findOrFail($product_id); 
        $product_types=  ProductType::orderBy('product_type_id')->get();
        return view('admin.product.edit', compact('product','product_types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidationProduct $request, $product_id)
    {
        if($request->file('product_image') == NULL){

            $product = Product::findOrFail($product_id);
            $request->request->add(['product_image_name' => $product->product_image_name]);
            

        }else{
            
            $product = Product::findOrFail($product_id);

            if ($product->product_image_name == NULL) {

                if($name_image = Product::setImage($request->product_image))
                $request->request->add(['product_image_name' => $name_image]);
                

            }else{

                if($name_image = Product::setImage($request->product_image,$product->product_image_name))
                $request->request->add(['product_image_name' => $name_image]);
                
            }
        }

        if(isset($request->state)){
            $request->request->add(['product_state' => 'active']);
            
        }else{
            $request->request->add(['product_state' => 'desactive']);
        }


        Product::findOrFail($product_id)->update($request->all());
        return redirect('admin/product/')->with('message', 'Producto editado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($product_id)
    {
        
        $product = Product::findOrFail($product_id);
        $count_product = count($product->combos);
        if($count_product == 0){

            Storage::disk('public')->delete("images/products/$product->product_image_name");
            Product::destroy($product_id);
            return redirect('admin/product/')->with('message', 'Producto eliminado correctamente');  
        }else{
            return redirect('admin/product/')->with('message', 'Este producto esta siendo utilizado');
        }
    }

    public function state($product_id)
    {
       if($_GET['product_state'] == 'active'){

            $product = Product::find($product_id);
            $product->product_state = 'desactive';
            $product->save();
            return redirect('admin/product/')->with('message', 'Producto desactivado correctamente');

       }else{

            $product = Product::find($product_id);
            $product->product_state = 'active';
            $product->save();   
            return redirect('admin/product/')->with('message', 'Producto activado correctamente');    

       }
    }

    public function editImage($product_id)
    {
        $product = Product::findOrFail($product_id); 
        return view('admin.product.edit-image', compact('product'));
    }

    public function updateimage(Request $request, $product_id)
    {
        $product = Product::findOrFail($product_id);
        if($name_image = Product::setImage($request->product_image, $product->product_image_name))
        $request->request->add(['product_image_name' => $name_image]);

        $product->update($request->all());
        return redirect('admin/product')->with('message', 'Imagen del producto fue cambiada con exito');     
    }
}
