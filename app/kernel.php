<?
	
	function __autoload($class_name) {

		$filename = strtolower($class_name) . '.php';
		$file = site_path . 'lib' . DIRSEP . $filename;
		
		if (!file_exists($file)){
			return false;
		}

		include ($file);
	}
	
	$registry = new Registry;
	
	//$registry = new db;
	
	//$db = new PDO('mysql:host=localhost;dbname=test', 'root', '');
	//$registry->set('db', $db);
	/*
	$template = new Template($registry);
	$registry->set('template', $template);*/

	$router = new Router($registry);
	$registry->set('router', $router);
	$router->setPath(site_path . 'controllers');
	$router->delegate();

	