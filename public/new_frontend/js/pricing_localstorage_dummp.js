order = new Array();
order_10k = new Array();
special_counties_array = new Array();
PACKAGE_LIMIT = 10000;
TENK_PRICE = 39.95;
BULK_UNIT_PRICE = 0.004;
SPECIAL_TENK_MARK = 0;
BULK_PRICE = 0;
special_county_agents = 0;


if (typeof(Storage) == "undefined") {
	swal('Unsupported Browser','Please use latest Mozila Firefox, Chrome or Internet Explorer','error');
}

localStorage.setItem('total_price',0);
localStorage.setItem('total_reach',0);
localStorage.setItem('additional_pricing',0);
localStorage.setItem('additional_agents',0);

function round_price(price)
{
	return parseFloat(price).toFixed(2);
}

function get_total_price(){
	/*var TOTAL_REACH = localStorage.getItem('total_reach'); old_logic */
	var TOTAL_REACH = parseInt(localStorage.getItem('total_reach'));

	if(TOTAL_REACH<PACKAGE_LIMIT)
	{
		return TENK_PRICE;
	}
	
	if(order.length==0){ 
	$('#selected_counties .selected_count_row').each(function(index, row) {
			 order.push({state: $(this).attr('state'), county: $(this).attr('county'), fips: $(this).attr('fips'), quantity: parseInt($(this).attr('quantity')), special: $(this).attr('special')});
		});
	 }

	if(special_counties_array.length==0){
		$('#special_counties div').each(function(index, row) {
			special_counties_array.push({state: $(this).attr('state'), county: $(this).attr('county'), fips: $(this).attr('fips'), quantity: parseInt($(this).attr('quantity')), special: $(this).attr('special')});
		});
	}

	if(special_counties_array.length==order.length)
	{
		return parseInt(special_counties_array.length) * TENK_PRICE;
	}
	else{
		if(special_counties_array.length>0)
		 {
		 	return round_price((parseInt(special_counties_array.length) * TENK_PRICE) + parseFloat(localStorage.getItem('additional_pricing')));
		 }
		else {
				return round_price(TENK_PRICE + parseFloat(localStorage.getItem('additional_pricing')));
			 }
	}
	
	if(TOTAL_REACH>PACKAGE_LIMIT)
	{
		if(special_counties_array.length==0)
			{
				var new_price =  round_price(TENK_PRICE + parseFloat(localStorage.getItem('additional_pricing')));
				localStorage.setItem('total_price', new_price);
				return new_price;
			}
		else {
			var new_price = round_price((parseInt(special_counties_array.length) * TENK_PRICE) + parseFloat(localStorage.getItem('additional_pricing')));
			localStorage.setItem('total_price', new_price);
			return new_price;

		}
	}
}

function get_additional_agents()
{

	var special_county_agents = 0;
	var total_special_counties = 0;
	var total = 0; 
	var TOTAL_REACH = parseInt(localStorage.getItem('total_reach'));

	if(special_counties_array.length>0)
	{
		$.each(special_counties_array, function(index, special_county) {
			special_county_agents=special_county_agents+parseInt(special_county.quantity);
			total_special_counties = total_special_counties+1;
		});
	}
	else{
		$('#special_counties div').each(function(index, row) {
			special_counties_array.push({state: $(this).attr('state'), county: $(this).attr('county'), fips: $(this).attr('fips'), quantity: parseInt($(this).attr('quantity')), special: $(this).attr('special')});
		});

		$.each(special_counties_array, function(index, special_county) {
			special_county_agents=special_county_agents+parseInt(special_county.quantity);
			total_special_counties = total_special_counties+1;
		});
	}
	
	// console.log('special counties:'+total_special_counties);

		if(special_county_agents==TOTAL_REACH) return 0;
		var total_additional_agents = TOTAL_REACH - PACKAGE_LIMIT;
		if(total_additional_agents<0) return 0;
		if(total_additional_agents>0)
		{ 
			// if(total_special_counties==0) return total_additional_agents;
			if(TOTAL_REACH>PACKAGE_LIMIT) 
				{
					if(total_special_counties==0) return total_additional_agents;
					if(total_special_counties>0) return TOTAL_REACH - special_county_agents;
				}
				
		}
		// return total_additional_agents;

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

	if(order.length==0){ 
	$('#selected_counties .selected_count_row').each(function(index, row) {
			 order.push({state: $(this).attr('state'), county: $(this).attr('county'), fips: $(this).attr('fips'), quantity: parseInt($(this).attr('quantity')), special: $(this).attr('special')});
		});
	 }

	 if(special_counties_array.length==0)
	 {
	 	$('#special_counties div').each(function(index, row) {
	 		special_counties_array.push({state: $(this).attr('state'), county: $(this).attr('county'), fips: $(this).attr('fips'), quantity: parseInt($(this).attr('quantity')), special: $(this).attr('special')});
	 	});
	 }


	$.ajax({
		url: site_url+'newdesign/get_cities_by_state',
		type: 'POST',
		dataType: 'json',
		data: {st: _state, fips: _county},
		success: function(res){
			if(res)
			{
				$('#detail_'+_county).text('');
				var str = '';
				// $.each(res, function(index, city) {

				// 	str = str + city.name+', ';
				// });
				for(i=0; i<res.length; i++)
				{
					str = str + res[i].name;
					if(i!=res.length-1) str = str +', ';
				}

				$('.detail_cities_covered').addClass('hidden');
				// var subs = str.substr(0, parseInt(str.length)-2);
				$('#detail_'+_county).text(str).removeClass('hidden');
				// REMOVE THE LAST COMMA FFS
			}
		},
		error: function(res){console.log(res);},
	});
});


