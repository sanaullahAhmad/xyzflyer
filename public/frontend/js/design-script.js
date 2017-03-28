var _selectedFile = "";
var _FlyerType = "";
var _FlyerXsize = 0;
var _FlyerYsize = 0;
var i = 1;
var _lockFlag = 1;
var _randomID = 1;
var _flag = 0;
$(document).ready(function($) {
    /**************************************************************/
    /*$('#picker').colpick({
        //flat:true,
        //flat:true,
        color: '#000000',
        layout: 'hex',
        colorScheme: 'dark',
        onChange: function(hsb, hex, rgb, el, bySetColor) {
            $(el).css('border-color', '#' + hex);
            //$(el).css('background-color','#'+hex);
            // Fill the text box just if the color was set using the picker, and not the colpickSetColor function.
            //alert('Here in color 1');
            if (!bySetColor) $(el).val(hex);
        },
        onSubmit: function(hsb, hex, rgb, el, bySetColor) {
            $(el).css('border-color', '#' + hex);
            //$(el).css('background-color','#'+hex);
            // Fill the text box just if the color was set using the picker, and not the colpickSetColor function.
            //function calling
            $(el).colpickHide();
            alert('Here in color 1');
            //proFabric.text.SetTextColor('#' + hex);
            // if(!bySetColor) $(el).val(hex);
        }
    });*/
    /*********************************************************************/
    $("#img-count1").removeClass('ui-state-active ui-widget-content');
    $("#uploadfile_1").change(function() {
        readURL(this);
        var file = this.files[0];
        var name = file.name;
        var size = file.size;
        var type = file.type;
        //console.log(file);
        console.log(name + " : " + size + " : " + type);
    });
    $("body").delegate('#addTextbtn', 'click', function() {
        //event.preventDefault();
        var obj;
        //console.log(
        //var bgcol =
        console.log('I am here');
        console.log($('#picker').css('borderBottomColor'));
        var hex_Col = proFabric.rgb2hex($('#picker').css('borderBottomColor'));
        console.log(hex_Col);
        var txt = $("#addText").val();
        obj = {
            text: txt,
            color: hex_Col,
            fontSize: $("#FontSize").val(),
            fontFamily: $("#FontFamily").val()
        };
        proFabric.text.add(obj);
        //console.log(txt);
        event.preventDefault();
        var txt = $("#addText").val();
        proFabric.text.add(txt);
    });
    $('#addText').bind('input', function() {
        proFabric.text.SetText($("#addText").val());
    });
    $("body").delegate('#ColorPicker', 'click', function(event) {
        event.preventDefault();
        console.log('I am here');
        proFabric.disableSelection();
        proFabric.droper();
        proFabric.enableSelection();
    });
    $('#FontSize').change(function() {
        var value = $("#FontSize option:selected").val();
        proFabric.text.set({
            fontSize: parseInt(value)
        });
    });
    $('#FontFamily').change(function() {
        var faimly = $("#FontFamily option:selected").val();
        proFabric.text.set({
            fontFamily: faimly
        });
    });
    $("body").delegate('#bold', 'click', function() {
        proFabric.text.set({
            fontWeight: 'bold'
        });
    });
    $("body").delegate('#italic', 'click', function() {
        proFabric.text.set({
            fontStyle: 'italic'
        });
    });
    $("body").delegate('#underline', 'click', function() {
        proFabric.text.set({
            textDecoration: 'underline'
        });
    });
    $("body").delegate('#left', 'click', function() {
        proFabric.text.set({
            textAlign: 'left'
        });
    });
    $("body").delegate('#right', 'click', function() {
        proFabric.text.set({
            textAlign: 'right'
        });
    });
    $("body").delegate('#center', 'click', function() {
        proFabric.text.set({
            textAlign: 'center'
        });
    });
    $("body").delegate('#Justify', 'click', function() {
        proFabric.text.set({
            textAlign: 'justify'
        });
    });
    $("body").delegate('#lock', 'click', function() {
        proFabric.set.lock();
    });
    $("body").delegate('#bringToFront', 'click', function() {
        proFabric.text.bringTextToFront();
        console.log("#bringToFront");
    });
    $("body").delegate('#bringToBack', 'click', function() {
        proFabric.text.bringTextToBack();
        console.log("#bringToBack");
    });
    $("body").delegate('#delete', 'click', function() {
        proFabric.delete('text');
    });
    $(document).delegate("img.add_svg", "click", function() {
        var id = proFabric.color.add($(this).attr("src"));
    });
    $(document).delegate("img.add_svg", "click", function() {
        var id = proFabric.color.add($(this).attr("src"));
    });
});


