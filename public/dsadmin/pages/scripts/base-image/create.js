$(document).ready(function () {

JSMT.validacionGeneral('form-general');

$("#base_image").on('change',function(event){

	var jquery_count = this.files.length;
	var image_count = $(this).attr('data-count');

	if(jquery_count <= image_count){

		$('#save_image').removeAttr('disabled','disabled');
		$(this).removeClass('is-invalid');
		$("#error-image").remove();

	}else{

		$(this).addClass('is-invalid');
		$('#save_image').attr('disabled','disabled');
		$("#label-base-image").append("<span id='error-image' style='color: red; font-size: 12px;'>No puedes selecionar más de "+image_count+" imagenes</span>");
	}

});

});