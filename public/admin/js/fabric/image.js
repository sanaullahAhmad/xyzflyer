var scale_x = 1, scale_y = 1;
proFabric.image = {
    parent: proFabric,
    canvas: proFabric.get.canvas(),  
    add: function(src, _options){
        var self = this;
        var _left   = (_options && _options.left) || (self.parent.get.width()/2)/(self.parent.get.zoom() / 100),
            _top    = (_options && _options.top) || (self.parent.get.height()/4)/(self.parent.get.zoom() / 100),
            _scaleX = (_options && _options.scaleX) || (1/(self.parent.get.zoom() / 100)),
            _scaleY = (_options && _options.scaleY) || (1/(self.parent.get.zoom() / 100));
        fabric.Image.fromURL(src, function(image) {
            image.set({
                left                : _left,
                top                 : _top,
                scaleX              : _scaleX,
                scaleY              : _scaleY,
                lockScalingX        : false,
                lockScalingY        : false,
                class               : 'image',
                linkid              : '',
                src                 :  src,
                type                : 'image',
                name                : (_options && _options.name),
                id                  : (_options && _options.id) || self.parent.get.guid(),
                opacity             : (_options && _options.opacity) || 1,
                target              : (_options && _options.target) || false,
                selectable          : (_options && _options.selectable) || true,
                hasControls         : (_options && _options.opacity) || true,
                hasRotatingPoint    : (_options && _options.hasRotatingPoint) || true,
                lockMovementX       : (_options && _options.lockMovementX) || false,
                lockMovementY       : (_options && _options.lockMovementY) || false,
                lockRotation        : (_options && _options.lockRotation) || false,
                lockScalingX        : (_options && _options.lockScalingX) || false,
                lockScalingY        : (_options && _options.lockScalingY) || false,
                uploader            : (_options && _options.uploader),
                firstTimeUpload     : (_options && _options.firstTimeUpload),
                logo_company        : (_options && _options.logo_company)
            });
            image.set({
                original_scaleX : image.scaleX,
                original_scaleY : image.scaleY,
                original_left   : image.left,
                original_top    : image.top
            });

            image.setCoords();
            self.canvas.add(image);
            self.parent.savestate('add', image.toJSON(['id','class']), image.toJSON(['id','class']));
            self.canvas.setActiveObject(image);
            self.canvas.renderAll();
            $('#editor-imageWidth').val(image.width);
            $('#editor-imageHeight').val(image.height);

        });
    },

    addBlob: function(src, _options){
        that = this;
        fabric.Image.fromURL(src, function(image) {
            var gcanvas=document.createElement('canvas');
            var myCanvas = new fabric.Canvas(gcanvas, { width: image.width, height: image.height});
            image.set({
                top:0,
                left:0
            });
            myCanvas.add(image);
            var base64 = myCanvas.toDataURL('image/jpeg');
            that.add(base64, _options);
        });
    },
    imageopacity : function(opacity) {
        var obj = this.canvas.getActiveObject();
        if (obj && obj.class == "image") {
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
    set: function(options) {
        var self = this;
        var obj = this.canvas.getActiveObject();
        if(!obj || obj.class !== 'image') return;
        var before = obj.toJSON(['id','class']);
        obj.set(options);

        obj.setCoords();
        this.parent.savestate('modified',before,obj.toJSON(['id','class']));
        this.canvas.renderAll();
    },

    setScaling: function(obj) {

        console.log('setScaling of Image is called');
        $('#editor-imageList').children().removeClass('btn-primary')
        $('#editor-imageList').find('button[data-id='+obj.id+']').addClass('btn-primary');

        obj.scaleX = 1;
        obj.scaleY = 1;
        obj.width = parseInt($("#editor-imageWidth").val());
        obj.height = parseInt($("#editor-imageHeight").val());
        
        if(obj.lockMovementX){
            $("#image").find("#editor-lockGroup").find('button[data-type=lock]').addClass('btn-primary').siblings().removeClass('btn-primary');
        }
        else{
            $("#image").find("#editor-lockGroup").find('button[data-type=unlock]').addClass('btn-primary').siblings().removeClass('btn-primary');
        }
        $('body').find('button.editor-textAssign').removeClass('btn-primary');
        $('body').find('button.editor-textAssign[data-id='+obj.id+']').addClass('btn-primary');
        $("#opacity_range_image").val(obj.opacity * 100);
    },
    updateUI: function(obj,zoom){
        
        $('#editor-imageList').children().removeClass('btn-primary')
        $('#editor-imageList').find('button[data-id='+obj.id+']').addClass('btn-primary');
        
        var obj_width = Math.ceil(obj.width * obj.scaleX)/zoom;
        var obj_height = Math.ceil(obj.height * obj.scaleY)/zoom;
        
        $("#editor-imageWidth").val(Math.ceil(obj.width * obj.scaleX)/zoom);
        $("#editor-imageHeight").val(Math.ceil(obj.height * obj.scaleY)/zoom);
        $("#editor-IMGstrokeWidth").val(obj.strokeWidth);
        $("#editor-IMGstrokeColor").val(obj.stroke);
        
        // console.log("scaleX var "+_scaleX);

        if(obj.lockMovementX){
            $("#image").find("#editor-lockGroup").find('button[data-type=lock]').addClass('btn-primary').siblings().removeClass('btn-primary');
        }
        else{
            $("#image").find("#editor-lockGroup").find('button[data-type=unlock]').addClass('btn-primary').siblings().removeClass('btn-primary');
        }
        $('body').find('button.editor-textAssign').removeClass('btn-primary');
        $('body').find('button.editor-textAssign[data-id='+obj.id+']').addClass('btn-primary');
        $("#opacity_range_image").val(obj.opacity * 100);
    }
};