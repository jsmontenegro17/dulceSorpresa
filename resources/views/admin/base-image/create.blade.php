@extends('dsadmin.layout')

@section('title','Base')

@section('scripts')

  <script src="{{asset('dsadmin/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
  <script src="{{asset('dsadmin/plugins/jquery-validation/additional-methods.min.js')}}"></script>
  <script src="{{asset('dsadmin/plugins/jquery-validation/localization/messages_es.min.js')}}"></script>
  <script src="{{asset('dsadmin/pages/scripts/base-image/create.js')}}"></script>
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
@php
	$count_img = count($base->baseImages);
	$add_img = 4 - $count_img;
 @endphp
  <!-- Default box -->
  <div class="card">
    <div class="card-header">
    @if($add_img == 1)	
        <h3 class="card-title"><strong>Agregar la imagen que hace falta de la {{$base->base_name}}</strong></h3>
    @else
    	<h3 class="card-title"><strong>Agrega las {{$add_img}} imagenes de la {{$base->base_name}} que hacen falta o tambien puedes agregar solo una</strong></h3>
    @endif  
      <div class="float-sm-right">
        <a href="{{route('base-index')}}">Listado</a> / <a class="active">Agregar Imagen</a>
      </div>  
    </div>
    <div class="card-body">
      @include('includes.form-error')
      <div class="row">
          <!-- left column -->
          <div class="col-md-12  ">
          <!-- /.card-header -->
              <!-- form start -->
              <form role="form" enctype="multipart/form-data" class="col-md-12" method="POST" action="{{route('base-image-store')}}" >
                @csrf
                <div class="card-body">                                                      
                    <div class="row form-group justify-content-center">
                      <div class="row col-md-10">
                        <label for="base_image" id="label-base-image">
                        	Seleccionar
                        </label>
                        <div class="input-group col-md-11">
                          <div class="custom-file">
                          	<input type="hidden" name="base_id" value="{{$base->base_id}}">
                            <input type="file" data-count="{{$add_img}}"  class="custom-file-input" name="base_image[]" id="base_image" accept="image/png, .jpeg, .jpg, image/gif" multiple="multiple">
                            <label class="custom-file-label" for="base_image">da click aquí para seleccionarla</label>
                          </div>
                          <div class="form-group col-md-1">
                            <button type="submit" id="save_image" class="btn btn-primary">Guardar</button>
                          </div>
                        </div>
                      </div>                    
                    </div>

                  </div>  

                <!-- /.card-body -->
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