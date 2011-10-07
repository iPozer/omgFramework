<?
	class backendController extends Controller{
		
		public function preExecute(){
			if(!isset($sign)){
				//header('Location: /admin');
			}
			return array('sign' => "Жопа попа колбаса");
		}
		
		public function index(){
		
		}
	}
