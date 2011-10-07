<?	
	class Template{

		protected $registry;

		protected $vars = array();
	

		function __construct($registry) {

			$this->registry = $registry;
			

		}
	
		public function show($name, $vars){
			
		
			$path = $this->registry->get('layout');
			
			if (!file_exists($path)) {
					trigger_error ('Template `' . $name . '` does not exist.', E_USER_NOTICE);
					return false;
			}
			
			// Load variables
			if(is_array($vars)) foreach($vars as $key => $value) ${$key} = $value;	
			$template = $this->registry->get('cmd_path') . 'template.php';
			$module = $this->registry->get('module');
			include ($path);               
		}

	}