<?php
function mysql_fix_string($string){
	if (get_magic_quotes_gpc()){
		$string =stripslashes($string);
	} else {
		return mysql_real_escape_string($string);
	}
}

?>