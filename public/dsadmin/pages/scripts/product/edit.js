$(document).ready(function () {

	JSMT.validacionGeneral('form-general');

	$("#product_name").focus();
	
	$('.select2').select2();

	$('#product_flavor_color').keyup(function(){

	    var value = $(this).val();

	    var value_without_space = $.trim(value);

	    $(this).val(value_without_space);

	});

	$('#product_flavor_color').focusout(function(){
		var value = $(this).val();
		var value_latest = value[value.length-1];
	    if (value_latest == "," || value_latest == "." ) {
	    	$(this).val(value.slice(0, -1));
	    }
	});

	var image_product = $("#product_image_name").val();

	$("#product_image").fileinput({
	    theme: "fa",
	    language: "es",
	    maxFileSize: 5000,
	    showClose: false,
	    showCaption: false,
	    showZoom: false,
	    browseLabel: 'Cambiar...',
	    browseIcon: '<i class="fa fa-folder-open"></i>',
	    browseClass: 'btn btn-outline-success',
	    removeIcon: '<i class="fa fa-trash-alt"></i>',
	    removeClass: 'btn btn-outline-secondary',
	    elErrorContainer: '#kv-product-errors-1',
	    msgErrorClass: 'alert alert-block alert-danger',
	    defaultPreviewContent: '<img id="product-image-default" src="'+image_product+'">',
	    layoutTemplates: {main2: '{preview} {remove} {browse}'},
	    allowedFileExtensions: ["jpg", "png", "gif"]
	});
	
});