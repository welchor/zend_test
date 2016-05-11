jQuery(document).ready(function() {
	
	$('#priceQuantity').on('change blur', function() {
		var thisvalue = $(this).val();
		var qty = $('#quantity').val();
		var price = $('#unitprice').val();

		if (thisvalue < 1) {
			$(this).val('1');
			//alert('less than 1');
		} else {
			if(parseInt(thisvalue) > parseInt(qty)) {
				$(this).val('1');
				//alert('Over the limit');
			} else {
				var total = (parseInt(thisvalue) * price);
				$('#totalpriceQuantity').val(total.toFixed(2));
				$('.totalquantity').text("$"+total.toFixed(2));
			}
		}
	});
	
	if($('.method').is(':checked')) {
		 var shippingmethod = $('.method:checked').attr('shippingmethod');
		 var total = $('.method:checked').val();
		 $('.shippingmethod').val(shippingmethod);
		 $('.shipping_total').val(total);
	}


	$('.method').on('change', function () {
	    var shippingmethod = $(this).attr("shippingmethod") 
	    var total = $(this).val();
	        console.log(shippingmethod);
	    	$('.shippingmethod').val(shippingmethod);
		 	$('.shipping_total').val(total);
	});
});