function addColorSet() {
    var sample = '<div id="color-sample-1"> <h3 class="center-text">Set Flyer Color Option 1</h3> <div class="col-wrap"> <div class="row"> <div class="col-three"> <div class="set-color-box mb-10"> Color 1 </div> </div> <div class="col-three"> <div class="color-box mb-10" style="background-color: #ffe59b"> &nbsp </div> </div> <div class="col-three last"> <div class="color-rgb-box mb-10"> R 255, G 229, B 156 </div> </div> </div> </div> </div>';
}
/*$("body").delegate('#unlock','click',function(){
 proFabric.set.unlock();
 });*/
/*$(document).delegate("img.add_svg", "click", function() {
 var id = new Date().getTime();
 proFabric.color.add($(this).attr("src"), id);
 if ($("#setcolortext div").last().html()) {
 i = i + 1;
 console.log(i);
 }
 $("#sample-sets #setcolortext").append('<div class="set-color-box mb-10">Color ' + i + '</div>');
 $("#sample-sets #setcolorbackground").append('<div id=' + id + ' class="color colorpicker color-box mb-10" style="background-color: #0036CC">&nbsp</div>');
 $("#sample-sets #setcolorcode").append('<div class="color-rgb-box mb-10">R 0, G 54, B 204</div>');
 colorpicker();
 });*/
/*$(document).delegate("#colortabs li", "click", function() {
 var html = $('#color-sample-area div:has(:visible)').find('#setcolorbackground');
 $(html.children()).each(function() {
 proFabric.color.fill($(this).attr('id'), $(this).css('backgroundColor'));
 });
 });
 $(document).delegate("#savecolor ", "click", function() {
 var num = 1;
 $("#color-sample-area>div").each(function() {
 console.log($(this).attr('id'));
 if ($(this).children().length == 1) {
 $(this).html($("#sample-sets").html());
 $(this).children('#setcolortitle').html("Set Flyer Color Option " + num + "");
 return false;
 } else {
 num = num + 1;
 }
 });
 //colorpicker();
 });
 colorpicker();
 /*function updateText(Object)
 {
 $("#addText").val(Object);
 }*/
/*
 var readURL = function(input) {left
 console.log(input.files);
 for(var i=0;i<input.files.length;i++)
 {
 if (input.files && input.files[i]) {
 var reader = new FileReader();
 reader.onload = function (e) {
 prototypefabric.addImage(e.target.result);
 setTimeout(function(){
 $(".file-upload").val('');
 },1000);
 }
 reader.readAsDataURL(input.files[i]);
 }
 }
 >>>>>>> d6bcd6275735aba2d3115ffd363602414c088c54
 }


 /*Umar's work*/
