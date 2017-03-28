_txtSelectionFlag=0;
proFabric.text = {
    parent : proFabric,
    canvas: proFabric.get.canvas(),
    updateUI:function(object,zoom){

        $("#textbox_width").val(Math.ceil(object.width * object.scaleX)/zoom);
        $("#textbox_height").val(Math.ceil(object.height * object.scaleY)/zoom);
        $("#textbox_padding").val(object.padding);
        if(object.padding > 0){
            proFabric.text.setPadding((object.padding*zoom)/zoom);
            $("#textbox_padding").val((object.padding*zoom)/zoom);
        }

        $('#textbox_lineHeight').val(object.lineHeight);
        if(!object){
            $("#editor-textarea").val('');
            return;
        }
        if (object.bullet){
            $("#editor-textarea").val(object.bulletText);
            $('body').find("button#editor-textList").addClass('btn-primary');
        }
        else{
            $("#editor-textarea").val(object.text);
            $('body').find("button#editor-textList").removeClass('btn-primary');
        }
        $('#coler-picker[data-type=text]').next('.evo-colorind').css('backgroundColor', object.fill);
        $("#editor-fontSize").val(object.fontSize);
        $('#editor-fontFamily').children('option').filter(function(){return $(this).val()==object.fontFamily}).prop('selected',true).change();
        $('div#editor-textAlign').find('button[data-type='+object.textAlign+']').addClass('btn-primary').siblings().removeClass('btn-primary');
        $('body').find('button.editor-textAssign').removeClass('btn-primary');
        $('body').find('button.editor-textAssign[data-id='+object.id+']').addClass('btn-primary');
        $("#opacity_range_text").val(object.opacity * 100);
        if(object.class=="text")
        {

            if(object.lockMovementX==false)
            {
                $('#lock-text').removeClass('btn-primary');
                $('#lock-text').removeClass('btn-primary');
                $('#unlock-text').removeClass('btn-default');
                $('#unlock-text').addClass('btn-primary');
                $('#lock-text').removeClass('btn-default');
            }
            else
            {
                
                $('#unlock-text').removeClass('btn-primary');
                $('#unlock-text').removeClass('btn-primary');
                $('#lock-text').removeClass('btn-default');
                $('#lock-text').addClass('btn-primary');
                $('#unlock-text').removeClass('btn-default');
            }
            if(object.fontWeight=="bold"){
                $('button#editor-textBold').removeClass('btn-default');
                $('button#editor-textBold').addClass('btn-primary');
            }
            else
            {
                $('button#editor-textBold').removeClass('btn-primary');
                $('button#editor-textBold').addClass('btn-default');
            }
            if(object.fontStyle=="italic")
            {
                $('button#editor-textItalic').removeClass('btn-default');
                $('button#editor-textItalic').addClass('btn-primary');
            }
            else
            {
                $('button#editor-textItalic').removeClass('btn-primary');
                $('button#editor-textItalic').addClass('btn-default');
            }
            if(object.textDecoration=="underline")
            {
                $('button#editor-textUnderline').removeClass('btn-default');
                $('button#editor-textUnderline').addClass('btn-primary');
            }
            else
            {
                $('button#editor-textUnderline').removeClass('btn-primary');
                $('button#editor-textUnderline').addClass('btn-default');
            }
        }
        else if(object.class=="image")
        {
            if(object.lockMovementX==false)
            {
                $('#lock-text').removeClass('btn-primary');
                $('#lock-text').removeClass('btn-primary');
                $('#unlock-text').removeClass('btn-default');
                $('#unlock-text').addClass('btn-primary');
                $('#lock-text').removeClass('btn-default');
            }
            else
            {
                
                $('#unlock-text').removeClass('btn-primary');
                $('#unlock-text').removeClass('btn-primary');
                $('#lock-text').removeClass('btn-default');
                $('#lock-text').addClass('btn-primary');
                $('#unlock-text').removeClass('btn-default');
            }
        }
        proFabric.text.setTextboxCords(Math.ceil(object.width * object.scaleX)/zoom, Math.ceil(object.height * object.scaleY)/zoom)
    },
    add: function(_text,_options,zoom){
        var self = this;
        var box_width = parseInt($("#textbox_width").val());
        var box_height = parseInt($("#textbox_height").val());
        var f_size = parseInt($("#editor-fontSize").val());
        var padding = parseInt($('#textbox_padding').val());
        
        var text = new fabric.Textbox(_text || 'Enter Your Text Here', {
            textAlign           : 'left',
            class               : 'text',
            fontSize            : (_options && _options.fontSize) || f_size,
            lockScalingX        : false,
            lockScalingY        : false,
            left                : (_options && _options.left) || self.parent.get.width() / 2,
            top                 : (_options && _options.top) || self.parent.get.height() / 4,
            width               : (_options && _options.width) || box_width,
            height              : (_options && _options.height) || box_height,
            padding             : (_options && _options.padding) || padding*zoom,
            id                  : (_options && _options.id) || self.parent.get.guid(),
            opacity             : (_options && _options.opacity) || 1,
            scaleX              : (_options && _options.scaleX)*zoom || 1*zoom,
            scaleY              : (_options && _options.scaleY)*zoom || 1*zoom,
            target              : (_options && _options.target) || false,
            selectable          : (_options && _options.selectable) || true,
            hasControls         : (_options && _options.opacity) || true,
            hasRotatingPoint    : (_options && _options.hasRotatingPoint) || true,
            lockMovementX       : (_options && _options.lockMovementX) || false,
            lockMovementY       : (_options && _options.lockMovementY) || false,
            lockRotation        : (_options && _options.lockRotation) || false,
            lockScalingX        : (_options && _options.lockScalingX) || true,
            lockScalingY        : (_options && _options.lockScalingY) || true,
            editable            : (_options && _options.editable ) || false,
            cursorWidth         : (_options && _options.cursorWidth ) || 0,
            
        });
        text.setCoords();
        self.canvas.add(text);
        self.parent.savestate('add', text.toJSON(['id','class']), text.toJSON(['id','class']));
        
        

       
        $('button#editor-textBold').removeClass('btn-primary');
        $('button#editor-textBold').addClass('btn-default');

        $('button#editor-textItalic').removeClass('btn-primary');
        $('button#editor-textItalic').addClass('btn-default');

        $('button#editor-textUnderline').removeClass('btn-primary');
        $('button#editor-textUnderline').addClass('btn-default');
        text.setHeight(box_height);
        self.canvas.renderAll();
        self.canvas.setActiveObject(text);
        self.canvas.renderAll();
        
    },
    setTextboxCords: function(width,height) {
        var obj = this.canvas.getActiveObject();
        if(!obj || obj.class !== 'text') return;
        
        obj.setWidth(width);
        this.canvas.renderAll();
        obj.setHeight(height);
        this.canvas.renderAll();
    },

    getTextByID: function(_id) {
        var _text = '';
        var foundObjFlag = 0;
        this.canvas.forEachObject(function(object){
            if(object.id == _id){
                foundObjFlag = 1;
                if(typeof object.bullet !== 'undefined' && object.bullet){
                    _text = object.bulletText;
                    return;
                }
                _text = object.text;
                return;
            }
        });
        if(foundObjFlag == 0)
        {
            console.log('object is no longer available');
            _text = -1;
        }
        return _text;
    },

    get: function(property) {
        var obj = this.canvas.getActiveObject();
        if(obj && obj.class !== 'text') return;
        return obj.get(property);
    },
    set: function(options) {
        var obj = this.canvas.getActiveObject();
        if(!obj || obj.class !== 'text' && (obj.lockMovementY==true || obj.lockScalingX==true)) return;
        var before = obj.toJSON(['id','class']);
        obj.set(options);
        obj.setCoords();
        this.parent.savestate('modified',before,obj.toJSON(['id','class']));
        this.canvas.renderAll();
    },
    setPadding: function(value) {
        var obj = this.canvas.getActiveObject();
        if(!obj || obj.class !== 'text' && (obj.lockMovementY==true || obj.lockScalingX==true)) return;
        var before = obj.toJSON(['id','class']);
        obj.set({padding:value});
        obj.setCoords();
        this.parent.savestate('modified',before,obj.toJSON(['id','class']));
        this.canvas.renderAll();
    },
    setLineheight: function(value) {
        var obj = this.canvas.getActiveObject();
        if(!obj || obj.class !== 'text' && (obj.lockMovementY==true || obj.lockScalingX==true)) return;
        var before = obj.toJSON(['id','class']);
        obj.set({lineHeight:value});
        obj.setCoords();
        this.parent.savestate('modified',before,obj.toJSON(['id','class']));
        this.canvas.renderAll();
    },
    settextcol : function(hex) {
        console.log('hex');
        var obj = this.canvas.getActiveObject();
        if (obj.class == "text") {
            var before = obj.toJSON(['id','class']);
            obj.set({
                fill: '#'+hex
            });
            this.parent.savestate('modified',before,obj.toJSON(['id','class']));
        }
        this.canvas.renderAll();
        console.log(hex);
    },
    textopacity : function(opacity) {
        var obj = this.canvas.getActiveObject();
        if (obj && obj.class == "text") {
            obj.setOpacity(opacity / 100);
        } else {
            obj = this.canvas.getActiveGroup();
            if (obj) {
                for (var i = 0; i < obj._objects.length; i++) {
                    obj._objects[i].opacity = opacity / 100;
                }
            }
        }
         this.canvas.renderAll();
    },
    assign: function(name, alreadyAssigned) {
        var obj = this.canvas.getActiveObject();
        if(!obj || obj.class !== 'text') return;
        if(!alreadyAssigned){
            obj.set({
                linkName : name
            });
        }
        else{
            obj.set({
                linkName : ''
            });
        }
        obj.setCoords();
        this.canvas.renderAll();
    },
    checkID: function(_id) {
        var flag = false;
        this.canvas.forEachObject(function(object){
            if(object.id == _id){
                flag = true;
            }
        });
        return flag;
    },
    list: function() {
        var obj = this.canvas.getActiveObject();
        if(!obj || obj.class !== 'text') return;
        //
        obj.setCoords();
        this.canvas.renderAll();
    },
         /******************************* AHMAD'S CODE END *******************************/
    
    bullet: function(converted) {
        var obj = this.canvas.getActiveObject();
        if(!obj || obj.class !== 'text') return;
        if(converted){
            obj.bullet = true;
            obj.bulletText = obj.text;
            _text = '';
            $.each(obj.bulletText.split('\n'), function(index, val) {
                if (index!=0) 
                    _text += '\n';
                _text += '\u2022 '+val;
            });

            obj.set({
                text : _text
            });
        }
        else{
            obj.bullet = false;
            _text = obj.bulletText;
            obj.set({
                text : _text
            });
        }
        this.canvas.renderAll();
    }
};