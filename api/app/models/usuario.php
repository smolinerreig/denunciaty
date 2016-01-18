<?php
class Usuario extends ActiveRecord {
	public function getUsuario($id) {
		$us = $this->find_by_sql ( 'SELECT * FROM usuario WHERE id = ' . $id . '' );
		if (count ( $us ) > 0) {
			return $us;
		}
	}
	public function getTodos() {
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
		if ($foto != null && $foto != '') {
			$usuario->foto = $foto;
		} else {
			$usuario->foto = '0';
		}
		$usuario->admin = $admin;
		if($usuario->create ()==true){
			return $usuario->create;
		}else{
			return '0';
		}
	}
	public function editUsuario($id, $campos = null) {
		$usuario = $this->find ( $id );
		if ($usuario == true) {
			if (isset ( $campos )) {
				if ($campos ['nombre']) {
					$usuario->nombre = $campos ['nombre'];
				}
				if ($campos ['apellidos']) {
					$usuario->apellidos = $campos ['apellidos'];
				}
				if ($campos ['nombre_usuario']) {
					$usuario->nombre_usuario = $campos ['nombre_usuario'];
				}
				if ($campos ['email']) {
					$usuario->email = $campos ['email'];
				}
				if ($campos ['localidad']) {
					$usuario->localidad = $campos ['localidad'];
				}
				$us = $usuario->update ();
				if ($us != false) {
					return $us;
				} else {
					return false;
				}
			} else {
				return '00';
			}
		} else {
			return '0';
		}
	}
}
?>
