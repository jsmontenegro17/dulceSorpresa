@extends('dsadmin.layout')

@section('title','Combo-Producto')

@section('scripts')

  <script src="{{asset('dsadmin/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}"></script>
  <script src="{{asset('dsadmin/plugins/select2/js/select2.full.min.js')}}"></script>
  <script src="{{asset('dsadmin/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
  <script src="{{asset('dsadmin/plugins/jquery-validation/additional-methods.min.js')}}"></script>
  <script src="{{asset('dsadmin/plugins/jquery-validation/localization/messages_es.min.js')}}"></script>
  <script src="{{asset('dsadmin/pages/scripts/combo-product/create.js')}}"></script>
  <script src="{{asset('dsadmin/custom/validation-general.js')}}"></script>
  <script src="{{asset('dsadmin/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
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
  <link href="{{asset("dsadmin/plugins/icheck-bootstrap/icheck-bootstrap.min.css")}}" rel="stylesheet" type="text/css"/>
  <link href="{{asset("dsadmin/plugins/select2/css/select2.min.cs")}}" rel="stylesheet" type="text/css"/>
  <link href="{{asset("dsadmin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css")}}" rel="stylesheet" type="text/css"/>
  <link href="{{asset("dsadmin/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css")}}" rel="stylesheet" type="text/css"/>
  <style type="text/css">
    .ekko-lightbox-nav-overlay a{
      -webkit-text-stroke: 2px black;
      background-color: rgba(0,0,0,0.1);
      color: #fff;
      font-size: 50px;

    }
  </style>
  <link href="{{asset("dsadmin/plugins/bootstrap-fileinput/css/fileinput.min.css")}}" rel="stylesheet" type="text/css"/>
@endsection

@section('content')

