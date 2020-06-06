@extends('dsadmin.layout')

@section('title','Base')

@section('scripts')

  <script src="{{asset('dsadmin/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
  <script src="{{asset('dsadmin/plugins/jquery-validation/additional-methods.min.js')}}"></script>
  <script src="{{asset('dsadmin/plugins/jquery-validation/localization/messages_es.min.js')}}"></script>
  <script src="{{asset('dsadmin/pages/scripts/base/create.js')}}"></script>
  <script src="{{asset('dsadmin/custom/validation-general.js')}}"></script>
  <script src="{{asset('dsadmin/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>

{{--   <script src="{{asset('dsadmin/plugins/bootstrap-fileinput/js/fileinput.min.js')}}"></script>
  <script src="{{asset('dsadmin/plugins/bootstrap-fileinput/js/locales/es.js')}}"></script>
  <script src="{{asset('dsadmin/plugins/bootstrap-fileinput/themes/fa/theme.min.js')}}"></script> --}}

@endsection

@section('styles')
  <link href="{{asset("dsadmin/plugins/bootstrap-fileinput/css/fileinput.min.css")}}" rel="stylesheet" type="text/css"/>
@endsection

@section('content')

<section class="content">

  <!-- Default box -->
  <div class="card">
    <div class="card-header">
      <h3 class="card-title"><strong>Crear base</strong></h3>
      <div class="float-sm-right">
        <a href="{{route('base-index')}}">Listado</a> / <a class="active">Crear</a>
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
              <form role="form" enctype="multipart/form-data" class="col-md-12" method="POST" action="{{route('base-store')}}" id="form-general">
                @csrf
                <div class="card-body">
                    <div class="row form-group">
                      <div class="col col-md-6">
                        <label for="exampleInputEmail1">Nombre</label>
                        <input type="text" name="base_name" class="form-control lowercase" id="base_name" placeholder="Nombre de la base" value="{{old('base_name')}}" autocomplete="off" required>
                      </div>
                      <div class="col col-md-6">
                        <label for="exampleInputEmail1">Medidas</label>
                        <input type="text" name="base_measure" class="form-control lowercase" id="base_measure" placeholder="Medidas de la base" value="{{old('base_measure')}}" autocomplete="off" required>
                      </div>
                    </div>
                    <div class="row form-group">                      
                      <div class="col col-md-12">
                        <label for="exampleInputEmail1">Descripción</label>
                        <textarea id="base_description" name="base_description" class="form-control lowercase" placeholder="Alguna referencia más de esta base" required>{{old('base_description')}}</textarea>
                      </div>                     
                    </div>                                                          
                    <div class="row form-group">
                      <div class="col-md-3">
                        <label for="exampleInputEmail1">Precio</label>
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                          </div>
                          <input type="number" name="base_price" class="form-control" id="base_price" placeholder="precio de la base" value="{{old('base_price')}}" autocomplete="off" required>
                        </div>
                      </div>                      
                      <div class="col-md-7">
                        <label for="base_image" id="label-base-image">Selecciona las imagenes</label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" multiple="multiple" data-count="4" class="custom-file-input" name="base_image[]" id="base_image">
                            <label class="custom-file-label" for="base_image">da click aquí para seleccionarlas max 4</label>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <label for="customSwitch3">Desactivo/Activo</label>
                          <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                            <input type="checkbox" checked="checked" class="custom-control-input" id="customSwitch3" name="state">
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