<?
class Registry{

    protected $vars = array();
	
	public function set($key, $var){

        if (isset($this->vars[$key])){
            throw new Exception('Unable to set var `' . $key . '`. Already set.');
        }

        $this->vars[$key] = $var;

        return true;
	}

	public function getVars(){
		return $this->vars;
	}
	public function get($key) {

		if (!$this->vars[$key]) {
				return null;
		}

		return $this->vars[$key];
	}


	public function remove($var) {

		unset($this->vars[$key]);

	}

}