$(document).ready(function($){
	$('.exit_tour').on('click', function(event) {
		event.preventDefault();
		
		$.ajax({
			url: '/editor/exit_tour',
			type: 'POST',
			beforeSend: function (msg){
				$.powerTour('end');
			},
			success: function (msg){
				console.log(msg);
			},
			error: function (msg){
				console.log(msg);
			}
		});
		
	});

	$(document).delegate('#pull_help a', 'click', function(event) {
		event.preventDefault();
		var _txt = $('#pull_help').html();
		$.ajax({
			url: '/editor/get_step',
			data: {way: 'manual'},
			type: 'POST',
			beforeSend: function(msg)
			{
				$('#pull_help').html('<i class="fa fa-spinner fa-pulse fa-fw"></i><span class="sr-only">Loading...</span>');
				// $.powerTour('end');
			},
			success: function(step)
			{
				console.log(step);
				$('#pull_help').html(_txt);
				if(step=='1') {$.powerTour('run',1);}
				else if(step=='2') {$.powerTour('run',2);}
				else if(step=='3') {$.powerTour('run',3);}
				else if(step=='4') {$.powerTour('run',4);}
				else if(step=='5') {$.powerTour('run',5);}
				else if(step=='6') {$.powerTour('run',6);}
			}, 
			error: function()
			{
				$('#pull_help').html(_txt);

			}
		});
		/* Act on the event */
	});
	$.powerTour({
		tours : [
		{
			trigger            : '#',
			startWith          : 1,
			easyCancel         : true,
			escKeyCancel       : true,
			scrollHorizontal   : false,
			keyboardNavigation : true,
			loopTour           : false,
			highlightStartSpeed: 200,
			highlightEndSpeed  : 200,
			onStartTour        : function(ui){ },
			onEndTour          : function(ui){ },	
			onProgress         : function(ui){ },
			steps : [
			{
				hookTo          : '#hook_1_1',
				content         : '#step-id-1',
				width           : 400,
				position        : 'rt',
				offsetY         : 0,
				offsetX         : 10,
				fxIn            : 'fadeIn',
				fxOut           : 'fadeOut',
				showStepDelay   : 0,
				center          : 'step',
				scrollSpeed     : 400,
				scrollEasing    : 'swing',
				scrollDelay     : 0,
				timer           : '00:15',
				highlight       : true,
				keepHighlighted : false,
				keepVisible     : false,
				onShowStep      : function(ui){},
				onHideStep      : function(ui){ }
			},
			{
				hookTo          : '#hook_1_2',
				content         : '#step-id-2',
				width           : 400,
				position        : 'lt',
				offsetY         : 0,
				offsetX         : 20,
				fxIn            : 'fadeIn',
				fxOut           : 'fadeOut',
				showStepDelay   : 0,
				center          : 'step',
				scrollSpeed     : 400,
				scrollEasing    : 'swing',
				scrollDelay     : 0,
				timer           : '00:15',
				highlight       : true,
				keepHighlighted : false,
				keepVisible     : false,
				onShowStep      : function(ui){},
				onHideStep      : function(ui){ }
			},
			{
				hookTo          : '#pull_help',
				content         : '#step-id-3',
				width           : 400,
				position        : 'tl',
				offsetY         : 15,
				offsetX         : 0,
				fxIn            : 'fadeIn',
				fxOut           : 'fadeOut',
				showStepDelay   : 0,
				center          : 'step',
				scrollSpeed     : 400,
				scrollEasing    : 'swing',
				scrollDelay     : 0,
				timer           : '00:15',
				highlight       : true,
				keepHighlighted : false,
				keepVisible     : false,
				onShowStep      : function(ui){},
				onHideStep      : function(ui){ }
			},
			]
		},

// step 2 tour
{
	trigger            : '#',
	startWith          : 1,
	easyCancel         : true,
	escKeyCancel       : true,
	scrollHorizontal   : false,
	keyboardNavigation : true,
	loopTour           : false,
	highlightStartSpeed: 200,
	highlightEndSpeed  : 200,
	onStartTour        : function(ui){ },
	onEndTour          : function(ui){ },	
	onProgress         : function(ui){ },
	steps : [
	{ //step 2, tip 1
		hookTo          : '#customButton',
		content         : '#step-2',
		width           : 400,
		position        : 'bm',
		offsetY         : 25,
		offsetX         : 0,
		fxIn            : 'fadeIn',
		fxOut           : 'fadeOut',
		showStepDelay   : 0,
		center          : 'step',
		scrollSpeed     : 400,
		scrollEasing    : 'swing',
		scrollDelay     : 0,
		timer           : '00:15',
		highlight       : true,
		keepHighlighted : false,
		keepVisible     : false,
		onShowStep      : function(ui){},
		onHideStep      : function(ui){ }
	}, { //step 2, tip 2
		hookTo          : '#choose_flyer_grid',
		content         : '#step-2_2',
		width           : 400,
		position        : 'rt',
		offsetY         : 0,
		offsetX         : 0,
		fxIn            : 'fadeIn',
		fxOut           : 'fadeOut',
		showStepDelay   : 0,
		center          : 'center',
		scrollSpeed     : 400,
		scrollEasing    : 'swing',
		scrollDelay     : 0,
		timer           : '00:15',
		highlight       : true,
		keepHighlighted : false,
		keepVisible     : false,
		onShowStep      : function(ui){},
		onHideStep      : function(ui){ }
	}, { //step 2, tip 3
		hookTo          : '#flyer_small_122',
		content         : '#step-2_3',
		width           : 400,
		position        : 'rt',
		offsetY         : 0,
		offsetX         : 0,
		fxIn            : 'fadeIn',
		fxOut           : 'fadeOut',
		showStepDelay   : 0,
		center          : 'center',
		scrollSpeed     : 400,
		scrollEasing    : 'swing',
		scrollDelay     : 0,
		timer           : '00:15',
		highlight       : true,
		keepHighlighted : false,
		keepVisible     : false,
		onShowStep      : function(ui){
			// alert($('#step_2 .flyer_small:first').attr('src'));
			// $(".flyer_small").removeClass('flyer_small_selected');
			$('#step_2 .flyer_small:first').addClass('flyer_small_selected');
			var flyerimg = $('#step_2 .flyer_small:first').attr("img");
			var id = $('#step_2 .flyer_small:first').attr("id");
			// $("#big_image").html('');
			$("#step_2 #big_image").attr('src', 'https://xyzflyers.com//public/upload/flyer_images/resized_'+flyerimg).removeClass('hidden').fadeIn();
			$("#step_2 #big_image").attr('idd', id);
			$('#step_2 #no_selected_img_alert').fadeOut().addClass('hidden');
			$('#selected_flyer').val(id);
		},
		onHideStep      : function(ui){ }
	}, { // //step 2, tip 4th
		hookTo          : '#hook-2_4',
		content         : '#step-2_4',
		width           : 400,
		position        : 'lm',
		offsetY         : 0,
		offsetX         : 20,
		fxIn            : 'fadeIn',
		fxOut           : 'fadeOut',
		showStepDelay   : 0,
		center          : 'center',
		scrollSpeed     : 400,
		scrollEasing    : 'swing',
		scrollDelay     : 0,
		timer           : '00:15',
		highlight       : true,
		keepHighlighted : false,
		keepVisible     : false,
		onShowStep      : function(ui){ },
		onHideStep      : function(ui){ }
	}, { // //step 2, tip 5th
		hookTo          : '#hook-2_5',
		content         : '#step-2_5',
		width           : 500,
		position        : 'lt',
		offsetY         : 0,
		offsetX         : 0,
		fxIn            : 'fadeIn',
		fxOut           : 'fadeOut',
		showStepDelay   : 0,
		center          : 'center',
		scrollSpeed     : 400,
		scrollEasing    : 'swing',
		scrollDelay     : 0,
		timer           : '00:15',
		highlight       : true,
		keepHighlighted : false,
		keepVisible     : false,
		onShowStep      : function(ui){ },
		onHideStep      : function(ui){ }
	}
	]
}, 
	//step 3 tour
	{
		trigger            : '#',
		startWith          : 1,
		easyCancel         : true,
		escKeyCancel       : true,
		scrollHorizontal   : false,
		keyboardNavigation : true,
		loopTour           : false,
		highlightStartSpeed: 200,
		highlightEndSpeed  : 200,
		onStartTour        : function(ui){ },
		onEndTour          : function(ui){ },	
		onProgress         : function(ui){ },
		steps : [
	{ //step 3, tip 1
		hookTo          : '#hook-3_1',
		content         : '#step-3_1',
		width           : 400,
		position        : 'lm',
		offsetY         : 0,
		offsetX         : 10,
		fxIn            : 'fadeIn',
		fxOut           : 'fadeOut',
		showStepDelay   : 0,
		center          : 'step',
		scrollSpeed     : 400,
		scrollEasing    : 'swing',
		scrollDelay     : 0,
		timer           : '00:15',
		highlight       : true,
		keepHighlighted : false,
		keepVisible     : false,
		onShowStep      : function(ui){},
		onHideStep      : function(ui){ }
	}, { //step 3, tip 2
		hookTo          : '#hook-3_2',
		content         : '#step-3_2',
		width           : 400,
		position        : 'lm',
		offsetY         : 0,
		offsetX         : 10,
		fxIn            : 'fadeIn',
		fxOut           : 'fadeOut',
		showStepDelay   : 0,
		center          : 'center',
		scrollSpeed     : 400,
		scrollEasing    : 'swing',
		scrollDelay     : 0,
		timer           : '00:15',
		highlight       : true,
		keepHighlighted : false,
		keepVisible     : false,
		onShowStep      : function(ui){
			$('.editor-textAssign[data-type=mainheader]').trigger('click');
		},
		onHideStep      : function(ui){ }
	}, { //step 3, tip 3
		hookTo          : '#hook-3_3',
		content         : '#step-3_3',
		width           : 400,
		position        : 'lm',
		offsetY         : 0,
		offsetX         : 10,
		fxIn            : 'fadeIn',
		fxOut           : 'fadeOut',
		showStepDelay   : 0,
		center          : 'center',
		scrollSpeed     : 400,
		scrollEasing    : 'swing',
		scrollDelay     : 0,
		timer           : '00:15',
		highlight       : true,
		keepHighlighted : false,
		keepVisible     : false,
		onShowStep      : function(ui){ 
			
		},
		onHideStep      : function(ui){

			
		/*	proFabric.canvas.forEachObject(function(obj)
			{
                if (obj.type== 'image') 
                { 
                    proFabric.canvas.setActiveObject(obj, '');
                    return false;
                }
            });	*/

}
	}, { // //step 3, tip 4th
		hookTo          : '#hook-3_4',
		content         : '#step-3_4',
		width           : 400,
		position        : 'rm',
		offsetY         : 0,
		offsetX         : 20,
		fxIn            : 'fadeIn',
		fxOut           : 'fadeOut',
		showStepDelay   : 0,
		center          : 'center',
		scrollSpeed     : 400,
		scrollEasing    : 'swing',
		scrollDelay     : 0,
		timer           : '00:15',
		highlight       : true,
		keepHighlighted : false,
		keepVisible     : false,
		onShowStep      : function(ui){ },
		onHideStep      : function(ui){ 
		/*	var main_obj = [];
			var num = 0;
			proFabric.canvas.forEachObject(function(obj){
				if (obj.type == 'image') 
					{ 
						num++;
						if(num<2) 
						{
							main_obj.push(obj);
							return false;
						}
					}
				});	
			console.log('echo : '+main_obj);
			proFabric.canvas.setActiveObject(main_obj[0]);*/
		}

	},/* { // //step 3, tip 5th
		hookTo          : '#uploadBtnContainer',
		content         : '#step-3_5',
		width           : 500,
		position        : 'bl',
		offsetY         : 20,
		offsetX         : 0,
		fxIn            : 'fadeIn',
		fxOut           : 'fadeOut',
		showStepDelay   : 0,
		center          : 'center',
		scrollSpeed     : 400,
		scrollEasing    : 'swing',
		scrollDelay     : 0,
		timer           : '00:15',
		highlight       : true,
		keepHighlighted : false,
		keepVisible     : false,
		onShowStep      : function(ui){ },
		onHideStep      : function(ui){ bootbox.hideAll();}
	},*/ { // //step 3, tip 5th
		hookTo          : '#hook-3_6',
		content         : '#step-3_6',
		width           : 500,
		position        : 'lm',
		offsetY         : 0,
		offsetX         : 10,
		fxIn            : 'fadeIn',
		fxOut           : 'fadeOut',
		showStepDelay   : 0,
		center          : 'center',
		scrollSpeed     : 400,
		scrollEasing    : 'swing',
		scrollDelay     : 0,
		timer           : '00:15',
		highlight       : true,
		keepHighlighted : false,
		keepVisible     : false,
		onShowStep      : function(ui){ },
		onHideStep      : function(ui){ }
	}, { // //step 3, tip 5th
		hookTo          : '#hook-3_7',
		content         : '#step-3_7',
		width           : 500,
		position        : 'lm',
		offsetY         : 0,
		offsetX         : 0,
		fxIn            : 'fadeIn',
		fxOut           : 'fadeOut',
		showStepDelay   : 0,
		center          : 'center',
		scrollSpeed     : 400,
		scrollEasing    : 'swing',
		scrollDelay     : 0,
		timer           : '00:15',
		highlight       : true,
		keepHighlighted : false,
		keepVisible     : false,
		onShowStep      : function(ui){ },
		onHideStep      : function(ui){ }
	}, { // //step 3, tip 5th
		hookTo          : '#hook-3_8',
		content         : '#step-3_8',
		width           : 500,
		position        : 'tm',
		offsetY         : 10,
		offsetX         : 0,
		fxIn            : 'fadeIn',
		fxOut           : 'fadeOut',
		showStepDelay   : 0,
		center          : 'center',
		scrollSpeed     : 400,
		scrollEasing    : 'swing',
		scrollDelay     : 0,
		timer           : '00:15',
		highlight       : true,
		keepHighlighted : false,
		keepVisible     : false,
		onShowStep      : function(ui){ },
		onHideStep      : function(ui){ }
	}, { // //step 3, tip 9th
		hookTo          : '#hook-3_9',
		content         : '#step-3_9',
		width           : 500,
		position        : 'lt',
		offsetY         : 0,
		offsetX         : 10,
		fxIn            : 'fadeIn',
		fxOut           : 'fadeOut',
		showStepDelay   : 0,
		center          : 'center',
		scrollSpeed     : 400,
		scrollEasing    : 'swing',
		scrollDelay     : 0,
		timer           : '00:15',
		highlight       : true,
		keepHighlighted : false,
		keepVisible     : false,
		onShowStep      : function(ui){ },
		onHideStep      : function(ui){ bootbox.hideAll(); }
	},
	]

},

// step 4 tour
{
	trigger            : '#',
	startWith          : 1,
	easyCancel         : true,
	escKeyCancel       : true,
	scrollHorizontal   : false,
	keyboardNavigation : true,
	loopTour           : false,
	highlightStartSpeed: 200,
	highlightEndSpeed  : 200,
	onStartTour        : function(ui){ },
	onEndTour          : function(ui){ },	
	onProgress         : function(ui){ },
	steps : [
	{ //step 4, tip 1
		hookTo          : '#hook-4_1',
		content         : '#step-4_1',
		width           : 400,
		position        : 'bm',
		offsetY         : 25,
		offsetX         : 0,
		fxIn            : 'fadeIn',
		fxOut           : 'fadeOut',
		showStepDelay   : 0,
		center          : 'step',
		scrollSpeed     : 400,
		scrollEasing    : 'swing',
		scrollDelay     : 0,
		timer           : '00:15',
		highlight       : true,
		keepHighlighted : false,
		keepVisible     : false,
		onShowStep      : function(ui){},
		onHideStep      : function(ui){ }
	}, { //step 4, tip 2
		hookTo          : '#hook-4_2',
		content         : '#step-4_2',
		width           : 400,
		position        : 'lt',
		offsetY         : 0,
		offsetX         : 0,
		fxIn            : 'fadeIn',
		fxOut           : 'fadeOut',
		showStepDelay   : 0,
		center          : 'center',
		scrollSpeed     : 400,
		scrollEasing    : 'swing',
		scrollDelay     : 0,
		timer           : '00:15',
		highlight       : true,
		keepHighlighted : false,
		keepVisible     : false,
		onShowStep      : function(ui){},
		onHideStep      : function(ui){ }
	}, { //step 4, tip 3
		hookTo          : '#hook-4_3',
		content         : '#step-4_3',
		width           : 400,
		position        : 'lt',
		offsetY         : 0,
		offsetX         : 0,
		fxIn            : 'fadeIn',
		fxOut           : 'fadeOut',
		showStepDelay   : 0,
		center          : 'center',
		scrollSpeed     : 400,
		scrollEasing    : 'swing',
		scrollDelay     : 0,
		timer           : '00:15',
		highlight       : true,
		keepHighlighted : false,
		keepVisible     : false,
		onShowStep      : function(ui){	},
		onHideStep      : function(ui){ }
	}, { // //step 4, tip 4th
		hookTo          : '#hook-4_4',
		content         : '#step-4_4',
		width           : 400,
		position        : 'lt',
		offsetY         : 0,
		offsetX         : 20,
		fxIn            : 'fadeIn',
		fxOut           : 'fadeOut',
		showStepDelay   : 0,
		center          : 'center',
		scrollSpeed     : 400,
		scrollEasing    : 'swing',
		scrollDelay     : 0,
		timer           : '00:15',
		highlight       : true,
		keepHighlighted : false,
		keepVisible     : false,
		onShowStep      : function(ui){ },
		onHideStep      : function(ui){ }
	}, { // //step 4, tip 5th
		hookTo          : '#hook-4_5',
		content         : '#step-4_5',
		width           : 500,
		position        : 'rt',
		offsetY         : 0,
		offsetX         : 0,
		fxIn            : 'fadeIn',
		fxOut           : 'fadeOut',
		showStepDelay   : 0,
		center          : 'center',
		scrollSpeed     : 400,
		scrollEasing    : 'swing',
		scrollDelay     : 0,
		timer           : '00:15',
		highlight       : true,
		keepHighlighted : false,
		keepVisible     : false,
		onShowStep      : function(ui){ },
		onHideStep      : function(ui){ }
	}
	]
}, 

// step 5 tour
{
	trigger            : '#',
	startWith          : 1,
	easyCancel         : true,
	escKeyCancel       : true,
	scrollHorizontal   : false,
	keyboardNavigation : true,
	loopTour           : false,
	highlightStartSpeed: 200,
	highlightEndSpeed  : 200,
	onStartTour        : function(ui){ },
	onEndTour          : function(ui){ },	
	onProgress         : function(ui){ },
	steps : [
	{ //step 4, tip 1
		hookTo          : '#hook-5_1',
		content         : '#step-5_1',
		width           : 400,
		position        : 'sc',
		offsetY         : 25,
		offsetX         : 0,
		fxIn            : 'fadeIn',
		fxOut           : 'fadeOut',
		showStepDelay   : 0,
		center          : 'step',
		scrollSpeed     : 400,
		scrollEasing    : 'swing',
		scrollDelay     : 0,
		timer           : '00:15',
		highlight       : true,
		keepHighlighted : false,
		keepVisible     : false,
		onShowStep      : function(ui){},
		onHideStep      : function(ui){ }
	}
	]
}, 

// step 6 tour
{
	trigger            : '#',
	startWith          : 1,
	easyCancel         : true,
	escKeyCancel       : true,
	scrollHorizontal   : false,
	keyboardNavigation : true,
	loopTour           : false,
	highlightStartSpeed: 200,
	highlightEndSpeed  : 200,
	onStartTour        : function(ui){ },
	onEndTour          : function(ui){ },	
	onProgress         : function(ui){ },
	steps : [
	{ //step 4, tip 1
		hookTo          : '#hook-6_1',
		content         : '#step-6_1',
		width           : 400,
		position        : 'bl',
		offsetY         : 25,
		offsetX         : 0,
		fxIn            : 'fadeIn',
		fxOut           : 'fadeOut',
		showStepDelay   : 0,
		center          : 'step',
		scrollSpeed     : 400,
		scrollEasing    : 'swing',
		scrollDelay     : 0,
		timer           : '00:15',
		highlight       : true,
		keepHighlighted : false,
		keepVisible     : false,
		onShowStep      : function(ui){},
		onHideStep      : function(ui){ }
	}, { //step 4, tip 2
		hookTo          : '#hook-6_2',
		content         : '#step-6_2',
		width           : 400,
		position        : 'lt',
		offsetY         : 0,
		offsetX         : 0,
		fxIn            : 'fadeIn',
		fxOut           : 'fadeOut',
		showStepDelay   : 0,
		center          : 'center',
		scrollSpeed     : 400,
		scrollEasing    : 'swing',
		scrollDelay     : 0,
		timer           : '00:15',
		highlight       : true,
		keepHighlighted : false,
		keepVisible     : false,
		onShowStep      : function(ui){},
		onHideStep      : function(ui){ }
	}, { //step 4, tip 3
		hookTo          : '#hook-6_3',
		content         : '#step-6_3',
		width           : 400,
		position        : 'rt',
		offsetY         : 0,
		offsetX         : 0,
		fxIn            : 'fadeIn',
		fxOut           : 'fadeOut',
		showStepDelay   : 0,
		center          : 'center',
		scrollSpeed     : 400,
		scrollEasing    : 'swing',
		scrollDelay     : 0,
		timer           : '00:15',
		highlight       : true,
		keepHighlighted : false,
		keepVisible     : false,
		onShowStep      : function(ui){	},
		onHideStep      : function(ui){ }
	}, { // //step 4, tip 4th
		hookTo          : '#paymentfields',
		content         : '#step-6_4',
		width           : 400,
		position        : 'lt',
		offsetY         : 0,
		offsetX         : 20,
		fxIn            : 'fadeIn',
		fxOut           : 'fadeOut',
		showStepDelay   : 0,
		center          : 'center',
		scrollSpeed     : 400,
		scrollEasing    : 'swing',
		scrollDelay     : 0,
		timer           : '00:15',
		highlight       : true,
		keepHighlighted : false,
		keepVisible     : false,
		onShowStep      : function(ui){ },
		onHideStep      : function(ui){ }
	}, { // //step 6, tip 5th
		hookTo          : '#hook-6_5',
		content         : '#step-6_5',
		width           : 500,
		position        : 'lt',
		offsetY         : 0,
		offsetX         : 0,
		fxIn            : 'fadeIn',
		fxOut           : 'fadeOut',
		showStepDelay   : 0,
		center          : 'center',
		scrollSpeed     : 400,
		scrollEasing    : 'swing',
		scrollDelay     : 0,
		timer           : '00:15',
		highlight       : true,
		keepHighlighted : false,
		keepVisible     : false,
		onShowStep      : function(ui){ },
		onHideStep      : function(ui){ }
	}
	]
}, 

]
});	

$.ajax({
	url: '/editor/get_step',
	type: 'POST',
	data: {way: 'auto'},
	success: function(step)
	{
		// console.log(msg);
		if(step=='1') {$.powerTour('run',1);}
		else if(step=='2') {$.powerTour('run',2);}
		else if(step=='3') {$.powerTour('run',3);}
		else if(step=='4') {$.powerTour('run',4);}
		else if(step=='5') {$.powerTour('run',5);}
		else if(step=='6') {$.powerTour('run',6);}
	}
});


});