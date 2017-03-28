var _selectedFile = "";
var _FlyerType = "";
var _FlyerXsize = 0;
var _FlyerYsize = 0;
var i = 1;
var _lockFlag = 1;
var _randomID = 1;
var _flag = 0;
var col_flag = 1;
var _gridSize = 30;
var _gridFlag = 0;
var _lockFlag = 0;
var _gridColor = "#9898a1";
var SnaptoGrid = 0;
var _gridToggle = 0;
var finalColorSets = ' ';
var _fullScreenFlag = false;
var _flagBG = true;
var button = [
['Address', 'Price', 'Main-header', 'Headline', 'Body-1', 'Body-2', 'Body-3', 'Call-action'],
['Agent-contect', 'Agent-license'],
['Agent-2-contect', 'Agent-2-license'],
['Company-contect', 'Company-license'],
['Company-2-contect', 'Company-2-license']
];
var tabs = ['prop-info', 'agent-info', 'agent-2-info', 'company-info', 'company-2-info'];
    // var _Fonts = "http://fonts.googleapis.com/css?family=Open";
    // var _fontSize = ['8','9','10','11','12','14','16','18','20','22','24','26','28','36','48','72'];


    $(document).ready(function($) {
        var options = {iframe: {url: base_url+'admin/manageflyers/save_flyer_assets'}};
          var zone = new FileDrop('zbasic', options);

          zone.event('send', function (files) {
            files.each(function (file) {
                file.event('done', function (xhr) {
                    // console.log(xhr);
                  // alert('Done uploading ' + this.name + ',' +
                        // ' response:\n\n' + xhr.responseText);
                        var jsn = xhr.responseText;
                        jsn = $.parseJSON(jsn);
                        console.log('xhr.responseText  => '+jsn.url);
                        console.log('this.name   =>   '+jsn.name);
                        var _src = jsn.url;
                    var size = $('#editor-imageList').children().size();
                    var id = proFabric.get.guid();
                    $('#editor-imageList').children().removeClass('btn-primary');
                    $('#editor-imageList').append('<button type="button" class="btn btn-default btn-circle btn-primary imagetextbold" data-id="'+(id)+'">'+(size+1)+'</button>');
                    proFabric.image.add(_src, {id:id, name: jsn.name});
                } );

              file.event('error', function (e, xhr) {
                alert('Error uploading ' + jsn.name + ': ' +
                      xhr.status + ', ' + xhr.statusText);
              });
              file.event('progress', function (sent, total) {
                    $('#zbasic').find('.progressing').remove();
                    $('.progress-bar').css('width',Math.round(sent / total * 100)+'%');
                    $('.progress-bar').text(Math.round(sent / total * 100)+'%');
                    var html = $('.progress').html();
                  $('#zbasic').append(html);
                })
              file.sendTo(base_url+'admin/manageflyers/save_flyer_assets');
            });
          });

          // <iframe> uploads are special - handle them.
          zone.event('iframeDone', function (xhr) {
            alert('Done uploading via <iframe>, response:\n\n' + xhr.responseText);
          });

          // Toggle multiple file selection in the File Open dialog.
          // fd.addEvent(fd.byID('zbasicm'), 'change', function (e) {
            zone.multiple(true);
          // });
    // alert("Welcome here");
    //$(".upper-canvas").css("margin-bottom","20px");
    $(".canvas-container").css("margin-bottom","20px");
    $(".canvas-container").css("margin-top","20px");
    //$(".canvasBig").css("margin-bottom","20px");
     //$(".upper-canvas").css("margin-bottom","20px");
    // //$(".canvas-container").css("margin-top","20px");
    // $("#myCanvas").css("margin-top","20px");
    // $("#myCanvas").css("margin-bottom","20px");
    $.ajax({
        url: site_url+'admin/manageflyers/get_fonts',
        type: 'GET',
        dataType: 'json',
        // beforeSend: function(res){console.log(res)},
        success: function(res){
            var fonts = new Array();
            if(res.length>0)
            {
                $.each(res, function(index, font) {
                    fonts.push(font.fontTitle)
                    $('#editor-fontFamily').append('<option style="font-family:'+font.fontTitle+'" value="'+font.fontTitle+'">'+font.fontTitle+'</option>');
             });


                
            }
            WebFontConfig = {
                google: { families: 
                   fonts}
                };

                (function() {
                    var src = ('https:' === document.location.protocol ? 'https' : 'http') +
                    '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';

                    $.getScript(src, function(data) {      
                        proFabric.canvas.renderAll();
                    });
                })();

            },
            error: function(res){console.log(res)},
        })

$('#picker').colpick({
        //flat:true,
        //flat:true,
        color: '#000000',
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
            //alert('Here in color 1');
            console.log('{fill :' + '#' + hex+'}');
            proFabric.text.settextcol(hex);
            // if(!bySetColor) $(el).val(hex);
        }
    });
objectsAligning(proFabric.canvas);
objectsCenter(proFabric.canvas);
    //alert("DESIGNER LAYOUT");
    // var map = [];
    $(window).bind('keydown', function(e) {
        var evtobj = window.event? event : e;

        if((evtobj.which == 90 || evtobj.keyCode == 90) && evtobj.ctrlKey)
        {
            console.log("Ctrl+z");
            proFabric.undo();
        }
        if((evtobj.which == 89 || evtobj.keyCode == 89) && evtobj.ctrlKey)
        {
            console.log("Ctrl+y");
            proFabric.redo();
        }
    });
    // $(window).bind('keyup', function(e){
    //     map = [];
    // });


$(document).delegate('#menuHider', 'click', function(event) {
    var navbar = $('.navbar-side');
    if(navbar.children('.sidebar-collapse').is(':visible')){
        navbar.children('.sidebar-collapse').hide();
        navbar.animate({width: '5px'}, 300);
        $(this).animate({left: '5px'}, 300);
        $('#page-wrapper').animate({marginLeft: '5px'}, 300);
    }
    else{
        navbar.children('.sidebar-collapse').show();
        navbar.animate({width: '260px'}, 300);
        $(this).animate({left: '260px'}, 300);
        $('#page-wrapper').animate({marginLeft: '260px'}, 300);
    }
});

/*Max font size set */
$("#editor-maxfontSize").val('50');
/*console.log(base_url);*/
for (var i = 0; i < button.length; i++) {
    var btn = button[i];
    for (var j = 0; j < btn.length; j++) {
        var d = new Date();
            // console.log('Button : ' + button[i][j] + ' ID >> ' + d.getTime() + _randomID); /*peham*/
            //add("button", (d.getTime() + _randomID), button[i][j], tabs[i]);
            _randomID = _randomID + 1;
        }
    }
    $("#editor-colorWidth").val('0');
    $("#editor-colorHeight").val('0');

    var fontsLink = base_url+"admin/ajax/fonts";
    var objectsLink = base_url+"admin/ajax/objects";
    /*$.get(fontsLink)
    .done(function(user_json) {
        if(user_json.data && user_json.data.fonts){
            $('#editor-fontFamily').empty();
            $.each(user_json.data.fonts, function(index, val) {
                $('#editor-fontFamily').append('<option value="'+val+'">'+val+'</option>');
            });
        }
    });
    $.get(objectsLink)
    .done(function(user_json) {
        if(user_json.data && user_json.data.opacity_range_imags){
            $('#editor-objectsBox, #editor-imageList').html('');
            $.each(user_json.data, function(index, val) {
                $('#editor-objectsBox').append('<img class="svgImage" id="editor-setsImage" src="'+val+'">');
                $('#editor-imageList').append('<img class="svgImage" id="editor-svgImage" src="'+val+'">');
            });
        }
    });*/
$("#editor-colorWidth").change(function(){
    if(($(this).val()!="")&&($(this).val()>=0)){
        proFabric.color.scaleToWidth($("#editor-colorWidth").val()*(proFabric.zoom/100));
    }
});
$("#editor-colorHeight").change(function(){
    if(($(this).val()!="")&&($(this).val()>=0)){
        proFabric.color.scaleToHeight($("#editor-colorHeight").val()*(proFabric.zoom/100));
    }
});

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
$(document).delegate('#undobtn','click',function(event){
    event.preventDefault();
    console.log('Here I am');
    proFabric.undo();
});
$(document).delegate('#redobtn','click',function(event){
    event.preventDefault();
    console.log('Here I am');
    proFabric.redo();
});
$(document).delegate('#editor-mainTabs>li', 'mousedown', function(){
    if(!$(this).hasClass('active')){
        proFabric.deselectCanvas();
    }
});
$(document).delegate('#editor-delete', 'click', function() {   
    type = $(this).attr('data-type');
    var obj = proFabric.get.currentObject();
    if(!obj) return;
    var _id = obj.id;
    var _name = obj.name;

    if(type=="image"){
        $('#editor-imageList').find('button[data-id='+_id+']').remove();
        arrangeImageNumbers();
        // alert(_name);
        $.ajax({
            url: site_url+'admin/manageflyers/remove_flyer_asset',
            type: 'POST',
            data: {file: _name},
            success: function(res){
                console.log('remove_flyer_asset SUCCESS   =>   ' + res);
            },
            error: function(res){
                console.log('remove_flyer_asset FAILED  =>   ' + res);
            }
        });

    }
    else if(type=="color"){
        $('#cs-tabContent').find('.colorRow[data-id='+_id+']').remove();
        arrangeColorSets();
    }
    $('#editor-textarea').val('');
    proFabric.delete();
    proFabric.deselectCanvas();



});
$(document).delegate('#editor-shapedelete', 'click', function() {

});
$(document).delegate('#editor-bringFront', 'click', function() {
    proFabric.set.bringFront();
});
$(document).delegate('#editor-sendBack', 'click', function() {
    proFabric.set.sendBack();
});
$(document).delegate('#editor-renameSet', 'click', function() {
    bootbox.prompt("Write name for active color sample", function(result) {                
        if (result != null) {
            $('#cs-tablist').find('.active').children('a').html(result);
        }
    });
});
$(document).delegate('#editor-duplicateShape', 'click', function() {
    proFabric.duplicate();
});
$(document).delegate('#editor-deleteSet', 'click', function() {
    if($('#cs-tablist').children('li').length <= 1)return;
    bootbox.confirm("Are you sure?", function(result) {
        if (result) {
            $('#cs-tablist').find('.active').remove();
            $('#cs-tabContent').find('.active').remove();
            console.log($('#cs-tablist').children('li:first-child'))
            $('#cs-tablist').children('li:first-child').find('a').trigger('click');
        }
    });
});
$(document).delegate('body', 'keydown', function(e) {
    if(e.target.tagName == 'INPUT' || e.target.tagName == 'TEXTAREA'){
        return;
    }
    var keycode = e.keyCode;
        if(keycode == 37){//left
            e.preventDefault();
            proFabric.move.left();
        }
        else if(keycode == 38){//up
            e.preventDefault();
            proFabric.move.up();
        }
        else if(keycode == 39){//right arrow
            e.preventDefault();
            proFabric.move.right();
        }
        else if(keycode == 40){//down arrow
            e.preventDefault();
            proFabric.move.down();
        }
    });
$(document).delegate('#editor-textarea', 'keyup', function() {
    var _text = $(this).val();
    var obj = proFabric.get.currentObject();
    if(!proFabric.get.lockMovementXText())
    {
        if(obj && obj.class=='text' && obj.bullet){
            proFabric.text.set({text: _text});
            proFabric.text.bullet(true);
            var textboxWidth = parseInt($("#textbox_width").val());
            var textboxHeight = parseInt($("#textbox_height").val());
            proFabric.text.setTextboxCords(textboxWidth,textboxHeight);
        }
        else
            proFabric.text.set({text: _text});
        var textboxWidth = parseInt($("#textbox_width").val());
        var textboxHeight = parseInt($("#textbox_height").val());
        proFabric.text.setTextboxCords(textboxWidth,textboxHeight);
    }
});
$(document).delegate('#editor-maxfontSize', 'change', function() {
    var value = $("#editor-maxfontSize").val();
    proFabric.text.set({
        maxfontSize: parseInt(value)
    });
});
$(document).delegate('#editor-fontSize', 'change', function() {
    var valueMax = $("#editor-maxfontSize").val();
    var value = $("#editor-fontSize").val();
    if(valueMax < value)
    {
        $("#editor-maxfontSize").val(value);
    }
    proFabric.text.set({
        maxfontSize: parseInt(value),
        fontSize: parseInt(value)
    });
    var textboxWidth = parseInt($("#textbox_width").val());
    var textboxHeight = parseInt($("#textbox_height").val());
    proFabric.text.setTextboxCords(textboxWidth,textboxHeight);
});

$(document).delegate('#editor-fontFamily', 'change', function() {
    var value = $("#editor-fontFamily>option:selected").val();
    proFabric.text.set({
        fontFamily: value
    });
    var textboxWidth = parseInt($("#textbox_width").val());
    var textboxHeight = parseInt($("#textbox_height").val());
    proFabric.text.setTextboxCords(textboxWidth,textboxHeight);
});
$(document).delegate('div#editor-textAlign>button', 'click', function() {
    var type = $(this).attr('data-type');
    $(this).addClass('btn-primary').siblings().removeClass('btn-primary');
    proFabric.text.set({
        textAlign: type
    });
    var textboxWidth = parseInt($("#textbox_width").val());
    var textboxHeight = parseInt($("#textbox_height").val());
    proFabric.text.setTextboxCords(textboxWidth,textboxHeight);
});
$(document).delegate('button#editor-textList', 'click', function() {
    if ($(this).hasClass('btn-primary')) {
        $(this).removeClass('btn-primary');
        proFabric.text.bullet(false);
        var textboxWidth = parseInt($("#textbox_width").val());
        var textboxHeight = parseInt($("#textbox_height").val());
        proFabric.text.setTextboxCords(textboxWidth,textboxHeight);
    }
    else{
        $(this).addClass('btn-primary');
        proFabric.text.bullet(true);
        var textboxWidth = parseInt($("#textbox_width").val());
        var textboxHeight = parseInt($("#textbox_height").val());
        proFabric.text.setTextboxCords(textboxWidth,textboxHeight);
    }
});
$(document).delegate('button#editor-textBold', 'click', function() {
    if ($(this).hasClass('btn-primary')) {
        $(this).removeClass('btn-primary');
        proFabric.text.set({
            fontWeight: 'normal'
        });
        var textboxWidth = parseInt($("#textbox_width").val());
        var textboxHeight = parseInt($("#textbox_height").val());
        proFabric.text.setTextboxCords(textboxWidth,textboxHeight);            
    }
    else{
        $(this).addClass('btn-primary');
        proFabric.text.set({
            fontWeight: 'bold'
        });
        var textboxWidth = parseInt($("#textbox_width").val());
        var textboxHeight = parseInt($("#textbox_height").val());
        proFabric.text.setTextboxCords(textboxWidth,textboxHeight);
    }
});
$(document).delegate('button#editor-textItalic', 'click', function() {
    if ($(this).hasClass('btn-primary')) {
        $(this).removeClass('btn-primary');
        proFabric.text.set({
            fontStyle: 'normal'
        });
        var textboxWidth = parseInt($("#textbox_width").val());
        var textboxHeight = parseInt($("#textbox_height").val());
        proFabric.text.setTextboxCords(textboxWidth,textboxHeight);
    }
    else{
        $(this).addClass('btn-primary');
        proFabric.text.set({
            fontStyle: 'italic'
        });
        var textboxWidth = parseInt($("#textbox_width").val());
        var textboxHeight = parseInt($("#textbox_height").val());
        proFabric.text.setTextboxCords(textboxWidth,textboxHeight);
    }

});


$(document).delegate('button#editor-textUnderline', 'click', function() {
    if ($(this).hasClass('btn-primary')) {
        $(this).removeClass('btn-primary');
        proFabric.text.set({
            textDecoration: 'none'
        });
    }
    else{
        $(this).addClass('btn-primary');
        proFabric.text.set({
            textDecoration: 'underline'
        });
    }
});
{

}
$(document).delegate('#lock-text', 'click', function() {
        //alert('lock-text');
        $('#unlock-text').removeClass('btn-primary');
        $('#lock-text').removeClass('btn-default');
        $('#lock-text').addClass('btn-primary');
        $('#unlock-text').removeClass('btn-default');
        proFabric.set.lock();
    });
$(document).delegate('#unlock-text', 'click', function() {
        //alert('#unlock-text');
        $('#lock-text').removeClass('btn-primary');
        $('#unlock-text').removeClass('btn-default');
        $('#unlock-text').addClass('btn-primary');
        $('#lock-text').removeClass('btn-default');

        $('#lockAll').removeClass().addClass('btn btn-danger').text('Lock Everything');
        _lockFlag = 0;
        proFabric.set.unlock();
    });
$(document).delegate('#lock-img', 'click', function() {

    $('#unlock-img').removeClass('btn-primary');
    $('#lock-img').removeClass('btn-default');
    $('#lock-img').addClass('btn-primary');
    $('#unlock-img').removeClass('btn-default');
        //alert('lock-image');
        proFabric.set.lock();
    });
$(document).delegate('#unlock-img', 'click', function() {

    $('#lock-img').removeClass('btn-primary');
    $('#unlock-img').removeClass('btn-default');
    $('#unlock-img').addClass('btn-primary');
    $('#lock-img').removeClass('btn-default');
        //alert('unlock-image');
        $('#lockAll').removeClass().addClass('btn btn-danger').text('Lock Everything');
        _lockFlag = 0;
        proFabric.set.unlock();
    });
$(document).delegate('#lock-svg', 'click',function(){

    $('#unlock-svg').removeClass('btn-primary');
    $('#lock-svg').removeClass('btn-default');
    $('#lock-svg').addClass('btn-primary');
    $('#unlock-svg').removeClass('btn-default');
        //alert('lock-image');
        proFabric.set.lock();
    });
$(document).delegate('#unlock-svg', 'click',function(){
    $('#lock-svg').removeClass('btn-primary');
    $('#lock-svg').removeClass('btn-primary');
    $('#unlock-svg').removeClass('btn-default');
    $('#unlock-svg').addClass('btn-primary');
    $('#lock-svg').removeClass('btn-default');
        //alert('unlock-image');
        $('#lockAll').removeClass().addClass('btn btn-danger').text('Lock Everything');
        _lockFlag = 0;
        proFabric.set.unlock();
    });
$("#myRange").change(function() {
    var opacity = $("#myRange").val();
    proFabric.shapes.svgopacity(opacity);
});
$("#opacity_range_text").change(function() {
    var opacity = $("#opacity_range_text").val();
    proFabric.text.textopacity(opacity);
});
$("#opacity_range_image").change(function() {
    var opacity = $("#opacity_range_image").val();
    proFabric.image.imageopacity(opacity);
});

$("#textbox_width").change(function() {
    var textboxWidth = parseInt($("#textbox_width").val());
    var textboxHeight = parseInt($("#textbox_height").val());
    proFabric.text.setTextboxCords(textboxWidth,textboxHeight);
});
$("#textbox_height").change(function() {
        // console.log(Number($("#textbox_padding").val()));
        var textboxWidth = parseInt($("#textbox_width").val());
        var textboxHeight = parseInt($("#textbox_height").val());
        proFabric.text.setTextboxCords(textboxWidth,textboxHeight);
    });

$("#textbox_padding").change(function() {
    // console.log("setpadding is called");
    var value = parseInt($(this).val());
    proFabric.text.setPadding(value);
    var textboxWidth = parseInt($("#textbox_width").val());
    var textboxHeight = parseInt($("#textbox_height").val());
    proFabric.text.setTextboxCords(textboxWidth,textboxHeight);
});

$("#textbox_lineHeight").change(function() {
    // console.log("setLineheight is called");
    var value = Number($(this).val());
    proFabric.text.setLineheight(value);
    var textboxWidth = parseInt($("#textbox_width").val());
    var textboxHeight = parseInt($("#textbox_height").val());
    proFabric.text.setTextboxCords(textboxWidth,textboxHeight);
});



$(document).delegate("#editor-addImage", "click", function(event) {
    $('#editor-addImageFile').trigger('click');
});

$(document).delegate('#editor-IMGstrokeWidth','change',function(){
    var obj = proFabric.canvas.getActiveObject();
    var val = Number($(this).val());
    var clr = $('#img_color_btn').css('background-color');
    if(obj && obj.type == 'image')
    {
        proFabric.image.set({strokeWidth:val, stroke:clr});
        proFabric.canvas.renderAll();
    }
    else
        return;
    
});



$(document).delegate("#editor-addImageFile", "change", function(event) {
    // console.log($(this));
    var fileObj = $(this)[0],
    file, fileURL=null;
    // console.log(fileObj);
    if (fileObj.files){
        if(fileObj.files.item(0).size > 26214400)
            return
        file = fileObj.files[0];
        var ext = (-1 !== file.name.indexOf('.')) ? file.name.replace(/.*[.]/, '').toLowerCase() : '';
        var allowed = ['jpg','png'];
        if (!allowed.length){return true;}
        for (var i=0; i<allowed.length; i++){
            if (allowed[i].toLowerCase() == ext){
                fileURL = URL.createObjectURL(file);
            }    
        }
    }
    if(fileURL){
        var size = $('#editor-imageList').children().size();
        var id = proFabric.get.guid();
        $('#editor-imageList').children().removeClass('btn-primary');
        $('#editor-imageList').append('<button type="button" class="btn btn-default btn-circle btn-primary imagetextbold" data-id="'+(id)+'">'+(size+1)+'</button>');
        proFabric.image.addBlob(fileURL, {id:id});
    }
});
$(document).delegate("#editor-imageList>button", "click", function() {
    var id = $(this).attr('data-id');
    if(!id)return;
    proFabric.set.setActiveobj(id);
});
$(document).delegate('#editor-imageWidth', 'change', function() {
    obj = proFabric.canvas.getActiveObject();
    wd = parseInt($(this).val()*(proFabric.zoom/100)/obj.scaleX);                    
    proFabric.image.set({width:wd});
});
$(document).delegate('#editor-imageHeight', 'change', function() {
    obj = proFabric.canvas.getActiveObject();
    ht = parseInt($(this).val()*(proFabric.zoom/100)/obj.scaleY);                    
    proFabric.image.set({height:ht});
});
$(document).delegate('#editor-svgImage', 'click', function() {
    var src = $(this).attr('src');
    proFabric.shapes.add(src);
});
$(document).delegate('#cs-tablist>li', 'click', function() {
    var href = $(this).children('a').attr('href');
    $(href).children('.colorRow').each(function(index, el) {
        proFabric.color.fill($(el).attr('data-id'), $(el).find('#svg_color_btn').css('backgroundColor'));
    });
});

$('#editor-objectsBox').toggle();

$(document).delegate('button.editor-textAssign', 'click', function() {
    var _id = $(this).attr('data-id'), _this = $(this);
    var exist = proFabric.text.checkID(_id);
    setTimeout(function () {
        if (!exist){
            var _newid = proFabric.get.guid();
            proFabric.text.add(_this.text(), {id: _newid}, (proFabric.zoom/100));
            _this.addClass('btn-primary').attr('data-id', _newid);
        }
        else{
            proFabric.set.setActiveobj(_id);
            _this.addClass('btn-primary');
        } 
    }, 50);
});


//OLD COLOR PICKER for TEXT

$(document).delegate('button#editor-cpicker', 'click', function(event) {
    // var obj = proFabric.get.currentObject();
        //alert(obj);
        // if(!obj) return;
        // var _id = obj.id;
        $('.colorRow').each(function(index, el) {
            $(el).find('#editor-cpicker').removeClass('btn-primary');
        });
        $(this).addClass('btn-primary');
        event.preventDefault();
        proFabric.disableSelection();
        proFabric.droper();

        $('div.canvas-container canvas').css('cursor', 'crosshair');
        // proFabric.setCursor('crosshair');
    });
    

$("#Gridbtn").click(function(){
    if(_gridFlag==0)
    {
        proFabric.makeGridBack();
        $(this).removeClass().addClass('btn btn-danger');
        $(this).text('Remove Grids');
        $('#gridToggle').removeClass('disabled');
        _gridFlag = 1;
    }
    else if(_gridFlag==1)
    {
        proFabric.removeGrid();
        $(this).removeClass().addClass('btn btn-success');
        $(this).text('Create Grids');
        $('#gridToggle').removeClass().addClass('btn btn-info');
        $('#gridToggle').addClass('disabled');
        $('#gridToggle').text('Bring Grids To Front');
        _gridFlag = 0;
        _gridToggle = 0;
    }
});

$(document).delegate('#gridToggle','click',function(){
    if(_gridFlag == 1){
        if(_gridToggle==0)
        {
            proFabric.removeGrid();
            proFabric.makeGridFront();
            $(this).removeClass().addClass('btn btn-success');
            $(this).text('Send Grids to Back');
            _gridToggle = 1;
        }
        else if(_gridToggle==1)
        {
            proFabric.removeGrid();
            proFabric.makeGridBack();
            $(this).removeClass().addClass('btn btn-info');
            $(this).text('Bring Grids To Front');
            _gridToggle = 0;
        }
    }
    else{
        console.log("Grids not Added");
    }
});


$("#lockAll").click(function(){
    if(_lockFlag==0)
    {
        proFabric.lockEverything();
        $(this).removeClass().addClass('btn btn-success');
        $(this).text('Unlock Everything');

        $('#unlock-text').removeClass('btn-primary');
        $('#lock-text').removeClass('btn-default');
        $('#lock-text').addClass('btn-primary');
        $('#unlock-text').removeClass('btn-default');

        $('#unlock-img').removeClass('btn-primary');
        $('#lock-img').removeClass('btn-default');
        $('#lock-img').addClass('btn-primary');
        $('#unlock-img').removeClass('btn-default');

        $('#unlock-svg').removeClass('btn-primary');
        $('#lock-svg').removeClass('btn-default');
        $('#lock-svg').addClass('btn-primary');
        $('#unlock-svg').removeClass('btn-default');

        _lockFlag = 1;
    }
    else if(_lockFlag==1)
    {
        proFabric.unlockEverything();
        $(this).removeClass().addClass('btn btn-danger');
        $(this).text('Lock Everything');

        $('#lock-text').removeClass('btn-primary');
        $('#unlock-text').removeClass('btn-default');
        $('#unlock-text').addClass('btn-primary');
        $('#lock-text').removeClass('btn-default');

        $('#lock-img').removeClass('btn-primary');
        $('#unlock-img').removeClass('btn-default');
        $('#unlock-img').addClass('btn-primary');
        $('#lock-img').removeClass('btn-default');

        $('#lock-svg').removeClass('btn-primary');
        $('#lock-svg').removeClass('btn-primary');
        $('#unlock-svg').removeClass('btn-default');
        $('#unlock-svg').addClass('btn-primary');
        $('#lock-svg').removeClass('btn-default');

        _lockFlag = 0;
    }
});

$(document).delegate("#save", "click", function(event) {
    proFabric.zoomcanvas(100);
    if (_fullScreenFlag) {
       $('#fullScreenEditor').trigger('click');
    }
    
    previousColor = [];
    $('#cs-tabContent').children('.tab-pane').each(function(index, el) {
        rowcolors = [];
        $(el).children('.colorRow').each(function(i, element) {
            color = proFabric.rgb2hex($(element).find('#svg_color_btn').css("backgroundColor"));
            id    = $(element).attr('data-id');
            rowcolors.push({objID:id, clr:color});
        });
        _name = $(el).attr('id');
        tab_name = $('.'+_name).html();
        previousColor.push({id:$(el).attr('id'), colors:rowcolors, name:tab_name});
    });
    finalColorSets = JSON.stringify(previousColor);

    console.log(previousColor);

    $('#flyer_success').hide();
        // remove_background();
        _id = $('.flyer_small_selected').attr('id');
        if(_id) 
           { flyer_id = $('.flyer_small_selected').attr('id');}
       else {
            // flyer_id = null;
            console.log(_id);
            bootbox.alert('No Flyer Selected!');
            return false;
        }

        objects = proFabric.canvas.getObjects();
        for(i=0;i<objects.length;i++)
        {
            objects[i].original_left = objects[i].left;
            objects[i].original_top = objects[i].top;
        }

        var json = JSON.stringify(proFabric.export.json());
        $('#flyer_json').html(json);
        $('#export-image-proof').attr('src', proFabric.export.base64());
        $('#view_html').attr('href', site_url+'admin/manageflyers/load_html/'+flyer_id);
		$('#flyer_pdf').attr('href', site_url+'admin/manageflyers/flyer_pdf/'+flyer_id);
        _colorJson = [];

        $('button.editor-textAssign').each(function(index, el) {
            var _type = $(el).attr('data-type'),
            _id = $(el).attr('data-id');
            _label = $(el).html();
            var _text = '';
            if(_id){
                _text = proFabric.text.getTextByID(_id);
                console.log(_text);
            }
            if(_text === -1)
            {
                 _id = '';
                 _text = '';   
                 console.log('text is wasted');
            }

            _colorJson.push({
                'property_type'  : _type,
                'property_id'    : _id,
                'property_text'  : _text,
                'property_label' : _label,
            });
        });
        // console.log(_colorJson);
        $('#deliver-json-names, #flyer_properties').html(JSON.stringify(_colorJson, null, 4));
        // $('#flyer_properties').html(_colorJson);
        //console.log(json);
        $('.nav-tabs a[href="#tab-id-1-4"]').tab('show');

    });



$(document).delegate('#opacity_range', 'change', function(event) {
    _op = $('#opacity_range').val();
    bgSetOpacity(_op/100);
    $('#opacityByNumber').val(_op);
    $('#opacity_range_proof').val(_op);
    $('#opacityByNumber_proof').val(_op);
});
$(document).delegate('#opacityByNumber', 'change', function(event) {
    _op = $(this).val();
    bgSetOpacity(_op/100);
    $('#opacity_range').val(_op);
    $('#opacity_range_proof').val(_op);
    $('#opacityByNumber_proof').val(_op);
});

$(document).delegate('#opacity_range_proof', 'change', function(event) {
    _op = Number($(this).val());
    bgSetOpacity(_op/100);
    $('#opacityByNumber_proof').val(_op);
    $('#opacity_range').val(_op);
    $('#opacityByNumber').val(_op);
    $('#export-image-proof').attr('src', proFabric.export.base64());
});
$(document).delegate('#opacityByNumber_proof', 'change', function(event) {
    _op = Number($(this).val());
    bgSetOpacity(_op/100);
    $('#opacity_range_proof').val(_op);
    $('#opacity_range').val(_op);
    $('#opacityByNumber').val(_op);
    $('#export-image-proof').attr('src', proFabric.export.base64());
});

$(document).delegate('#remove_reload_background', 'click', function(event) {
    if(_flagBG == true)
    {
        remove_background();
        $(this).removeClass('btn-danger').addClass('btn-success').html('<i class="fa fa-refresh"></i> Reload Background');
        $("#addRemove_BG").removeClass('btn-danger').addClass('btn-success').html('<i class="fa fa-refresh"></i> Reload Background');
        $('.bgOpacityContainer').hide();
        $('.bgOpacityContainer_proof').hide();
        // $('#opacity_range').hide();
        _flagBG = false;
    }
    else
    {
        addBackgroundImage();
        $(this).removeClass('btn-success').addClass('btn-danger').html('<i class="fa fa-ban"></i> Remove Background');
        $('#addRemove_BG').removeClass('btn-success').addClass('btn-danger').html('<i class="fa fa-ban"></i> Remove Background');
        $('.bgOpacityContainer').show();
        $('#opacity_range').val(100);
        $('#opacity_range_proof').val(100);
        $('#opacityByNumber').val(100);
        $('#opacityByNumber_proof').val(100);
        $('.bgOpacityContainer_proof').show();
        _flagBG = true;
    }

});



    //*************************PROOF TAB********************
    
    $(document).delegate("#addRemove_BG", "click", function() {
        if(_flagBG == true)
        {
            remove_background();
            $('#export-image-proof').attr('src', proFabric.export.base64());
            $('#addRemove_BG').removeClass('btn-danger').addClass('btn-success').html('<i class="fa fa-refresh"></i> Reload Background');
            $('#remove_reload_background').removeClass('btn-danger').addClass('btn-success').html('<i class="fa fa-refresh"></i> Reload Background');
            $('.bgOpacityContainer').hide();
            $('.bgOpacityContainer_proof').hide();
            _flagBG = false;

        }
        else if(_flagBG == false)
        {
            addBackgroundImage();
            setTimeout(function(){
                $('#export-image-proof').attr('src', proFabric.export.base64());
                $('#addRemove_BG').removeClass('btn-success').addClass('btn-danger').html('<i class="fa fa-ban"></i> Remove Background');
                $('#remove_reload_background').removeClass('btn-success').addClass('btn-danger').html('<i class="fa fa-ban"></i> Remove Background');
                _flagBG = true;
                $('.bgOpacityContainer').show();
                $('.bgOpacityContainer_proof').show();
                $('#opacity_range').val(100);
                $('#opacity_range_proof').val(100);
                $('#opacityByNumber').val(100);
                $('#opacityByNumber_proof').val(100);
            },50); 
            

        };
        
    });


    $(document).delegate('.load_flyer_json', 'click', function(event) {

    _id = $('.flyer_small_selected').attr('id');

    if(_id)
    {
        $.ajax({
            url: site_url+'admin/manageflyers/load_json/'+_id,
                // dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
                // data: {param1: 'value1'},
                async: false,
                type: 'json',
                beforeSend: function(msg){noti('default','Loading Flyer on canvas, hold on.');},
                success: function(msg){
                    if(msg)
                    {
                        var _height = new Array();
                        msg = JSON.parse(msg);
                        for(i = 0; i< msg.objects.length;i++)
                        {
                            _height[i] = msg.objects[i].height;
                        }

                            
                        canvas = proFabric.canvas;
                        canvas.loadFromDatalessJSON(msg, canvas.renderAll.bind(canvas), function(o, object) {
                        });

                        var objs = new Array();
                        objs = canvas.getObjects();
                        setTimeout(function(){
                        objs = proFabric.canvas.getObjects();
                        for(i = 0; i< msg.objects.length;i++)
                        {
                            objs[i].setHeight(_height[i]);
                            proFabric.canvas.renderAll();
                        }
                    },500);
                        $.ajax({
                            url: site_url+'/editor/get_flyer_properties/'+_id,
                            type: 'POST',
                            dataType: 'json',
                            async: false,
                            success: function(properties){
                                $(properties).each(function(index, el) {
                                    if(el.property_id !== '')
                                    {
                                        _dataType = el.property_type;
                                        _dataId = el.property_id;
                                        $('.editor-textAssign').each(function(index,el){
                                            if($(el).attr('data-type') == _dataType){
                                                $(el).attr('data-id',_dataId);
                                            } 
                                        });
                                    }
                                });
                                
                            },
                            // beforeSend: function(msg){console.log(msg);},
                            error: function(error){console.log('------ PROEPERTIES ERROR:  '+error);},

                        });

                        $.ajax({
                            url: site_url+'/editor/get_flyer_colorsets',
                            type: 'POST',
                            dataType: 'json',
                            async: false,
                            data: {flyerId: _id},
                            success: function(colorsets){
                                sz = $('#cs-tablist').children().size();
                                $('#cs-tablist').children().remove();
                                $('#cs-tabContent').children().remove();
                                $.each(colorsets, function(index, colorset) {
                                    paneID = colorset.id;
                                    tabLi = '<li><a href="#'+paneID+'" class="'+paneID+'" data-toggle="tab">'+colorset.name+'</a></li>';
                                    $('#cs-tablist').append(tabLi);

                                    tabDiv = '<div role="tabpanel" class="tab-pane" id="'+paneID+'"></div>';
                                    $('#cs-tabContent').append(tabDiv);
                                    $.each(colorset.colors, function(index,color) {
                                        size = $('#'+colorset.id).children().size();
                                        element_id = color.objID;
                                        element_clr = color.clr;
                                        searchHTML = '<li><div class="row"><div class="col-md-6"><input type="text" class="form-control" id="pickClrByName" placeholder="00000" maxlength="6" /></div><div class="col-md-6" id="show_color"><a class="btn btn-xs temp clr_thumbnail_lg btn-color" data-value="#000000"></a><a class="btn btn-xs clr_thumbnail_lg btn-color" data-value="#000000"></a></div></div></li>';
                                        var paletePicker = '<a style="box-shadow:2px 2px 2px black" id="svg_color_btn" class="btn btn-xs dropdown-toggle btn_css" data-toggle="dropdown" style="" aria-expanded="false"></a><ul id="svg" class="dropdown-menu clrpicker">'+searchHTML+'<li style="margin-top:5px"><div id="'+paneID+'--'+element_id+'" data-id="'+element_id+'" class="picker"></div></li><li style="margin-top: 5px;"><div class="svg_hover_clr pull-left"><a class="btn btn-xs clr_thumbnail"></a><span>#000000</span></div><div class="svg_selected_clr pull-right"><a class="btn btn-xs clr_thumbnail"></a><span>#000000</span></div></li></ul>';
                                        var _html = '<div class="row pt-10 colorRow" data-id="'+element_id+'"><div class="col-md-4 col-xs-12">Color '+(size+ 1)+'</div><div class="col-md-4 col-xs-12">'+paletePicker+'</div><div class="col-md-4 col-xs-12 nopad text-right pr-20"><button type="button" id="editor-cpicker" data-type="colorsFill" data-id="" class="btn btn-default"><i class="fa fa-eyedropper"></i></button></div></div>';
                                        $(_html).appendTo('#'+paneID);
                                        proFabric.setColorPallete(paneID+'--'+element_id);
                                        $('#'+paneID+'--'+element_id).closest('ul').prev().css('background-color',element_clr);
                                        $('#'+paneID+'--'+element_id).closest('ul').find('.svg_selected_clr').children('span').html(element_clr);
                                        $('#'+paneID+'--'+element_id).closest('ul').find('.svg_selected_clr').children('.btn').css('background-color',element_clr);
                                        size++;
                                    });
                                    sz++;
                                });
                                $('#cs-tablist').children('li:first-child').addClass('active');
                                $('#cs-tabContent').children('div:first-child').addClass('active');
                            
                                $('#cs-tablist').find('li.active').trigger('click');
                            },
                            error: function(error){
                                console.log(error);
                            },
                        });
                    noti('success','Flyer loaded');
                    }
                    else noti('success','Flyer loaded');
                },
                error: function(msg){noti('danger','flyer could not be loaded')},
            });
        }
    });




$(document).delegate('#fullScreenEditor', 'click', function() {
    if (!document.fullscreenElement && !document.mozFullScreenElement && !document.webkitFullscreenElement && !document.msFullscreenElement ) {
        _fullScreenFlag = true;
        $(this).val('Exit').html('Exit');
        $('#editor').css({
            position: 'fixed',
            top: 0,
            left: 0,
            padding: '25px',
            backgroundColor : '#fff',
            overflow: 'auto',
            width: '100vw',
            height: '100vh'
        });
            //proFabric.zoomcanvas(160);
            if(document.documentElement.requestFullscreen) {
                document.getElementById('editor').requestFullscreen();
                $("#editor-left").removeClass('col-md-8');
                $("#editor-left").addClass('col-md-9');
                $("#editor-right").removeClass('col-md-4');
                $("#editor-right").addClass('col-md-3');
                $('#screen_value').val(160);
                $('.canvasBig').css('height', '900px', 'max-height', '900px');
                proFabric.zoomcanvas(160);
            }
            else if(document.documentElement.msRequestFullscreen){
                document.getElementById('editor').msRequestFullscreen();
                $("#editor-left").removeClass('col-md-8');
                $("#editor-left").addClass('col-md-9');
                $("#editor-right").removeClass('col-md-4');
                $("#editor-right").addClass('col-md-3');
                $('.canvasBig').css('height', '900px', 'max-height', '900px');
                $('#screen_value').val(160);
                proFabric.zoomcanvas(160);
            }
            else if(document.documentElement.mozRequestFullScreen){
                document.getElementById('editor').mozRequestFullScreen();
                $("#editor-left").removeClass('col-md-8');
                $("#editor-left").addClass('col-md-9');
                $("#editor-right").removeClass('col-md-4');
                $("#editor-right").addClass('col-md-3');
                $('.canvasBig').css('height', '900px', 'max-height', '900px');
                $('#screen_value').val(160);
                proFabric.zoomcanvas(160);
            }
            else if(document.documentElement.webkitRequestFullscreen){
                document.getElementById('editor').webkitRequestFullscreen();
                $("#editor-left").removeClass('col-md-8');
                $("#editor-left").addClass('col-md-9');
                $("#editor-right").removeClass('col-md-4');
                $("#editor-right").addClass('col-md-3');
                $('.canvasBig').css('height', '900px', 'max-height', '900px');
                $('#screen_value').val(160);
                proFabric.zoomcanvas(160);
            }
        }
        else {
            _fullScreenFlag = false;
            $(this).val('Full Screen').html('Full Screen');
            $('#editor').removeAttr('style');
            if(document.exitFullscreen){
                document.exitFullscreen();
                $('.canvasBig').css('height', '600px', 'max-height', '600px');
                $('#screen_value').val(100);
            }
            else if(document.msExitFullscreen){
                document.msExitFullscreen();
                $('.canvasBig').css('height', '600px', 'max-height', '600px');
                $('#screen_value').val(100);
                
            }
            else if(document.mozCancelFullScreen){
                document.mozCancelFullScreen();
                $('.canvasBig').css('height', '600px', 'max-height', '600px');
                $('#screen_value').val(100);
            }
            else if(document.webkitExitFullscreen){
                document.webkitExitFullscreen();
                $('.canvasBig').css('height', '600px', 'max-height', '600px');
                $('#screen_value').val(100);
            }
        }
    });
document.addEventListener("fullscreenchange", FShandler);
document.addEventListener("webkitfullscreenchange", FShandler);
document.addEventListener("mozfullscreenchange", FShandler);
document.addEventListener("MSFullscreenChange", FShandler);
colorPickerInit();

$(".wan-spinner-1").WanSpinner({
    maxValue: 500,
    minValue: 40,
    step: 20,
    inputWidth: 70,
    start: 100,
    valueChanged: function(val) {
        var value = parseInt($(val).parent().find('input').val());
        if(value > 0)
            proFabric.zoomcanvas(value);
        console.log(value);
    }
});
$(document).delegate("#editor-zoomButton", "click", function(event) {
    var value = parseInt($(this).data('number'));
    if(value > 0){
        $('.wan-spinner').find('input').val(value);
        proFabric.zoomcanvas(value);
    }
});
});
FShandler = function(){
    if (!document.fullscreenElement && !document.mozFullScreenElement && !document.webkitFullscreenElement && !document.msFullscreenElement ) {
        $('#fullScreenEditor').val('Full Screen').html('Full Screen');
        $('#editor').removeAttr('style');
        $("#editor-left").removeClass('col-md-9');
        $("#editor-left").addClass('col-md-8');
        $("#editor-right").removeClass('col-md-3');
        $("#editor-right").addClass('col-md-4');
        proFabric.zoomcanvas(100);
    }
}

