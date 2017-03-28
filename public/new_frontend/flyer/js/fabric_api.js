proFabric;
var _pickerFlag = 0;
var _selectionflag=0;
var _img_num=1;
var undo_redo_tmp_obj=[],canvas_state = new Array(), current_state=0;
var imgCounter=0;
var imgListLength=0;
var imgList = new Array();
var proFabric = new function(){
    var that = this; // refrence for proFabric
    this.canvasWidth = 510;
    this.canvasHeight = 650;
    var modifiedCheck = true;
    var Top = this.canvasHeight;
    var Left = this.canvasWidth;
    this.zoom = 100, this.defaultZoom = 100;
    this.canvas = new fabric.Canvas('myCanvas',{backgroundColor:'#fff'});
    var resizeCanvas;
    this.canvas.setWidth(this.canvasWidth);
    this.canvas.setHeight(this.canvasHeight);
    this.canvas.selection = false;
    var BaseURL = $('#base_url').val();
    //     fabric.Image.fromURL(BaseURL+'abc.jpg', function(img) {
    //         img.class = 'image';
    //         img.src = BaseURL+'abc.jpg';
    //         img.orignalSource = BaseURL+'abc.jpg';
    //         img.id = "test";
    //         img.originX = "center";
    //         img.originY = "center";
    //         img.top = Top-102;
    //         img.left = Left-510;
    //         img.height = 200;
    //         img.width = 200;
    //         img.color = "#0000ff";
    //         img.lockMovementX = true;
    //         img.lockMovementY = true;
    //         img.lockRotation = true;
    //     that.canvas.add(img);
    // });
    this.canvas.renderAll();
    
    fabric.Object.prototype.toObject = (function (toObject) {
        return function () {
            return fabric.util.object.extend(toObject.call(this), {
                id: this.id,
                class: this.class,
                original_scaleX: this.original_scaleX,
                original_scaleY: this.original_scaleY,
                original_left: this.original_left,
                original_top: this.original_top,
                padding:this.padding,
                lockMovementX: this.lockMovementX,
                lockMovementY: this.lockMovementY,
                lockScalingX: this.lockScalingX,
                lockScalingY: this.lockScalingY,
                lockRotation: this.lockRotation,
                editable: this.editable,
                uploader: this.uploader,
                maxfontSize:this.maxfontSize,
                logo_company:this.logo_company,
            });
        };
    })(fabric.Object.prototype.toObject);

    this.canvas.on('object:modified', function(o){
        var object = o.target;
            
        if(object.class == 'image'){
            // that.image.updateUI(object,(that.zoom/100));
        }

        if(modifiedCheck){
            prevObject = object.toJSON(['src','id','class','index','alignment']);
            modifiedCheck = false;
            modifiedType = "modified";
        }

        if(object){
            object.set({
                original_scaleX : object.scaleX / (that.zoom/100),
                original_scaleY : object.scaleY / (that.zoom/100),
                original_left  : object.left / (that.zoom/100),
                original_top   : object.top / (that.zoom/100)
            });
        }
    });
    this.canvas.on('mouse:up', function(o){
        var object = that.canvas.getActiveObject();
        if(!object) {
            that.unselectSelected();
            that.text.disableTextOpts();
            that.getcolorObjects();
            that.selectfalseColor();
            that.disableImgOpts();
        }
        if(modifiedCheck){
            prevObject = object.toJSON(['src','id','class','index','alignment']);
            modifiedCheck = false;
            modifiedType = "mouseup";
        }
        if(object){
            object.set({
                original_scaleX : object.scaleX / (that.zoom/100),
                original_scaleY : object.scaleY / (that.zoom/100),
                original_left   : object.left / (that.zoom/100),
                original_top    : object.top / (that.zoom/100)
            });
        }
    });
    this.canvas.on('before:selection:cleared', function(o){
        var object = o.target;
        console.log('before:selection:cleared', object);
        /*if(object && object.class=='image'){
            that.replaceimage(object.group_src, object);
        }*/


    });
    this.canvas.on('selection:cleared', function(o){
        $("#font_Size").attr('disabled','disabled');
        $('button.editor-textAssign').each(function(index,el){
            $(el).removeClass('btn-primary');
        });
        
    });

    this.canvas.on('object:selected', function(o){
        console.log(canvas.getActiveObject());
        var object = o.target;
        console.log(object);

        var dataId=object.class;
        if(object.class=="text"){
            $("#font_Size").removeAttr('disabled');
            $("#text-area").val("");
            $("#text-area").val(object.text);
            $("#font_Size").val(object.fontSize);
            $("#font_Size").attr('max',object.maxfontSize);
            $('#TBHeight').val(object.height);
            console.log(parseInt(object.height));
            $('#font_color').css('background-color',object.fill);
            $("#font_color").removeAttr('disabled');
            $('.selected_clr .btn').css('background-color',object.fill);
            if(object.fill.charAt(0) != '#'){
                $('.selected_clr span').text(proFabric.rgb2hex(object.fill));
            }
            else{
                $('.selected_clr span').text(object.fill);
            }
            $("#col-picker").colorpicker("val", object.fill);
            $("#textfont" ).val(object.fontFamily);
            $('.text-btns button').removeClass('btn-primary');
            $('.text-btns  #'+object.id).addClass('btn-primary');
            that.text.updateUI(object);
            that.text.enableTextOpts();
            that.disableImgOpts();
        }
        else if(object.class=='image'){
            that.text.disableTextOpts();
            // that.image.updateUI(object,(that.zoom/100));
            // that.enableImgOpts();

            if(object.uploader == 'true')
            {
                if(object.logo_company && object.logo_company === 'true')
                {
                    $('#editor-logo_companyModal').modal('show');
                    $('#editor-logo_companyModal').removeClass('hide');
                }
                else
                {
                    if(object.firstTimeUpload == 'true')
                    {
                        $('#cropBtnContainer').hide();
                        $('#uploadBtnContainer').addClass('col-md-offset-3');
                    }
                    else
                    {
                        $('#cropBtnContainer').show();
                        $('#uploadBtnContainer').removeClass('col-md-offset-3');
                    }
                    $('#editor-uploaderModal').modal('show');
                    $('#editor-uploaderModal').removeClass('hide');
                }
            }
            else
            {
                that.canvas.discardActiveObject();
                console.log('Not an uploader');
            }
            // $('#targetImage').attr('src',object.src);
            // $("#settingOpt").show();
            // $("#imageOpt").show();
        }
        else if(object.class=='shape'){
            that.disableImgOpts();
            that.text.disableTextOpts();
            proFabric.shapes.shapeSelected(object);
        }
        $("#tabs li" ).each(function() {
            if($(this).data('id')==object.class){
                $(this).trigger('click');
            }
        });
        if(modifiedCheck){
            prevObject = object.toJSON(['src','id','class','index','alignment']);
            modifiedCheck = false;
            modifiedType = "select";
        }
        if(object){
            object.set({
                original_scaleX : object.scaleX / (that.zoom/100),
                original_scaleY : object.scaleY / (that.zoom/100),
                original_left   : object.left / (that.zoom/100),
                original_top    : object.top / (that.zoom/100)
            });
        }
    });

    this.get = {
        canvas : function(){
            return that.canvas;
        },
        width : function(){
            return that.canvasWidth;
        },
        height : function(){
            return that.canvasHeight;
        },
        currentObject : function(){
            return that.canvas.getActiveObject();
        },
        currentGroup : function(){
            return that.canvas.getActiveGroup();
        },
        zoom : function(){
            return that.zoom;
        },
        guid : function() {
            return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function (c) {
                var r = Math.random() * 16 | 0, v = c == 'x' ? r : (r & 0x3 | 0x8);
                return v.toString(16);
            });
        },
        defaultZoom : function(){
            return that.defaultZoom;
        },
        inchesToPixel : function(inc){
            return inc * 96;
        },
        checkID: function(_id) {
        var flag = false;
        that.canvas.forEachObject(function(object){
            if(object.id == _id){
                flag = true;
            }
        });
        return flag;
    }
        
    };
    this.set = {
        width : function(w){
            that.canvasWidth = w;
        },
        height : function(h){
            that.canvasHeight = h;
        },
        zoom : function(z){
            that.zoom = z;
        },
        defaultZoom : function(z){
            that.defaultZoom = z;
        },
        bringFront : function(){
            var obj = that.get.currentObject();
            if(!obj)return;
            that.canvas.bringForward(obj);
            that.canvas.renderAll();
        },
        sendBack : function(){
            var obj = that.get.currentObject();
            if(!obj)return;
            that.canvas.sendBackwards(obj);
            that.canvas.renderAll();
        },
        lock : function(){
            var obj = that.get.currentObject();
            if(!obj)return;
            if(obj.class=='text')
            {
                if(obj.lockMovementX==false) {
                    obj.set({
                        lockMovementX: true,
                        lockMovementY: true,
                        lockRotation: true,
                        lockScalingX: true,
                        lockScalingY: true
                    });
                    $("#text_lock").removeClass('fa fa-lock');
                    $("#text_lock").addClass('fa fa-unlock');
                }
                else
                {
                    obj.set({
                        lockMovementX     : false,
                        lockMovementY     : false,
                        lockRotation      : false,
                        lockScalingX      : false,
                        lockScalingY      : false
                    });
                    $("#text_lock").removeClass('fa fa-unlock');
                    $("#text_lock").addClass('fa fa-lock');
                }
                that.canvas.renderAll();
            }
            else {
                if (obj.lockMovementX == false) {
                    obj.set({
                        lockMovementX: true,
                        lockMovementY: true,
                        lockRotation: true,
                        lockScalingX: true,
                        lockScalingY: true
                    });
                }
                else {
                    obj.set({
                        lockMovementX: false,
                        lockMovementY: false,
                        lockRotation: false,
                        lockScalingX: false,
                        lockScalingY: false
                    });
                }
                that.canvas.renderAll();
            }
        },
        unlock : function(){
            var obj = that.get.currentObject();
            if(!obj)return;
            obj.set({
                lockMovementX     : false,
                lockMovementY     : false,
                lockRotation      : false,
                lockScalingX      : false,
                lockScalingY      : false
            });
            that.canvas.renderAll();
        },
        ID : function(id){
            if(id) {
                var obj = that.canvas.getActiveObject();
                if (obj&&obj.class=='text') {
                    if(!obj.btnID)
                    {
                        obj.btnID = id;
                        $(id).addClass('ui-state-active');
                        $(id).addClass('ui-widget-content');
                        alert("Assigning ID");
                    }
                    else if(id == obj.btnID)
                    {
                        alert('FLAG : '+_txtSelectionFlag);
                        if(_selectionflag==1&&_txtSelectionFlag==1) {
                            obj.btnID = "";
                            that.canvas.setActiveObject(obj);
                            $(id).removeClass('ui-state-active');
                            $(id).removeClass('ui-widget-content');
                            alert("id already assigned to button . . . . Un-selecting and removing ID");
                            _txtSelectionFlag=0;
                        }
                        _txtSelectionFlag = 1;
                    }
                    else
                    {
                        //console.log("id already assigned to button");
                    }
                    selectionflag = 0;
                }
            }
        },
        canvas_size: function(w, h) {
            that.canvas.setHeight(h || that.canvas.getHeight());
            that.canvas.setWidth(w || that.canvas.getWidth());
            that.canvas.renderAll();
        },
        setActiveobj:function(id){
            that.canvas.forEachObject(function(obj) {
                if (obj.linkid == id) { 
                    that.canvas.setActiveObject(obj, '');
                }
            });
            that.canvas.renderAll();
        },
        setActiveobjByID:function(id){
            that.canvas.forEachObject(function(obj) {
                if (obj.id == id) { 
                    that.canvas.setActiveObject(obj, '');
                }
            });
            that.canvas.renderAll();
        },
        setColorSet:function(id,color){
            var self = this;
            that.canvas.forEachObject(function(obj) {
                if (obj.id == id) {
                    var before = obj.toJSON(['id','class','src']);
                    if (obj.isSameColor && obj.isSameColor() || !obj.paths) {
                        obj.setFill(color);
                        obj.paths.forEach(function(i) { i.set({stroke: color}); });
                    }
                    else if (obj.paths) {
                        obj.paths.forEach(function(i) {
                            i.setFill(color);
                            i.set({stroke: color});
                        });
                    }
                    obj.setCoords();
                }
            });
            that.canvas.renderAll();
        }
    },
    this.export = {
        svg : function(){
        },
        json : function(){
            return that.canvas.toJSON();
        }
    };
    this.randBtnSelection = function(id) {
        that.canvas.forEachObject(function(obj){
            if (obj.btnID) {
                if (id == obj.btnID) {
                    that.canvas.setActiveObject(obj);
                    _selectionflag = 1;
                    if(_txtSelectionFlag==1)
                    _txtSelectionFlag = 0;
                    else
                        _txtSelectionFlag=1;
                    return;
                }
            }
        });
    };
    this.import = {
        svg : function(svg){
        },
        json :function(_json){
                var _JSON_NEW = JSON.stringify(_json);
                var _img_flag = true;
                var i = 0, image_number=0;
                $('.imgOptclass').hide();
                that.canvas.loadFromJSON(_JSON_NEW, function(){
                    console.log(that.canvas);
                    that.canvas.forEachObject(function (obj) {
                        image_number++;
                        if(obj.class == "image"){
                            var circle = new fabric.Circle({
                                radius: 20,
                                fill: 'white',
                                class:"img-num",
                                opacity : 0.8,
                                originX: "center",
                                originY: "center"
                            });
                            var text = new fabric.Text(image_number.toString(), {
                                fontSize: 18,
                                originX: "center",
                                originY: "center"
                            });
                            var circleGroup = new fabric.Group([circle, text], {
                                left: (obj.left+((obj.width * obj.scaleX)/2)),
                                top: (obj.top+((obj.height * obj.scaleY)/2)),
                                originX: "center",
                                originY: "center"
                            });
                            var _img = fabric.util.object.clone(obj);
                            _img.set({
                                original_top    : 0,
                                original_left   : 0,
                                originX         : 'left',
                                originY         : 'top'
                            });
                            var imageGroup = new fabric.Group([_img, circleGroup], {
                                original_scaleX : 1,
                                original_scaleY : 1,
                                original_top    : obj.original_top,
                                original_left   : obj.original_left,
                                originX         : 'left',
                                originY         : 'top',
                            });
                            var _im = imageGroup.toDataURL();
                            obj.set({
                                original_src : obj.src,
                                group_src : _im
                            });
                            that.replaceimage(_im, obj);
                        }
                    });
                },function(o, object) {
                    var col = object.fill;
                    var o_Width = object.width;
                    var o_Height = object.height;
                    if(object.class=="text")
                    {
                        var _txt = object.text;
                        var _count = 0;
                        for(var k=0;k<_txt.length;k++)
                        {
                            if(_txt[k]=='\n')
                            {
                                _count++;
                            }
                        }
                        object.set({nextline : _count});
                    }
                    object.set({
                        lockMovementX: true,
                        lockMovementY: true,
                        lockRotation: true,
                        lockScalingX: true,
                        lockScalingY: true,
                        hasControls: false,
                        editable :false,
                        orignalWidth:o_Width,
                        orignalHeight:o_Height
                    });
                    if(object.type=="path-group")
                    {
                        object.set({selectable :false, stroke:col});
                        object.selectable = false;
                    }
                    if(object.class == "image"&& object.src){
                        _img_flag = false;
                        $('.imgOptclass').show();
                        $('#img-present-box').append('<div class="row" style="margin: 0px;padding: 0px;"><div class="col-md-6 col-xs-6" style="margin: 0px;padding: 0px;"><div class="row" style="margin-top: 12px;"><div class="divbtnImgs col-md-3 col-xs-3" align="left" style="font-weight: bolder;font-family: sans-serif;font-size: 14px;" id="'+object.id+'">'+_img_num+'</div><div align="left" class="col-md-9 col-xs-9" style="font-size: 14px;font-weight: bolder;font-family: sans-serif;" align="right">Add Image</div></div></div>'+
                        '<div class="col-md-6 col-xs-6" align="right" style="margin: 0px;padding: 0px;"><button type="button" class="btnImgs btn btn-success" ' +
                        'style="margin-top: 5px;font-weight: bolder;"' +
                        'id="'+object.id+'" value="'+_img_num+'" >Upload</button></div></div>');
                        _img_num++
                    }
                });
                that.canvas.renderAll();
        }
    };
    this.replaceimage = function(newsrc, obj){
        var ImageObj = new Image();
        ImageObj.onload = function() {
            image = new fabric.Image(ImageObj);
            image.top  = obj.top;
            image.left = obj.left;
            image.scaleX = obj.scaleX;
            image.scaleY = obj.scaleY;
            image.width = obj.width;
            image.height = obj.height;
            image.index= obj.index;
            image.src=newsrc;
            image.id = obj.id;
            image.class=obj.class;
            image.angle=obj.angle;
            image.original_scaleX   = obj.original_scaleX;
            image.original_scaleY = obj.original_scaleY;
            image.original_left     = obj.original_left;
            image.original_top      = obj.original_top;

            image.set({
                original_src    : obj.src,
                group_src       : obj._im,
                lockMovementX   : true,
                lockMovementY   : true,
                lockRotation    : true,
                lockScalingX    : true,
                lockScalingY    : true,
                hasControls     : false,
                editable        : false,
            });
            that.canvas.add(image);
            that.canvas.moveTo(image, that.canvas.getObjects().indexOf(obj));
            that.canvas.setActiveObject(image);
            that.canvas.remove(obj);
            that.canvas.renderAll();
        };
        ImageObj.src = newsrc;
    }
    this.rgb2hex=function (rgb){
        rgb = rgb.match(/^rgba?[\s+]?\([\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?/i);
        return (rgb && rgb.length === 4) ? "#" +
        ("0" + parseInt(rgb[1],10).toString(16)).slice(-2) +
        ("0" + parseInt(rgb[2],10).toString(16)).slice(-2) +
        ("0" + parseInt(rgb[3],10).toString(16)).slice(-2) : '';
    };
    this.hexToRgb = function(hex) {
    // Expand shorthand form (e.g. "03F") to full form (e.g. "0033FF")
    var shorthandRegex = /^#?([a-f\d])([a-f\d])([a-f\d])$/i;
    hex = hex.replace(shorthandRegex, function(m, r, g, b) {
        return r + r + g + g + b + b;
    });

    var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
    return result ? {
        r: parseInt(result[1], 16),
        g: parseInt(result[2], 16),
        b: parseInt(result[3], 16)
    } : null;
}

  /*  this.createPNGImage = function(){
            var pngimage = that.canvas.toDataURL('png');
            $('full-flyer-design img').src(pngimage);
    };
*/

    this.deselectCanvas =function(){
        that.canvas.discardActiveObject();
        that.canvas.discardActiveGroup();
        that.canvas.renderAll();
    };
    this.zoomcanvas = function(zoom){
        console.log(this.canvasWidth, this.canvasHeight);

        this.zoom = zoom;
        console.log(zoom);
        // var actOBJ = this.canvas.getActiveObject().id;
        proFabric.deselectCanvas();

        this.canvas.renderAll();
        this.canvas.forEachObject(function(obj){
                var scale_X = typeof obj.original_scaleX === "undefined" ? obj.scaleX : obj.original_scaleX,
                scale_Y     = typeof obj.original_scaleY === "undefined" ? obj.scaleY : obj.original_scaleY,
                left        = typeof obj.original_left === "undefined"   ? obj.left   : obj.original_left,
                top         = typeof obj.original_top === "undefined"    ? obj.top    : obj.original_top;
                
                obj.original_scaleX = typeof obj.original_scaleX === "undefined" ? obj.scaleX : obj.original_scaleX;
                obj.original_scaleY = typeof obj.original_scaleY === "undefined" ? obj.scaleY : obj.original_scaleY;
                obj.original_left   = typeof obj.original_left === "undefined"   ? obj.left   : obj.original_left;
                obj.original_top    = typeof obj.original_top === "undefined"    ? obj.top    : obj.original_top;
                obj.scaleX = scale_X * (zoom/100);
                obj.scaleY = scale_Y * (zoom/100);
                obj.left   = left   * (zoom/100);
                obj.top    = top    * (zoom/100);

            obj.setCoords();
        });
        this.canvas.setWidth(this.canvasWidth * (zoom/100)).setHeight(this.canvasHeight * (zoom/100));
        var cntMaxW = $('#canvas-containerOut').css('max-width');
        var cntMaxH = $('#canvas-containerOut').css('max-height');
        // console.log('cntMaxW = ',cntMaxW)
        cntMaxW = Number(cntMaxW.substring(0, cntMaxW.length-2));
        cntMaxH = Number(cntMaxH.substring(0, cntMaxH.length-2));
        // console.log('proFabric.canvas.width = '+proFabric.canvas.width+' cntMaxW '+cntMaxW);
        if(proFabric.canvas.width >= cntMaxW ){
            $('#canvas-containerOut').css('overflow-x','scroll');
            // console.log('testing max width ' +cntMaxW);
        }
        else{
            $('#canvas-containerOut').css('overflow-x','visible');
            console.log('testing max width ' +cntMaxW);
        }
        if(proFabric.canvas.height >= cntMaxH ){
            $('#canvas-containerOut').css('overflow-y','scroll');
            // console.log('testing max height ' +cntMaxW);
        }
        else{
            $('#canvas-containerOut').css('overflow-y','visible');
        }
        updateBackgroundImage();
        this.canvas.renderAll();
        // proFabric.set.setActiveobj(actOBJ);
    };
    function updateBackgroundImage(_bg){
    canvas = proFabric.canvas;
    canvas.setBackgroundImage((_bg || ""), canvas.renderAll.bind(canvas), {
        originX: 'left',
        originY: 'top',
        left: 0,
        top: 0,
        width: canvas.width,
        height: canvas.height,
        opacity: 0
    });
}
    this.getCanvasPixelData = function(x, y) {
        var ctx = that.canvas.getContext('2d');
        var pixel = ctx.getImageData(x, y, that.canvasWidth, that.canvasHeight);
        var data = pixel.data;
        return 'rgba(' + data[0] + ',' + data[1] + ',' + data[2] + ',' + data[3] + ')';
    };
    this.delete = function(opt_obj) {//Edited by Ahmad
        if(opt_obj=='text')
        {
            if(that.canvas.getActiveGroup()){
                var obj = that.canvas.getActiveGroup();
                for(var i = 0 ; i < obj._objects.length ; i++) {
                    if(obj._objects[i].class=="text") {
                        that.canvas.fxRemove(obj._objects[i]);
                    }
                }
                that.canvas.discardActiveGroup();
                that.canvas.renderAll();
                that.canvas.discardActiveGroup().renderAll();
            } else {
                that.canvas.remove(that.canvas.getActiveObject());
            }
        }
        else if(opt_obj=='image')
        {
            if(that.canvas.getActiveGroup()){
                var obj = that.canvas.getActiveGroup();
                for(var i = 0 ; i < obj._objects.length ; i++) {
                    if(obj._objects[i].class=='image') {
                        that.canvas.fxRemove(obj._objects[i]);
                    }
                }
                that.canvas.discardActiveGroup();
                that.canvas.renderAll();
                that.canvas.discardActiveGroup().renderAll();
            } else {
                that.canvas.remove(that.canvas.getActiveObject());
            }
        }
        else
        {
            if(that.canvas.getActiveGroup()){
                var obj = that.canvas.getActiveGroup();
                for(var i = 0 ; i < obj._objects.length ; i++) {
                    that.canvas.fxRemove(obj._objects[i]);
                }
                that.canvas.discardActiveGroup();
                that.canvas.renderAll();
                that.canvas.discardActiveGroup().renderAll();
            } else {
                that.canvas.remove(that.canvas.getActiveObject());
            }
        }
    };
    this.droper = function (){
            _pickerFlag = 1;
    };
    this.disableSelection=function(){
        that.canvas.deactivateAll();
        that.canvas.selection = false;
        var lenght = that.canvas._objects.length;
        for(var i = 0 ; i < lenght ; i++) {
            that.canvas._objects[i].selectable = false;
        }
        that.canvas.renderAll();
    };
    this.enableSelection=function(){
        that.canvas.deactivateAll();
        that.canvas.selection = false;
        var lenght = that.canvas._objects.length;
        for(var i = 0 ; i < lenght ; i++) {
            that.canvas._objects[i].selectable = true;
        }
        that.canvas.renderAll();
    };
    this.unselectSelected=function(){
        that.canvas.deactivateAll();
        that.canvas.renderAll();
    };
    this.setActiveId=function(_id)
    {
        var lenght = that.canvas._objects.length;
        console.log(_id);
        //console.log("-------------------------------------------------------------------");
        for(var i = 0 ; i < lenght ; i++) {
            var temp = that.canvas._objects[i];
            if(temp.id ==_id)
            {
                this.canvas.setActiveObject(temp);
                break;
            }
        }
        //console.log("-------------------------------------------------------------------");
        that.canvas.renderAll();
    };
    this.replaceImg=function(source,_id){
        var obj = that.canvas.getActiveObject();
        var before = obj.toJSON(['id','class']);
        console.log(obj);
        var top = obj.original_top;
        var left = obj.original_left;
        var _width = obj.width;
        var _height = obj.height;
        var _scaleX = obj.scaleX;
        var _scaleY = obj.scaleY;
        var _id = obj.id;
        var _class = obj.class;
        var _type = obj.type;
        // var _num = obj.num;
        //var _object = fabric.util.object.clone(obj);
        console.log("O-top : "+obj.original_top);
        console.log("O-left : "+obj.original_left);
        console.log("top : "+top);
        console.log("left : "+left);
        console.log("width : "+_width);
        console.log("height : "+_height);
        console.log(" ------------- ");
        //console.log(obj['_objects']);
        //console.log(obj['_objects'][0].src);
        //_object['_objects'][0].src = source;
        //that.canvas.add(_object);
        //that.canvas.renderAll();
        that.canvas.fxRemove(obj);
        fabric.Image.fromURL(source, function(img) {
            img.class = _class;
            img.type = _type;
            img.src = source;
            img.orignalSource = source;
            img.id = _id;
            img.top = top;
            img.left = left;
            img.width = _width;
            img.height = _height
            img.color = "#0000ff";
            img.set({
                lockMovementX: true,
                lockMovementY: true,
                lockRotation: true,
                lockScalingX: true,
                lockScalingY: true,
                hasControls: false,
                borderColor: 'yellow',
                scaleX:_scaleX,
                scaleY:_scaleY
            });
            canvas.add(img);
            that.savestate('modified',before,img.toJSON(['id','class']));
            canvas.discardActiveGroup();
            canvas.setActiveObject(img);
            that.canvas.renderAll();
        });
    };
    this.placeLogoImage = function(source)
    {   
        var currentObj = canvas.getActiveObject();
        var _id = currentObj.id;
        var obj;
        if(currentObj.firstTimeUpload === 'true'){
            proFabric.canvas.forEachObject(function(object) {
                if (object.id == _id+'placeholderBG') {
                    obj = object;
                }
            });
        }
        else
        {
           proFabric.canvas.forEachObject(function(object) {
                if (object.id == _id) {
                    obj = object;
                }
            }); 
        }
        proFabric.upload_cropped_image(source,obj.id,_id);

    }
    this.getIds = function(){
        var obj;
        var currentObj = canvas.getActiveObject();
        var _id = currentObj.id;

        if(currentObj.firstTimeUpload === 'true'){
            proFabric.canvas.forEachObject(function(object) {
                if (object.id == _id+'placeholderBG') {
                    obj = object;
                }
            });
        }
        else
        {
           proFabric.canvas.forEachObject(function(object) {
                if (object.id == _id) {
                    obj = object;
                }
            }); 
        }
        return obj;
    },

    this.cropImage = function(source)
    {   
        // $('.content').removeAttr('style');
        var currentObj = canvas.getActiveObject();
        var _id = currentObj.id;
        var _obj = proFabric.getIds();
        var _objId = proFabric.getIds().id;
        console.log('_objId',_objId);
        $('#editor-cropperModalContent content').remove();
        $('#editor-cropperModal').modal('show');

        $('#editor-cropperModal').on('shown.bs.modal', function () {
            var html = '<div class="content">\
                            <div class="row">\
                                <div class="col-md-10 col-md-offset-1">\
                                    <div class="img-container" id="imgToCrop">\
                                        <img src="'+source+'" alt="Picture"/>\
                                    </div>\
                                </div>\
                            </div>\
                            <div class="row" id="actions">\
                                <div class="col-md-10 col-md-offset-1 docs-buttons">\
                                    <br><br>\
                                    <div>\
                                        <button type="button" class="btn btn-success getCanvas" data-method="getCroppedCanvas">\
                                            Crop\
                                        </button>\
                                        <button type="button" class="btn btn-default" id="cancelCrop">\
                                            Cancel\
                                        </button>\
                                    </div><br><br>\
                                </div>\
                            </div>\
                        </div>';
            $('.modal-content-CROP').html('');
            $('.modal-content-CROP').html('<center>'+html+'</center>');
            proFabric.cropperjs(_obj.getWidth(), _obj.getHeight(),_objId, _id);
        });   

    }
    

    this.cropperjs = function(ww,hh,_activeObjID, btn_id) {

        // 'use strict';
        // var www,hhh;
        // var resCheck;
        var container = document.querySelector('#imgToCrop');
        // alert(container);
        var image = container.getElementsByTagName('img').item(0);
        var download = document.getElementById('download');
        var actions = document.getElementById('actions');
        // console.log('testing cropper');
        var options = {
            // aspectRatio: ww / hh,
            // multiple:true,
            minContainerWidth:50,
            minContainerHeight:50,
            minCanvasWidth:50,
            minCanvasHeight:50,
            // maxContainerHeight:window.height(),
            // background:false,
            autoCropArea:1,
            zoomable:false,
            ready: function (e) {
                // console.log(e.type);
            },
            cropstart: function (e) {
                // console.log(e.type, e.detail.action);
            },
            cropmove: function (e) {
                // console.log(e.type, e.detail.action);
            },
            cropend: function (e) {
                // console.log(e.type, e.detail.action);
            },
            crop: function (e) {
                var data = e.detail;
                // console.log(e.type);
                // www = Math.round(data.height);
                // hhh = Math.round(data.width);

                // resCheck = proFabric.ImageResolutionCheck(www, hhh, ww, hh);
                // $('.strip p').removeClass(resCheck.bgClass);
                // $('.strip p').attr('class',resCheck.bgClass);
                // $('.strip p').html('<b>Image Quality : </b>'+resCheck.msg);
                
            },
            zoom: function (e) {
                console.log(e.type,e.detail.oldRatio, e.detail.ratio);
            }
        };
        var cropper = new Cropper(image, options);
        cropper.setCropBoxData({"width":ww,"height":hh});
        var canvasCRP = document.createElement('canvas');
        canvasCRP.width = image.width;
        var canvasCTX = canvasCRP.getContext;
        if (!canvasCTX) {
          $('button[data-method="getCroppedCanvas"]').prop('disabled', true);
        }
        
        if (typeof document.createElement('cropper').style.transition === 'undefined') {
            $('button[data-method="rotate"]').prop('disabled', true);
            $('button[data-method="scale"]').prop('disabled', true);
        }
         // Methods
        actions.querySelector('.docs-buttons').onclick = function (event) {
            var e = event || window.event;
            var target = e.target || e.srcElement;
            var result;
            var input;
            var data;
            if (!cropper) {
                return;
            }
            
            while (target !== this) {
                if (target.getAttribute('data-method')) {
                    break;
                }
                target = target.parentNode;
            }
            
            if (target === this || target.disabled || target.className.indexOf('disabled') > -1) {
                return;
            }
            data = {
                method: target.getAttribute('data-method'),
                target: target.getAttribute('data-target'),
                option: target.getAttribute('data-option'),
                secondOption: target.getAttribute('data-second-option')
            };
            
            if (data.method) {
                if (typeof data.target !== 'undefined') {
                    input = document.querySelector(data.target);
                    if (!target.hasAttribute('data-option') && data.target && input) {
                        try {
                            data.option = JSON.parse(input.value);
                        } catch (e) {
                        console.log(e.message);
                        }
                    }
                }
                if (data.method === 'getCroppedCanvas') {
                  data.option = JSON.parse(data.option);
                }
                
                result = cropper[data.method](data.option, data.secondOption);
                switch (data.method) {
                    case 'scaleX':
                    case 'scaleY':
                        target.setAttribute('data-option', -data.option);
                    break;
                
                    case 'getCroppedCanvas':
                        if (result) {
                            // proFabric.uploadImage(result);
                            // Bootstrap's Modal
                            // if(resCheck.imgstatus == 1)
                            // {
                                var src = result.toDataURL('');
                                $('#editor-cropperModal').modal('hide');
                                bootbox.dialog({
                                    message:'<center><img src="'+src+'" id="croppedImg"/></center>',
                                    buttons: {
                                                
                                                insert: {
                                                    label: "Insert",
                                                    className: "btn-success",
                                                    callback: function() {
                                                        // proFabric.uploadPlaceHolderImage(src,_activeObjID,btn_id);
                                                        proFabric.upload_cropped_image(src, _activeObjID,btn_id)
                                                        $('#editor-cropperModalContent').children().remove();
                                                        $('#editor-cropperModal').modal('hide');
                                                    }
                                                },
                                                crop: {
                                                    label: "Crop Again",
                                                    className: "btn-primary",
                                                    callback: function() {
                                                        $('#editor-cropperModal').modal('show');
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
                            // }
                            /*else
                            {
                                $('#editor-cropperModal').modal('hide');
                                bootbox.dialog({
                                    message:'Can not Upload the image of Unacceptable Quality'
                                });
                                window.setTimeout(function(){
                                    bootbox.hideAll();
                                }, 2000);
                            }*/
                        }
                    break;
                    
                    case 'destroy':
                        cropper = null;
                    break;
                }
                
                if (typeof result === 'object' && result !== cropper && input) {
                    try {
                        input.value = JSON.stringify(result);
                    } catch (e) {
                        console.log(e.message);
                    }
                }
            }
        };
    };

    this.upload_cropped_image = function(image_file,_activeObjID,btn_id)

    {

        $.ajax({
            url: 'https://xyzflyers.com/editor/upload_flyer_images',
            data: {image_file},
            type: 'POST',
            async: true,
            beforeSend: function (res)
            {   
                // console.log('_activeIMGid = '+_activeIMGid);
                bootbox.hideAll();
                bootbox.dialog({
                    message:'<center><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i><br><br><p><strong>Uploading Image please Hold on...</strong></p><center>',
                    closeButton: false,
                });
                imgCounter++;
                $('#save_flyer_design').addClass('disabled');
            },
            error: function (res)
            {
                bootbox.dialog({'message':'Error saving the image', 'backdrop': true});
                setTimeout(function(){
                    bootbox.hideAll();
                },1500)
                $('#save_flyer_design').removeClass('disabled');
            },
            success: function (res)
            {
                // res = $.parseJSON(res);
                res = $.parseJSON(res);
                if(res.message == "success")
                {
                    
                    // proFabric.set.setActiveobj(_activeObjID);
                    console.log('res.url = '+res.url);
                    imgCounter--;
                    imgList.push(res.name);
                    imgListLength++; 
                    proFabric.uploadImage(res.url, _activeObjID,btn_id,res.name);
                    if(imgCounter == 0)
                        $('#save_flyer_design').removeClass('disabled');
                    
                    setTimeout(function(){
                        bootbox.hideAll();
                    },1500);
                }
                else{
                    bootbox.dialog({'message':'Image Not Uploaded', 'backdrop': true});
                }
                /*bootbox.hideAll();
                myFabric.setActiveobj(_activeIMGid);
                console.log('res.id = '+res.id);
                var _src = 'http://fabric.dev.web2print.inf.br/index.php?option=com_isi_preview&task=api.getUploadedImage&local_image_id='+res.id+'&format=raw';
                myFabric.uploadImage(_src, _activeIMGid);
                $('#objectLoading').slideUp();*/
            },
        }); 
    };
/*
   this.ImageResolutionCheck = function(cropWidth, cropHeight, fieldWidth, fieldHeight) {
        "use strict";
        var retorno = new Object;
        // Check image or crop area resolution
        var QualityStr = ['Good', 'Medium', 'Low','Unacceptable'];
        var QualityVal = [300, 200, 100];
        var QualityColorClass = ['qtip-green', 'qtip-yellow', 'qtip-red', 'qtip-red'];
        var QualityColor = ['bg-success', 'bg-warning', 'bg-danger', 'bg-danger'];
        fieldWidth = fieldWidth / 72; // Convertendo de pt para inches
        fieldHeight = fieldHeight / 72; // Convertendo de pt para inches
        var dpiWidth, dpiHeight, dpiSmaller, i;
        dpiWidth = cropWidth / fieldWidth;
        dpiHeight = cropHeight / fieldHeight;
        dpiSmaller = Math.min(dpiWidth, dpiHeight);
        for (i = 0; i < QualityVal.length; ++i) {
            if (dpiSmaller >= QualityVal[i]) {
                retorno.msg = QualityStr[i];
                retorno.imgstatus = 1; // CROP AREA OR IMAGE ok, means: NOT UNACCEPTABLE
                retorno.qtipclass = QualityColorClass[i];
                retorno.bgClass = QualityColor[i];
                return retorno;
            }
        }
        retorno.msg = QualityStr[QualityStr.length - 1];
        retorno.imgstatus = 0 // BAD CROP AREA OR BAD IMAGE, UNACCEPTABLE
        retorno.qtipclass = QualityColorClass[QualityColorClass.length - 1];
        retorno.bgClass = QualityColor[QualityColor.length - 1];
        return retorno;
    };
*/
    this.uploadPlaceHolderImage = function(source,_activeObjID,btn_id){
        var obj;   
        console.log('hello jawad');
        proFabric.canvas.forEachObject(function(object) {
            if (object.id == _activeObjID) {
                obj = object;
            }
            else if(object.id == btn_id)
            {
                canvas.remove(object);
            }
        });
        $('#editor-uploaderModal').modal('hide');
        var _index  = canvas.getObjects().indexOf(obj); 
        fabric.Image.fromURL(source, function(img) {

            img.set({
                label                       :       obj.label,
                class                       :       obj.class,
                id                          :       obj.id,
                formordering                :       obj.formordering,
                type                        :       obj.type,
                originX                     :       obj.originX,
                originY                     :       obj.originY,
                left                        :       obj.left,
                top                         :       obj.top,
                width                       :       obj.width,
                height                      :       obj.height,
                fill                        :       obj.fill,
                stroke                      :       obj.stroke,
                strokeWidth                 :       obj.strokeWidth,
                strokeDashArray             :       obj.strokeDashArray,
                strokeLineCap               :       obj.strokeLineCap,
                strokeLineJoin              :       obj.strokeLineJoin,
                strokeMiterLimit            :       obj.strokeMiterLimit,
                scaleX                      :       obj.scaleX,
                scaleY                      :       obj.scaleY,
                angle                       :       obj.angle,
                flipX                       :       obj.flipX,
                flipY                       :       obj.flipY,
                opacity                     :       obj.opacity,
                shadow                      :       obj.shadow,
                visible                     :       obj.visible,
                clipTo                      :       obj.clipTo,
                backgroundColor             :       obj.backgroundColor,
                fillRule                    :       obj.fillRule,
                globalCompositeOperation    :       obj.globalCompositeOperation,
                page_id                     :       obj.page_id,
                inputfield                  :       obj.inputfield,
                evented                     :       obj.evented,
                selectable                  :       true,
                src                         :       source,
                filters                     :       obj.filters,
                crossOrigin                 :       obj.crossOrigin,
                alignX                      :       obj.alignX,
                alignY                      :       obj.alignY,
                meetOrSlice                 :       obj.meetOrSlice,
                upload                      :       obj.upload,
                imagelist                   :       obj.imagelist,
                lockMovementX               :       obj.lockMovementX,
                lockMovementY               :       obj.lockMovementY,
                lockRotation                :       obj.lockRotation,
                lockScalingX                :       obj.lockScalingX,
                lockScalingY                :       obj.lockScalingY,
                hasControls                 :       obj.hasControls,
                borderColor                 :       obj.borderColor,
                hoverCursor                 :       obj.hoverCursor,
                showincanvas                :       obj.showincanvas,
                original_scaleX             :       obj.original_scaleX,
                original_scaleY             :       obj.original_scaleX,
                original_top                :       obj.original_top,
                original_left               :       obj.original_left,
                uploader                    :       'true',
                logo_company                :       obj.logo_company,
            });

            // canvas.getActiveObject().remove();
            canvas.remove(obj);
            canvas.add(img);
            canvas.sendToBack(img);
                for(i = 0; i < _index; i++)
                {
                    canvas.bringForward(img);
                }
            canvas.renderAll();
            $('#editor-cropperModal').modal('hide');
            // $('#editor-cropperModal').addClass('hide');
            // img.scaleX = obj.scaleX * that.zoom /100;
        });
    };

    this.uploadImage = function(source, _activeObjID,btn_id,_name){
        // proFabric.set.setActiveobjByID(_activeObjID)
        var obj;
        proFabric.canvas.forEachObject(function(object) {
            if (object.id == _activeObjID) {
                obj = object;
            }
            else if(object.id == btn_id)
            {
                canvas.remove(object);
            }
        });
        var _index  = canvas.getObjects().indexOf(obj); 
        fabric.Image.fromURL(source, function(img) {

            img.set({
                label                       :       obj.label,
                class                       :       obj.class,
                id                          :       obj.id,
                formordering                :       obj.formordering,
                type                        :       obj.type,
                originX                     :       obj.originX,
                originY                     :       obj.originY,
                left                        :       obj.left,
                top                         :       obj.top,
                width                       :       obj.width,
                height                      :       obj.height,
                fill                        :       obj.fill,
                stroke                      :       obj.stroke,
                strokeWidth                 :       obj.strokeWidth,
                strokeDashArray             :       obj.strokeDashArray,
                strokeLineCap               :       obj.strokeLineCap,
                strokeLineJoin              :       obj.strokeLineJoin,
                strokeMiterLimit            :       obj.strokeMiterLimit,
                scaleX                      :       obj.scaleX,
                scaleY                      :       obj.scaleY,
                angle                       :       obj.angle,
                flipX                       :       obj.flipX,
                flipY                       :       obj.flipY,
                opacity                     :       obj.opacity,
                shadow                      :       obj.shadow,
                visible                     :       obj.visible,
                clipTo                      :       obj.clipTo,
                backgroundColor             :       obj.backgroundColor,
                fillRule                    :       obj.fillRule,
                globalCompositeOperation    :       obj.globalCompositeOperation,
                page_id                     :       obj.page_id,
                inputfield                  :       obj.inputfield,
                evented                     :       obj.evented,
                selectable                  :       true,
                src                         :       source,
                filters                     :       obj.filters,
                crossOrigin                 :       obj.crossOrigin,
                alignX                      :       obj.alignX,
                alignY                      :       obj.alignY,
                meetOrSlice                 :       obj.meetOrSlice,
                upload                      :       obj.upload,
                imagelist                   :       obj.imagelist,
                lockMovementX               :       obj.lockMovementX,
                lockMovementY               :       obj.lockMovementY,
                lockRotation                :       obj.lockRotation,
                lockScalingX                :       obj.lockScalingX,
                lockScalingY                :       obj.lockScalingY,
                hasControls                 :       obj.hasControls,
                borderColor                 :       obj.borderColor,
                hoverCursor                 :       obj.hoverCursor,
                showincanvas                :       obj.showincanvas,
                original_scaleX             :       obj.original_scaleX,
                original_scaleY             :       obj.original_scaleX,
                original_top                :       obj.original_top,
                original_left               :       obj.original_left,
                name                        :       _name,
                uploader                    :       'true',
                logo_company                :       obj.logo_company,

            });

            obj.remove();
            canvas.add(img);
            canvas.sendToBack(img);
                for(i = 0; i < _index; i++)
                {
                    canvas.bringForward(img);
                }
            canvas.renderAll();
            // $('#editor-cropperModal').modal('hide');
            // $('#editor-cropperModal').addClass('hide');
            // img.scaleX = obj.scaleX * that.zoom /100;
        });
    };
    
    this.getEditImg=function(source){
        var obj = that.canvas.getActiveObject();
        if(obj.orignalSource)
            return obj.orignalSource;
        else {
            obj.orignalSource = obj.src;
            return obj.src;
        }
    };
    this.newImg = function(newObj){
        var dataURL;
        var obj = that.canvas.getActiveObject();
        var before = obj.toJSON(['id','class']);
        var _width = obj.width;
        var _height = obj.height;
        TempCanvas = new fabric.Canvas(fabric.util.createCanvasElement());
        TempCanvas.setWidth(newObj.imgWidth);
        TempCanvas.setHeight(newObj.imgHeight);
        fabric.Image.fromURL(newObj.src, function(img) {
            TempCanvas.add(img);
            TempCanvas.renderAll();
            dataURL = TempCanvas.toDataURL({
                format: 'png',
                left: newObj.x,
                top: newObj.y,
                width: newObj.width,
                height: newObj.height
            });
            var ImageObj = new Image();
            ImageObj.onload = function() {
                image = new fabric.Image(ImageObj);
                image.top = obj.top;
                image.left = obj.left;
                image.width = _width;
                image.height = _height;
                image.src = dataURL;
                image.orignalSource = obj.orignalSource;
                //image.original_src = obj.original_src;
                image.angle = obj.angle;
                image.id = obj.id;
                image.class = "image";
                image.set({
                    original_scaleX: newObj.scaleX,
                    original_scaleY: newObj.scaleX,
                    lockMovementX: true,
                    lockMovementY: true,
                    lockRotation: true,
                    lockScalingX: true,
                    lockScalingY: true,
                    hasControls: false
                });
                that.canvas.add(image);
                that.canvas.moveTo(image, that.canvas.getObjects().indexOf(obj));
                that.canvas.setActiveObject(image);
                that.canvas.fxRemove(obj);
                that.savestate('modified',before,image.toJSON(['id','class']));
                that.canvas.renderAll();
            }
            ImageObj.src = dataURL;
        });
    };
    this.getcolorObjects = function(){
        var lenght = that.canvas._objects.length;
        for(var i = 0 ; i < lenght ; i++) {
            that.canvas._objects[i].selectable = true;
            if(that.canvas._objects[i].class=="color")
            {
                //console.log(that.canvas._objects[i]);
            }
        }
    }
    this.selectfalseColor = function (){
        var lenght = that.canvas._objects.length;
        for(var i = 0 ; i < lenght ; i++) {
            if(that.canvas._objects[i].type =="path-group") {
                that.canvas._objects[i].selectable = false;
            }
        }
        that.canvas.renderAll();
    }
    this.undo = function(){
        console.log("-------------------> Undo");
        if(current_state<0)
            return;
        that.canvas.discardActiveObject();
        that.canvas.discardActiveGroup();
        if(current_state > 0){
            current_state--;
            var state=canvas_state;
            obj = state[current_state];
            var action = obj.action;
            if(action == 'background'){
                var color = obj.before;
                $('li#showgrid').removeClass('active');
                that.canvas.backgroundColor = color;
                that.canvas.renderAll();
            }
            if(action == 'modified'){
                var object = obj.before;
                //console.log(object);
                if(object.type != "group"){
                    that.canvas.forEachObject(function(temp){
                        if(temp.id == object.id){
                            that.canvas.remove(temp);
                            setTimeout(function(){
                                that.addObject(object,0,0,1,1);
                            },10);
                        }
                    });
                }
                else{
                    $.each(object.objects,function(index,obj){
                        that.canvas.forEachObject(function(temp){
                            if(temp.id == obj.id){
                                that.canvas.remove(temp);
                                setTimeout(function(){
                                    that.addObject(obj,object.left+object.width/2,object.top+object.height/2,object.scaleX,object.scaleY);
                                },10);
                            }
                        });
                    });
                }
            }
            else if(action == 'add'){
                var object = obj.object;
                that.canvas.forEachObject(function(temp){
                    if(temp.id == object.id){
                        that.canvas.fxRemove(temp);
                    }
                });
            }
            else if(action== 'delete'){
                var object = obj.object;
                if(object.type != "group"){
                    that.addObject(object,0,0,1,1);
                }
                else{
                    $.each(object.objects,function(index,obj){
                        that.addObject(obj,object.left+object.width/2,object.top+object.height/2,object.scaleX,object.scaleY);
                    });
                }
            }
            that.canvas.renderAll();
        }
        else{
            current_state = 0;
        }
    };
    this.redo = function(){
        if(current_state<0)
            return;
        console.log("Redo start --------------------->");
        console.log(canvas_state[current_state]);
        console.log(current_state);
        console.log(canvas_state);
        that.canvas.discardActiveObject();
        that.canvas.discardActiveGroup();
        if((current_state < canvas_state.length)){
            var state=canvas_state;
            var obj = state[current_state];
            var action = obj.action;
            if(action == 'background'){
                //$('li#showgrid').removeClass('active');
                var color = obj.after;
                that.canvas.backgroundColor = color;
                that.canvas.renderAll();
            }
            if(action == 'modified'){
                var object = obj.after;
                if(object.type != "group"){
                    that.canvas.forEachObject(function(temp){
                        if(temp.id == object.id){
                            console.log("Called->",object);
                            that.canvas.remove(temp);
                            setTimeout(function(){
                                that.addObject(object,0,0,1,1);
                            },10);
                        }
                    });
                }
                else{
                    $.each(object.objects,function(index,obj){
                        that.canvas.forEachObject(function(temp){
                            if(temp.id == obj.id){
                                that.canvas.remove(temp);
                                setTimeout(function(){
                                    that.addObject(obj,object.left+object.width/2,object.top+object.height/2,object.scaleX,object.scaleY);
                                },10);
                            }
                        });
                    });
                }
            }
            else if(action == 'add'){
                var object = obj.object;
                if(object.type != "group"){
                    that.addObject(object,0,0,1,1);
                }
                else{
                    $.each(object.objects,function(index,obj){
                        that.addObject(obj,object.left+object.width/2,object.top+object.height/2,object.scaleX,object.scaleY);
                    });
                }
            }
            else if(action=="delete"){
                var object = obj.object;
                if(object.type != "group"){
                    that.canvas.forEachObject(function(temp){
                        if(temp.id == object.id){
                            that.canvas.fxRemove(temp);
                        }
                    });
                }
                else{
                    $.each(object.objects,function(index,obj){
                        that.canvas.forEachObject(function(temp){
                            if(temp.id == obj.id){
                                that.canvas.fxRemove(temp);
                            }
                        });
                    }); 
                }
            }
            that.canvas.renderAll();
            current_state++;
        }
    };
    this.disableImgOpts = function(){
        $("#Up-imageUpload").attr("disabled", "disabled");
        $("#modal-click").attr("disabled", "disabled");
    };
    this.enableImgOpts = function(){
        $("#Up-imageUpload").removeAttr("disabled");
        $("#modal-click").removeAttr("disabled");
    };
    this.savestate = function(type,object,object1){
        var obj = {
            action:type,
            object:object,
            before:object,
            after:object1
        };
        canvas_state.splice(current_state,0,obj);
        current_state++;
    };
    this.addObject = function(obj,offsetLeft,offsetTop,scaleX,scaleY) {
        console.log(obj);
        if (!obj) return;
        if (obj.class == "text"){
            text = new fabric.Textbox(obj.text, {
                fontSize: obj.fontSize,
                fontFamily: obj.fontFamily,
                fill: obj.fill,
                class:obj.class,
                textDecoration:obj.textDecoration,
                fontStyle:obj.fontStyle,
                fontWeight:obj.fontWeight,
                originX: obj.originX,
                originY: obj.originY,
                id:obj.id,
                alignment:obj.alignment,
                angle:obj.angle,
                textAlign:obj.textAlign,
                index:obj.index
            });
            text.set({
                left:obj.left+offsetLeft,
                top:obj.top+offsetTop,
                scaleY:obj.scaleY*scaleY,
                scaleX:obj.scaleX*scaleX,
                width:obj.width,
                height:obj.height,
                lockMovementX     : true,
                lockMovementY     : true,
                lockRotation      : true,
                lockScalingX      : true,
                lockScalingY      : true,
                hasControls       : false
            });
            if(obj.shadow)
            {
                text.setShadow({
                    blur: obj.shadow.blur,
                    color: obj.shadow.color,
                    offsetX: obj.shadow.offsetX,
                    offsetY: obj.shadow.offsetY
                });
            }
            if(obj.stroke)
            {
                text.set({
                    stroke:obj.stroke,
                    strokeWidth : obj.strokeWidth
                });
            }
            text.on('editing:entered', function(obj) {
                $("textarea#text_area").val(text.text);
            });
            text.on('editing:exited', function(obj) {
                $("textarea#text_area").val(text.text);
            });
            that.canvas.add(text);
            that.canvas.renderAll();
        }
        
        else if(obj.type == "image"){

                var source = obj.src;
                var top = obj.top;
                var left = obj.left;
                var _width = obj.width;
                var _height = obj.height;
                var _original_scaleX = obj.original_scaleX;
                var _original_scaleY = obj.original_scaleY;
                var _original_left =  obj.original_left;
                var _original_top =  obj.original_top;
                that.canvas.fxRemove(obj);
                that.canvas.renderAll();
                

        }
        else if(obj.type == "group"){
            var source = obj.src;
                var top = obj.top;
                var left = obj.left;
                var _width = obj.width;
                var _height = obj.height;
                var _original_scaleX = obj.original_scaleX;
                var _original_scaleY = obj.original_scaleY;
                var _original_left =  obj.original_left;
                var _original_top =  obj.original_top;
                that.canvas.fxRemove(obj);
                that.canvas.renderAll();
                console.log(source);
                console.log(top);
                console.log(left);
                console.log(_width);
                console.log(_height);
                console.log(_original_scaleX);
                console.log(_original_scaleY);
                console.log(_original_left);
                console.log(_original_top);
            alert();
        }
    }



     WebFontConfig = {
        google: { families: 
            [ 
                'Ribeye::latin','Lora','Croissant+One','Graduate','Oswald','Oxygen','Courgette','Ranchers','Bangers','Audiowide',
                'Sacramento','Lobster','Pacifico','Open Sans','Roboto','Lato','Oswald','Lora','Source Sans Pro',
                'Montserrat','Raleway','Ubuntu','Droid Serif','Merriweather','Indie Flower','Titillium Web',
                'Poiret One','Oxygen','Yanone Kaffeesatz','Lobster','Playfair Display','Fjalla One','Inconsolata',
                'Droid Sans','Droid Serif','helsinki'
            ]}
      };
    
    (function() {
        var src = ('https:' === document.location.protocol ? 'https' : 'http') +
            '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
        
        $.getScript(src, function(data) {      
            proFabric.canvas.renderAll();
        });
    })();
};