<section class="content">

  <!-- Default box -->
  <div class="card">
    <div class="card-header">
      <h3 class="card-title"><strong>Crear combo</strong></h3>
      <div class="text-right">
          Precio sin ganancia : <strong>$ </strong><label id="label_price"></label>
      </div>  
    </div>
    <div class="card-body">
      @include('includes.form-error')
      @include('includes.messages')
      <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <div class="col-12 col-sm-12">
            <div class="card card-primary card-tabs">
              <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-two-home-tab" data-toggle="pill" href="#custom-tabs-two-home" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true">Productos</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-two-profile-tab" data-toggle="pill" href="#custom-tabs-two-profile" role="tab" aria-controls="custom-tabs-two-profile" aria-selected="false">Base</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-two-messages-tab" data-toggle="pill" href="#custom-tabs-two-messages" role="tab" aria-controls="custom-tabs-two-messages" aria-selected="false">Precio</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-two-images-tab" data-toggle="pill" href="#custom-tabs-two-images" role="tab" aria-controls="custom-tabs-two-images" aria-selected="false">Completar</a>
                  </li>                
                </ul>

              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-two-tabContent">
                  <div class="tab-pane fade show active" id="custom-tabs-two-home" role="tabpanel" aria-labelledby="custom-tabs-two-home-tab">
                    <div class="card-body col-md-12">
                      <div class="card">
                        <div class="card-header">
                          <h3 class="card-title"><strong>Productos que vas a ultizar, Cantidad por unidad</strong></h3>

                        </div>
                        <form role="form" enctype="multipart/form-data" class="col-md-12" method="POST" action="{{route('combo-product-store', ['combo_id' => $combo_last->combo_id])}}" id="form-general">
                        @csrf @method("put")
                        <div class="row card-body">
                          @foreach($products as $product)
                          <div class="col-md-2" style="margin-top: 15px">
                            <div class="product-image-thumb">
                              <img class="combo-image" width="38px" height="51px" src="{{Storage::url("images/products/".$product->product_image_name)}}">
                              <input type="number" class="product_units" data-price="{{$product->product_price}}" min="1" data-price-total="{{$product->product_price}}" name="units[]" id="units" value="{{old("units") ?: '1'}}" style="width: 55px; height: 51px; padding: 9px; font-size: 30px; margin: 5px;">
                              <input type="hidden" name="product[]" value="{{$product->product_id}}">

                            </div> 
                            <label>Nombre :  {{$product->product_name}}</label>
                            <label>Descripcion :  {{$product->product_description}}</label>
                            <label>Precio : $ {{$product->product_price}}</label>
                          </div>
                          @endforeach
                        </div>

                      </div>
                    </div> 
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-two-profile" role="tabpanel" aria-labelledby="custom-tabs-two-profile-tab">
                    <div class="card-body col-md-12">
                      <div class="card">
                        <div class="card-header">
                          <h3 class="card-title"><strong>Que base deseas usar para este combo</strong></h3>
                        </div>
                        <div class="row card-body">
                          <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th>Imagenes</th>
                                  <th>Nombre</th>
                                  <th>Medidas</th>
                                  <th>Descripción</th>
                                  <th>Precio</th>
                                  <th class="text-center"></th>
                                  <th></th>
                                </tr>
                              </thead>
                              <tbody>@php $count = 1; @endphp
                                <form id="form-image" enctype="multipart/form-data">
                                @foreach($bases as $base)
                                <tr>
                                  <td class="align-middle">{{$count++}}</td>
                                  <td class="justify-content-center">
                                    <div class="row">
                                    @php $count_image = 0; @endphp
                                    @foreach($base->baseImages as $base_image)
                                    <div class="product-image-thumb">
                                      <a href="{{Storage::url("images/bases/".$base_image->base_image_name)}}" data-gallery="base-gallery-{{$base->base_id}}" data-title="{{$base->base_name}} </strong>({{$base->base_description}})" data-toggle="lightbox">
                                        <img class="base-image" width="24px" height="32px" src="{{Storage::url("images/bases/".$base_image->base_image_name)}}">
                                      </a>
                                     </div> 
                                     @php $count_image++; @endphp
                                    @endforeach                                             
                                    </div>
                                  </td>
                                  <td class="align-middle">{{$base->base_name}}</td>
                                  <td class="align-middle">{{$base->base_measure}}</td>
                                  <td class="align-middle">{{$base->base_description}}</td>
                                  <td class="align-middle">$ {{$base->base_price}}</td>
                                  <td class="align-middle">
                                    <div class="icheck-primary d-inline">
                                      <input type="radio" class="base" id="radioPrimary{{$base->base_id}}" name="base_id" data-price-before="0" data-price-base="{{$base->base_price}}" value="{{$base->base_id}}"{{ (is_array(old('base_id')) and in_array($base->base_id, old('base_id'))) ? ' checked' : '' }} required>
                                      <label for="radioPrimary{{$base->base_id}}">
                                      </label>
                                    </div>
                                  </td>
                                </tr>
                                @endforeach
                              </tbody>
                            </table>
                        </div>
                       </div>
                      </div>                
                      <!-- /.card -->
                    </div>
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-two-messages" role="tabpanel" aria-labelledby="custom-tabs-two-messages-tab">
                     <div class="row form-group">
                        <div class="col-md-2">
                          <label for="exampleInputEmail1">Precio sin ganancia</label>
                          <div class="input-group mb-6">
                            <div class="input-group-prepend">
                              <span class="input-group-text">$</span>
                            </div>
                            <input type="number" name="price" class="form-control" id="price" placeholder="precio de combo" value="{{old('price')}}" autocomplete="off" required disabled>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <label for="exampleInputEmail1">Que porcentaje deseas ganar</label>
                          <div class="input-group mb-6">
                            <div class="input-group-prepend">
                              <span class="input-group-text">%</span>
                            </div>
                            <input type="text" name="porcentage" class="form-control" id="porcentage" placeholder="porcentaje" value="{{old('porcentage')}}" autocomplete="off"  required>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <label for="exampleInputEmail1">ganancia</label>
                          <div class="input-group mb-6">
                            <div class="input-group-prepend">
                              <span class="input-group-text">$</span>
                            </div>
                            <input type="number" name="gain" class="form-control" id="gain" placeholder="Ingrese el porcentaje" value="{{old('gain')}}" autocomplete="off"  required disabled>
                          </div>
                        </div>                        
                        <div class="col-md-4">
                          <label for="exampleInputEmail1">Precio más ganancia</label>
                          <div class="input-group mb-6">
                            <div class="input-group-prepend">
                              <span class="input-group-text">$</span>
                            </div>
                            <input type="number" name="price_gain" class="form-control" id="price_gain" placeholder="Ingrese el porcentaje" value="{{old('price_gain')}}" autocomplete="off" required disabled>
                            <input type="hidden" name="combo_price" id="combo_price" >
                          </div>
                        </div>                        
                      </div> 
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-two-images" role="tabpanel" aria-labelledby="custom-tabs-two-iamges-tab">
                    <div class="row form-group">                      
                        <div class="col-md-10">
                          <label for="combo_image" id="label-combo-image">Selecciona las imagenes</label>
                          <div class="input-group">
                            <div class="custom-file">
                              <input type="file" multiple="multiple" data-count="4" class="custom-file-input" name="combo_image[]" id="combo_image">
                              <label class="custom-file-label" for="combo_image">da click aquí para seleccionarlas max 4</label>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-2">
                          <div class="form-group">
                            <label for="exampleInputFile">Desactivo/Activo</label>
                            <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                              <input type="checkbox" checked="checked" class="custom-control-input" id="customSwitch3" name="state">
                              <label class="custom-control-label" for="customSwitch3"></label>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <!-- /.card -->
            </div>
          </div>
        </div>
              <!-- /.card-header -->
              <!-- form start -->




          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
      </div>
    <!-- /.card-body -->
    </div>
    <div class="card-footer">
      {{-- Footer --}}
    </div>
    <!-- /.card-footer-->
  </div>
  <!-- /.card -->

</section>

@endsection