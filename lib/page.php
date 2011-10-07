<?
	class Page extends db{
		
		public static function getList($c = null){
			$sql = 'SELECT * FROM `page`';
			if($c) $sql.= $c;
			
			return self::doSelect($sql);
		}


	}


?>