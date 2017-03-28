order = new Array();
order_10k = new Array();
special_counties_array = new Array();
PACKAGE_LIMIT = 10000;
TENK_PRICE = 39.95;
BULK_UNIT_PRICE = 0.004;
SPECIAL_TENK_MARK = 0;
BULK_PRICE = 0;
special_county_agents = 0;

function round_price(price)
{
	return parseFloat(price).toFixed(2);
}

function get_total_price(){
	if(parseInt($('#total_reach').text())<PACKAGE_LIMIT)
	{
		return TENK_PRICE;
	}

	if(special_counties_array.length==order.length)
	{
		return parseInt(special_counties_array.length) * TENK_PRICE;
	}
	
	var sum = 0;
	$('.sum_it').each(function() {
		sum = sum + parseFloat($(this).text());
	});
	if(sum<0) {console.log('price is negative : '+price); sum = 0;}
	console.log(sum);
	return sum;
	
}

function get_additional_agents()
{

	var special_county_agents = 0;
	var total_special_counties = 0;
	if(special_counties_array.length>0)
	{
		$.each(special_counties_array, function(index, special_county) {
			special_county_agents=special_county_agents+parseInt(special_county.quantity);
			total_special_counties++;
		});
	}
	
	var total =0; 
	if(special_county_agents==parseInt($('#total_reach').text())) return 0;
	/*if(special_county_agents-parseInt($('#total_reach').text())<PACKAGE_LIMIT)
		{total = parseInt($('#total_reach').text()) - parseInt(special_county_agents);}
		else*/ 
		
		total= parseInt($('#total_reach').text()) - parseInt(PACKAGE_LIMIT + special_county_agents);

		console.log('get_additional_agents: '+total);
		if(total<0){console.log('agents number is negative : '+total); total = total+PACKAGE_LIMIT;}
		if(total>0 && total_special_counties>0){ if(parseInt($('#total_reach_10k').text())>PACKAGE_LIMIT && total_special_counties==1) total = parseInt($('#total_reach').text()) - parseInt($('#total_reach_10k').text()); 
					else total = parseInt($('#total_reach').text()) - special_county_agents;
				}
		return total;

	}

	function add_to_order(obj)
	{order.push(obj);}

	function remove_from_order(obj){

	// order.filter((obj.fips)=>obj.fips!='3');
	return;
}

$(document).on('click', '.cities_covered', function(event) {
	event.preventDefault();
	_county = $(this).attr('id');
	_state = $('#state_name').attr('name');

	$.ajax({
		url: site_url+'newdesign/get_cities_by_state',
		type: 'POST',
		dataType: 'json',
		data: {st: _state, fips: _county},
		success: function(res){
			if(res)
			{
				$('#detail_'+_county).text('');
				$.each(res, function(index, city) {

					$('#detail_'+_county).append(city.name+', ').removeClass('hidden');
				});
			}
		},
		error: function(res){console.log(res);},
	});
});


