$(document).ready(function(){
	if($('#register').text() != ''){
		var dem = 4;
		var interval_obj = setInterval(function(){
			dem= dem-1;
		    $('#minus').text(dem);
		    if(dem==0){
		    	location.reload();
		    	clearInterval(interval_obj);
		    }
		}, 1000);
	}
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

	$('[name="carrier"]').click(function(){
		if($('[name="carrier"]').is(':checked')){
			priceShip = parseFloat($(this).parent('td').parent('tr').find('[name="priceShip"]').val());
			totalPrice = parseFloat($('[name="totalPrice"]').val());
			price = priceShip + totalPrice;
			$('#price').empty();
			$('#price').text(formatNumber(price)+' VND');
		}
	});

	$('[name="addressOption"]').click(function(){
		if($(this).is(':checked')){
			if($(this).val() == '1'){
				address = $('[name="address_default"]').val();
				console.log(address);
				$('.addAddress').empty();
				$('.addAddress').html('<textarea name="address">'+address+'</textarea>');
			}
			else{
				$('.addAddress').empty();
				$('.addAddress').html('<textarea name="address"></textarea>');
			}
		}

	});
});

formatNumber = (nStr, decSeperate = '.', groupSeperate = ',') => {
        nStr += '';
        x = nStr.split(decSeperate);
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + groupSeperate + '$2');
        }
        return x1 + x2;
    }

renderHtmlCart = (product) => {
	html = '';
	for(i in  product)
	{
		html += '<li class="item even">';
		html += '<a class="product-image" href="product-detail/'+product[i].id_product+'" title="Downloadable Product ">';
		html += '<img alt="" src="upload/product/'+product[i].image+'" width="80"></a>';
	    html +=  '<div class="detail-item">';
	    html += '<div class="product-details"> <a href="" title="Remove This Item" class="glyphicon glyphicon-remove">&nbsp;</a> ';
	    html += '<p class="product-name">';
	    html += '<a href="product-detail/'+product[i].id_product+'" title="Downloadable Product">'+product[i].name+'</a>';
	    html += '</p></div>';
	    html += '<div class="product-details-bottom"> ';
	    html += '<span class="price">'+formatNumber(product[i].price)+' VND</span>';
	    html += '<span class="title-desc">Số lượng:</span>';
	    html += '<strong>'+product[i].quantity+'</strong> ';
	    html += '</div></div></li>';
	}
	return html;
}

addCart = (id_product, action, quantity = 1) => {
	action = action + 'cart/add';
	$.ajax({
        type: 'GET',
        url: action,
        data: {
            id_product: id_product,
            quantity: quantity,
            id_product_attribute: 0,
        },
        dataType: 'json',
        success: function(data) {
        	if(!data.error){
        		toastr.success(data.messages);
        		$('#cart-total').text(data.totalQuantity);
        		htmlCart = renderHtmlCart(data.product);
        		$('#cart-sidebar').empty();
        		$('#cart-sidebar').html(htmlCart);
        		$('#totalPrice').text(formatNumber(data.totalPrice)+' VND');
        	}
        	else{
        		toastr.error(data.messages);
        	}
        },
        error: function(data) {
        	toastr.error(data.messages);
        },
    });
}

addWishlist = (id_product, action) => {
	action = action + 'web/wishlist/add';
	$.ajax({
		type: 'GET',
		url: action,
		data: {
			id_product: id_product,
			id_product_attribute: 0,
		},
		dataType: 'json',
		success: function(data) {
			if(!data.error){
				toastr.success(data.messages);
			}
			else{
				toastr.error(data.messages);
			}
		},
		error: function(data) {
			toastr.error(data.messages);
		},
		statusCode: {
			302: () => {
				toastr.error('Vui lòng đăng nhập để thêm sản phẩm vào danh sách yêu thích');
			},
		}
	});
}

removeWishlist = (id_product, action, _this) => {
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('[name="_token"]').val(),
		}
	});
	action = action + 'web/wishlist/remove';
	$.ajax({
		type: 'POST',
		url: action,
		data: {
			id_product: id_product,
			id_product_attribute: 0,
		},
		dataType: 'json',
		success: function(data) {
			if(!data.error){
				toastr.success(data.messages);
				$(_this).parents('tr').remove();
				if(parseInt(data.total) == 0){
					setTimeout(function () {
						location.reload();
					},500);
				}
			}
			else{
				toastr.error(data.messages);
			}
		},
		error: function(data) {
			toastr.error(data.messages);
		},
		statusCode: {
			302: () => {
				toastr.error('Vui lòng đăng nhập để xóa danh sách yêu thích');
			},
		}
	});
}


