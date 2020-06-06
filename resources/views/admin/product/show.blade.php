
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<h4 class="modal-title"><strong> {{$product->product_name}} </strong>({{$product->product_description}})</h4>
            <div class="form-group">
            </div>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="modal-body" >
			<img height="auto" width="100%" src="{{Storage::url("images/products/".$product->product_image_name)}}">
		</div>
	{{--           <div class="modal-footer justify-content-between">
	<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
	</div> --}}
	</div>
<!-- /.modal-content -->
</div>