$(document).on('click', '#county_list .order', function(event) {

	event.preventDefault();
	if(!$(this).hasClass('disabled'))
	{
		$(this).addClass('disabled');
		
		var tenk_mark = false;
		var special = false;
		var _county_fips = $(this).attr('id');
		var _county_name = $('#county_list #row_'+_county_fips+' .county_name').text();
		var _county_agents = parseInt($(this).attr('agents'));
		var _state_agents = $('#state_agents').text();

		var current_state = $('#state_name').text();
		var current_state_name = $('#state_name').attr('name');

		var _total_reach = parseInt($('#total_reach').text());
		var total_agents_reached = _total_reach+_county_agents;
		var show_second_pricing_box = true;

		var _free_total_agents = parseInt($('#free_total_agents').text());
		if(parseInt(_county_agents)>PACKAGE_LIMIT) //if special county is clicked
		{	
			var special = true;
			show_second_pricing_box = true;
			special_counties_array.push({state: current_state_name, county: _county_name, fips: _county_fips, quantity: parseInt(_county_agents), special: special});
			$('#special_counties p').append('<div id="special_'+_county_fips+'" fips="'+_county_fips+'" quantity="'+_county_agents+'" json="" class="special_count_row"><small>'+_county_name+', '+_county_agents+' Agents @ $<span class="sum_it">39.95</span></small></div>');		
			$("#special_counties").fadeIn();
		}

		var check = $('#selected_counties #selected_'+_county_fips).attr('quantity');
		// alert('check'+check);
		if(!check)
		{
			order.push({state: current_state_name, county: _county_name, fips: _county_fips, quantity: _county_agents, special: special});
			$('#selected_counties').prepend('<div id="selected_'+_county_fips+'" fips="'+_county_fips+'" quantity="'+_county_agents+'" json="" class="selected_count_row"><a href="" id="remove_selected_county" id="remove_'+_county_fips+'" special="'+special+'" quantity="'+_county_agents+'" state="'+current_state_name+'"><i class="fa fa-times text-danger"></i></a> '+current_state_name+' &raquo; '+_county_name+'</div>');
			$('#total_reach').text(total_agents_reached); //sum up total agents reached
		}

			//show second pricing box logic
			if($('#selected_counties').children('div[id^="selected_"]').length==1) show_second_pricing_box = false;

			if(total_agents_reached<PACKAGE_LIMIT)
			{
				$('#free_total_agents').text(PACKAGE_LIMIT-total_agents_reached);
				show_second_pricing_box = false;
				$('#total_price').text(get_total_price());
			}
			else {$('#free_total_agents').text(0); $('#total_reach_price').text(round_price(get_total_price()));}

			var additional_agents=parseInt(total_agents_reached)-PACKAGE_LIMIT;	
			var special_counties_price = 0;
			if(special)
			{		
				additional_agents=get_additional_agents();
				$('#total_reach_price').text(round_price(get_total_price()));
			}
			else{
				additional_agents=get_additional_agents();
			}


			console.log('additional_agents = '+additional_agents);
			// var c_agents = parseInt(_county_agents)-parseInt(additional_agents);
			_total_reach = parseInt($('#total_reach').text());
			if(!special)
			{
				if(_total_reach<PACKAGE_LIMIT)
					{var c_agents = parseInt(_county_agents);}
				else{
					var c_agents = parseInt(_county_agents)-parseInt(additional_agents);
					SPECIAL_TENK_MARK++;
				}
				if(SPECIAL_TENK_MARK<2) order_10k.push({state: current_state_name, county: _county_name, fips: _county_fips, quantity: c_agents, special: special});
			}
			else{

			}

			if(show_second_pricing_box)
			{
				$('#additional_agents').text(get_additional_agents());
				$('#additional_pricing').text(round_price(additional_pricing));
				$('#total_reach_10k').removeClass('hidden');
				$('.row_additional_pricing').fadeIn();
				$('#total_reach_additioanl').parent().removeClass('hidden');
				$('#total_reach_additioanl').text($('#total_reach').text());
			}

			$('#additional_agents').text(get_additional_agents());
			$('#additional_pricing').text(round_price(additional_agents*BULK_UNIT_PRICE));
			$('#total_reach_price').text(round_price(get_total_price()));
			

			if(special_counties_array.length==order.length)
			{
				$('.row_additional_pricing').fadeIn();
				$('#total_reach_additioanl').text($('#total_reach').text());
				if(special_counties_array.length<2)
				{
					order_10k = [];
					order_10k.push({state: current_state_name, county: _county_name, fips: _county_fips, quantity: _county_agents, special: true});
					$('#total_reach').text(_county_agents)
					$('#total_reach_10k').text($('#total_reach').text());
					$('#total_price').removeClass('sum_it').text(TENK_PRICE);
					$('.row_additional_pricing').addClass('hidden');
				}else{
					$('.row_additional_pricing').removeClass('hidden');
				}
				

				// $('.row_pricing, .row_additional_pricing p:first').addClass('hidden');
				// $('.row_additional_pricing #additional_agents, .row_additional_pricing #additional_pricing').text(0);
				$('#total_reach_additioanl').parent().removeClass('hidden');
				// $('#total_price').text(0);
			}
			else{
				$('.row_pricing, .row_additional_pricing p:first').removeClass('hidden');
				$('#total_reach_additioanl').parent().removeClass('hidden');
				$('.row_additional_pricing').removeClass('hidden');
			}
		}

	});


$('.process_order').on('click', function(event) {
	event.preventDefault();
	var html = '';
	var sum = 0;
	// console.log(order_10k.length);
	// alert(order.length);return false;
	if(order.length==0)
	{
		// $.each('#selected_counties .selected_count_row', function(index, row) {
			$('#selected_counties .selected_count_row').each(function(index, row) {
			 order.push({state: $(this).attr('state'), county: $(this).attr('county'), fips: $(this).attr('fips'), quantity: parseInt($(this).attr('quantity')), special: $(this).attr('special')});
		});
	}
	if(order_10k.length==0) {order_10k = order;}

	$.each(order_10k, function(index, jsn) {
		html = html + '<div><strong>State:</strong> '+jsn.state+' - <strong>County:</strong> '+jsn.county+' - <strong>Agents:</strong> '+jsn.quantity;
		sum = sum + jsn.quantity;
	});
	html = html + '<br><hr><h4>Total: '+sum+' Price: <strong>'+$("#total_price").text()+'</strong></h4>';
	bootbox.dialog({message: html, title: 'Order Detail',    
		buttons: {
			cancel: {
				label: 'Cancel',
				className: 'btn-danger',
				callback: function(){

				}
			},
			confirm: {
				label: 'Continue',
				className: 'btn-success',
				callback: function(){
					$.ajax({
						url: site_url+'api/save_order',
						type: 'POST',
						data: {order: order_10k, order_type: 'tenk', quantity: parseInt($('#total_reach_10k').text()), price: round_price($('#total_price').text())},
						success: function(msg)
						{
							if(msg=='done') window.location = site_url+'login';
							else return false;
						},
						beforeSend: function(){},
						error: function(err){swal('Oops','Something went wrong. Please try again later.', 'error'); console.log('error: '+err);}
					});				
				}

			}
		}
	});
});

