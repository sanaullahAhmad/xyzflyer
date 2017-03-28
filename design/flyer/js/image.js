proFabric.image = {
	parent: proFabric,
	canvas: proFabric.get.canvas(),
	add: function(src, _options){
        var self = this;

        fabric.Image.fromURL(src, function(image) {

            image.set({
                left: (_options && _options.left) || self.parent.get.width() / 2,
                top: (_options && _options.top) || self.parent.get.height() / 4,
                class: 'image',
                linkid:'',
                id: (_options && _options.id) || self.parent.get.guid(),
                opacity: (_options && _options.opacity) || 1,
                scaleX: (_options && _options.scaleX) || 1,
                scaleY: (_options && _options.scaleY) || 1,
                target: (_options && _options.target) || false,
                selectable: (_options && _options.selectable) || true,
                hasControls		  : (_options && _options.opacity) || true,
                hasRotatingPoint  : (_options && _options.hasRotatingPoint) || true,
                lockMovementX     : (_options && _options.lockMovementX) || false,
                lockMovementY	  : (_options && _options.lockMovementY) || false,
                lockRotation 	  : (_options && _options.lockRotation) || false,
                lockScalingX 	  : (_options && _options.lockScalingX) || false,
                lockScalingY 	  : (_options && _options.lockScalingY) || false
                });

            image.set({
                original_scaleX: image.scaleX / (self.parent.get.zoom() / 100),
                original_scaleY: image.scaleY / (self.parent.get.zoom() / 100),
                original_left: image.left / (self.parent.get.zoom() / 100),
                original_top: image.top / (self.parent.get.zoom() / 100)
            });

            image.setCoords();
            self.canvas.add(image);
            self.canvas.setActiveObject(image);
            self.canvas.renderAll();
        });
	},
    set: function(options) {
        var obj = this.canvas.getActiveObject();
        if(obj && obj.class !== 'image') return;

        obj.set(options);
        obj.setCoords();
        this.canvas.renderAll();
    },
    stroke_color: function(color) {
        var obj = this.canvas.getActiveObject();
        if(obj && obj.class !== 'image') return;

        obj.set({stroke: color});
        obj.setCoords();
        this.canvas.renderAll();

    },
    stroke_width: function(width) {
        var obj = this.canvas.getActiveObject();
        if(obj && obj.class !== 'image') return;

        obj.set({strokeWidth: width});
        obj.setCoords();
        this.canvas.renderAll();
    },
    imageSelected: function(obj){
        //$("#imageTab").trigger('click');
       $("#img_width_input").val(Math.ceil(obj.width));
       $("#img_height_input").val(Math.ceil(obj.height));
       if(obj.lockMovementX){
        $("#lock_img").addClass('ui-state-active');
        $("#unlock_img").removeClass('ui-state-active');
       }
       else{
        $("#lock_img").removeClass('ui-state-active');
        $("#unlock_img").addClass('ui-state-active');
       }
    }
/*    linktoId:function(id){

        var obj = this.canvas.getActiveObject();

    }*/
};