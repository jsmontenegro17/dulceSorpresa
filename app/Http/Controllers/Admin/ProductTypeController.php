<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\ProductType;
use App\Http\Requests\ValidationProductType;


class ProductTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $count=1;
        $product_types = ProductType::orderBy('created_at', 'DESC')->get();
        return view('admin.product-type.index', compact('product_types','count'));    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product-type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidationProductType $request)
    {
        ProductType::create($request->all());
        return redirect('admin/product-type/create')->with('message', 'Tipo de producto creado con exito');
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
    public function edit($product_type_id)
    {
        $product_type = productType::findOrFail($product_type_id);
        return view('admin.product-type.edit', compact('product_type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidationProductType $request, $product_type_id)
    {
        ProductType::findOrFail($product_type_id)->update($request->all());
        return redirect('admin/product-type/')->with('message', 'Tipo de producto editado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($product_type_id)
    {
        ProductType::destroy($product_type_id);
        return redirect('admin/product-type/')->with('message', 'Tipo de producto eliminado correctamente');
    }
}