function add(type, idToAppend, name, _tab) {
    var element = document.createElement("input");
    //Assign different attributes to the element.
    element.type = type;
    element.setAttribute("id", idToAppend);
    element.setAttribute('class', 'btn btn-default');
    element.value = name; // Really? You want the default value to be the type string?
    //element.name = type;  // And the name too?
    element.onclick = function (event) { // Note this is a function
        event.preventDefault();
        var val = proFabric.randBtnSelection(this.id);
        proFabric.set.ID(this.id, val);
    };
    console.log(element);
    console.log(_tab);
    var foo = document.getElementById(_tab);
    console.log(foo);
    //Append the element in page (in span).
    foo.appendChild(element);
    //document.getElementById("prop-info").innerHTML =
    //$( "#prop-info" ).append('<input type="'+type+'" class="ui-helper-hidden-accessible" id="'+idToAppend+'"><label for="'+idToAppend+'"  class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only">Address</label>');
}
function arrangeImageNumbers() {
    $('#editor-imageList').children('button').each(function(index, el) {
        $(el).html(index+1);
    });
}
function arrangeColorSets() {
    $('#cs-tabContent').children('.tab-pane').each(function(index, el) {
        $(el).children('.colorRow').each(function(i, element) {
            $(element).children('div:first-child').html("Color "+ (i+1));
        });
    });
}

