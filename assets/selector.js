$(document).on('click', '.qiwi', function(){
	$.ajax({
		type: "POST",
		url: "select.php",
		dataType: "html",
		data: {qiwi:''},
		success: function(link) {
			window.location.href = link;
		}
	});
});

$(document).on('click', '.unitpay', function(){
	$.ajax({
		type: "POST",
		url: "select.php",
		dataType: "html",
		data: {unitpay:''},
		success: function(link) {
			window.location.href = link;
		}
	});
});

$(document).on('click', '.enot', function(){
	$.ajax({
		type: "POST",
		url: "select.php",
		dataType: "html",
		data: {enot:''},
		success: function(link) {
			window.location.href = link;
		}
	});
});