$(document).on('click', '#county_list .order, .email_entire_state .order', function(event) {

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

		// var _total_reach = localStorage.getItem('total_reach');
		var _total_reach = parseInt(localStorage.getItem('total_reach'));
		// var total_agents_reached = parseInt(localStorage.getItem('total_reach'))+_county_agents; //totlal agents reached yellow box
		localStorage.setItem('total_reach',parseInt(localStorage.getItem('total_reach'))+_county_agents);
		var show_second_pricing_box = true;

		var _free_total_agents = parseInt($('#free_total_agents').text());
		if( _county_agents > PACKAGE_LIMIT) //if special county is clicked
		{	
			var special = true;
			show_second_pricing_box = true;
			var special_check = $('#special_counties #special_'+_county_fips).attr('quantity');
			if(!special_check)
			{
				special_counties_array.push({state: current_state_name, county: _county_name, fips: _county_fips, quantity: parseInt(_county_agents), special: special});
				$('#special_counties').append('<div id="special_'+_county_fips+'" state="'+current_state_name+'" county="'+_county_name+'" fips="'+_county_fips+'" special="'+special+'" quantity="'+_county_agents+'" json="" class="special_count_row"><small>'+_county_name+', '+_county_agents+' Agents @ $<span class="sum_it">39.95</span></small></div>');		
			}
			$("#special_counties").fadeIn();
		}

		var check = $('#selected_counties #selected_'+_county_fips).attr('quantity');
		// alert('check'+check);
		if(!check) // if county does not already exists
		{
			order.push({state: current_state_name, county: _county_name, fips: _county_fips, quantity: _county_agents, special: special});
			$('#selected_counties').prepend('<div id="selected_'+_county_fips+'" fips="'+_county_fips+'" quantity="'+_county_agents+'" json="" class="selected_count_row"><a href="" class="remove_selected_county" id="remove_'+_county_fips+'" fips="'+_county_fips+'" special="'+special+'" quantity="'+_county_agents+'" state="'+current_state_name+'"><i class="fa fa-times text-danger"></i></a> '+current_state_name+' &raquo; '+_county_name+'</div>');
			
			$('#total_reach').text(parseInt(localStorage.getItem('total_reach'))); //sum up total agents reached

		}

			//show second pricing box logic
			if($('#selected_counties').children('div[id^="selected_"]').length==1) show_second_pricing_box = false;

			if(parseInt(localStorage.getItem('total_reach'))<PACKAGE_LIMIT)
			{
				$('#free_total_agents').text(PACKAGE_LIMIT-parseInt(localStorage.getItem('total_reach')));
				show_second_pricing_box = false;
				localStorage.setItem('total_price', TENK_PRICE);
				$('#total_price').text(TENK_PRICE);
			}
			else {
					$('#free_total_agents').text(0); 
					$('#total_reach_price').text(round_price(get_total_price()));
				}

			var additional_agents=parseInt(localStorage.getItem('total_reach'))-PACKAGE_LIMIT;	
			var special_counties_price = 0;
			if(special)
			{		
				additional_agents=get_additional_agents();
				// $('#total_reach_price').text(round_price(get_total_price()));
				localStorage.setItem('total_price', round_price(get_total_price()));
				$('#total_reach_price').text(localStorage.getItem('total_price'));
				localStorage.setItem('additional_agents', get_additional_agents());
			}
			else{
				additional_agents=get_additional_agents();
				localStorage.setItem('additional_agents', get_additional_agents());
			}


			// console.log('additional_agents = '+additional_agents);
			// var c_agents = parseInt(_county_agents)-parseInt(additional_agents);
			_total_reach = parseInt(localStorage.getItem('total_reach'));
			if(!special)
			{
				if(parseInt(localStorage.getItem('total_reach'))<PACKAGE_LIMIT)
					{var c_agents = parseInt(_county_agents);}
				else{
					var c_agents = parseInt(_county_agents)-parseInt(localStorage.getItem('additional_agents'));
					SPECIAL_TENK_MARK++;
				}
				var check = $('#selected_counties #selected_'+_county_fips).attr('quantity');
				if(!check){
					if(SPECIAL_TENK_MARK<2) order_10k.push({state: current_state_name, county: _county_name, fips: _county_fips, quantity: c_agents, special: special});
					}
			}
			else{

			}

			if(show_second_pricing_box)
			{
				$('#additional_agents').text(get_additional_agents());
				$('#additional_pricing').text(round_price(parseFloat(localStorage.getItem('additional_pricing'))));
				$('#total_reach_10k').removeClass('hidden');
				$('.row_additional_pricing').fadeIn();
				$('#total_reach_additioanl').parent().removeClass('hidden');
				$('#total_reach_additioanl').text(parseInt(localStorage.getItem('total_reach')));
			}

			$('#additional_agents').text(get_additional_agents());
			$('#additional_pricing').text(round_price(additional_agents*BULK_UNIT_PRICE));
			$('#total_reach_price').text(round_price(localStorage.getItem('total_price')));
			

			if(special_counties_array.length==order.length)
			{
				$('.row_additional_pricing').fadeIn();
				$('#total_reach_additioanl').text(parseInt(localStorage.getItem('total_reach')));
				if(special_counties_array.length<2)
				{
					order_10k = [];
					var check = $('#selected_counties #selected_'+_county_fips).attr('quantity');
					if(!check) order_10k.push({state: current_state_name, county: _county_name, fips: _county_fips, quantity: _county_agents, special: true});
					$('#total_reach').text(_county_agents);
					parseInt(localStorage.setItem('total_reach', _county_agents));
					$('#total_reach_10k').text(parseInt(localStorage.getItem('total_reach')));
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
			if($('#selected_counties .selected_count_row').children().length!=0)
			{
				$('#selected_counties .selected_count_row').each(function(index, row) 
				{
			 		order.push({state: $(this).attr('state'), county: $(this).attr('county'), fips: $(this).attr('fips'), quantity: parseInt($(this).attr('quantity')), special: $(this).attr('special')});
			 	});
			}
			else{
				swal('No counties selected','Please select some counties to proceed.', 'warning');
				return false;
			}
	}
	if(order_10k.length==0) {order_10k = order;}

	$.each(order_10k, function(index, jsn) {
		html = html + '<div style="font-size: 16px"><strong>State:</strong> '+jsn.state+' - <strong>County:</strong> '+jsn.county+' - <strong>Agents:</strong> '+jsn.quantity;
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
	// html = html + '<br><hr><h4>Total: '+sum+' Price: <strong>'+$("#total_reach_price").text()+'</strong></h4>';
	html = html + '<br><hr><h4>Total: '+sum+' Price: <strong>'+localStorage.getItem('total_price')+'</strong></h4>';
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
						data: {order: order, order_type: 'complete', quantity: parseInt(localStorage.getItem('additional_agents')), price: round_price(parseFloat(localStorage.getItem('total_price')))},
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
				localStorage.clear();
				swal('Success','Counties Select Cleared', 'success');
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

$(document).delegate('.remove_selected_county', 'click', function(event) {
	event.preventDefault();
	
	var if_special = $(this).attr('special');
	var state = $(this).attr('state');
	var quantity = $(this).attr('quantity');
	var fips = $(this).attr('fips');
	var additional_agents = parseInt($('#additional_agents').text());
	var total_reach_price = parseFloat($('#total_reach_price').text());

	// alert('state: '+state+' quantity:'+quantity+' fips:'+fips+' special:'+if_special);
	// alert(order.length);

	if(order.length>0)
	{
		for(i=0; i<order.length; i++)
		{
			if(order[i].fips==fips) order.splice(i, 1);
		}
		/*$.each(order, function(index, v) {
			 if(v.fips==fips) order.splice(index,1);
			console.log(v.fips);
		});*/
	}

	var total_reach = parseInt(localStorage.getItem('total_reach'));
	var new_total_reach = parseInt(localStorage.getItem('total_reach')) - quantity;
	$('#total_reach').text(new_total_reach);

	if(quantity>additional_agents)
	{
		$('#additional_agents').text(0);
		$('#additional_pricing').text(0);
		$('.row_additional_pricing').hide();
		var free_total_agents = PACKAGE_LIMIT-new_total_reach;
		if(free_total_agents>0) $('#free_total_agents').text(free_total_agents);
		else $('#free_total_agents').text(new_total_reach);

	}
	else{
			if(total_reach>PACKAGE_LIMIT)
			{
				$('#additional_agents').text(additional_agents-quantity); //UPDATE additional agents
				// var additional_pricing = parseFloat($('#additional_pricing').text()); 
				$('#additional_pricing').text(round_price((additional_agents-quantity)*BULK_UNIT_PRICE)); //UPDATE additional pricing
				$('#total_reach_price').text(round_price(total_reach_price - ((additional_agents-quantity)*BULK_UNIT_PRICE))); //UPDATE total price
			}

			if(total_reach<PACKAGE_LIMIT)
			{
				$('#free_total_agents').text(PACKAGE_LIMIT-total_reach);
			}
		}
	$('#row_'+fips+' button').removeClass('disabled');
	$('#selected_'+fips).remove();
	$('#special_'+fips).remove();
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
		_total_reach = parseInt(localStorage.getItem('total_reach'));
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