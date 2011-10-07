<?php

class Response{
	protected $errors = array();
	
	public function json(){
		header("Content-type: text/html; charset=utf-8");
		if(count($this->errors) > 0){
			if(count($this->errors) == 1){
				$this->error = $this->errors[0];
			}else{
				$this->error = array();
				foreach($this->errors as $error){
					array_push($this->error,$error);
				}
			}
		}
		print json_encode($this);
		exit;
	}
	
	public function error($string){
		array_push($this->errors,$string);
		return $this;
	}
}