function addColorSet() {
    var sample = '<div id="color-sample-1"> <h3 class="center-text">Set Flyer Color Option 1</h3> <div class="col-wrap"> <div class="row"> <div class="col-three"> <div class="set-color-box mb-10"> Color 1 </div> </div> <div class="col-three"> <div class="color-box mb-10" style="background-color: #ffe59b"> &nbsp </div> </div> <div class="col-three last"> <div class="color-rgb-box mb-10"> R 255, G 229, B 156 </div> </div> </div> </div> </div>';
}

function addBackgroundImage(){
    var img = new Image();
    img.onload = function(){
        canvas = proFabric.canvas;
        canvas.setBackgroundImage(img.src, canvas.renderAll.bind(canvas), {
            originX: 'left',
            originY: 'top',
            left: 0,
            top: 0,
            width: canvas.width,
            height: canvas.height,
            opacity: 1
        });
    };
    img.src = $('#big_image').prop('src');
    proFabric.canvas.renderAll();
}
function bgSetOpacity(_op){
    proFabric.canvas.setBackgroundImage(proFabric.canvas.backgroundImage, proFabric.canvas.renderAll.bind(proFabric.canvas), {
        originX: 'left',
        originY: 'top',
        left: 0,
        top: 0,
        width: proFabric.canvas.width,
        height: proFabric.canvas.height,
        opacity: _op
    });
}
function colorPickerInit(val){
    $('input#coler-picker').hide();
    $('input#coler-picker').colorpicker(
        {color:'#000000', defaultPalette:'web',showOn:'button'}
        )
    .on('change.color', function(event, color){
        var type = $(this).data('type');
        var _rgb = $(this).next('.evo-colorind-ff').css('backgroundColor');
        colorPickerSubmit(_rgb, this);
        //alert('called');
    });
}
function colorPickerSubmit(_rgb, el){
    var type = $(el).data('type');
    if (type == "text") {
        proFabric.text.set({
            fill : _rgb
        });
    }
    else if (type == "svgFill") {
        proFabric.shapes.fill(_rgb);
    }
    else if (type == "colorsFill") {
        proFabric.color.fill($(el).parents('.colorRow').attr('data-id'), _rgb);
    }
}
function updateBackgroundImage(){
    canvas = proFabric.canvas;
    canvas.setBackgroundImage(canvas.backgroundImage, canvas.renderAll.bind(canvas), {
        originX: 'left',
        originY: 'top',
        left: 0,
        top: 0,
        width: canvas.width,
        height: canvas.height,
            // opacity: _op
        });
}


