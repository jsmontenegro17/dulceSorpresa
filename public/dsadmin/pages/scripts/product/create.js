
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

	$("#product_image").fileinput({
	    theme: "fa",
	    language: "es",
	    maxFileSize: 5000,
	    showClose: false,
	    showCaption: false,
	    showZoom: false,
	    browseLabel: 'Buscar...',
	    browseIcon: '<i class="fa fa-folder-open"></i>',
	    browseClass: 'btn btn-outline-info',
	    removeIcon: '<i class="fa fa-trash-alt"></i>',
	    removeClass: 'btn btn-outline-secondary',
	    elErrorContainer: '#kv-product-errors-1',
	    msgErrorClass: 'alert alert-block alert-danger',
	    defaultPreviewContent: '<img id="product-image-default" src="https://www.dropbox.com/s/0zvf0jmjo2b9cz2/1f3f7.png?raw=1" alt="Imagen del producto" id="product_image">',
	    layoutTemplates: {main2: '{preview} {remove} {browse}'},
	    allowedFileExtensions: ["jpg", "png", "gif"]
	});

});