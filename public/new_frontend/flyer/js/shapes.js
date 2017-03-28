proFabric.shapes = {
	parent : proFabric,
	canvas: proFabric.get.canvas(),
	get: {
		width: function() {
			var obj = this.canvas.getActiveObject();
			if(obj && obj.class !== 'shape') return;

			return obj.getWidth();
		},
		height: function() {
			var obj = this.canvas.getActiveObject();
			if(obj && obj.class !== 'shape') return;

			return obj.getHeight();
		}
	},
	add: function(src, _options) {

		var self = this;

		fabric.loadSVGFromURL(src, function (objects, options) {

			for (var i = 0; i < objects.length; i++) {
				objects[i].set({stroke: 'black', strokeWidth: 1});
			}

			var obj = fabric.util.groupSVGElements(objects, options);

			obj.set({
				left: (_options && _options.left) || self.parent.get.width() / 2,
				top: (_options && _options.top) || self.parent.get.height() / 4,
				class: 'shape',
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
            
			obj.set({
				original_scaleX: obj.scaleX / (self.parent.get.zoom() / 100),
				original_scaleY: obj.scaleY / (self.parent.get.zoom() / 100),
				original_left: obj.left / (self.parent.get.zoom() / 100),
				original_top: obj.top / (self.parent.get.zoom() / 100)
			});

			obj.setCoords();
			self.parent.canvas.add(obj);
			self.parent.canvas.setActiveObject(obj);
			self.canvas.renderAll();

		}, function (item, object) {

			object.set('id', item.getAttribute('id'));
			object.set('class', item.getAttribute('class'));
			object.set('original_scaleX', item.getAttribute('original_scaleX'));
			object.set('original_scaleY', item.getAttribute('original_scaleY'));
			object.set('original_left', item.getAttribute('original_left'));
			object.set('original_top', item.getAttribute('original_top'));

			return object.id;
		}).bind(this);

	},
	stroke_color: function(color) {
		var obj = this.canvas.getActiveObject();
		if(obj && obj.class !== 'shape') return;

		obj.paths.forEach(function(i) { i.set({stroke: color}); });
		obj.setCoords();
		this.canvas.renderAll();
	},
	stroke_width: function(width) {
		var obj = this.canvas.getActiveObject();
		if(obj && obj.class !== 'shape') return;

		obj.paths.forEach(function(i) { i.set({strokeWidth: width}); });
		obj.setCoords();
		this.canvas.renderAll();
	},
	fill: function(color) {
		console.log(color);
		var obj = this.canvas.getActiveObject();
		if(obj && obj.class !== 'shape') return;

		console.log(obj);
		if (obj.isSameColor && obj.isSameColor() || !obj.paths) {
			obj.setFill(color);
		}
		else if (obj.paths) {
			obj.paths.forEach(function(i) { i.setFill(color) });
		}

		obj.setCoords();
		this.canvas.renderAll();
	},
	set: function(option) {
		var obj = this.canvas.getActiveObject();
		if(obj && obj.class !== 'shape') return;
		obj.paths.forEach(function(i) { i.set(option) });
		obj.setCoords();
		this.canvas.renderAll();
	},
    scaleToWidth: function(width) {
        var obj = this.canvas.getActiveObject();
        if(obj && obj.class !== 'shape') return;

		var boundingRectFactor = obj.getBoundingRect().width / obj.getWidth();
		obj.set({scaleX : width / obj.width / boundingRectFactor});	
        //obj.scaleToWidth(width / sx);
        obj.setCoords();
        this.canvas.renderAll();
    },
    scaleToHeight: function(height) {
        var obj = this.canvas.getActiveObject();
        if(obj && obj.class !== 'shape') return;

		var boundingRectFactor = obj.getBoundingRect().height / obj.getHeight();
		obj.set({scaleY : height / obj.height / boundingRectFactor});
        //obj.scaleToHeight(height / sy);
        obj.setCoords();
        console.log(obj.getHeight());
        this.canvas.renderAll();
    },
    setScaleX: function(width) {
    	var obj = this.canvas.getActiveObject();
        if(obj && obj.class !== 'shape') return;

        obj.set({scaleX : width / obj.width});
        obj.setCoords();
        this.canvas.renderAll();
    },
    setScaleY: function(height) {
    	var obj = this.canvas.getActiveObject();
        if(obj && obj.class !== 'shape') return;

        obj.set({scaleY : height / obj.height});
        obj.setCoords();
        this.canvas.renderAll();
    },
    shapeSelected: function(obj){
    	//$("#imageTab").addClass('.ui-tabs-active ui-state-active');
    	$("#shape_width_input").val(Math.ceil(obj.getWidth()));
    	$("#shape_height_input").val(Math.ceil(obj.getHeight()));
    	$("#svgFill").css("background-color",obj.fill);
    	$("#svgStroke").css("background-color",obj.paths[0].stroke);
    	if(obj.lockMovementX){
    		$("#lock_shape").addClass('ui-state-active');
    		$("#unlock_shape").removeClass('ui-state-active');
    	}
    	else{
    		$("#lock_shape").removeClass('ui-state-active');
    		$("#unlock_shape").addClass('ui-state-active');
    	}
    }
};