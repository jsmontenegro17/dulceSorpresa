
<div class="modal-dialog modal-lg">
    <div class="modal-content">
    	<div class="modal-header">
			<h4 class="modal-title text-center"><strong> {{$combo->combo_name}}</strong>({{$combo->comboType->combo_type_name}}) {{$combo->combo_description}}</h4>
            <div class="form-group">
            </div>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="modal-body">
			<div class="row">
          <div class="col-12 col-sm-12">
            <div class="card card-primary card-tabs">
              <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                	<li class="pt-2 px-3"><h3 class="card-title">{{$combo->combo_name}}</h3></li>
                  	<li class="nav-item">
                   	 <a class="nav-link active" id="custom-tabs-one-images-tab" data-toggle="pill" href="#custom-tabs-one-images" role="tab" aria-controls="custom-tabs-one-images" aria-selected="true">Imagenes</a>
                  	</li>
                  	<li class="nav-item">
                   	 <a class="nav-link" id="custom-tabs-one-base-tab" data-toggle="pill" href="#custom-tabs-one-base" role="tab" aria-controls="custom-tabs-one-base" aria-selected="false">Base</a>
                  	</li>
                  	<li class="nav-item">
                   	 <a class="nav-link" id="custom-tabs-one-products-tab" data-toggle="pill" href="#custom-tabs-one-products" role="tab" aria-controls="custom-tabs-one-products" aria-selected="false">Productos</a>
                 	</li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">
                  <div class="tab-pane fade show active" id="custom-tabs-one-images" role="tabpanel" aria-labelledby="custom-tabs-one-images-tab">
                     <div class="row justify-content-center">
                     	@foreach($combo->comboImages as $combo_image)
                     	<div class="col-md-2" style="border: 2px solid #000; padding: 2px; margin: 2px">
                     		<img src="{{Storage::url("images/combos/".$combo_image->combo_image_name)}}" width="100%">
                     	</div>
                     	@endforeach
                     </div>
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-one-base" role="tabpanel" aria-labelledby="custom-tabs-one-base-tab">
                  	<div class="col-md-12 text-center"><h5><strong>{{$combo->base->base_name}}</strong></h5></div>
                  	<div class="row justify-content-center">
                     	@foreach($combo->base->baseImages as $base_images)
                     	<div class="col-md-2" style="border: 2px solid #000; padding: 2px;margin: 2px">
                     		<img src="{{Storage::url("images/bases/".$base_images->base_image_name)}}" width="100%">
                     	</div>
                     	@endforeach
                     </div>
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-one-products" role="tabpanel" aria-labelledby="custom-tabs-one-products-tab">
					<div class="row">
						@foreach($combo->products as $products)
			        	<div class="col-12 col-sm-6 col-md-3">
			            	<div class="info-box">
			              		<span class="elevation-1">
			              			<img src="{{Storage::url("images/products/".$products->product_image_name)}}" width="50">
			              		</span>

			              	<div class="info-box-content">
			                	<span class="info-box-text">{{$products->product_name}}<small> ({{$products->product_trademark}})</small>
                          <br>
                          <small style="width: 100%;">{{$products->product_description}}</small>
                        </span>
			                	<span class="info-box-number">
			                 	 {{$products->pivot->units}}
			                  	<small>Unidades</small>
			                	</span>
			              	</div>		 
			           		</div>
			        	</div>
			        	@endforeach
			        </div>
                  </div>
                </div>
              </div>
              <!-- /.card -->
            </div>
          </div>
		</div>
	</div>
</div>