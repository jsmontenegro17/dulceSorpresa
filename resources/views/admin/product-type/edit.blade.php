@extends('dsadmin.layout')

@section('title','Tipo de producto')

@section('scripts')

  <script src="{{asset('dsadmin/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
  <script src="{{asset('dsadmin/plugins/jquery-validation/additional-methods.min.js')}}"></script>
  <script src="{{asset('dsadmin/plugins/jquery-validation/localization/messages_es.min.js')}}"></script>
  <script src="{{asset('dsadmin/pages/scripts/product-type/create.js')}}"></script>
  <script src="{{asset('dsadmin/custom/validation-general.js')}}"></script>

@endsection

@section('styles')



@endsection

@section('content')

<section class="content">

  <!-- Default box -->
  <div class="card">
    <div class="card-header">
      <h3 class="card-title"><strong>Editar Tipo de producto</strong></h3>
      <div class="float-sm-right">
        <a href="{{route('product-type-index')}}">Listado</a> / <a class="active">Editar</a>
      </div>  
    </div>
    <div class="card-body">
      @include('includes.form-error')
      @include('includes.messages')
      <div class="row">
          <!-- left column -->
          <div class="col-md-12">

              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" enctype="multipart/form-data" class="col-md-12" method="POST" action="{{route('product-type-update', ['product_type_id' => $product_type->product_type_id])}}" id="form-general">
                @csrf  @method("put")
                <div class="card-body">
                    <div class="row form-group">
                      <div class="col col-md-12">
                        <label for="exampleInputEmail1">Nombre</label>
                        <input type="text" name="product_type_name" class="form-control" id="product_type_name" placeholder="Nombre del tipo de producto" value="{{old('product_type_name', $product_type->product_type_name?? '')}}" autocomplete="off" required>
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