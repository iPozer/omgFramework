var List = {data: "", filters: {search:""}, afterReload: function(){},
	// Получение списка
	reload: function(){
		jQuery("#list").stop().animate({opacity: 0.3});
		jQuery.get(module+'/list', List.filters, function(data){
			Check(data);
			List.data = data;
			List.build();	
			if(List.data.search) if(List.data.search.length){
				List.build_search();
			}else{
				alert("Поиск не дал результатов");
				List.filters.search = "";
			}
			jQuery("#list > table tr:visible").not(":even").addClass("odd");
			//jQuery("#list > table tr").bind("mouseover",function(){jQuery(this).addClass('hover')}).bind("mouseout",function(){jQuery(this).removeClass('hover')});
			jQuery("#list").stop().animate({opacity: 1});
			List.afterReload();
		});
	},
	build_search: function(){
		jQuery(List.data.search).each(function(key,item){
			//jQuery("#list > table tr:not(:eq(0))").hide();
			jQuery("#list > table tr[rel="+item.id+"]").addClass("search");
		});
	}
	,
	// Конструирование списка
	build: function(){
	}
};



jQuery(function(){
	jQuery("#options a.create").click(function(){EdIt.open();return false;});
	//jQuery("#search > form").bind("submit",function(){List.search = jQuery("#search > form").serialize();List.reload();return false;});
	jQuery("#search > form").bind("submit",function(){List.filters.search = jQuery("#search > form input[name=search]").val();List.reload();return false;});
	jQuery("div.list > table tr").live("mouseover",function(){jQuery(this).addClass('hover')}).live("mouseout",function(){jQuery(this).removeClass('hover')});
	jQuery("div.editor.form div.list > div").live("mouseover",function(){jQuery(this).addClass('hover')}).live("mouseout",function(){jQuery(this).removeClass('hover')});
	
	jQuery("#list a[href=#edit]").live("click",function(){EdIt.open(jQuery(this).closest("tr").attr("rel"));return false;});
	jQuery("#list a[href=#delete]").live("click",function(){
		if(confirm("Вы уверены, что хотите удалить элемент?")){
			var parent = jQuery(this).closest("tr").hide();
			var table = jQuery(parent).attr("table");
			jQuery.get(module+"/delete",jQuery.extend({id:jQuery(parent).attr("rel")},(table?{table:table}:{})),function(data){
				if(Check(data)){
					jQuery(parent).remove();
				}else{
					List.reload();
				}
			});
		}
		return false;
	});
	jQuery("#list a[href=#visible]").live("click",function(){
		var parent = jQuery(this).closest("tr");
		var table = jQuery(parent).attr("table");
		var eye = jQuery(this).attr("rel") == 1 ? 0 : 1;
		jQuery(this).attr("rel",eye);
		jQuery.get(module+"/visible",jQuery.extend({id:jQuery(parent).attr("rel"),visible:eye},(table?{table:table}:{})),function(data){
			if(!Check(data)){
				List.reload();
			}
		});
		return false;
	});
	jQuery("#list a[href=#up]").live("click",function(){
			var parent = jQuery(this).closest("tr");
			var table = jQuery(parent).attr("table");
			jQuery.get(module+"/up",jQuery.extend({id:jQuery(parent).attr("rel")},(table?{table:table}:{})),function(data){
				Check(data);
				List.reload();
			});
		return false;
	});
	jQuery("#list a[href=#down]").live("click",function(){
			var parent = jQuery(this).closest("tr");
			var table = jQuery(parent).attr("table");
			jQuery.get(module+"/down",jQuery.extend({id:jQuery(parent).attr("rel")},(table?{table:table}:{})),function(data){
				Check(data);
				List.reload();
			});
		return false;
	});


});