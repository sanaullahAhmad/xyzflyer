proFabric;
var _pickerFlag = 0;
var _selectionflag=0;
var _pickerFlag = 0;
var _selectionflag=0;
var _img_num=1;
var undo_redo_tmp_obj=[],canvas_state = new Array(), current_state=0;
var ShapeID = 0;
var proFabric = new function(){
    var that = this; // refrence for proFabric
    this.canvasWidth = 510;
    this.canvasHeight = 650;
    this.zoom = 100, this.defaultZoom = 100;
    var modifiedCheck = true;
    var modifiedType = "";

    fabric.Object.prototype.toObject = (function (toObject) {
        return function () {
            return fabric.util.object.extend(toObject.call(this), {
                id: this.id,
                type: this.type,
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
                name: this.name,
                padding: this.padding,
                index: this.index,
                width: this.width,
                height: this.height,
                scaleY: this.scaleY,
                scaleX: this.scaleX,
                lineHeight: this.lineHeight,
                uploader:this.uploader,
                firstTimeUpload:this.firstTimeUpload,
                maxfontSize:this.maxfontSize,
                logo_company:this.logo_company,
            });
        };
    })(fabric.Object.prototype.toObject);

    this.canvas = new fabric.Canvas('myCanvas',{backgroundColor:'#fff'});
    this.canvas.setWidth(this.canvasWidth);
    this.canvas.setHeight(this.canvasHeight);
    
    this.canvas.on('mouse:down', function(o){
        if(_pickerFlag==1) {

            // get the current mouse position
            var ctx = that.canvas.getContext("2d");
            var mouse = that.canvas.getPointer(o.e,'ignoreZoom');
            console.log('o = '+o);
            mousePercentX = mouse.x * 0.33;
            mousePercentY = mouse.y * 0.33;
            console.log('mousePercentX = '+mousePercentX);
            var x = mouse.x + mousePercentX;
            var y = mouse.y + mousePercentY;
            // get the color array for the pixel under the mouse
            var px = ctx.getImageData(x, y, 1, 1).data;
            var rgb_val = px[0] + ':' + px[1] + ':' + px[2] + ':' + px[3];
            // report that pixel data
            _pickerFlag = 0;
            that.canvas.hoverCursor = 'move';
            proFabric.setCursor('default');
            var rgba = 'rgba(' + px[0] + ',' + px[1] + ',' + px[2] + ',' + px[3] + ')';
            var hex = proFabric.rgb2hex( rgba );
            console.log(hex);
            //$('#picker').colpickSetColor(hex);
            var button = $('#editor-cpicker.btn-primary');
            if(button){
                proFabric.enableSelection();
                // that.canvas.setCursor("default");
                // $('div.canvas-container, canvas').css('cursor', 'pointer');
                // that.set.setActiveobj($(button).closest('.colorRow').attr('data-id'));
                $(button).removeClass('btn-primary');
                var type = $(button).attr('data-type');
                // var el = $('.colorpicker[data-type='+type+']');
                // $(el).css('backgroundColor',hex);
                // var hexHash = hex.split('#')[1];
                // colorPickerSubmit('', hexHash, '', el);

                _id = $(button).closest('.colorRow').attr('data-id');
                proFabric.set.setActiveobj(_id);
                $(button).closest('.colorRow').find('#svg_color_btn').css('background-color',hex);
                $(button).closest('.colorRow').find('.svg_selected_clr').children('span').html(hex);
                $(button).closest('.colorRow').find('.svg_selected_clr').children('.btn').css('background-color',hex);
                proFabric.color.fill(_id, hex);
                that.canvas.renderAll();

            }
        }
    });


    //this.canvas.on('mouse:move', function(o){});
    this.canvas.on('object:remove', function(o){
        var object = o.target;
    });
   
    //this.canvas.on('mouse:up', function(o){});
    this.canvas.on('mouse:up', function(o) {
        object = o.target;
        if(object && modifiedType != ""){
            modifiedCheck = true;
            modifiedType = "";
            //proFabric.savestate('modified',prevObject,object.toJSON(['src','id','class','index','alignment']));
        }
    });
    this.canvas.on('selection:cleared', function(o){

        // var object = o.target;
        // if(!object){
        //     proFabric.text.updateUI('');
        //     proFabric.image.updateUI('');
        //     proFabric.shapes.shapeSelected('');
        //     proFabric.color.colorSelected('');
        // }
        $('.clr-pallete-picker').attr('disabled','disabled');
        $("#propertyinfo button").removeClass("btn-primary");
        /*$('button.editor-textAssign').each(function(i,el){
            if($(el).attr('data-id'))
            {
                $(el).removeClass('btn-primary').addClass('btn-success');
            }
        }); */
    });
    this.canvas.on('selection:created', function(o){});
    this.canvas.on('object:added', function(o){
        // $('#lockAll').removeClass().addClass('btn btn-danger').text('Lock Everything');
    });
    
    this.canvas.observe('object:scaling', function(o){
        var object = o.target;
        if(object.class=="text"){
            that.text.updateUI(object,(that.zoom/100));
        }
        else if(object.class == 'image'){
            that.image.updateUI(object,(that.zoom/100));
        }
        else if(object.class=='shape'){
            proFabric.shapes.shapeSelected(object);
        }
        else if(object.class=='color'){
            proFabric.color.colorSelected(object,(that.zoom/100));
        }
        if(modifiedCheck){
            prevObject = object.toJSON(['src','id','class','index','alignment']);
            modifiedCheck = false;
            modifiedType = "scale";
            
        }
    });

    this.canvas.on('object:modified', function(o){
        var object = o.target;
            
        if(object.class == 'image'){
            that.image.updateUI(object,(that.zoom/100));
        }
        else if(object.class=='color'){
            proFabric.color.colorSelected(object,(that.zoom/100));
        }
        
        if(modifiedCheck){
            prevObject = object.toJSON(['src','id','class','index','alignment']);
            modifiedCheck = false;
            modifiedType = "scale";
            
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

    this.canvas.on('object:rotating', function(o){
        var obj = o.target;
        if(modifiedCheck){
            //object.angle = 0;
            prevObject = obj.toJSON(['src','id','class','index','alignment']);
            modifiedCheck = false;
            modifiedType = "rotate";
        }

        if(object){
            object.set({
                original_scaleX : object.scaleX / (that.zoom/100),
                original_scaleY : object.scaleY / (that.zoom/100),
                original_left  : object.left / (that.zoom/100),
                original_top   : object.top / (that.zoom/100)
            });
        }
        if(obj.angle>=350 || obj.angle<=10){
            obj.angle=0;
        }
        else if(obj.angle>=80 && obj.angle<=100){
            obj.angle=90;
        }
        else if(obj.angle>=260 && obj.angle<=280){
            obj.angle=270;
        }
        else if(obj.angle>=170 && obj.angle<=190){
            obj.angle=180;
        }
        console.log(obj.angle);
    });

    this.canvas.on('object:moving', function(o){
        var object = o.target;
            
        if(object.class == 'image'){
            that.image.updateUI(object,(that.zoom/100));
        }

        if(modifiedCheck){
            prevObject = object.toJSON(['src','id','class','index','alignment']);
            modifiedCheck = false;
            modifiedType = "move";
        }
        if(object){
            object.set({
                original_scaleX : object.scaleX / (that.zoom/100),
                original_scaleY : object.scaleY / (that.zoom/100),
                original_left   : object.left / (that.zoom/100),
                original_top    : object.top / (that.zoom/100)
            });
        }
        if($("#GridRT").is(':checked') && _gridFlag==1)
            {
                options.target.set({
                left: Math.round(options.target.left / _gridSize) * _gridSize,
                top: Math.round(options.target.top / _gridSize) * _gridSize
              });
            }
    });

    this.canvas.on('object:selected', function(o){
        var object = o.target;
        console.log(object);
        console.log("id&clasas ::: "+object.id+":---:"+object.class);
        if(object.class=="text"){
            $('#editor-mainTabs a[href="#text"]').tab('show');
            that.text.updateUI(object,(that.zoom/100));
            $('#text_color_btn').removeAttr('disabled').css('backgroundColor',object.fill);
            $('.text_selected_clr .btn').css('background-color',object.fill);
            $('#editor-maxfontSize').val(object.maxfontSize); 
            if(object.fill.charAt(0) != '#'){
                $('.text_selected_clr span').text(proFabric.rgb2hex(object.fill));
            }
            else{
                $('.text_selected_clr span').text(object.fill);
            }

        }
        else if(object.class == 'image'){
            $('#img_color_btn').removeAttr('disabled').css('backgroundColor',object.stroke);
            $('#editor-mainTabs a[href="#image"]').tab('show');
            that.image.updateUI(object,(that.zoom/100));
            if(object.lockMovementX == false){
                $('#lock-img').removeClass('btn-primary');
                $('#lock-img').removeClass('btn-primary');
                $('#unlock-img').removeClass('btn-default');
                $('#unlock-img').addClass('btn-primary');
                $('#lock-img').removeClass('btn-default');
            }
            else{
                $('#unlock-img').removeClass('btn-primary');
                $('#unlock-img').removeClass('btn-primary');
                $('#lock-img').removeClass('btn-default');
                $('#lock-img').addClass('btn-primary');
                $('#unlock-img').removeClass('btn-default');
            }
        }
        else if(object.class=='shape'){
            $('#editor-mainTabs a[href="#object"]').tab('show');
            proFabric.shapes.shapeSelected(object);
        }
        else if(object.class=='color'){
            // alert('object selected ScaleX '+object.scaleX);
            $('#editor-mainTabs a[href="#color"]').tab('show');
            proFabric.color.colorSelected(object,(that.zoom/100));
            if(object.lockMovementX == false){
                $('#lock-svg').removeClass('btn-primary');
                $('#lock-svg').removeClass('btn-primary');
                $('#unlock-svg').removeClass('btn-default');
                $('#unlock-svg').addClass('btn-primary');
                $('#lock-svg').removeClass('btn-default');
                $("#myRange").val(object.opacity * 100);
            }
            else{
                $('#unlock-svg').removeClass('btn-primary');
                $('#unlock-svg').removeClass('btn-primary');
                $('#lock-svg').removeClass('btn-default');
                $('#lock-svg').addClass('btn-primary');
                $('#unlock-svg').removeClass('btn-default');
            }
        }
        // console.log(object);
        var dataId=object.class;
        $("#tabs li" ).each(function() {
            if($(this).data('id')==object.class){
                $(this).trigger('click');
                //console.log($(this).data('id'));
                /*$(this).siblings('li').removeClass('.ui-tabs-active ui-state-active');
                $(this).addClass('.ui-tabs-active ui-state-active');*/
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
    this.canvas.on('mouse:move', function(e) {
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
            //alert(that.canvas.getActiveObject());
            return that.canvas.getActiveObject();
        },
        currentGroup : function(){
            return that.canvas.getActiveGroup();
        },
        zoom : function(){
            return that.zoom;
        },
        guid : function() {
            return 'xxxxxx-xxxx-xxxxxx'.replace(/[xy]/g, function (c) {
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
        lockMovementXText : function(){
            var _obj = that.canvas.getActiveObject();
            return _obj.lockMovementX;
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
                    console.log("Here Locked !! ------- "+obj.lockMovementX);
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
                    console.log("Here Un-Locked !! ------ "+obj.lockMovementX);
                }
                that.canvas.renderAll();
            }
            else{
                if (obj.lockMovementX == false) {
                    obj.set({
                        lockMovementX: true,
                        lockMovementY: true,
                        lockRotation: true,
                        lockScalingX: true,
                        lockScalingY: true
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
                //console.log('ID Assigning : ' + id);
                //console.log("Here");
                var obj = that.canvas.getActiveObject();
                if (obj&&obj.class=='text') {
                    if(!obj.btnID)
                    {
                        obj.btnID = id;
                        $(id).addClass('ui-state-active');
                        $(id).addClass('ui-widget-content');
                        //alert("Assigning ID");
                    }
                    else if(id == obj.btnID)
                    {
                        //alert('FLAG : '+_txtSelectionFlag);
                        if(_selectionflag==1&&_txtSelectionFlag==1) {
                            obj.btnID = "";
                            that.canvas.setActiveObject(obj);
                            $(id).removeClass('ui-state-active');
                            $(id).removeClass('ui-widget-content');
                            //alert("id already assigned to button . . . . Un-selecting and removing ID");
                            _txtSelectionFlag=0;
                        }
                        _txtSelectionFlag = 1;
                    }
                    else
                    {
                        console.log("id already assigned to button");
                    }
                    selectionflag = 0;
                    //console.log("Here2");
                    //console.log(obj);
                }
            }
        },
        canvas_size: function(w, h) {
            that.canvas.setWidth(w || that.canvas.getWidth());
            that.canvas.setHeight(h || that.canvas.getHeight());
            this.width(w || that.canvas.getWidth());
            this.height(h || that.canvas.getHeight())
            that.canvas.renderAll();
        },
        setActiveobj:function(id){
            that.canvas.forEachObject(function(obj) {
                if (obj.id == id) {
                    console.log(obj);
                    that.canvas.setActiveObject(obj, '');
                }
            });
            that.canvas.renderAll();
        }
    },
    this.export = {
        svg : function(){
        },
        base64 : function(){
            that.deselectCanvas();
            return that.canvas.toDataURL({
                format: 'png'
            });
        },
        json : function(){
            // return that.canvas.toObject(['id','original_scaleX','original_scaleY','original_left','original_top','class','index','lockMovementX','lockMovementY','lockScalingX','lockScalingY','lockRotation','width','height','scaleY','scaleX','lineHeight','padding']);
            return that.canvas.toDatalessJSON(['maxfontSize','id','logo_company','original_scaleX','original_scaleY','original_left','original_top','class','index','lockMovementX','lockMovementY','lockScalingX','lockScalingY','lockRotation','width','height','scaleY','scaleX','lineHeight','padding']);
        }
    };
    this.import = {
        svg : function(svg){
        },
        json : function(json){
        }
    };

    this.createDataLessJSON = function(){
        jsn = that.canvas.toDatalessJSON();
        console.log(jsn);
        return jsn;
    }

    this.move = {
        up : function(){
            var obj = that.canvas.getActiveObject();
            if(!obj || obj.lockMovementY) return;
            obj.set({
                top : (obj.top-1)
            });
            that.canvas.renderAll();
        },
        down : function(){
            var obj = that.canvas.getActiveObject();
            if(!obj || obj.lockMovementY) return;
            obj.set({
                top : (obj.top+1)
            });
            that.canvas.renderAll();
        },
        left : function(){
            var obj = that.canvas.getActiveObject();
            if(!obj || obj.lockMovementX) return;
            obj.set({
                left : (obj.left-1)
            });
            that.canvas.renderAll();
        },
        right : function(){
            var obj = that.canvas.getActiveObject();
            if(!obj || obj.lockMovementX) return;
            obj.set({
                left : (obj.left+1)
            });
            that.canvas.renderAll();
        }
    };
    this.randBtnSelection = function(id) {
        that.canvas.forEachObject(function(obj){
            console.log(obj+"  ::  "+id);
            if (obj.btnID) {
                console.log(obj.btnID);
                if (id == obj.btnID) {
                    console.log('Selected');
                    that.canvas.setActiveObject(obj);
                    _selectionflag = 1;
                    if(_txtSelectionFlag==1)
                    _txtSelectionFlag = 0;
                    else
                        _txtSelectionFlag=1;
                    return;
                }
            }
            console.log(">>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> HERE WE ARE");
        });
    };

    this.duplicate = function(){
        var ActiveObj = that.canvas.getActiveObject();
        if(ActiveObj)
        {
            console.log("ActiveObj.fill : "+ActiveObj.fill);
            console.log("ActiveObj.color : "+ActiveObj.color);
            //var col = this.rgb2hex(ActiveObj.fill);
            var col = ActiveObj.fill;
            console.log("col : "+col);
            _id= Math.random().toString(36).substr(2,5);
            var copyData = ActiveObj.toObject();
            fabric.util.enlivenObjects([copyData], function(objects) {
              objects.forEach(function(o) {
                o.set('top', o.top + 15);
                o.set('left', o.left + 15);
                o.set('id', _id);
                o.set('fill', col);
                o.set('color', col);
                o.set('stroke', col);
                o.class = ActiveObj.class;
                o.paths.forEach(function(path) {path.fill = col});
                that.canvas.discardActiveObject(ActiveObj);
                that.canvas.add(o);
                that.canvas.setActiveObject(o);
                console.log("o.fill : "+o.fill);
                console.log("o : "+o.color);
                console.log(ActiveObj);
                console.log(o);
                o.setFill(ActiveObj.fill);
                console.log(">>>>>ActiveObj.fill :: "+ActiveObj.fill)
                o.set({
                    fill : ActiveObj.fill
                });
              });
              that.canvas.renderAll();
            });
            // ShapeID = ShapeID + 1;
            // var object = fabric.util.object.clone(ActiveObj);
            // object.set("top", ActiveObj.top+10);
            // object.set("left", ActiveObj.left+10);
            // object.id = _id;
                previousColor = [];
            $('#cs-tabContent').children('.tab-pane').each(function(index, el) {
                var rowcolors = [];
                $(el).children('.colorRow').each(function(i, element) {
                    rowcolors.push($(element).find('div.evo-pointer').css("backgroundColor"));
                });
                previousColor.push({id:$(el).attr('id'), colors:rowcolors});
            });
            // that.canvas.discardActiveObject(ActiveObj);
            // that.canvas.add(object);
            // that.canvas.setActiveObject(object);
            // that.canvas.renderAll();
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
            // console.log(this.get.guid()+":::::"+_id);
        }
        else
            console.log("Here");
    };

    this.deleteObj = function(obj){
        that.canvas.fxRemove(obj);
        that.canvas.renderAll();
    }
    this.duplicate2 = function(){
        var object = fabric.util.object.clone(that.canvas.getActiveObject());
        object.set("top", object.top+10);
        object.set("left", object.left+10);
        that.canvas.discardActiveObject(that.canvas.getActiveObject());
        //that.canvas.setActiveObject(object)
        //that.canvas.add(object);
        _id = proFabric.get.guid(),
            previousColor = [];
        $('#cs-tabContent').children('.tab-pane').each(function(index, el) {
            var rowcolors = [];
            $(el).children('.colorRow').each(function(i, element) {
                rowcolors.push($(element).find('div.evo-pointer').css("backgroundColor"));
            });
            previousColor.push({id:$(el).attr('id'), colors:rowcolors});
        });
        proFabric.color.add(object.src, {
            id : _id,
            top : object.top,
            left : object.left,
            fill: object.fill,
            height: object.height,
            width: object.width,
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

    };

    this.duplicate3 = function(){
        var ActiveObj = that.canvas.getActiveObject();
        if(ActiveObj)
        {
            // ShapeID = ShapeID + 1;
            var object = fabric.util.object.clone(ActiveObj);
            object.set("top", ActiveObj.top+10);
            object.set("left", ActiveObj.left+10);
           _id= Math.random().toString(36).substr(2,5);
            object.id = _id;
                previousColor = [];
            $('#cs-tabContent').children('.tab-pane').each(function(index, el) {
                var rowcolors = [];
                $(el).children('.colorRow').each(function(i, element) {
                    rowcolors.push($(element).find('div.evo-pointer').css("backgroundColor"));
                });
                previousColor.push({id:$(el).attr('id'), colors:rowcolors});
            });
            that.canvas.discardActiveObject(ActiveObj);
            that.canvas.add(object);
            that.canvas.setActiveObject(object);
            that.canvas.renderAll();
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
        else
            console.log("Here");
    };


    this.rgb2hex=function (rgb){
        rgb = rgb.match(/^rgba?[\s+]?\([\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?/i);
        return (rgb && rgb.length === 4) ? "#" +
        ("0" + parseInt(rgb[1],10).toString(16)).slice(-2) +
        ("0" + parseInt(rgb[2],10).toString(16)).slice(-2) +
        ("0" + parseInt(rgb[3],10).toString(16)).slice(-2) : '';
    };



    this.deselectCanvas =function(){
        that.canvas.discardActiveObject();
        that.canvas.discardActiveGroup()
    };
    this.zoomcanvas = function(zoom){
        console.log(zoom);
        this.zoom = zoom;
        this.canvas.forEachObject(function(obj){
            /*if(obj.type === 'group'){
                obj.saveState();
                var groupobj = obj['_objects'];
                for(i=0; i<groupobj.length; i++){
                    var objct = groupobj[i],
                    scale_X= typeof objct.original_scaleX === "undefined" ? objct.scaleX : objct.original_scaleX,
                    scale_Y= typeof objct.original_scaleY === "undefined" ? objct.scaleY : objct.original_scaleY,
                    left   = typeof objct.original_left === "undefined"   ? objct.left   : objct.original_left,
                    top    = typeof objct.original_top === "undefined"    ? objct.top    : objct.original_top;
                    // alert(' if scale_X '+scale_X );
                    objct.scaleX = scale_X * (zoom/100);
                    objct.scaleY = scale_Y * (zoom/100);
                    objct.left   = left   * (zoom/100);
                    objct.top    = top    * (zoom/100);
                    objct.setCoords();
                }
                obj.saveCoords().setObjectsCoords();
            }*/
            /*else{*/
                var scale_X= typeof obj.original_scaleX === "undefined" ? obj.scaleX : obj.original_scaleX,
                scale_Y    = typeof obj.original_scaleY === "undefined" ? obj.scaleY : obj.original_scaleY,
                left       = typeof obj.original_left === "undefined"   ? obj.left   : obj.original_left,
                top        = typeof obj.original_top === "undefined"    ? obj.top    : obj.original_top;

                // alert(' else scale_X '+scale_X +" scaleY "+scale_Y);

                obj.original_scaleX = typeof obj.original_scaleX === "undefined" ? obj.scaleX : obj.original_scaleX;
                obj.original_scaleY = typeof obj.original_scaleY === "undefined" ? obj.scaleY : obj.original_scaleY;
                obj.original_left   = typeof obj.original_left === "undefined"   ? obj.left   : obj.original_left;
                obj.original_top    = typeof obj.original_top === "undefined"    ? obj.top    : obj.original_top;

                obj.scaleX = scale_X * (zoom/100);
                obj.scaleY = scale_Y * (zoom/100);
                obj.left   = left   * (zoom/100);
                obj.top    = top    * (zoom/100);
            // }
            obj.setCoords();
        });
        console.log(this.canvasWidth, this.canvasHeight)
        this.canvas.setWidth(this.canvasWidth * (zoom/100)).setHeight(this.canvasHeight * (zoom/100));
        this.canvas.renderAll();
        proFabric.updateBackgroundImage();
    };

    this.updateBackgroundImage = function(){
        if(that.canvas.backgroundImage == null)
            return;
        that.canvas.setBackgroundImage(that.canvas.backgroundImage, that.canvas.renderAll.bind(that.canvas), {
            originX: 'left',
            originY: 'top',
            left: 0,
            top: 0,
            width: that.canvas.width,
            height: that.canvas.height,
                // opacity: _op
            });
    }

    this.getCanvasPixelData = function(x, y) {
        var ctx = that.canvas.getContext('2d');
        var pixel = ctx.getImageData(x, y, that.canvasWidth, that.canvasHeight);
        var data = pixel.data;
        return 'rgba(' + data[0] + ',' + data[1] + ',' + data[2] + ',' + data[3] + ')';
    };
    this.delete = function() {
        var o = that.canvas.getActiveObject();
        if(o){
            that.canvas.remove(o);
            console.log("Single Object");
        }
        else 
        {
            o = that.canvas.getActiveObject();
            if(o)
            {
                var len = o._objects.length;
                console.log(len+" : len");
                for(var i = 0 ; i < len ; i++) {
                        console.log(o._objects[i]);
                        this.canvas.fxRemove(o._objects[i]);
                    }
                console.log("Multiple Objects");
                this.canvas.discardActiveGroup();
                this.canvas.renderAll();
            }
            else
                console.log("Here");
            
        }
        this.canvas.renderAll();
    };
    this.droper = function(){
        // that.canvas.setCursor("crosshair");
        proFabric.setCursor('pointer');
        that.canvas.hoverCursor = 'pointer';
        $('div.canvas-container canvas').css('cursor', 'pointer');
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
        console.log(that.canvas);
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
    this.setCursor = function(cursorType) {
        if (cursorType == 'move') {
            that.canvas.defaultCursor = 'move';
        } else if (cursorType == 'pointer') {
            that.canvas.defaultCursor = 'pointer'; // this doesn't work
        }
        else if (cursorType == 'default') {
            that.canvas.defaultCursor = 'default'; // this doesn't work
        }
    }

    this.lockEverything = function(){
        var obj = that.canvas.getObjects();
        for (var i = 0; i < obj.length; i++) {
            obj[i].set({
                lockScalingX:true,
                lockScalingY:true,
                lockMovementX:true,
                lockMovementY:true,
                lockRotation:true,
            });
        };
        that.canvas.renderAll();
    };

    this.removeGrid = function() {
        this.canvas.forEachObject(function(obj) {
            if (obj.class == "grid") {
                obj.remove();
            }
        });
    };
_gridSize = 50;
    this.makeGridBack = function () {
        this.removeGrid();
        var canvasWidth = this.canvas.width;
        var LoopLengthX = canvasWidth/_gridSize;
        var canvasHeight = this.canvas.height;
        var LoopLengthY = canvasHeight/_gridSize;

        console.log('Grid Start');
        for (var i = 0; i < LoopLengthY; i++) {
            var hLine = new fabric.Line([ i * _gridSize, 0, i * _gridSize, canvasHeight], { stroke: '#ccc', selectable: false, class:'grid' });
            this.canvas.add(hLine);
            hLine.sendToBack();
            var vLine = new fabric.Line([ 0, i * _gridSize, canvasHeight, i * _gridSize], { stroke: '#ccc', selectable: false, class:'grid' });
            this.canvas.add(vLine);
            vLine.sendToBack();
        }

        console.log('Grid End');
        this.canvas.renderAll();
    };

    this.makeGridFront = function () {
        this.removeGrid();
        var canvasWidth = this.canvas.width;
        var LoopLengthX = canvasWidth/_gridSize;
        var canvasHeight = this.canvas.height;
        var LoopLengthY = canvasHeight/_gridSize;

        console.log('Grid Start');
        for (var i = 0; i < LoopLengthY; i++) {
            var hLine = new fabric.Line([ i * _gridSize, 0, i * _gridSize, canvasHeight], { stroke: '#ccc', selectable: false, class:'grid' });
            this.canvas.add(hLine);
            hLine.bringToFront();
            var vLine = new fabric.Line([ 0, i * _gridSize, canvasHeight, i * _gridSize], { stroke: '#ccc', selectable: false, class:'grid' });
            this.canvas.add(vLine);
            vLine.bringToFront();
        }
        console.log('Grid End');
        this.canvas.renderAll();
    };

    this.unlockEverything = function(){
        var obj = that.canvas.getObjects();
        for (var i = 0; i < obj.length; i++) {
            obj[i].set({
                lockScalingX:false,
                lockScalingY:false,
                lockMovementX:false,
                lockMovementY:false,
                lockRotation:false,
            });
        };
            that.canvas.renderAll();
    };

    this.undo = function(){
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
        that.canvas.discardActiveObject();
        that.canvas.discardActiveGroup();
        if((current_state < canvas_state.length)){
            var state=canvas_state;
            var obj = state[current_state];
            var action = obj.action;
            if(action == 'background'){
                var color = obj.after;
                that.canvas.backgroundColor = color;
                that.canvas.renderAll();
            }
            if(action == 'modified'){
                var object = obj.after;
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
                height:obj.height
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
        else if (obj.class == "svg"||obj.class == "shape" || obj.class == "color"){
            var group = [];
            //alert(obj.src);
            fabric.loadSVGFromURL(obj.src, function(objects, options) {
                var loadedObjects = new fabric.util.groupSVGElements(objects, options);
                loadedObjects.src = obj.src;
                loadedObjects.class = obj.class;
                loadedObjects.set({
                    originX: obj.originX,
                    originY: obj.originY,
                    id:obj.id,
                    fill:obj.fill,
                    class: 'svg',
                    top: obj.top+offsetTop,
                    left: obj.left+offsetLeft,
                    scaleX: obj.scaleX*scaleX,
                    scaleY: obj.scaleY*scaleY,
                    opacity:obj.opacity,
                    angle:obj.angle,
                    alignment : obj.alignment,
                    index:obj.index,
                    hasControls : false
                });
                if(obj.paths)
                {
                    if(obj.paths[0].stroke)
                    {
                        $.each(loadedObjects.paths,function(index,value){
                            value.set({
                                stroke: obj.paths[0].stroke
                            });
                        });
                    }
                    if(obj.paths[0].strokeWidth)
                    {
                        $.each(loadedObjects.paths,function(index,value){
                            value.set({
                                strokeWidth:obj.paths[0].strokeWidth
                            });
                        });
                    }
                    if(obj.paths[0].shadow)
                    {
                        $.each(loadedObjects.paths,function(index,value){
                            value.setShadow({
                                blur: obj.paths[0].shadow.blur,
                                color: obj.paths[0].shadow.color,
                                offsetX: obj.paths[0].shadow.offsetX,
                                offsetY: obj.paths[0].shadow.offsetY
                            });
                        });
                    }
                }
                else
                {
                    if(obj.stroke)
                    {
                        $.each(loadedObjects.paths,function(index,value){
                            value.set({
                                stroke: obj.stroke
                            });
                        });
                    }
                    if(obj.strokeWidth)
                    {
                        $.each(loadedObjects.paths,function(index,value){
                            value.set({
                                strokeWidth:obj.strokeWidth
                            });
                        });
                    }
                    if(obj.shadow)
                    {
                        $.each(loadedObjects.paths,function(index,value){
                            value.setShadow({
                                blur: obj.shadow.blur,
                                color: obj.shadow.color,
                                offsetX: obj.shadow.offsetX,
                                offsetY: obj.shadow.offsetY
                            });
                        });
                    }
                }
                that.canvas.add(loadedObjects);
                that.canvas.moveTo(loadedObjects,obj.index);
                that.canvas.renderAll();
            }, function(item, object)
            {
                object.set('id', item.getAttribute('id'));
                group.push(object);
            }, {
                crossOrigin: 'anonymous'
            });
        }
        else if(obj.type == "image"){
            var ImageObj = new Image();
            ImageObj.onload = function() {
                image = new fabric.Image(ImageObj);
                image.top  = obj.top+offsetTop;
                image.left = obj.left+offsetLeft;
                image.width = obj.width;
                image.height = obj.height;
                image.scaleX = obj.scaleX*scaleX;
                image.scaleY = obj.scaleY*scaleY;
                image.src = obj.src;
                image.original_src = obj.original_src;
                image.class="image";
                image.angle = obj.angle;
                image.originX = obj.originX;
                image.originY = obj.originY;
                image.id = obj.id;
                image.alignment = obj.alignment;
                image.index = obj.index;
                that.canvas.add(image);
                that.canvas.moveTo(image,obj.index);
                that.canvas.bringForward(image);
                that.canvas.renderAll();
            }
            ImageObj.src = obj.src;
        }
    }

    this.clearCanvas = function(){
        var canObject = that.canvas.getObjects();
                while(1){
                    for(var i = 0;i<canObject.length;i++){
                       if(that.canvas.item(i).type != 'line'){
                            that.canvas.item(i).remove();
                            that.canvas.renderAll();
                        }
                    }
                    that.canvas.renderAll();
                    var lineStatus = false;
                    for(var i = 0;i<canObject.length;i++){
                        if(that.canvas.item(i).type != 'line'){
                        lineStatus = true;
                        }
                    }
                    if(lineStatus){
                        canObject = that.canvas.getObjects();
                        continue;
                    }else{
                        break;
                    }      
                }
                that.canvas.renderAll();
    }


    //***********************COPY PASTE*****************
      
        var copiedObject;
        var copiedObjects = new Array();
        
        createListenersKeyboard();
        
        function createListenersKeyboard() {
            document.onkeydown = onKeyDownHandler;
            //document.onkeyup = onKeyUpHandler;
        }
        
        function onKeyDownHandler(event) {
            //event.preventDefault();
            
            var key;
            if(window.event){
                key = window.event.keyCode;
            }
            else{
                key = event.keyCode;
            }
            
            switch(key){
                //////////////
                // Shortcuts
                //////////////
                // Copy (Ctrl+C)
                case 67: // Ctrl+C
                    if(ableToShortcut()){
                        if(event.ctrlKey){
                            event.preventDefault();
                            copy();
                        }
                    }
                    break;
                // Paste (Ctrl+V)
                case 86: // Ctrl+V
                    if(ableToShortcut()){
                        if(event.ctrlKey){
                            event.preventDefault();
                            paste();
                        }
                    }
                    break;            
                default:
                    // TODO
                    break;
            }
        }
        
        
        function ableToShortcut(){
            
            // TODO check all cases for this
            
            if($("textarea").is(":focus")){
                return false;
            }
            if($(":text").is(":focus")){
                return false;
            }
            
            return true;
        }
        
        function copy(){
            if(that.canvas.getActiveGroup()){
                for(var i in that.canvas.getActiveGroup().objects){
                    var object = fabric.util.object.clone(that.canvas.getActiveGroup().objects[i]);
                    object.set("top", object.top+5);
                    object.set("left", object.left+5);
                    copiedObjects[i] = object;
                }                    
            }
            else if(that.canvas.getActiveObject()){
                var object = fabric.util.object.clone(that.canvas.getActiveObject());
                object.set("top", object.top+5);
                object.set("left", object.left+5);
                copiedObject = object;
                copiedObjects = new Array();
            }
        }
        
        function paste(){
                                
            if(copiedObject.class=='color')
            {
                console.log("ActiveObj.fill : "+copiedObject.fill);
                console.log("ActiveObj.color : "+copiedObject.color);
                //var col = this.rgb2hex(ActiveObj.fill);
                var col = copiedObject.fill;
                console.log("col : "+col);
                _id= Math.random().toString(36).substr(2,5);
                var copyData = copiedObject.toObject();
                fabric.util.enlivenObjects([copyData], function(objects) {
                  objects.forEach(function(o) {
                    o.set('top', o.top + 15);
                    o.set('left', o.left + 15);
                    o.set('id', _id);
                    o.set('fill', col);
                    o.set('color', col);
                    o.set('stroke', col);
                    o.class = copiedObject.class;
                    o.paths.forEach(function(path) {path.fill = col});
                    that.canvas.discardActiveObject(copiedObject);
                    that.canvas.add(o);
                    that.canvas.setActiveObject(o);
                    console.log("o.fill : "+o.fill);    
                    console.log("o : "+o.color);
                    // console.log(ActiveObj);
                    console.log(o);
                    o.setFill(copiedObject.fill);
                    console.log(">>>>>ActiveObj.fill :: "+copiedObject.fill)
                    o.set({
                        fill : copiedObject.fill
                    });
                  });
                  that.canvas.renderAll();
                });
                // ShapeID = ShapeID + 1;
                // var object = fabric.util.object.clone(ActiveObj);
                // object.set("top", ActiveObj.top+10);
                // object.set("left", ActiveObj.left+10);
                // object.id = _id;
                var size = $('#cs-sample1').children().size();
                $('#cs-tabContent').children('.tab-pane').each(function(index, el) {
                    paneID = $(el).attr('id');
                    var searchHTML = '<li><div class="row"><div class="col-md-6"><input type="text" class="form-control" id="pickClrByName" placeholder="00000" maxlength="6" /></div><div class="col-md-6" id="show_color"><a class="btn btn-xs temp clr_thumbnail_lg btn-color" data-value="#000000"></a><a class="btn btn-xs clr_thumbnail_lg btn-color" data-value="#000000"></a></div></div></li>';
                    var paletePicker = '<a style="box-shadow:2px 2px 2px black" id="svg_color_btn" class="btn btn-xs dropdown-toggle btn_css" data-toggle="dropdown" style="" aria-expanded="false"></a><ul class="dropdown-menu clrpicker">'+searchHTML+'<li><div id="'+paneID+'--'+_id+'" data-id="'+_id+'" class="picker"></div></li><li style="margin-top: 5px;"><div class="svg_hover_clr pull-left"><a class="btn btn-xs clr_thumbnail"></a><span>#000000</span></div><div class="svg_selected_clr pull-right"><a class="btn btn-xs clr_thumbnail"></a><span>#000000</span></div></li></ul>';
                    var _html = '<div class="row pt-10 colorRow" data-id="'+_id+'"><div class="col-md-4 col-xs-12">Color '+(size+ 1)+'</div><div class="col-md-4 col-xs-12">'+paletePicker+'</div><div class="col-md-4 col-xs-12 nopad text-right pr-20"><button type="button" id="editor-cpicker" data-type="colorsFill" data-id="" class="btn btn-default"><i class="fa fa-eyedropper"></i></button></div></div>';
                    $(_html).appendTo(el);
                    proFabric.setColorPallete(paneID+'--'+_id);
                });
                    activePane = $('#cs-tabContent').children('.active').attr('id');
                    $('#'+activePane+'--'+_id).closest('ul').prev().css('background-color',copiedObject.fill);
                    $('#'+activePane+'--'+_id).closest('ul').find('.svg_selected_clr').children('span').html(proFabric.rgb2hex(copiedObject.fill));
                    $('#'+activePane+'--'+_id).closest('ul').find('.svg_selected_clr').children('.btn').css('background-color',copiedObject.fill);
            }
            else if(copiedObject.class=="image")
            {
                var size = $('#editor-imageList').children().size();
                var id = proFabric.get.guid();
                copiedObject.id = id;
                $('#editor-imageList').children().removeClass('btn-primary');
                $('#editor-imageList').append('<button type="button" class="btn btn-default btn-circle btn-primary imagetextbold" data-id="'+(id)+'">'+(size+1)+'</button>');
                that.canvas.add(copiedObject);
                that.canvas.renderAll(); 
            }

            else if(copiedObject.class=="text")
            {
                that.canvas.discardActiveObject(copiedObject);
                that.canvas.add(copiedObject);
                that.text.updateUI(copiedObjec,(that.zoom/100));
                that.canvas.discardActiveObject(copiedObject);
                that.canvas.setActiveObject(copiedObject);
                that.canvas.renderAll(); 
                
            }

            else{
                that.canvas.discardActiveObject();
                that.canvas.add(copiedObject);
                that.canvas.setActiveObject(copiedObject);
            }
            console.log("---->>>>  Object Copied..")
        }

    //***********************COPY PASTE*****************


    

      //***************************************************

(function($) {
  "use strict";
  var aaColor = [
    ['#000000', '#424242', '#636363', '#9C9C94', '#CEC6CE', '#EFEFEF', '#F7F7F7', '#FFFFFF'],
    ['#FF0000', '#FF9C00', '#FFFF00', '#00FF00', '#00FFFF', '#0000FF', '#9C00FF', '#FF00FF'],
    ['#F7C6CE', '#FFE7CE', '#FFEFC6', '#D6EFD6', '#CEDEE7', '#CEE7F7', '#D6D6E7', '#E7D6DE'],
    ['#E79C9C', '#FFC69C', '#FFE79C', '#B5D6A5', '#A5C6CE', '#9CC6EF', '#B5A5D6', '#D6A5BD'],
    ['#E76363', '#F7AD6B', '#FFD663', '#94BD7B', '#73A5AD', '#6BADDE', '#8C7BC6', '#C67BA5'],
    ['#CE0000', '#E79439', '#EFC631', '#6BA54A', '#4A7B8C', '#3984C6', '#634AA5', '#A54A7B'],
    ['#9C0000', '#B56308', '#BD9400', '#397B21', '#104A5A', '#085294', '#311873', '#731842'],
    ['#630000', '#7B3900', '#846300', '#295218', '#083139', '#003163', '#21104A', '#4A1031']
  ];

  var createPaletteElement = function(element, _aaColor) {
    element.addClass('bootstrap-colorpalette');
    var aHTML = [];
    $.each(_aaColor, function(i, aColor){
      aHTML.push('<center><div>');
      $.each(aColor, function(i, sColor) {
        var sButton = ['<button type="button" class="btn-color" style="background-color:', sColor,
          '" data-value="', sColor,
          '" title="', sColor,
          '"></button>'].join('');
        aHTML.push(sButton);
      });
      aHTML.push('</div></center>');
    });
    element.html(aHTML.join(''));
  };

  var attachEvent = function(palette) {
    palette.element.on('click', function(e) {
      var welTarget = $(e.target),
          welBtn = welTarget.closest('.btn-color');

      if (!welBtn[0]) { return; }

      var value = welBtn.attr('data-value');
      palette.value = value;
      palette.element.trigger({
        type: 'selectColor',
        color: value,
        element: palette.element
      });
    });
  };

  var Palette = function(element, options) {
    this.element = element;
    createPaletteElement(element, options && options.colors || aaColor);
    attachEvent(this);
  };

  $.fn.extend({
    colorPalette : function(options) {
      this.each(function () {
        var $this = $(this),
            data = $this.data('colorpalette');
        if (!data) {
          $this.data('colorpalette', new Palette($this, options));
        }
      });
      return this;
    }
  });
})(jQuery);
//************************************************************************************


var options = {
        colors:[['#003366', '#336699', '#3366cc', '#003399', '#000099', '#0000cc', '#000066'],
        ['#006666', '#006699', '#0099cc', '#0066cc', '#0033cc', '#0000ff', '#3333ff', '#333399'],
        ['#669999', '#009999', '#33cccc', '#00ccff', '#0099ff', '#0066ff', '#3366ff', '#3333cc', '#666699'],
        ['#339966', '#00cc99', '#00ffcc', '#00ffff', '#33ccff', '#3399ff', '#6699ff', '#6666ff', '#6600ff', '#6600cc'],
        ['#339933', '#00cc66', '#00ff99', '#66ffcc', '#66ffff', '#66ccff', '#99ccff', '#9999ff', '#9966ff', '#9933ff', '#9900ff'],
        ['#006600', '#00cc00', '#00ff00', '#66ff99', '#99ffcc', '#ccffff', '#ccccff', '#cc99ff', '#cc66ff', '#cc33ff', '#cc00ff', '#9900cc'],
        ['#003300', '#009933', '#33cc33', '#66ff66', '#99ff99', '#ccffcc', '#ffffff', '#ffccff', '#ff99ff', '#ff66ff', '#ff00ff', '#cc00cc', '#660066'],
        ['#333300', '#009900', '#66ff33', '#99ff66', '#ccff99', '#ffffcc', '#ffcccc', '#ff99cc', '#ff66cc', '#ff33cc', '#cc0099', '#993399'],
        ['#336600', '#669900', '#99ff33', '#ccff66', '#ffff99', '#ffcc99', '#ff9999', '#ff6699', '#ff3399', '#cc3399', '#990099'],
        ['#666633', '#99cc00', '#ccff33', '#ffff66', '#ffcc66', '#ff9966', '#ff6666', '#ff0066', '#d60094', '#993366'],
        ['#a58800', '#cccc00', '#ffff00', '#ffcc00', '#ff9933', '#ff6600', '#ff0033', '#cc0066', '#660033'],
        ['#996633', '#cc9900', '#ff9900', '#cc6600', '#ff3300', '#ff0000', '#cc0000', '#990033'],
        ['#663300', '#996600', '#cc3300', '#993300', '#990000', '#800000', '#993333']
        ]
    }

    $('#editor-font-clr').colorPalette(options)
      .on('selectColor', function(e) {
        $('#text_color_btn').css('background-color',e.color);
        $('.text_selected_clr span').html(e.color);
        $('.text_selected_clr .btn').css('background-color',e.color);
      });
    $('#editor-font-clr .btn-color').mouseover(function(){
        clr = $(this).attr('data-value');
        $('.text_hover_clr span').html(clr);
        $('.text_hover_clr .btn').css('background-color',clr);
    });


    $('#editor-IMGstrokeColor').colorPalette(options)
      .on('selectColor', function(e) {
        $('#img_color_btn').css('background-color',e.color);
        $('.img_selected_clr span').html(e.color);
        $('.img_selected_clr .btn').css('background-color',e.color);
      });
    $('#editor-IMGstrokeColor .btn-color').mouseover(function(){
        clr = $(this).attr('data-value');
        $('.img_hover_clr span').html(clr);
        $('.img_hover_clr .btn').css('background-color',clr);
    });

    this.setColorPallete = function(selector){
        $('#'+selector).colorPalette(options).on('selectColor', function(e) {
            $('#'+selector).closest('ul').prev().css('background-color',clr);
            $('#'+selector).closest('ul').find('.svg_selected_clr').children('span').html(clr);
            $('#'+selector).closest('ul').find('.svg_selected_clr').children('.btn').css('background-color',clr);
            _id = $('#'+selector).attr('data-id');
            proFabric.color.fill(_id, clr);
        });
        $('#'+selector+' .btn-color').mouseover(function(){
            clr = $(this).attr('data-value');
            $('#'+selector).closest('ul').find('.svg_hover_clr').children('span').html(clr);
            $('#'+selector).closest('ul').find('.svg_hover_clr').children('.btn').css('background-color',clr);
        });

    }
    this.setPlaceHolder = function(_type){
        var src,flagi;
        if(_type === 'companyUploader')
        {
            src = base_url+'/assets/imgs/companyPH_BG.png';
            flagi = 1;
        }
        else if(_type === 'agentUploader')
        {
            src = base_url+'/assets/imgs/userPH_BG.png';
            flagi = 1;
        }
        else
        {
            src = base_url+'/assets/imgs/placeholder.png';
            flagi = 0;
        }
        var _id = proFabric.get.guid();
        var pH_id = _id+'placeholderBG';
        if(flagi == 1)
        {
            proFabric.image.add(src, {id:pH_id,uploader:'false',firstTimeUpload:'false',logo_company:'true'});
        }
        else
        {
            proFabric.image.add(src, {id:pH_id,uploader:'false',firstTimeUpload:'false',logo_company:'false'});
        }
            
        
        // that.canvas.forEachObject(function(obj) {
            // if (obj.id == pH_id) {
            // }
        // });
        setTimeout(function(){
            if(flagi == 1){
                proFabric.image.add(base_url+'/assets/imgs/placeholderBtn.png', {id:_id,uploader:'true',firstTimeUpload:'true',logo_company:'true'});
            }
            else
            {
                proFabric.image.add(base_url+'/assets/imgs/placeholderBtn.png', {id:_id,uploader:'true',firstTimeUpload:'true',logo_company:'false'});
            }
                
            that.canvas.forEachObject(function(obj) {
                if (obj.id == _id) {
                    obj.bringToFront();
                }
            });
        }, 1000);
        console.log('added');
    }
};
