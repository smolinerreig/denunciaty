<?php
class Usuario extends ActiveRecord {
	public function login($post) {
		$usuario = $post ['usuario'];
		$password = sha1 ( $post ['password'] );
		
		$auth = new Auth ( "model", "class: Usuario", "nombre_usuario: {$usuario}", "password: {$password}" );
		if ($auth->authenticate ()) {
			return true;
		} else {
			return false;
		}
	}
	public function logout() {
		Auth::destroy_identity ();
		return true;
	}
}