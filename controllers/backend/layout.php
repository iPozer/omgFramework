<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>	
		<title>Управление сайтом</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<meta name="description" content=""/>
		<meta name="keywords" content=""/>		
		<link rel="shortcut icon" href="/favicon.ico"/>
		<link rel="stylesheet" type="text/css" media="screen" href="/css/layout.css"/>	
		<script type="text/javascript" src="/js/jquery.js"></script>	
		<script type="text/javascript" src="/js/editor.js"></script>	
		<script type="text/javascript" src="/js/blackout.js"></script>	
	</head>
	<script>
	 var module = '<?=$module?>';
	</script>
<body>
<div id="blackout"></div>
<div id="layout">
	<div id="modules">
		<div class="options"><a href="/">Перейти на сайт</a><a href="/admin/?logout=1">Выход</a></div>
		<a href="/admin/pages">Страницы</a>
		<div class="clear"></div>
	</div>

	<?include_once($template)?>

</div>
</body>
</html>