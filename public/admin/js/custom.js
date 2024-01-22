
// Font Awesome prefix
$.fn.hummingbird.defaults.symbolPrefix = "far"

// Collapsed Symbol
$.fn.hummingbird.defaults.collapsedSymbol = "fa-folder";

// Expand Symbol
$.fn.hummingbird.defaults.expandedSymbol = "fa-folder-open";

// Collapse all nodes on init
$.fn.hummingbird.defaults.collapseAll = false; 

// Enable checkboxes
$.fn.hummingbird.defaults.checkboxes = "enabled"; 

// Set this to "disabled" to disable all checkboxes from nodes that are parents
$.fn.hummingbird.defaults.checkboxesGroups= "enabled"; 

// Enable end-nodes
$.fn.hummingbird.defaults.checkboxesEndNodes = "enabled"; 

// Set this to true to enable the functionality to account for n-tuples (doubles, triplets, ...). 
$.fn.hummingbird.defaults.checkDoubles = false;

// New option singleGroupOpen to allow only one group to be open and collapse all others.
// The number provided defines the level to which the function should be applied (starting at 0). 
$.fn.hummingbird.defaults.singleGroupOpen = -1;

// Enable a mouse hover effect on items
$.fn.hummingbird.defaults.hoverItems = false; 

// Or "bootstrap" to use <a href="https://www.jqueryscript.net/tags.php?/Bootstrap/">Bootstrap</a>'s styles
$.fn.hummingbird.defaults.hoverMode = "html"; 

// Background color on hover
$.fn.hummingbird.defaults.hoverColorBg1 = "#17A2B8"; 

// Background color on non hover
$.fn.hummingbird.defaults.hoverColorBg2 = "white"; 

// Text color on hover
$.fn.hummingbird.defaults.hoverColorText1 = "white"; 

// Text color on non hover
$.fn.hummingbird.defaults.hoverColorText2 = "black"; 

// Use Bootstrap colors
$.fn.hummingbird.defaults.hoverColorBootstrap = "bg-secondary text-white"; 

$(document).ready(function(){

	$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val(),
            }
        });
	setAttributeColor($('.custom-select').val());
	$('.custom-select').change(function(){
		setAttributeColor($(this).val());
	});
	$('input[name="birthday"]').daterangepicker({
	    singleDatePicker: true,
	    showDropdowns: true,
	    minYear: 1901,
	    maxYear: parseInt(moment().format('YYYY'),10),
	    locale: {
	      format: 'DD-MM-YYYY'
	    }
	  }, function(start, end, label) {
	    var years = moment().diff(start, 'years');
	    alert("Xác nhận bạn " + years + " tuổi!");
	  });
	$("#treeview").hummingbird();

	$('[name="tax"]').change(function(){
		value = $(this).val();
		value = '[value="'+value+'"]';
		data = parseInt($('.tax-option').find(value).attr('data'));
		percent = parseInt($('.percentPrice').val());
		setPrice(data);
		setPriceSale(percent);
	});
	$('[name="price"]').keyup(function(){
		value = $('[name="tax"]').val();
		value = '[value="'+value+'"]';
		data = parseInt($('.tax-option').find(value).attr('data'));
		percent = parseInt($('.percentPrice').val());
		if($.isNumeric(percent) != true){
			percent = 0;
			$('.percentPrice').val(0);
		}
		setPrice(data);
		setPriceSale(percent);
	});

	$('.saveProduct').submit(function(){
		check = true;
		$('.add-product-param-select').find('.product-param-selected').each(function(index){
			feature = parseInt($(this).find('.feature').val());
			$('.add-product-param-select').find('.product-param-selected').each(function(index1){
				if(index==index1){
					return;
				}
				feature1 = parseInt($(this).find('.feature').val());
				if(feature==feature1){
					check = false;
				}
			});
		});
		if(!check){
			toastr.error('Không thể chọn thông số sản phẩm trùng nhau');
		}
		return check;
	});

	$('.sale').change(function(){
		if($(this).is(':checked')){
			$('.on_sale').attr('style','display:block !important');
		}else{
			$('.on_sale').hide();
		}
	});

	$('.percentPrice').keyup(function(){
		percent = $('.percentPrice').val();
		price_tax = $('[name="price_tax"]').val();
		if(price_tax == ''){
			toastr.error('Vui lòng nhập giá sản phẩm');
			$('.percentPrice').val('');
		}else{
			if($.isNumeric(percent) != true){
				percent = 0;
				$('.percentPrice').val('');
			}
			else if(percent<=0||percent>100){
				toastr.error('Giá trị phần trăm nằm trong khoảng 1-100');
				$('.percentPrice').val('');
			}
			else{
				setPriceSale(percent);
			}
			
		}
		
	});


	
});

setPrice = (data = null) => {
	price = $('[name="price"]').val();
	if($.isNumeric(price)){
		price = parseFloat($('[name="price"]').val());
		if(data != null && data != 0){
			price_tax = price + price*(data/100);
		}
		else{
			price_tax = price;
		}
		$('[name="price_tax"]').val(price_tax);
	}
	else{
		$('[name="price"]').val('');
		$('[name="price_tax"]').val('');
	}
}

