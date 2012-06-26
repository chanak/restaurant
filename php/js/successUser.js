$(document).ready(function() {
	var originalPrice = 0; // price of selected product
	var selectedPrice = 0; // price of selected product*by quantity
	var selectedName = '';
	var selectedQuantity = 1;
	var names = {};
	var totals = 0; // price of order list

	// Enable sort for products inside products and order list
	$( '#productsList, #orderList' ).sortable({
		connectWith: '.containerDiv'
    });

    // FACNYBOX with id bind
	$("#fancyBtn").fancybox({
		'titleShow'		: false,
		'openEffect'	: 'fade',
		'closeEffect'	: 'fade'
	});

	// Products listing filter
	$('#All').click(function() {
		$('ul#productsList li').show();
	})
	$('#FastFood').click(function() {
		$('ul#productsList li').show();
		$('ul#productsList li.productDiv:not(:contains("FastFood"))').hide();
	})
	$('#DinnerMain').click(function() {
		$('ul#productsList li').show();
		$('ul#productsList li.productDiv:not(:contains("Dinner main"))').hide();
	})
	$('#Desserts').click(function() {
		$('ul#productsList li').show();
		$('ul#productsList li.productDiv:not(:contains("Desserts"))').hide();
	})
	$('#Drinks').click(function() {
		$('ul#productsList li').show();
		$('ul#productsList li.productDiv:not(:contains("Drinks"))').hide();
	})

	// set Animation on product drop after drag and set actions on mousedown and mouseup
	$('.productDiv').jrumble({ x: 2, y: 2, rotation: 3, });
	$('.productDiv').bind({
		'mousedown': function(){
			$(this).find('.label').focus();
			$(this).trigger('stopRumble');
			$('.label').blur();

			$this = $(this); // to be more safe on selection, it can cause some problems if directly taken
			originalPrice = parseInt($this.find("op").text().replace(/[^\d.,]+/,''),10); // Original price (hidden field)
			selectedPrice = parseInt($this.find("h2").text().replace(/[^\d.,]+/,''),10); // put the price of the product in selectedPrice and convert to integer
			selectedName = $this.find("h1").text(); // put the name of the product in selectedName
			selectedQuantity = parseInt($this.find('.label').val().replace(/[^\d.,]+/,''),10);
		}, 
		'mouseup': function(){
			$(this).trigger('startRumble');
			setTimeout(function(){$('ul li').trigger('stopRumble')}, 400);
		}
	});

	// Product price depending on quantity 
	$('.label').change(function() {
	    var price = originalPrice*parseInt(($this).find('.label').val().replace(/[^\d.,]+/,''),10); // the price after multiplied by quantity
	    $this.find("h2").html("$"+price); // write in its self
	});

	// when item is recieved in order list increment totals and redraw TOTAL $
	$('#orderList').bind('sortreceive', function(){
		$(this).find('.label').attr('disabled', true).css({'background-color':'#3E3E3E', 'color':'#F1EDE0'});
		$('table#ordersTable').append('<tr id="'+selectedName.replace(/ /g,'')+'"><h6><td>'+selectedName+"</td><td>"+selectedQuantity+"</td><td>$"+originalPrice+'</td></h6></tr>'); // Find product by id and add it to the final Orders list(.replace(/ /g,'') removes empty space from id otherwise id wont work)
		calcTotals(originalPrice, selectedQuantity);
		names[selectedName] = {"name":selectedName, "quantity":selectedQuantity}; // add item to array on last position
	});
	// when item is recieved in products list decrement totals and redraw TOTAL $
	$('#productsList').bind('sortreceive', function(){
		$(this).find('.label').attr('disabled', false).css({'background-color':'#F1EDE0', 'color':'#747862'});		
		$('table#ordersTable tr#'+selectedName.replace(/ /g,'')).remove(); // Find product by id and remove it (.replace(/ /g,'') removes empty space from id otherwise id wont work)
		calcTotals(originalPrice, -selectedQuantity);
		delete names[selectedName];
	});

	function calcTotals (oPrice, sQuantity) {
		totals = totals + (oPrice*sQuantity);
		$('ul#orderMenu li#totals').html("<h5> $"+totals+"</h5>"); // update totals
		$('table#ordersTable th#total').html("<h4>$"+totals+"</h4>"); // update total in order list
	}

	// PLACE ORDER
	$("a#placeOrder").bind('click', function() {
	    $.ajax({
	    url: "../user/placeOrder.php",
	    type: "POST",
	    data: { json: JSON.stringify(names) },
	    cache: false,
		success: function(data) {
			$.fancybox(data);
		}
	    });
	  return false;
	});

});