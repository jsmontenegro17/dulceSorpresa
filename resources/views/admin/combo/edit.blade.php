@extends('dsadmin.layout')

@section('title','Producto')

@section('scripts')

  <script src="{{asset('dsadmin/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
  <script src="{{asset('dsadmin/plugins/jquery-validation/additional-methods.min.js')}}"></script>
  <script src="{{asset('dsadmin/plugins/jquery-validation/localization/messages_es.min.js')}}"></script>
  <script src="{{asset('dsadmin/pages/scripts/product/create.js')}}"></script>
  <script src="{{asset('dsadmin/custom/validation-general.js')}}"></script>
  <script src="{{asset('dsadmin/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>


{{--   <script src="{{asset('dsadmin/plugins/bootstrap-fileinput/js/fileinput.min.js')}}"></script>
  <script src="{{asset('dsadmin/plugins/bootstrap-fileinput/js/locales/es.js')}}"></script>
  <script src="{{asset('dsadmin/plugins/bootstrap-fileinput/themes/fa/theme.min.js')}}"></script> --}}

@endsection

@section('styles')
  <link rel="stylesheet" href="{{asset("dsadmin//plugins/toastr/toastr.min.css")}}">
  <link href="{{asset("dsadmin/plugins/bootstrap-fileinput/css/fileinput.min.css")}}" rel="stylesheet" type="text/css"/>

@endsection

@section('content')

<section class="content">

  <!-- Default box -->
  <div class="card">
    <div class="card-header">
      <h3 class="card-title"><strong>Editar este producto</strong></h3>
      <div class="float-sm-right">
        <a href="{{route('product-index')}}">Listado</a> / <a class="active">Editar</a>
      </div>  
    </div>
    <div class="card-body">
      @include('includes.form-error')
      <div class="row">
          <!-- left column -->
          <div class="col-md-12  ">
          <!-- /.card-header -->
              <!-- form start -->
              <form role="form" enctype="multipart/form-data" class="col-md-12" method="POST" action="{{route('product-update', ['product_id' => $product->product_id])}}" id="form-general">
                @csrf @method("put")
                <div class="card-body">
                    <div class="row form-group">
                      <div class="col-md-6">
                      <label for="exampleInputEmail1">Nombre</label>
                      <input type="text" name="product_name" class="form-control" id="product_name" placeholder="Nombre del producto" value="{{old('product_name', $product->product_name ?? '')}}" autocomplete="off" required>
                      </div>
                      <div class="col-md-6">
                        <label for="exampleInputEmail1">Marca</label>
                        <input type="text" name="product_trademark" class="form-control" id="product_trademark" placeholder="Marca del producto" value="{{old('product_trademark', $product->product_trademark ?? '')}}" autocomplete="off" required>
                      </div>
                    </div>  
                    <div class="row form-group">
                      <div class="col col-md-6">
                        <label>Tipo de producto</label>
                        <select class="form-control bs-select" name="product_type_id" id="product_type_id" required>
                          <option value="{{$product->productType->product_type_id}}">{{$product->productType->product_type_name}}</option>
                          @foreach($product_types as $product_type)
                            <option value="{{$product_type->product_type_id}}">{{$product_type->product_type_name}}</option>
                          @endforeach
                        </select>
                      </div>                       
                      <div class="col-md-6">
                        <label for="exampleInputEmail1">Descripción</label>
                        <textarea id="product_description" name="product_description" class="form-control" placeholder="Sabor, medida o cantidad" required>{{old('product_description', $product->product_description ?? '')}}</textarea>
                      </div>   
                    </div>                                                        
                    <div class="row form-group">
                      <div class="col-md-3">
                        <label for="exampleInputEmail1">Precio</label>
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                          </div>
                          <input type="number" name="product_price" class="form-control" id="product_price" placeholder="precio de producto" value="{{old('product_price', $product->product_price ?? '')}}" autocomplete="off" required>
                        </div>
                      </div>
                      <div class="col-md-7">
                        <label for="exampleInputFile">Selecciona otra imagen si la deseas cambiar</label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" name="product_image" id="exampleInputFile">
                            <label class="custom-file-label" for="exampleInputFile">da click aquí para seleccionarla</label>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <label for="exampleInputFile">Desactivo/Activo</label>
                          <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                            @if($product->product_state == 'desactive')
                              <input type="checkbox" class="custom-control-input" id="customSwitch3" name="state">
                            @else
                              <input type="checkbox" checked="checked" class="custom-control-input" id="customSwitch3" name="state">
                            @endif
                            <label class="custom-control-label" for="customSwitch3"></label>
                          </div>
                        </div>
                      </div>                      
                    </div>
                  </div>  

                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
    <!-- /.card-body -->
    <div class="card-footer">
      {{-- Footer --}}
    </div>
    <!-- /.card-footer-->
  </div>
  <!-- /.card -->

</section>

@endsection