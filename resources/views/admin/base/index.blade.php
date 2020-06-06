@extends('dsadmin.layout')

@section('title','Base')

@section('scripts')

  <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="{{asset('dsadmin/pages/scripts/base/index.js')}}"></script>
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
  <link href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css" rel="stylesheet">
  <style type="text/css">
    .ekko-lightbox-nav-overlay a{
      -webkit-text-stroke: 2px black;
      background-color: rgba(0,0,0,0.1);
      color: #fff;
      font-size: 50px;

    }
  </style>
@endsection

@section('content')

<section class="content">

  <!-- Default box -->
  <div class="card">
    <div class="card-header">
      <h3 class="card-title"><strong>Bases</strong></h3>
    </div>
    <div class="card-body">
      @include('includes.messages')
      <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Listado</h3>
                <div class="card-tools">
                  <a href="{{route('base-create')}}" class="btn btn-block btn-outline-info">
                    <i class="fas fa-plus"></i> Agregar
                  </a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <br>
                <table class="table table-hover text-nowrap" id="table-bases">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Imagenes</th>
                      <th>Nombre</th>
                      <th>Medidas</th>
                      <th>Descripción</th>
                      <th>Precio</th>
                      <th class="text-center">Estado</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <form id="form-image" enctype="multipart/form-data">
                    @foreach($bases as $base)
                    <tr>
                      <td class="align-middle">{{$count++}}</td>
                      <td class="justify-content-center">
                        <div class="row">
                        @php $count_image = 0; @endphp
                        @foreach($base->baseImages as $base_image)
                        <div class="product-image-thumb">
                          <a href="{{Storage::url("images/bases/".$base_image->base_image_name)}}" data-gallery="base-gallery-{{$base->base_id}}" data-title="{{$base->base_name}} </strong>({{$base->base_description}})" data-footer="<a href='{{route('base-image-edit', ['base_image_name' => $base_image->base_image_name])}}' class='btn btn-success' title='Cambiar imagen'><i class='fa fa-exchange-alt'></i></a><a href='{{route('base-image-destroy', ['base_image_name' => $base_image->base_image_name])}}'  class='btn btn-danger base-destroy' title='Eliminar imagen'><i class='fas fa-trash'></i></a>" data-toggle="lightbox">
                            <img class="base-image" width="24px" height="32px" src="{{Storage::url("images/bases/".$base_image->base_image_name)}}">
                          </a>
                         </div> 
                         @php $count_image++; @endphp
                        @endforeach
                        @if($count_image < 4)
                          @php $for =  4 - $count_image;  @endphp
                          @for($i = 0; $i < $for; $i++)
                            <div class="product-image-thumb justify-content-center">
                              <a href="{{route('base-image-create', $base)}}" style="font-size: 24px; color:#17a2b0"><i class="fa fa-plus-circle"></i></a>
                            </div>
                          @endfor  
                        @endif                                               
                        </div>
                      </td>
                      <td class="align-middle">{{$base->base_name}}</td>
                      <td class="align-middle">{{$base->base_measure}}</td>
                      <td class="align-middle">{{$base->base_description}}</td>
                      <td class="align-middle">$ {{$base->base_price}}</td>
                      <td class="text-center align-middle">
                        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                          @if($base->base_state == 'desactive')
                            <input type="checkbox" data-url="{{route('base-change-state', ['base_id' => $base->base_id, 'base_state' => $base->base_state])}}" class="custom-control-input change-state" id="{{$base->base_id}}" name="state">
                          @else
                            <input type="checkbox" data-url="{{route('base-change-state', ['base_id' => $base->base_id, 'base_state' => $base->base_state])}}" checked="checked" class="custom-control-input change-state" id="{{$base->base_id}}" name="state">
                          @endif
                          <label class="custom-control-label" for="{{$base->base_id}}"></label>
                        </div>
                      </td>
                      <td class="text-right py-0 align-middle">
                        <div class="btn-group btn-group-sm">
                          <a href="{{route('base-show', $base)}}" class="btn btn-info base-show" data-toggle="modal" data-target="#modal-default"><i class="fas fa-eye"></i></a>
                          @csrf
                          <a href="{{route('base-edit', ['base_id' => $base->base_id])}}" class="btn btn-success" title="Editar"><i class="fas fa-edit"></i></a>
                          <a href="{{route('base-destroy', ['base_id' => $base->base_id])}}" class="btn btn-danger base-destroy"><i class="fas fa-trash"></i></a>
                        </div>
                      </td>
                    </tr>
                    @endforeach
                  </form>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
    </div>
    <div class="modal fade" id="modal-base-show">
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