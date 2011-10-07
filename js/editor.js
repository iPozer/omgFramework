var Editor = {
	editor: "",
	data: "",
	id: "",
	position: function(){
		width = $("#modules").width()-60;
		heidht = $("#modules").height();
	},
	create: function(editor){
		this.position();
		Blackout.show();
		$(editor).css({"width": width, "margin-left": -width/2}).show();
	},
	close: function(){
		$("#editor").hide();
		Blackout.hide();
	},
	save: function(){
		$.ajax({ type: 'post', url: '/admin/'+module+'/update', dataType: 'json',
			data: $("#")
			
		});
	}
	
}

$(function(){
	$("#editor input.close").bind("click", function(){Editor.close()});
	$("#editor input[type=submit]").bind("click", function(){Editor.save(); return false});
});