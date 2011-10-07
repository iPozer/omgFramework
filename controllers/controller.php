<?

class IndexController Extends Controller{

	public function preExecute(){
		
	}
	
	public function index(){
	    
		return array('arr' => array(1,2,3,4,56));
	}


}


?>