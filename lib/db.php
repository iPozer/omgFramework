<?

	class db{
		
		protected function connection(){
			$user = 'root';
			$password = '';
			$host = 'localhost';
			$db = mysql_connect($host, $user, $password);
			mysql_select_db("test", $db);
			return $db;
		}
		
		public static function doSelect($sql){
			
			$query = mysql_query($sql, self::connection());
	
			while($page = mysql_fetch_array($query, MYSQL_ASSOC)){
				$pages[] = $page;
			}
			
			return $pages;
		}

	}