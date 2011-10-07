var Blackout = { layers: [], callbacks: [],
	// --
	show: function(){
			this.refresh();
			jQuery("#blackout").css({opacity:0}).show().stop().animate({opacity:0.4});
			/*
			this.refresh();
			if(!depth) depth = 100;
			if(this.layers.length == 0)	jQuery("#blackout").css({opacity:0}).show().stop().animate({opacity:0.4});
			jQuery("#blackout").css({zIndex:depth});
			this.layers.push(depth);
			this.callbacks.push(callback || "");*/
	},
	hide: function(click){	
			/*if(!click || (click && this.callbacks.slice(-1) != "")){
				var layers = this.layers.pop();
				callback = this.callbacks.pop();
				if(click && callback != ""){
					if(callback.call({blackout:true}) == false){
						this.layers.push(layers);
						this.callbacks.push(callback);
						return false;
					}
				}
				depth = this.layers.slice(-1);
				if(depth != "") jQuery("#blackout").css({zIndex:depth}); else jQuery("#blackout").fadeOut(300);
			}*/
			$("#editor").hide();
			$("#blackout").fadeOut(300)
	},
	refresh: function(){ 
		jQuery("#blackout").width(jQuery(window).width()).height(jQuery(window).height());
	}
};
jQuery(function(){	
	
	jQuery("#blackout").click(function(){Blackout.hide(true)});
});
