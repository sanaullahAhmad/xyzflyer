var _selectedFile = "";
var _FlyerType = "";
var _FlyerXsize = 0;
var _FlyerYsize = 0;
var i = 1;
var _lockFlag = 1;
var _randomID = 1;
var _flag = 0;
var obj;
var t_id="";
var _zoomMenu=0;

var tabs = ['prop-info', 'agent-info', 'agent-2-info', 'company-info', 'company-2-info'];
$(document).ready(function($) {
    $(window).load(function(){
       $('#editor-uploaderModal').modal('hide'); 
    });
    


    // for(var i=0;i<_fontSize.length;i++)
    // {
    //     if(Object.maxfontSize>=_fontSize[i])
    //     $('#fontSize').append($('<option>', {
    //         value: _fontSize[i],
    //         text: _fontSize[i]
    //     }));
    // }
    /*var _json = window._json;
    console.log(_json);
    proFabric.import.json(_json);*/
    var _options = {
        maxValue: 999,
        minValue: -999,
        step: 1,
        start: 1,
        inputWidth: 40,
        plusClick: function(element, val) {// callbacks
            return true;
        },
        minusClick: function(element, val) {
            return true;
        },
        exceptionFun: function(exp) {
            return true;
        },
        valueChanged: function(element, val) {
            return true;
        }
    }
    $(".demo").WanSpinner(_options);


    sets = {
        0: {
            0: {
                id: 'set-id-1',
                color: '#FF8000'
            },
            1: {
                id: 'set-id-2',
                color: '#B8CC00'
            },
            2: {
                id: 'set-id-3',
                color: '#336600'
            },
            3: {
                id: 'set-id-4',
                color: '#00FFB3'
            },
            4: {
                id: 'set-id-5',
                color: '#00CCFF'
            },
            5: {
                id: 'set-id-6',
                color: '#007ACC'
            }
        },
        1: {
            0: {
                id: 'set-id-1',
                color: '#99006B'
            },
            1: {
                id: 'set-id-2',
                color: '#CC0052'
            },
            2: {
                id: 'set-id-3',
                color: '#FF001A'
            },
            3: {
                id: 'set-id-4',
                color: '#99002E'
            },
            4: {
                id: 'set-id-5',
                color: '#808000'
            },
            5: {
                id: 'set-id-6',
                color: '#90EE90'
            }
        },
        2: {
            0: {
                id: 'set-id-1',
                color: '#B22222'
            },
            1: {
                id: 'set-id-2',
                color: '#C71585'
            },
            2: {
                id: 'set-id-3',
                color: '#D2691E'
            },
            3: {
                id: 'set-id-4',
                color: '#D8BFD8'
            },
            4: {
                id: 'set-id-5',
                color: '#DB7093'
            },
            5: {
                id: 'set-id-6',
                color: '#DEB887'
            }
        },
        3: {
            0: {
                id: 'set-id-1',
                color: '#F0E68C'
            },
            1: {
                id: 'set-id-2',
                color: '#F4A460'
            },
            2: {
                id: 'set-id-3',
                color: '#FA8072'
            },
            3: {
                id: 'set-id-4',
                color: '#FF0000'
            },
            4: {
                id: 'set-id-5',
                color: '#191970'
            },
            5: {
                id: 'set-id-6',
                color: '#FFFF00'
            }
        },
        4: {
            0: {
                id: 'set-id-1',
                color: '#696969'
            },
            1: {
                id: 'set-id-2',
                color: '#708090'
            },
            2: {
                id: 'set-id-3',
                color: '#7B68EE'
            },
            3: {
                id: 'set-id-4',
                color: '#808080'
            },
            4: {
                id: 'set-id-5',
                color: '#8A2BE2'
            },
            5: {
                id: 'set-id-6',
                color: '#2E8B57'
            }
        },
        5: {
            0: {
                id: 'set-id-1',
                color: '#4B0082'
            },
            1: {
                id: 'set-id-2',
                color: '#6A5ACD'
            },
            2: {
                id: 'set-id-3',
                color: '#FF69B4'
            },
            3: {
                id: 'set-id-4',
                color: '#006400'
            },
            4: {
                id: 'set-id-5',
                color: '#DAA520'
            },
            5: {
                id: 'set-id-6',
                color: '#00FFFF'
            }
        }
    }
    var j = 1;
    i = 1;
    $.each(sets, function (index, obj) {
        $.each(obj, function (index, obj1) {
            $('#C' + i + j).css("background-color", obj1.color);
            ++j;
        });
        j = 1;
        ++i;
    });

    $('#col-picker').hide();
    $('#col-picker').colorpicker(
        {color:'#31859b', defaultPalette:'web',showOn:'button'}
    )
    .on('change.color', function(event, color){
        $('body').find('.evo-colorind, .evo-colorind-ie, .evo-colorind-ff').css("width", "64px");
        $('body').find('.evo-colorind, .evo-colorind-ie, .evo-colorind-ff').css("height", "24px");
        $('body').find('.evo-colorind, .evo-colorind-ie, .evo-colorind-ff').css("border-radius", "3px");
        $('body').find('.evo-colorind, .evo-colorind-ie, .evo-colorind-ff').css("border", "");
        $('body').find('.evo-colorind, .evo-colorind-ie, .evo-colorind-ff').css("float", "left");
            if(color)
                proFabric.text.set({
                    fill: color
                });col_flag
    });
    setTimeout(function(){
       $('body').find('.evo-colorind, .evo-colorind-ie, .evo-colorind-ff').css("width", "64px");
        $('body').find('.evo-colorind, .evo-colorind-ie, .evo-colorind-ff').css("height", "24px");
        $('body').find('.evo-colorind, .evo-colorind-ie, .evo-colorind-ff').css("border-radius", "3px");
        $('body').find('.evo-colorind, .evo-colorind-ie, .evo-colorind-ff').css("border", "");
        $('body').find('.evo-colorind, .evo-colorind-ie, .evo-colorind-ff').css("float", "left")
    },1000);

    $('body').delegate('.color-pallet-row','click',function(){
        $.each($('body').find('.txt'),function(index,obj){
            $(obj).removeClass('textalignactive');
        });
        $.each($('body').find('.colorRow'),function(index,obj){
            $(obj).removeClass('colorRowhover');
        });
        $(this).addClass('colorRowhover');
        $(this).find('.txt').addClass('textalignactive');
    });
    $("body").delegate('#Ccol-1', 'click', function(event) {
        i=1;
        $.each(sets, function (index, obj) {
            if (i == '1') {
                proFabric.text.setGroupTextColor(obj);
            }
            ++i;
        });
    });
    $("body").delegate('#Ccol-2', 'click', function(event) {
        i=1;
        $.each(sets, function (index, obj) {
            if (i == '2') {
                proFabric.text.setGroupTextColor(obj);
            }
            ++i;
        });
    });
    $("body").delegate('#Ccol-3', 'click', function(event) {
        i=1;
        $.each(sets, function (index, obj) {
            if (i == '3') {
                proFabric.text.setGroupTextColor(obj);
            }
            ++i;
        });
    });
    $("body").delegate('#Ccol-4', 'click', function(event) {
        i=1;
        $.each(sets, function (index, obj) {
            if (i == '4') {
                proFabric.text.setGroupTextColor(obj);
            }
            ++i;
        });
    });
    $("body").delegate('#Ccol-5', 'click', function(event) {
        i=1;
        $.each(sets, function (index, obj) {
            if (i == '5') {
                proFabric.text.setGroupTextColor(obj);
            }
            ++i;
        });
    });
    $("body").delegate('#Ccol-6', 'click', function(event) {
        i=1;
        $.each(sets, function (index, obj) {
            if (i == '6') {
                proFabric.text.setGroupTextColor(obj);
            }
            ++i;
        });
    });

/*
    $("body").delegate('.divbtnImgs', 'click', function(event) {
        proFabric.unselectSelected();
        proFabric.setActiveId($(this).attr('id'));
        console.log($(this).attr('id'));
        //console.log($(this).attr('id'));
    });*/

    /*$("body").delegate('.btnImgs', 'click', function(event) {
        t_id = $(this).attr('id');
        proFabric.unselectSelected();
        proFabric.setActiveId(t_id);
        alert(t_id);
        $( "#imageUpload" ).trigger( "click" );
    });*/

    $(document).delegate('#cancelCrop','click',function(){
        $('#editor-cropperModal').modal('hide');
        proFabric.deselectCanvas();
    });

    $(document).delegate('.modal-header .close','click',function(){
        proFabric.deselectCanvas();
        console.log('canvas deselected');
    });   

    $(document).delegate('#imageUpload','change',function(){
        readURL(this);
        $('#editor-uploaderModal').modal('hide');
    });
    var readURL = function(input) {
        // alert("HERE");
            if (input.files) {
                var reader = new FileReader();
                if(input.files[0].size <= (5*1024*1024))
                {
                    reader.onload = function(e) {
                        // $('#imgLoading').modal('hide');
                        // proFabric.cropImage(e.target.result);

                        var _idd = proFabric.canvas.getActiveObject().id;
                        var _objID = proFabric.getIds().id;
                        bootbox.dialog({
                        message:'<center><img src="'+e.target.result+'"/><br></center>',
                        buttons: {
                                    insert: {
                                        label: "Insert",
                                        className: "btn-success",
                                        callback: function() {
                                            proFabric.upload_cropped_image(e.target.result, _objID,_idd);
                                        }
                                    },
                                    crop: {
                                        label: "Crop Image",
                                        className: "btn-primary",
                                        callback: function() {
                                            proFabric.cropImage(e.target.result);
                                        }
                                    },
                                    cancel: {
                                        label: "Cancel",
                                        className: "btn-default",
                                        callback: function() {
                                            proFabric.deselectCanvas();
                                            bootbox.hideAll();
                                        }
                                    },
                                },
                        backdrop:true,
                        closeButton: false,
                    });
                        
                        // console.log(e.target.result);
                        console.log("Image Loaded");
                        setTimeout(function() {
                            $(".imageUpload").val('');
                        }, 2000);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
                else
                {
                    bootbox.dialog({
                        message:'Please select an Image of size less than 5MB',
                        buttons: {
                                    yes: {
                                        disabled: "false",
                                        label: "Upload New",
                                        className: "btn-success",
                                        callback: function() {
                                            bootbox.hideAll();
                                            $('#editor-uploaderModal').modal('show');
                                        }
                                    },
                                    no: {
                                        label: "Cancel",
                                        className: "btn-default",
                                        callback: function() {
                                            bootbox.hideAll();
                                            proFabric.deselectCanvas();
                                        }
                                    },
                                },
                        backdrop:true,
                        closeButton: false,
                    });
                }
                   
            }
        
    }

    $("body").delegate('#Up-imageUpload', 'click', function(event) {
        $( "#imageUpload" ).trigger( "click" );
    });

    $("body").delegate('#crop-Done-btn', 'click', function(event) {
        proFabric.newImg(obj);
        $('#crop-End-btn').trigger('click');
    });


    $("body").delegate('#modal-click', 'click', function(event) {
        var img = new Image();
        var _src = proFabric.getEditImg();
        $('.cropper-container>img').css("width", "300px");
        $('.cropper-container>img').css("height", "300px");
        img.onload = function() {
            $('#img-Edit').html(img);
            setTimeout(function(){
                $('#img-Edit').find('img').cropper({
                    aspectRatio: 9 / 10,
                    viewMode :3,
                    responsive:true,
                    scalable:true,
                    movable: true,
                    crop: function(e) {
                        obj = {//JSON
                            x: e.x,
                            y: e.y,
                            width: e.width,
                            height: e.height,
                            rotate : e.rotate,
                            scaleX : e.scaleX,
                            scaleY : e.scaleY,
                            src : _src,
                            imgHeight : img.height,
                            imgWidth : img.width
                        }
                    }
                });
                img.style.width = '100%';
                img.style.marginBottom = '10px';
                $("#myModal").modal('show');
            },1500);
        };

        img.src = _src;

    });
    

   
    $("body").delegate('#settingbtn', 'click', function(event) {
        proFabric.unselectSelected();
        $("#colorStyleOpt").show();
        $("#settingOpt").fadeOut();
        $("#imageOpt").fadeOut();
        $("#settingOpt").fadeOut();
        $("#textOpt").fadeOut();
        proFabric.getcolorObjects();
        proFabric.selectfalseColor();
    });
    /*$('#text-area').bind('keyup', function(e) {col_flag
        console()
        if(e.keyCode == 8)
        {
            prototypefabric.removeObj();
            return;
        }
    });*/
    canvas = proFabric.canvas;
    $(document).delegate('#text-area','keyup',function(e){
        // console.log(e.keyCode);
        // var _num=0;
        // if(e.keyCode == 8)
        // {
        //     //alert(e.keyCode);
        //     _num=proFabric.text.getNextLinesCount();
        // }
        var _height = canvas.getActiveObject().height;
        var _txt = $("#text-area").val();
        proFabric.text.set({text:_txt});
        canvas.getActiveObject().setHeight(_height);
        canvas.renderAll();
        /*var _count = 0;
        for(var k=0;k<_txt.length;k++)
        {
            if(_txt[k]=='\n')_count++;
        }
        //console.log(proFabric.text.getNextLinesCount());
        //console.log(_count);
        if(proFabric.text.getNextLinesCount()>=_count) {
            proFabric.text.SetText(_txt);
            if (_num)
            {
                proFabric.setNextLinesCount(_num);
            }
            return;
        }
        if (_num)
        {
            proFabric.text.setNextLinesCount(_num);
        }
        $("#text-area").val(proFabric.text.get("text"));*/
    });

    /*$(document).delegate('#text-area','keyup',function(){
    var _text = $(this).val();
    var obj = canvas.getActiveObject();
    if(obj){

        if(obj.class == 'text')
        {
            obj.set({
                text : _text
            });
            canvas.renderAll();
            console.log('text updated');
        }
    }
})
*/

    $("body").delegate('#ColorPicker', 'click', function(event) {
        event.preventDefault();
        proFabric.disableSelection();
        proFabric.droper();
        proFabric.enableSelection();
    });
    $(document).delegate('#font_Size','change',function() {
        var value = $(this).val();
        if(!canvas.getActiveObject())
            return;
        var _height = canvas.getActiveObject().height;
        if(Number($(this).val()) > $(this).attr('max'))
        {
            $(this).val($(this).attr('max'));
            value = $(this).attr('max');
        }
        if(Number($(this).val()) < $(this).attr('min'))
        {
            $(this).val($(this).attr('min'));
            value = $(this).attr('min');
        }
        proFabric.text.set({
            fontSize: parseInt(value)
        });
        canvas.getActiveObject().setHeight(_height);
        canvas.renderAll();
    });

    $(document).delegate('#textfont','change',function() {
        var family = $("#textfont option:selected").val();
        var _height = canvas.getActiveObject().height;
        //console.log(family);
        proFabric.text.set({
            fontFamily: family
        });
        canvas.getActiveObject().setHeight(_height);
        canvas.renderAll();
    });
    $(document).delegate('.bootstrap-colorpalette .btn-color','click',function(){
        obj = canvas.getActiveObject();
        color = $(this).attr('data-value');
        if(obj && obj.class == 'text')
        {
            proFabric.text.set({
                fill: color
            });  
            canvas.renderAll();
        }
        
    });
    $(document).delegate('#bold', 'click', function() {
        var _height = Number($('#TBHeight').val());
        var col = proFabric.rgb2hex($('#bold').css("background-color"));
        var bodCol = proFabric.rgb2hex($('#bold').css("border-color"));
        if( !$('#bold').hasClass("btn-primary")) {
            $('#bold').addClass("btn-primary");
            proFabric.text.set({
                fontWeight: 'bold'
            });
        }
        else
        {
            $('#bold').removeClass("btn-primary");
            proFabric.text.set({
                fontWeight: 'normal'
            });
        }
        canvas.getActiveObject().setHeight(_height);
        canvas.renderAll();
    });
    $(document).delegate('#italic', 'click', function() {
        var _height = Number($('#TBHeight').val());
        var col = proFabric.rgb2hex($('#italic').css("background-color"));
        var bodCol = proFabric.rgb2hex($('#italic').css("border-color"));
        if(!$('#italic').hasClass("btn-primary")) {
            $('#italic').addClass("btn-primary");
            proFabric.text.set({
                fontStyle: 'italic'
            });
        }
        else
        {
            $('#italic').removeClass("btn-primary");
            proFabric.text.set({
                fontStyle: 'normal'
            });
        }
        canvas.getActiveObject().setHeight(_height);
        canvas.renderAll();
    });
    $(document).delegate('#underline', 'click', function() {
        var _height = Number($('#TBHeight').val());
        var col = proFabric.rgb2hex($('#underline').css("background-color"));
        var bodCol = proFabric.rgb2hex($('#underline').css("border-color"));
        if(!$('#underline').hasClass("btn-primary")) {
            $('#underline').addClass("btn-primary");
            proFabric.text.set({
                textDecoration: 'underline'
            });
        }
        else
        {
            $('#underline').removeClass("btn-primary");
            proFabric.text.set({
                textDecoration: 'normal'
            });
        }
        canvas.getActiveObject().setHeight(_height);
        canvas.renderAll();
    });
    $('body').delegate('.zoom-class','click',function(){
        var _id = $(this).attr('id');
        if(_id=="zoom-50")
        {
            $("#zoom").val("50");
            proFabric.zoomcanvas(50);
        }
        else if(_id=="zoom-75")
        {
            $("#zoom").val("75");
            proFabric.zoomcanvas(75);
        }
        else if(_id=="zoom-100")
        {
            $("#zoom").val("100");
            proFabric.zoomcanvas(100);
        }
        else if(_id=="zoom-120")
        {
            $("#zoom").val("120");
            proFabric.zoomcanvas(120);
        }
        else if(_id=="zoom-125")
        {
            $("#zoom").val("125");
            proFabric.zoomcanvas(125);
        }
        else if(_id=="zoom-150")
        {
            $("#zoom").val("150");
            proFabric.zoomcanvas(150);
        }
        else if(_id=="zoom-200")
        {
            $("#zoom").val("200");
            proFabric.zoomcanvas(200);
        }
    });
    $('body').delegate('#zoom','click',function(){
        var _display = $( this ).css( "display" );
        _zoomMenu=1;
        // console.log(_display);
        //if(_display=="none")
        $('#zoom-menu').css("display", "block");
    });
    $("body").delegate('.minus', 'click', function() {
        var value = $("#zoom").val();

        var decreament = 10;
        value=value-decreament;
        $("#zoom").val("");
        $("#zoom").val(value);
        proFabric.zoomcanvas(value);
        //console.log("===========>> "+value);
    });
    /*$('body').click(function(){
        var _display = $( this ).css( "display" );
        var id = $( this).id;
        console.log(id +"----"+_display);
        if(_display=="block"&&id!="zoom"&&_zoomMenu==0) {
            $('#zoom-menu').css("display", "none");
        }
        _zoomMenu=0;
    });*/
	//$("body").delegate('body', 'click', function() {
     //   var _display = $( this ).css( "display" );
     //   console.log(_display);
     //   if($( this ).css( "display" )!="none")
	//	$('#zoom-menu').css("display", "none");
	//	});
	$('#zoom-menu li').click(function(){
		var value = $(this).val();
		$("#zoom").val(value);
		$('#zoom-menu').css("display", "none");
        _zoomMenu=0;
		 proFabric.zoomcanvas(value);
	});
    $("body").delegate('.plus', 'click', function() {
        var value = $("#zoom").val();
        var increament = 10;
        if(value<=0) {
            value = -Math.abs(value) + Math.abs(increament);
        }
        else {
            value = Math.abs(value) + Math.abs(increament);
        }
        //$("#zoom").val("");
        $("#zoom").val(value);
        //console.log("===========>> "+value);
        proFabric.zoomcanvas(value);
    });
    $("body").delegate('#left', 'click', function() {
        var _height = Number($('#TBHeight').val());
        var col = proFabric.rgb2hex($('#left').css("background-color"));
        var bodCol = proFabric.rgb2hex($('#left').css("border-color"));
        if(!$('#left').hasClass("btn-primary")) {
            $('#left').addClass("btn-primary");
            proFabric.text.set({
                textAlign: 'left'
            });
        }
        $('#right').removeClass("btn-primary");
        $('#center').removeClass("btn-primary");
        $('#justify').removeClass("btn-primary");
        canvas.getActiveObject().setHeight(_height);
        canvas.renderAll();
    });
    $("body").delegate('#right', 'click', function() {
        var _height = Number($('#TBHeight').val());
        var col = proFabric.rgb2hex($('#right').css("background-color"));
        var bodCol = proFabric.rgb2hex($('#right').css("border-color"));
        if(!$('#right').hasClass("btn-primary")) {
            $('#right').addClass("btn-primary");
            proFabric.text.set({
                textAlign: 'right'
            });
        }
        $('#left').removeClass("btn-primary");
        $('#center').removeClass("btn-primary");
        $('#justify').removeClass("btn-primary");
        canvas.getActiveObject().setHeight(_height);
        canvas.renderAll();
    });
    $("body").delegate('#center', 'click', function() {
        var _height = Number($('#TBHeight').val());
        var col = proFabric.rgb2hex($('#center').css("background-color"));
        var bodCol = proFabric.rgb2hex($('#center').css("border-color"));
        if(!$('#center').hasClass("btn-primary")) {
            $('#center').addClass("btn-primary");
            proFabric.text.set({
                textAlign: 'center'
            });
        }
        $('#left').removeClass("btn-primary");
        $('#right').removeClass("btn-primary");
        $('#justify').removeClass("btn-primary");
        canvas.getActiveObject().setHeight(_height);
        canvas.renderAll();
    });
    $("body").delegate('#justify', 'click', function() {
        var _height = Number($('#TBHeight').val());
        var col = proFabric.rgb2hex($('#justify').css("background-color"));
        var bodCol = proFabric.rgb2hex($('#justify').css("border-color"));
        if(!$('#justify').hasClass("btn-primary")) {
            $('#justify').addClass("btn-primary");
            proFabric.text.set({
                textAlign: 'justify'
            });
        }
        $('#left').removeClass("btn-primary");
        $('#right').removeClass("btn-primary");
        $('#center').removeClass("btn-primary");
        canvas.getActiveObject().setHeight(_height);
        canvas.renderAll();
    });
    $(document).delegate('#undobtn','click',function(event){
        event.preventDefault();
        proFabric.undo();
    });
    $(document).delegate('#redobtn','click',function(event){
        event.preventDefault();
        proFabric.redo();
    });

    $(document).delegate('#cropBtn','click',function(){
        $('#editor-uploaderModal').modal('hide');
        proFabric.cropImage(proFabric.canvas.getActiveObject().src);
    })
    $('#editor-cropperModal').on('hidden.bs.modal', function (e) {
        $('.cropper').remove();
    });

    $(document).delegate('#imageUpload_logo_company','change',function(){
        $('#editor-logo_companyModal').modal('hide');
        readLogoURL(this);
    });
    var readLogoURL = function(input) {
            if (input.files) {
                var reader = new FileReader();
                if(input.files[0].size <= (5*1024*1024))
                {
                    reader.onload = function(e) {
                        proFabric.placeLogoImage(e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
                else
                {
                    bootbox.dialog({
                        message:'Please select an Image of size less than 5MB',
                        buttons: {
                                    yes: {
                                        disabled: "false",
                                        label: "Upload New",
                                        className: "btn-success",
                                        callback: function() {
                                            bootbox.hideAll();
                                            $('#editor-uploaderModal').modal('show');
                                        }
                                    },
                                    no: {
                                        label: "Cancel",
                                        className: "btn-default",
                                        callback: function() {
                                            bootbox.hideAll();
                                        }
                                    },
                                },
                        'backdrop':true,
                    });
                }
                   
            }
        
    }

});
function removeclasses(obj){
    $(obj).removeClass('colorRowhover');
    $(obj).removeClass('textalignactive');
    $(obj).removeClass('colorRowhover');
}


    function addColorSet() {
        var sample = '<div id="color-sample-1"> <h3 class="center-text">Set Flyer Color Option 1</h3> <div class="col-wrap"> <div class="row"> <div class="col-three"> <div class="set-color-box mb-10"> Color 1 </div> </div> <div class="col-three"> <div class="color-box mb-10" style="background-color: #ffe59b"> &nbsp </div> </div> <div class="col-three last"> <div class="color-rgb-box mb-10"> R 255, G 229, B 156 </div> </div> </div> </div> </div>';
    }