$('.process_order_full').on('click', function(event) {
	event.preventDefault();
	var html = '';
	var sum = 0;
	if(order.length==0)
	{
		// $.each('#selected_counties .selected_count_row', function(index, row) {
			$('#selected_counties .selected_count_row').each(function(index, row) {
			 order.push({state: $(this).attr('state'), county: $(this).attr('county'), fips: $(this).attr('fips'), quantity: parseInt($(this).attr('quantity')), special: $(this).attr('special')});
		});
	}
	$.each(order, function(index, jsn) {
		html = html + '<div><strong>State:</strong> '+jsn.state+' - <strong>County:</strong> '+jsn.county+' - <strong>Agents:</strong> '+jsn.quantity;
		sum = sum + jsn.quantity;
	});
	html = html + '<br><hr><h4>Total: '+sum+' Price: <strong>'+$("#total_reach_price").text()+'</strong></h4>';
	bootbox.dialog({message: html, title: 'Order Detail',    
		buttons: {
			cancel: {
				label: 'Cancel',
				className: 'btn-danger',
				callback: function(){

				}
			},
			confirm: {
				label: 'Continue',
				className: 'btn-success',
				callback: function(){
					$.ajax({
						url: site_url+'api/save_order',
						type: 'POST',
						data: {order: order, order_type: 'complete', quantity: parseInt($('#total_reach_additioanl').text()), price: round_price($("#total_reach_price").text())},
						success: function(msg)
						{
							if(msg=='done') window.location = site_url+'login';
							else return false;
						},
						beforeSend: function(){},
						error: function(err){swal('Oops','Something went wrong. Please try again later.', 'error'); console.log('error: '+err);}
					});		
				}

			}
		}
	});
});

$('#clear_selection').on('click', function(event) {
	event.preventDefault();
	$.ajax({
		url: site_url+'api/clear_order_selection',
		type: 'POST',
		success: function(msg)
		{
			if(msg=='done') 
			{
				// swal('Success','Counties Select Cleared', 'success');
				// setTimeout(function() {
					location.reload();
				// }, 1000);
				
			}
			else return false;
		},
		beforeSend: function(){
			$('#ajax_loader').show();
		},
		error: function(err){swal('Oops','Something went wrong. Please try again later.', 'error'); console.log('error: '+err);}
	});
	
});


/*$('.email_entire_state').on('click', function(event) {
	event.preventDefault();
	var _state_agents = $('#state_agents').text();
	var _state_name = $('#state_name').text();
	var _state = $('#state_name').attr('name');
	
	if(_state_agents>PACKAGE_LIMIT)
	{
		if(!$(this).hasClass('disabled'))
		{
			$(this).addClass('disabled');
			$('#total_reach').text(_state_agents);
			$('#free_total_agents_wrapper').hide();
			$('#total_price').text(round_price(parseInt(_state_agents)*0.0025));
			$('#county_list .order_column').addClass('hidden');
			$('#selected_counties').empty().html('<a href="" class="remove_state" id="'+_state+'"><i class="fa fa-times text-danger"></i></a> All counties in '+_state_name);
		}

	}
	else
	{
		_total_reach = parseInt($('#total_reach').text());
	}

});*/

/////////////scroll functions

$(function() {

		// set the offset pixels automatically on how much the sidebar height is.
		// plus the top margin or header height
		var offsetPixels = $('#county_list .col-md-4').outerHeight() + 900;

		$(window).scroll(function() {
			if ( $(window).scrollTop() > offsetPixels ) {
				$('.floting_div').css({
					'position': 'fixed',
					'top': '120px',
					'background-color': 'white',
					'width': '300px',
					'z-index': '10!important'
				});
			} else {
				$('.floting_div').css({
					'position': 'static'
				});
			}
		});
	});