setPriceSale = (percent) => {
	price_tax = $('[name="price_tax"]').val();
	price_sale = 0;
	if(percent != null && percent != 0 ){
		price_sale = price_tax - price_tax*(percent/100);
	}
	else{
		price_sale = price_tax;
	}
	$('.price-sale').val(price_sale);
}

setAttributeColor = (value) => {
		value = '[value="'+value+'"]';
		group = parseInt($('.custom-select').find(value).attr('group'));
		if(group==0){
			$('.setcolor').hide();
			$('[name="color"]').attr('disabled','disabled');
		}else{
			$('.setcolor').show();
			$('[name="color"]').removeAttr('disabled');
		}
	}

addImage = () => {
	imageInput = $('.add-image').html();
	imageTotal = 1;
	$('.add-select-image').find('.check_image').each(function(index){
		imageTotal = imageTotal + 1;
	});
	imageInput = imageInput.replace('disabled="disabled"','');
	id = 'id="cover'+ imageTotal + '"';
	labelRadio = 'label for="cover'+ imageTotal + '"';
	value = 'value="' + imageTotal + '"';
	$('.totalImage').val(imageTotal);
	imageInput = imageInput.replace('id="cover"', id);
	imageInput = imageInput.replace('value=""', value);
	imageInput = imageInput.replace('label for="cover"', labelRadio);
	$('.add-select-image').append(imageInput);
}

deleteImage = (_this) => {
	id_image = $(_this).parent('div').parent('div').parent('div').find('img').attr('data');
	if(typeof id_image === 'undefined'){
		$(_this).parent('div').parent('div').parent('div').remove();
        return true;
	}
	action = $('.getAPI').val();
	action = action + 'admins/product/delete-image';
	$.ajax({
        type: 'POST',
        url: action,
        data: {
            id_image: id_image,
        },
        dataType: 'json',
        success: function(data) {	
        	if(!data.error){
        		$(_this).parent('div').parent('div').parent('div').remove();
        		toastr.success(data.messages);
        	}
        	else{
        		toastr.error(data.messages);
        	}
        },
        error: function(data) {
        	console.log(data);
        	toastr.error(data.messages);
        },
    });
	
}

addProductParam = () => {
	productParamInput = $('.add-product-param').html();
	productTotal = 1;
	$('.add-product-param-select').find('.form-group').each(function(index){
		productTotal = productTotal + 1;
	});
	productParamInput = productParamInput.replace('disabled="disabled"','');
	productParamInput = productParamInput.replace('disabled="disabled"','');
	$('.totalProductParam').val(productTotal);
	$('.add-product-param-select').append(productParamInput);
}

deleteProductParam = (_this, check = 0) => {
	if(check != 1){
		$(_this).parents('.product-param-selected').remove();
		return;
	}
	feature = parseInt($(_this).parents('.product-param-selected').find('.feature').val());
	id_product =parseInt($('.productID').val());
	action = $('.getAPI').val();
	action = action + 'admins/product/delete-feature';
	$.ajax({
        type: 'POST',
        url: action,
        data: {
            id_feature: feature,
            id_product: id_product,
        },
        dataType: 'json',
        success: function(data) {	
        	if(!data.error){
        		$(_this).parents('.product-param-selected').remove();
        		toastr.success(data.messages);
        	}
        	else{
        		toastr.error(data.messages);
        	}
        },
        error: function(data) {
        	console.log(data);
        	toastr.error(data.messages);
        },
    });
	
}

getFeatureValue = (_this) => {
	id_feature = $(_this).val();
	action = $('.getAPI').val();
	action = action + 'admins/feature/get-feature-value';
	$.ajax({
        type: 'POST',
        url: action,
        data: {
            id: id_feature,
        },
        dataType: 'json',
        success: function(data) {	
        	html = '';
        	for (i in data.featureValue) {
        		html += '<option value="'+data.featureValue[i].id_feature_value+'">'+data.featureValue[i].value+'</option>';
        	}
        	$(_this).parents('.product-param-selected').find('.featureValue').empty();
            $(_this).parents('.product-param-selected').find('.featureValue').append(html);
        },
        error: function(data) {
        	toastr.error(data.messages);
        },
    });
}

saveShowHomeCategory = (_this, id) => {
	action = 1;
	if($(_this).parent('div').find('input').is(':checked')!=true){
		action = 1;
	}
	else{
		action = 0;
	}
	$.ajax({
	        type: 'POST',
	        url: '',
	        data: {
	            id: id,
	            action: action,
	        },
	        dataType: 'json',
	        success: function(data) {	
				toastr.success(data.messages);;
	        },
	        error: function(data) {
	        	toastr.error(data.messages);
	        },
    	});
}

saveShowHomePage = (_this, id) => {
	action = 1;
	if($(_this).parent('div').find('input').is(':checked')!=true){
		action = 1;
	}
	else{
		action = 0;
	}
	$.ajax({
	        type: 'POST',
	        url: '',
	        data: {
	            id: id,
	            action: action,
	        },
	        dataType: 'json',
	        success: function(data) {	
				toastr.success(data.messages);;
	        },
	        error: function(data) {
	        	toastr.error(data.messages);
	        },
    	});
}
