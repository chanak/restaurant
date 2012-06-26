$(document).ready(function() {

  // FANCY BOX
  // Initialization of fancybox with id bind
	$("#actionBox").fancybox({
    scrolling   : 'no',
		titleShow		: 'false',
		openEffect	: 'fade',
		closeEffect	: 'fade',
    'afterClose'  : function() {
      $("#addFood_error").hide();
      $('#imageName').text("Image path");
    }
	});

  $("#viewBox").fancybox({
    scrolling   : 'auto',
    titleShow   : 'false',
    openEffect  : 'fade',
    closeEffect : 'fade',
  });
  
  // SEARCH FOR USERS TABLE
	//Extend selector for case insensitive search *containsi*
	$.extend($.expr[':'], {
  	"containsi": function (elem, i, match, array) {
  	/* For example $('#ShowItems tr:containsi("Share")'), then match[3] will be Share*/
  		return (elem.textContent || elem.innerText || '').toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
  	}
	});

  $('#searchUsers').data('oldVal', $(this).val());
  // Look for changes in the value
  $('#searchUsers').bind("propertychange keyup input paste", function(event){
    // If value has changed...
   	if ($(this).data('oldVal') != $(this).val()) {
    // Updated stored value
        $(this).data('oldVal', $(this).val());
        $('Table#usersTable tr:not(:containsi("'+$(this).val()+'"))').not('#userCategories').hide();
        if ($(this).val() == "") {
          $('#usersTable tr').show();
          };
     	}
 	});

  // DELETE USER
  $("input#deleteUser").bind('click', function() {
  var usersContainerDU = $(this).closest('tr');
  var idDU = usersContainerDU.attr("id");
  var stringDU = 'id='+idDU;

    $.ajax({
    type: "POST",
    url: "../admin/deleteUser.php",
    data: stringDU,
    cache: false,
    success: function(){
      usersContainerDU.slideUp("slow", function() {
        $(this).remove();
      });
      $.fancybox.toggle();
    }
    });
  return false;
  });

  // DELETE FOOD
  $("input#deleteFood").bind('click', function() {
  var foodContainerDF = $(this).closest('tr');
  var idDF = foodContainerDF.attr("id");
  var stringDF = 'id='+idDF;

    $.ajax({
    type: "POST",
    url: "deleteFood.php",
    data: stringDF,
    cache: false,
    success: function(){
      foodContainerDF.slideUp("slow", function() {
        $(this).remove();
      });
    }
    });
  return false;
  });

  // DELETE ORDER
  $("input#deleteOrder").bind('click', function() {
  var ordersContainerDO = $(this).closest('tr');
  var idDO = ordersContainerDO.attr("id");
  var stringDO = 'id='+idDO;

    $.ajax({
    type: "POST",
    url: "deleteOrders.php",
    data: stringDO,
    cache: false,
    success: function(){
      ordersContainerDO.slideUp("slow", function() {
        $(this).remove();
      });
    }
    });
  return false;
  });

  // ACCEPT ORDER
  $("input#acceptOrder").bind('click', function() {
  var ordersContainerAO = $(this).closest('tr');
  var idAO = ordersContainerAO.attr("id");
  var stringAO = 'id='+idAO;

    $.ajax({
    type: "POST",
    url: "acceptOrders.php",
    data: stringAO,
    cache: false,
    success: function(){
      ordersContainerAO.find('#acceptOrder').prop('disabled', true);
    }
    });
  return false;
  });

});