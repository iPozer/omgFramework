<script>
$(function(){
	$.ajax({
		url: '/admin/'+module+'/list',
		type: 'get',
		data: {search: ''},
		dataType: 'json',
		success: function(data){
			html = "<table cellpadding='0' cellspacing='1' width='100%'><tr><td width='50%'>Заголовок</td><td width='45%'>Название страницы</td><td></td><td></td></tr>"
			$(data.list).each(function(key, item){
				html += "<tr rel='"+item.id+"'><td width='50%'><a href='#edit'>"+item.title+"</td><td width='45%'>"+item.name+"</td><td></td><td></td></tr>"
			});
			html += "</table>"
			$("#list").append(html);
		}
	});
	
	$("#template div.actions a.create").bind("click", function(){
		Editor.create('#editor');
		return false;
	});
});	

</script>
<div id="template">
	<div class="actions">
		<a href="#" class="create">Создать страницу</a>
	</div>
	<div id="list" class="list"></div>
</div>
<div id="editor" class="editor form">
<form method="post" enctype="multipart/form-data" action="">
<input type="hidden" name="id">
<div class="header">
<div class="buttons"><input type="button" class="create edit" value="Новая страница" rel="parent_id"><input type="button" value="Сохранить и закрыть" class='save minor'><input type="submit" value="Сохранить"><input type="button" value="Удалить" class="delete edit"><input type="button" value="Закрыть" class="close"></div>
<h3 class="new">Новая страница</h3>
<a href="/nojs" class="eye" title="Показать / скрыть"><input type="hidden" name="visible"></a>
</div>
<label>Привязка</label>
<select name="parent_id" style="width:100%"></select><br/>
<label>Заголовок</label>
<input name="title" style="width:99%"><br/>
<label>Название страницы (латинскими)</label>
<input name="name" style="width:99%"><br/>
<label>Содержание</label>
<textarea name="content" class="mceEditor" style="width:100%;height:200px"></textarea><br/>
</form>
</div>

