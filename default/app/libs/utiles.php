 <?php
	class Utiles {
		static function random_pass($n_char) {
			$str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
			$cad = "";
			for($i = 0; $i < $n_char; $i ++) {
				$cad .= substr ( $str, rand ( 0, 62 ), 1 );
			}
			return $cad;
		}
	}