/*$(document).delegate("#zoomminus", "click", function() {
 alert("msg");
 proFabric.set.zoom($("#zoomValue").val());
 console.log($("#zoomValue").val());
 });
 $(document).delegate("#zoomplus", "click", function() {
 proFabric.set.zoom($("#zoomValue").val());
 });
 $(document).delegate("#addimage", "click", function() {
 proFabric.image.add('images/images/test.jpg', {
 id: proFabric.get.guid()
 });
 });
 $(document).delegate("#lock_img", "click", function() {
 proFabric.set.lock();
 });
 $(document).delegate("#unlock_img", "click", function() {
 proFabric.set.unlock();
 });
 $(document).delegate("#bringFrontImage", "click", function() {
 proFabric.set.bringFront();
 });
 $(document).delegate("#bringBackImage", "click", function() {
 proFabric.set.sendBack();
 });
 $(document).delegate("#lock_color", "click", function() {
 proFabric.set.lock();
 });
 $(document).delegate("#unlock_color", "click", function() {
 proFabric.set.unlock();
 });
 $(document).delegate("#bringFrontColor", "click", function() {
 proFabric.set.bringFront();
 });
 $(document).delegate("#bringBackColor", "click", function() {
 proFabric.set.sendBack();
 });
 $('#color_width_input').change(function(event) {
 var width = $("#color_width_input").val();
 var height = $("#color_height_input").val();
 proFabric.color.scaleToWidth(width);
 //proFabric.shapes.setScaleX(width);
 });
 $('#color_height_input').change(function(event) {
 var width = $("#color_width_input").val();
 var height = $("#color_height_input").val();
 proFabric.color.scaleToHeight(height);
 //proFabric.shapes.setScaleY(height);
 });
 $('#img_width_input').change(function(event) {
 var width = $("#img_width_input").val();
 var height = $("#img_height_input").val();
 proFabric.image.set({
 width, height
 });
 });
 $('#img_height_input').change(function(event) {
 var width = $("#img_width_input").val();
 var height = $("#img_height_input").val();
 proFabric.image.set({
 width, height
 });
 });
 $('body').delegate('#image-count>div', 'click', function(event) {
 console.log($(this).attr('class'));
 var obj = proFabric.get.currentObject();
 var id = new Date().getTime();
 if ($(this).hasClass('ui-state-active')) {
 if ($(this).attr('uniqueId') == obj.linkid) {
 id = '';
 $(this).attr('uniqueId', id);
 proFabric.image.set({
 'linkid': id
 });
 $(this).removeClass('ui-state-active');
 } else {
 event.preventDefault();
 proFabric.set.setActiveobj($(this).attr('uniqueId'));
 return;
 }
 } else {
 event.preventDefault();
 if (obj.linkid != '') {
 alert('object already linked');
 return;
 }
 $(this).attr('uniqueId', id);
 console.log('ja raha');
 $(this).addClass('ui-state-active');
 proFabric.image.set({
 'linkid': id
 });
 }
 console.log($(this).attr('class'));
 });
 $('#shape_width_input').change(function(event) {
 var width = $("#shape_width_input").val();
 var height = $("#shape_height_input").val();
 proFabric.shapes.scaleToWidth(width);
 //proFabric.shapes.setScaleX(width);
 });
 $('#shape_height_input').change(function(event) {
 var width = $("#shape_width_input").val();
 var height = $("#shape_height_input").val();
 proFabric.shapes.scaleToHeight(height);
 //proFabric.shapes.setScaleY(height);
 });
 $('body').delegate('#canvas_size li', 'click', function(event) {
 var values = $(this).children('a').html();
 var values = values.split('x');
 proFabric.set.canvas_size(proFabric.get.inchesToPixel(values[0]), proFabric.get.inchesToPixel(values[1]));
 });
 $(document).delegate("#addshape", "click", function() {
 proFabric.shapes.add('images/SVG/plain.svg');
 });
 $(document).delegate("#lock_shape", "click", function() {
 proFabric.set.lock();
 });
 $(document).delegate("#unlock_shape", "click", function() {
 proFabric.set.unlock();
 });
 $(document).delegate("#bringFrontShape", "click", function() {
 proFabric.set.bringFront();
 });
 $(document).delegate("#bringBackShape", "click", function() {
 proFabric.set.sendBack();
 });

 function addColorSet() {
 var sample = '<div id="color-sample-1"> <h3 class="center-text">Set Flyer Color Option 1</h3> <div class="col-wrap"> <div class="row"> <div class="col-three"> <div class="set-color-box mb-10"> Color 1 </div> </div> <div class="col-three"> <div class="color-box mb-10" style="background-color: #ffe59b"> &nbsp </div> </div> <div class="col-three last"> <div class="color-rgb-box mb-10"> R 255, G 229, B 156 </div> </div> </div> </div> </div>';
 }
 /*$('.colorpicker').colpick({
 color:'78A4BA',
 onShow:function(el){
 },
 onChange:  function(hsb,hex,rgb,el) {

 },
 onSubmit:function(hsb,hex,rgb,el) {
 var type = $(el).data('type');
 if(type=="svgfill"){
 proFabric.shapes.fill('#'+hex);
 $('#svgFill').css('background-color', '#'+hex);
 }
 if(type=="svgstroke"){
 proFabric.shapes.stroke_color('#'+hex);
 }
 $('#svgStroke').css('background-color', '#'+hex);*/
/*function colorpicker() {
 $('div.colorpicker').colpick({
 onShow: function(el) {},
 onChange: function(hsb, hex, rgb, el) {},
 onSubmit: function(hsb, hex, rgb, el) {
 var type = $(el).data('type');
 if (type == "svgfill") {
 proFabric.shapes.fill('#' + hex);
 $('#svgFill').css('background-color', '#' + hex);
 }
 if (type == "svgstroke") {
 proFabric.shapes.stroke_color('#' + hex);
 $('#svgStroke').css('background-color', '#' + hex);
 }
 $(el).css('background-color', '#' + hex);
 $(el).colpickHide();
 }
 });
 }*/


