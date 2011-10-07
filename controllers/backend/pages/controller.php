<?

	class PagesController extends backendController{
		
		public function execute(){
		}
		
		public function executeList(){
		
			$pages = Page::getList();
			
			$response = new Response();
			$response->list = array();
			
			foreach($pages as $key => $value){
				$data = new Response();
				$data->id = $value['id'];
				$data->pid =  $value['parent_id'];
				$data->title = $value['title'];
				$data->name = $value['name'];
				$data->content = $value['content'];
				$data->created_at = $value['created_at'];
				array_push($response->list, $data);
			}
			
			$response->json();
		}
		
		public function executeUpdate(){
		
		}

	}


?>