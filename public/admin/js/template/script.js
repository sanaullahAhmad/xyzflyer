var _selectedFile = "";
var _FlyerType = "";
var _FlyerXsize = 0;
var _FlyerYsize = 0;
var i = 1;
var _lockFlag = 1;
var _randomID = 1;
var _flag = 0;
var col_flag = 1;
var button = [
    ['Address', 'Price', 'Main-header', 'Headline', 'Body-1', 'Body-2', 'Body-3', 'Call-action'],
    ['Agent-contect', 'Agent-license'],
    ['Agent-2-contect', 'Agent-2-license'],
    ['Company-contect', 'Company-license'],
    ['Company-2-contect', 'Company-2-license']
];
var tabs = ['prop-info', 'agent-info', 'agent-2-info', 'company-info', 'company-2-info'];
$(document).ready(function($) {
    objectsAligning(proFabric.canvas);
    objectsCenter(proFabric.canvas);
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
    $("#editor-maxfontSize").val('36');
    for (var i = 0; i < button.length; i++) {
        var btn = button[i];
        for (var j = 0; j < btn.length; j++) {
            var d = new Date();
            console.log('Button : ' + button[i][j] + ' ID >> ' + d.getTime() + _randomID);
            //add("button", (d.getTime() + _randomID), button[i][j], tabs[i]);
            _randomID = _randomID + 1;
        }
    }
    $("#editor-colorWidth").val('0');
    $("#editor-colorHeight").val('0');

    var fontsLink = base_url+"admin/ajax/fonts";
    console.log(base_url, fontsLink);
    $.get(fontsLink)
    .done(function(user_json) {
        $.each(user_json.data.fonts, function(index, val) {
            console.log('fonts', index, val);
        });
    });
    $("#editor-colorWidth").keyup(function(){
        if(($("#editor-colorWidth").val()!="")&&($("#editor-colorWidth").val()>=0))
        proFabric.color.scaleToWidth($("#editor-colorWidth").val());
    });
    $("#editor-colorHeight").keyup(function(){
        if(($("#editor-colorHeight").val()!="")&&($("#editor-colorHeight").val()>=0))
        proFabric.color.scaleToHeight($("#editor-colorHeight").val());
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
        if(type=="image"){
            $('#editor-imageList').find('button[data-id='+_id+']').remove();
            arrangeImageNumbers();
        }
        else if(type=="color"){
            $('#cs-tabContent').find('.colorRow[data-id='+_id+']').remove();
            arrangeColorSets();
        }
        $('#editor-textarea').val('');
        proFabric.delete();
        proFabric.deselectCanvas();
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
            }
            else
                proFabric.text.set({text: _text});
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
        if(valueMax<value)
        {
            $("#editor-maxfontSize").val(value);
        }
        proFabric.text.set({
            maxfontSize: parseInt(value),
            fontSize: parseInt(value)
        });
    });
    $(document).delegate('#editor-fontFamily', 'change', function() {
        var value = $("#editor-fontFamily>option:selected").val();
        proFabric.text.set({
            fontFamily: value
        });
    });
    $(document).delegate('div#editor-textAlign>button', 'click', function() {
        var type = $(this).attr('data-type');
        $(this).addClass('btn-primary').siblings().removeClass('btn-primary');
        proFabric.text.set({
            textAlign: type
        });
    });
    $(document).delegate('button#editor-textList', 'click', function() {
        if ($(this).hasClass('btn-primary')) {
            $(this).removeClass('btn-primary');
            proFabric.text.bullet(false);
        }
        else{
            $(this).addClass('btn-primary');
            proFabric.text.bullet(true);
        }
    });
    $(document).delegate('button#editor-textBold', 'click', function() {
        if ($(this).hasClass('btn-primary')) {
            $(this).removeClass('btn-primary');
            proFabric.text.set({
                fontWeight: 'normal'
            });
        }
        else{
            $(this).addClass('btn-primary');
            proFabric.text.set({
                fontWeight: 'bold'
            });
        }
    });
    $(document).delegate('button#editor-textItalic', 'click', function() {
        if ($(this).hasClass('btn-primary')) {
            $(this).removeClass('btn-primary');
            proFabric.text.set({
                fontStyle: 'normal'
            });
        }
        else{
            $(this).addClass('btn-primary');
            proFabric.text.set({
                fontStyle: 'italic'
            });
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
    $(document).delegate('div#editor-lockGroup>button', 'click', function() {
        var type = $(this).attr('data-type');
        $(this).addClass('btn-primary').siblings().removeClass('btn-primary');
        if(type=='lock'){
            proFabric.set.lock();
        }
        else{
            proFabric.set.unlock();
        }
    });
    $(document).delegate("#editor-addImage", "click", function(event) {
        $('#editor-addImageFile').trigger('click');
    });
    $(document).delegate("#editor-addImageFile", "change", function(event) {
        console.log($(this));
        var fileObj = $(this)[0],
            file, fileURL=null;
        console.log(fileObj);
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
        var value = $(this).val();
        proFabric.image.set({
            width: parseInt(value)
        });
    });
    $(document).delegate('#editor-imageHeight', 'change', function() {
        var value = $(this).val();
        proFabric.image.set({
            height: parseInt(value)
        });
    });
    $(document).delegate('#editor-svgImage', 'click', function() {
        var src = $(this).attr('src');
        proFabric.shapes.add(src);
    });
    $(document).delegate('#cs-tablist>li', 'click', function() {
        var href = $(this).children('a').attr('href');
        $(href).children().each(function(index, el) {
            proFabric.color.fill($(el).attr('data-id'), $(el).find('.evo-colorind').css('backgroundColor'));
        });
    });
    $(document).delegate('#editor-setsImage', 'click', function() {
        var src = $(this).attr('src'),
            _id = proFabric.get.guid(),
            previousColor = [];
        $('#cs-tabContent').children('.tab-pane').each(function(index, el) {
            var rowcolors = [];
            $(el).children('.colorRow').each(function(i, element) {
                rowcolors.push($(element).find('div.evo-pointer').css("backgroundColor"));
            });
            previousColor.push({id:$(el).attr('id'), colors:rowcolors});
        });
        proFabric.color.add(src, {
            id : _id,
            callback : function () {
                var size = $('#cs-sample1').children().size();
                var _html = '<div class="row pt-10 colorRow" data-id="'+_id+'"><div class="col-md-4 col-xs-12">Color '+(size+ 1)+'</div><div class="col-md-4 col-xs-12"> <div class="inline vt"><input style="width:0px;" id="coler-picker" data-type="colorsFill"></div></div><div class="col-md-4 col-xs-12 nopad text-right pr-20"><button type="button" id="editor-cpicker" data-type="colorsFill" data-id="" class="btn btn-default"><i class="fa fa-eyedropper"></i></button></div></div>';
                $('#cs-tabContent').children('.tab-pane').each(function(index, el) {
                    $(el);
                    $(_html).appendTo(el);
                });
                colorPickerInit();
                $.each(previousColor.reverse(), function(index, val) {
                    $('#'+val.id).find('.colorRow').each(function(i, el) {
                        console.log(val.colors[i]);
                        $(el).find('#coler-picker').colorpicker("val", val.colors[i]);
                    });
                });
            }
        });
    });
    $(document).delegate('#editor-addSets', 'click', function() {
        var content = $('#cs-sample1').html(),
            size = $('#cs-tablist').children().size(),
            previousColor = [];
        if(size > 5) return;
        $('#cs-tabContent').children('.tab-pane').each(function(index, el) {
            var rowcolors = [];
            $(el).children('.colorRow').each(function(i, element) {
                rowcolors.push($(element).find('div.evo-colorind').css("backgroundColor"));
            });
            previousColor.push({id:$(el).attr('id'), colors:rowcolors});
        });
        var _html = '<div role="tabpanel" class="tab-pane" id="cs-sample'+(size+ 1)+'">'+content+'</div>';
        $(_html).appendTo('#cs-tabContent');
        $('#cs-sample'+(size+ 1)+'').find('.evo-cp-wrap').replaceWith('<input style="width:0px;" id="coler-picker" data-type="colorsFill">');

        var _tabs = '<li><a href="#cs-sample'+(size+1)+'" data-toggle="tab">Sample '+(size+1)+'</a></li>';
        $(_tabs).appendTo('#cs-tablist');
        colorPickerInit();
        $.each(previousColor.reverse(), function(index, val) {
            $('#'+val.id).find('.colorRow').each(function(i, el) {
                console.log(val.colors[i]);
                $(el).find('#coler-picker').colorpicker("val", val.colors[i]);
            });
        });
        $('#cs-tablist').find('li.active').trigger('click');
    });
    /*$(document).delegate('#editor-addShapes', 'click', function() {
        $('#editor-objectsBox').toggle();
    });*/
    $('#editor-objectsBox').toggle();

    $(document).delegate('button.editor-textAssign', 'click', function() {
        var _id = $(this).attr('data-id'), _this = $(this);
        var exist = proFabric.text.checkID(_id);
        setTimeout(function () {
            if (!exist){
                var _newid = proFabric.get.guid();
                proFabric.text.add('Your Text Here', {id: _newid});
                _this.addClass('btn-primary').attr('data-id', _newid);
            }
            else{
                proFabric.set.setActiveobj(_id);
                _this.addClass('btn-primary');
            } 
        }, 50);
    });
    $(document).delegate('button#editor-cpicker', 'click', function() {
        var obj = proFabric.get.currentObject();
        //alert(obj);
        if(!obj) return;
        var _id = obj.id;
        $('div.canvas-container, canvas').css('cursor', 'crosshair');
        $(this).addClass('btn-primary').attr('data-id', _id);
        event.preventDefault();
        proFabric.disableSelection();
        proFabric.droper();
    });

    $(document).delegate("#save", "click", function(event) {
        var json = JSON.stringify(proFabric.export.json());
        $('#export-image-proof').attr('src', proFabric.export.base64());
        _colorJson = [];
        $('button.editor-textAssign').each(function(index, el) {
            var _type = $(el).attr('data-type'),
                _id = $(el).attr('data-id'),
                _text = '';
            if(_id){
                _text = proFabric.text.getTextByID(_id);
                console.log(_text);
            }
            _colorJson.push({
                'type'  : _type,
                'id'    : _id,
                'text'  : _text
            });
        });
        console.log(_colorJson);
        $('#deliver-json-names').html(JSON.stringify(_colorJson, null, 4));
        //console.log(json);
    });

    $(document).delegate('#fullScreenEditor', 'click', function() {
        if (!document.fullscreenElement && !document.mozFullScreenElement && !document.webkitFullscreenElement && !document.msFullscreenElement ) {
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
            if(document.documentElement.requestFullscreen) {
                document.getElementById('editor').requestFullscreen();
            }
            else if(document.documentElement.msRequestFullscreen){
                document.getElementById('editor').msRequestFullscreen();
            }
            else if(document.documentElement.mozRequestFullScreen){
                document.getElementById('editor').mozRequestFullScreen();
            }
            else if(document.documentElement.webkitRequestFullscreen){
                document.getElementById('editor').webkitRequestFullscreen();
            }
        }
        else {
            $(this).val('Full Screen').html('Full Screen');
            $('#editor').removeAttr('style');
            if(document.exitFullscreen){
                document.exitFullscreen();
            }
            else if(document.msExitFullscreen){
                document.msExitFullscreen();
            }
            else if(document.mozCancelFullScreen){
                document.mozCancelFullScreen();
            }
            else if(document.webkitExitFullscreen){
                document.webkitExitFullscreen();
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
    }
}
function colorPickerInit(val){
    $('input#coler-picker').hide();
    $('input#coler-picker').colorpicker(
        {color:'#000000', defaultPalette:'web',showOn:'button'}
    )
    .on('change.color', function(event, color){
        var type = $(this).data('type');
        var _rgb = $(this).next('.evo-colorind').css('backgroundColor');
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

