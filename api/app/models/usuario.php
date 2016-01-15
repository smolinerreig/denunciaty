<?php
class Usuario extends ActiveRecord {
	public function getUsuario($id) {
		$us = $this->find_by_sql ( 'SELECT * FROM usuario WHERE id = ' . $id . '' );
		if (count ( $us ) > 0) {
			return $us;
		}
	}
	public function getTodos() {
//cosas
		return $this->find_all_by_sql ( 'SELECT * FROM usuario' );
	}
	public function createUsuario($nombre, $apellidos, $nombre_usuario, $email, $password, $foto = null, $admin, $localidad) {
		$usuario = new Usuario ();
		$usuario->nombre = $nombre;
		$usuario->apellidos = $apellidos;
		$usuario->nombre_usuario = $nombre_usuario;
		$usuario->email = $email;
		$usuario->password = sha1 ( $password );
		$usuario->localidad = $localidad;
		if ($foto != '0') {
			$usuario->foto = $foto;
		}
		$usuario->admin = $admin;
		return $usuario->create ();
	}
	
	public function uploadImage(){
		
	}
}
?>
