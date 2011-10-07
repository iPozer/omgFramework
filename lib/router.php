<?
	class Router{

		protected $registry;
		protected $file;
		protected $action;
		protected $application;
		protected $module;
		protected $controller;

		protected $path;

		protected $args = array();


		public function __construct($registry){

			$this->registry = $registry;

		}
		
		public function setPath($path){
			$path = trim($path, '/\\');
			$path .= DIRSEP;

			if (is_dir($path) == false) {
				throw new Exception ('Invalid controller path: `' . $path . '`');
			}
			$this->path = $path;
		}
		
		public function delegate(){

			// Анализируем путь
			$this->getController();
		
			if(!is_readable($this->file)){
				die ('404 Not Found');
			}
			
			// Подключаем файл
			include($this->application . "controller.php");
			if($this->file != $this->application . "controller.php") include($this->file);
			
			$layout = $this->application . "layout.php";
			$this->registry->set('layout', $layout);
			
			
			
			// Создаём экземпляр контроллера
			$class = $this->controller . "Controller";
			
			$controller = new $class($this->registry);
			
			// Действие доступно?
			if(!is_callable(array($controller, $this->action))){
				print('404 Not Found');
			}
			
			if(is_callable(array($controller, 'preExecute'))) $pre_result = $controller->preExecute();
			$action = $this->action;
			
			// Calling $action method of $controller's class and get nessesary varaibles for template
			$result = $controller->$action();
			
			if(isset($pre_result) && isset($result)){$result = array_merge($pre_result, $result);}else{$result = $pre_result;}
			
			$template = new Template($this->registry);
			$template->show($this->action, $result);
		}
		
		protected function getController(){

			$route = (empty($_GET['route'])) ? '' : $_GET['route'];
			
			if (!$route) { $route = 'index'; }

			// Получаем раздельные части

			$route = trim($route, '/\\');
			$parts = explode('/', $route);
		
			// Находим правильный контроллер
			$cmd_path = $this->path;
			
			$route = $parts;
			
			$parts[0] = ($parts[0] != 'admin') ? 'frontend' : 'backend';
			
			$this->application = $cmd_path . $parts[0] . DIRSEP;
	
			foreach($parts as $part){
						
				$fullpath = $cmd_path . $part;
							
				// Есть ли папка с таким путём?
				if (is_dir($fullpath)){
					$cmd_path .= $part . DIRSEP;
					array_shift($parts);
					$this->module = $part;
					continue;
				}
				
				if(is_file($fullpath . DIRSEP . "indexController.php")){
					$this->controller = $part;
					array_shift($parts);
					break;
				}

			}
			
			if(!isset($this->controller)){ $this->controller = $this->module; }
			
		
			// Получаем действие

			$action = array_shift($parts);
			
			$action = (empty($action)) ? 'index' : 'execute' . $action;
			
			
			$this->action = $action;
			
			
			$this->registry->set('cmd_path', $cmd_path);
			
			$this->registry->set('module', $this->module);
			
			$this->file = $cmd_path . 'controller.php';
			
			$this->args = $parts;
				
		}

	}


?>