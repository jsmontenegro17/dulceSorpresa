@extends('dsadmin.layout')

@section('title','Producto')

@section('scripts')

  <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="{{asset('dsadmin/pages/scripts/product/index.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.js"></script>

  <script>
    $(document).on('click','[data-toggle="lightbox"]', function(event){
      event.preventDefault();
      $(this).ekkoLightbox({
        alwaysShowClose: true
      });
    });
  </script>

@endsection

@section('styles')
<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
@endsection


@section('content')

  <section class="content">

<!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title"><strong>Productos</strong></h3>
      </div>
      <div class="card-body">
      @include('includes.messages')
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Listado</h3>
                <div class="card-tools">
                  <a href="{{route('product-create')}}" class="btn btn-block btn-outline-info">
                    <i class="fas fa-plus"></i> Agregar
                  </a>
                </div>
              </div>         
              <div class="card-body table-responsive p-0">
                <br>
                <table class="table table-hover text-nowrap hover" id="table-products">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Imagen</th>
                      <th>Nombre</th>
                      <th>Marca</th>
                      <th>Tipo</th>
                      <th>Precio</th>
                      <th class="text-center">Estado</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($products as $product)
                      <tr>
                        <td class="align-middle">{{$count++}}</td>
                        <td>
                          @if($product->product_image_name == "")
                          <div class="product-image-thumb justify-content-center" style="width: 42px; height: auto;">
                              <a href="{{route('product-image-edit', ['product_id' => $product->product_id])}}" style="font-size: 24px;  color:#17a2b0"><i class="fa fa-plus-circle"></i></a>
                            </div>
                          @else
                          <div class="product-image-thumb" style="width: 42px; height: auto;">
                            <a href="{{Storage::url("images/products/".$product->product_image_name)}}" data-gallery="product-gallery-{{$product->product_id}}" data-title="{{$product->product_name}} </strong>({{$product->product_trademark}})" data-footer="<a href='{{route('product-image-edit', ['product_id' => $product->product_id])}}' class='btn btn-success' title='Cambiar imagen'><i class='fa fa-exchange-alt'></i></a>" data-toggle="lightbox">
                            <img src="{{Storage::url("images/products/".$product->product_image_name)}}">
                            </a>
                          </div> 
                          @endif 
                        </td>
                        <td class="align-middle">{{$product->product_name}}</td>
                        <td class="align-middle">{{$product->product_trademark}}</td>
                        <td class="align-middle">{{$product->productType->product_type_name}}</td>
                        <td class="align-middle">$ {{$product->product_price}}</td>
                        <td class="text-center align-middle">
                          <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                            @if($product->product_state == 'desactive')
                            <input type="checkbox" data-url="{{route('product-change-state', ['product_id' => $product->product_id, 'product_state' => $product->product_state])}}" class="custom-control-input change-state" id="{{$product->product_id}}" name="state">
                            @else
                            <input type="checkbox" data-url="{{route('product-change-state', ['product_id' => $product->product_id, 'product_state' => $product->product_state])}}" checked="checked" class="custom-control-input change-state" id="{{$product->product_id}}" name="state">
                            @endif
                            <label class="custom-control-label" for="{{$product->product_id}}"></label>
                          </div>
                        </td>
                        <td class="text-right py-0 align-middle">
                          <div class="btn-group btn-group-sm">
                          <a href="{{route('product-show', $product)}}" class="btn btn-info product-show" data-toggle="modal" data-target="#modal-default"><i class="fas fa-eye"></i></a>
                          @csrf
                          <a href="{{route('product-edit', ['product_id' => $product->product_id])}}" class="btn btn-success" title="Editar"><i class="fas fa-edit"></i></a>
                          <a href="{{route('product-destroy', ['product_id' => $product->product_id])}}" class="btn btn-danger product-destroy"><i class="fas fa-trash"></i></a>
                        </div>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="modal-product-show">
      <!-- /.modal-dialog -->
      </div>  
      <div class="card-footer">
      {{-- Footer --}}
      </div>
<!-- /.card-footer-->
  </div>
<!-- /.card -->
</section>

@endsection