var remove_background = function(){
    canvas = proFabric.canvas;  
    canvas.setBackgroundImage(null, canvas.renderAll.bind(canvas));
    $('#opacity_range').val(1);
}



function rgb_Con(rgb) {
    rgb = rgb.match(/^rgba?[\s+]?\([\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?/i);
        return (rgb && rgb.length === 4) ? "#" + ("0" + parseInt(rgb[1], 10).toString(16)).slice(-2) + ("0" + parseInt(rgb[2], 10).toString(16)).slice(-2) + ("0" + parseInt(rgb[3], 10).toString(16)).slice(-2) : "";
    }

//**************************************************BY JAWAD**************************************************************
$(document).delegate('#svg_color_btn', 'click', function() {
    var idd = $(this).closest('.colorRow').attr('data-id');
    console.log(idd);
    proFabric.set.setActiveobj(idd);
});
$(document).delegate('#editor-setsImage', 'click', function() {
    var src = $(this).attr('src'),
    _id = proFabric.get.guid(),
    previousColor = [];
    
    proFabric.color.add(src, {
        id : _id,
        callback : function () {
            var size = $('#cs-sample1').children().size();
            console.log('size = '+size);
                //adds a new element to all color samples
                $('#cs-tabContent').children('.tab-pane').each(function(index, el) {
                    paneID = $(el).attr('id');
                    var searchHTML = '<li><div class="row"><div class="col-md-6"><input type="text" class="form-control" id="pickClrByName" placeholder="00000" maxlength="6" /></div><div class="col-md-6" id="show_color"><a class="btn btn-xs temp clr_thumbnail_lg btn-color" data-value="#000000"></a><a class="btn btn-xs clr_thumbnail_lg btn-color" data-value="#000000"></a></div></div></li>';
                    var paletePicker = '<a style="box-shadow:2px 2px 2px black" id="svg_color_btn" class="btn btn-xs dropdown-toggle btn_css" data-toggle="dropdown" style="" aria-expanded="false"></a><ul id="svg" class="dropdown-menu svgPicker clrpicker">'+searchHTML+'<li style="margin-top:5px"><div id="'+paneID+'--'+_id+'" data-id="'+_id+'" class="picker"></div></li><li style="margin-top: 5px;"><div class="svg_hover_clr pull-left"><a class="btn btn-xs clr_thumbnail"></a><span>#000000</span></div><div class="svg_selected_clr pull-right"><a class="btn btn-xs clr_thumbnail"></a><span>#000000</span></div></li></ul>';
                    var _html = '<div class="row pt-10 colorRow" data-id="'+_id+'"><div class="col-md-4 col-xs-12">Color '+(size+ 1)+'</div><div class="col-md-4 col-xs-12">'+paletePicker+'</div><div class="col-md-4 col-xs-12 nopad text-right pr-20"><button type="button" id="editor-cpicker" data-type="colorsFill" data-id="" class="btn btn-default"><i class="fa fa-eyedropper"></i></button></div></div>';
                    $(_html).appendTo(el);
                    proFabric.setColorPallete(paneID+'--'+_id);
                });
        }
    });
});


$(document).delegate('#editor-addSets', 'click', function() {
    tabsize = $('#cs-tablist').children().size();
    if(tabsize > 5) return;
    var _html = '';
    paneID = 'cs-sample'+(tabsize+1);
    $('#cs-sample1').children('.colorRow').each(function(i, element) {
        id = $(element).attr('data-id');
        searchHTML = '<li><div class="row"><div class="col-md-6"><input type="text" class="form-control" id="pickClrByName" placeholder="00000" maxlength="6" /></div><div class="col-md-6" id="show_color"><a class="btn btn-xs temp clr_thumbnail_lg btn-color" data-value="#000000"></a><a class="btn btn-xs clr_thumbnail_lg btn-color" data-value="#000000"></a></div></div></li>';
        paletePicker = '<a style="box-shadow:2px 2px 2px black" id="svg_color_btn" class="btn btn-xs dropdown-toggle btn_css" data-toggle="dropdown" style="" aria-expanded="false"></a><ul id="svg" class="dropdown-menu svgPicker clrpicker">'+searchHTML+'<li style="margin-top:5px"><div id="'+paneID+'--'+id+'" data-id="'+id+'" class="picker"></div></li><li style="margin-top: 5px;"><div class="svg_hover_clr pull-left"><a class="btn btn-xs clr_thumbnail"></a><span>#000000</span></div><div class="svg_selected_clr pull-right"><a class="btn btn-xs clr_thumbnail"></a><span>#000000</span></div></li></ul>'
        _html = _html+'<div class="row pt-10 colorRow" data-id="'+id+'"><div class="col-md-4 col-xs-12">Color '+(i+ 1)+'</div><div class="col-md-4 col-xs-12">'+paletePicker+'</div><div class="col-md-4 col-xs-12 nopad text-right pr-20"><button type="button" id="editor-cpicker" data-type="colorsFill" data-id="" class="btn btn-default"><i class="fa fa-eyedropper"></i></button></div></div>';
    });

var content = '<div role="tabpanel" class="tab-pane" id="cs-sample'+(tabsize+ 1)+'">'+_html+'</div>';
$(content).appendTo('#cs-tabContent');
$('#cs-sample'+(tabsize+ 1)+'').find('#svg_color_btn').css('background-color','#0000000');

var _tabs = '<li><a href="#cs-sample'+(tabsize+1)+'" class="'+paneID+'" data-toggle="tab">Sample '+(tabsize+1)+'</a></li>';
$(_tabs).appendTo('#cs-tablist');
$('#cs-sample'+(tabsize+1)).children('.colorRow').each(function(i, element) {
    id = $(element).attr('data-id');
    proFabric.setColorPallete(paneID+'--'+id);
});
$('#cs-tablist').find('li.active').trigger('click');
});




//****************************************************TEMPORARAY
$(document).delegate('#pickClrByName','keyup',function(){
    code = '#'+$(this).val();
    var condition  = /(^#[0-9A-F]{6}$)|(^#[0-9A-F]{3}$)/i.test(code);
    if(condition == true)
    {
        $(this).closest('.clrpicker').find('#show_color .temp').css('background-color',code);
        $(this).closest('.clrpicker').find('#show_color .temp').attr('data-value',code);
        $(this).closest('.clrpicker').find('#show_color span').text(code);
    }
})

$(document).delegate('#pickClrByName','keypress',function(e){
    if(e.keyCode == 13) {
        obj = proFabric.canvas.getActiveObject();
        tyype = $(this).closest('ul').attr('id');
        color = '#'+$(this).val();
        if(tyype == 'img')
        {
            val = Number($('#editor-IMGstrokeWidth').val());
            var condition  = /(^#[0-9A-F]{6}$)|(^#[0-9A-F]{3}$)/i.test(color);
            if(condition == true)
            {
                if(obj && obj.type == 'image')
                {
                    proFabric.image.set({strokeWidth:val, stroke:color}); 
                    proFabric.canvas.renderAll();
                    $('#img_color_btn').css('background-color',color);
                    $('.imgStroke .img_selected_clr a').css('background-color',color);
                    $('.imgStroke .img_selected_clr span').text(color);
                }
                else
                    return;
            }
        }
        else if(tyype == 'text')
        {
            if(obj && obj.class == 'text')
            {
                proFabric.text.set({
                    fill: color
                });  
                proFabric.canvas.renderAll();
                $('#text_color_btn').css('background-color',color);
                $('.text_selected_clr a').css('background-color',color);
                $('.text_selected_clr span').text(color);
            }
        }
        else if(tyype == 'svg')
        {
            _id = $(this).closest('.colorRow').attr('data-id');
            $(this).closest('ul').prev().css('background-color',color);
            $(this).closest('ul').find('.svg_selected_clr').children('span').html(color);
            $(this).closest('ul').find('.svg_selected_clr').children('.btn').css('background-color',color);
            proFabric.color.fill(_id, color);
        }

    }
});


$(document).delegate('.btn-color','click',function(){
    tyype = $(this).closest('ul').attr('id');
    obj = proFabric.canvas.getActiveObject();
    color = $(this).attr('data-value');
    if(tyype == 'img')
    {
        val = Number($('#editor-IMGstrokeWidth').val());
        if(obj && obj.type == 'image')
        {
            proFabric.image.set({strokeWidth:val, stroke:color}); 
            proFabric.canvas.renderAll();
            $('#img_color_btn').css('background-color',color);
            $('.imgStroke .img_selected_clr a').css('background-color',color);
            $('.imgStroke .img_selected_clr span').text(color);
        }
        else
            return;
    }
    else if(tyype == 'text')
    {
        if(obj && obj.class == 'text')
        {
            proFabric.text.set({
                fill: color
            });  
            proFabric.canvas.renderAll();
            $('#text_color_btn').css('background-color',color);
            $('.text_selected_clr a').css('background-color',color);
            $('.text_selected_clr span').text(color);
        }

    }
    else if(tyype == 'svg')
    {
        _id = $(this).closest('.colorRow').attr('data-id');
        $(this).closest('ul').prev().css('background-color',color);
        $(this).closest('ul').find('.svg_selected_clr').children('span').html(color);
        $(this).closest('ul').find('.svg_selected_clr').children('.btn').css('background-color',color);
        proFabric.color.fill(_id, color);
    }
    
});
$(document).delegate('.btn-color','mouseover',function(){
    color = $(this).attr('data-value');
    type = $(this).closest('ul').attr('id');
    $(this).closest('ul').find('.'+type+'_hover_clr a').css('background-color',color);
    $(this).closest('ul').find('.'+type+'_hover_clr span').text(color);
    
});

$(document).delegate('.pHimage','click',function(){
    console.log('clicked');
    proFabric.setPlaceHolder($(this).attr('data-value'));
    // 
})
