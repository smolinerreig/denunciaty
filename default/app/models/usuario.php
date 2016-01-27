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
	public function getUsuario($id) {
		$us = $this->find_by_sql ( 'SELECT * FROM usuario WHERE id = ' . $id . '' );
		if (count ( $us ) > 0) {
			return $us;
		}
	}
	public function getTodos() {
		return $this->find_all_by_sql ( 'SELECT * FROM usuario' );
	}
	public function createUsuario() {
		$usuario = new Usuario ();
		$usuario->nombre = $_POST ['nombre'];
		$usuario->apellidos = $_POST ['apellidos'];
		$usuario->nombre_usuario = $_POST ['nombre_usuario'];
		$usuario->email = $_POST ['email'];
		$usuario->password = sha1 ( $_POST ['password'] );
		$usuario->localidad = $_POST ['localidad'];
		if ($_POST ['foto'] != null && $_POST ['foto'] != '') {
			$usuario->foto = $_POST ['foto'];
		} else {
			$usuario->foto = '0';
		}
		$usuario->admin = $_POST ['admin'];
		$us = $usuario->create ();
		if ($us == true) {
			return $us;
		} else {
			return '0';
		}
	}
	public function editUsuario($id, $campos = null) {
		$usuario = $this->find ( $id );
		if (isset ( $campos )) {
			if ($campos ['nombre'] != '') {
				$usuario->nombre = $campos ['nombre'];
			}
			if ($campos ['apellidos'] != '') {
				$usuario->apellidos = $campos ['apellidos'];
			}
			if ($campos ['nombre_usuario'] != '') {
				$usuario->nombre_usuario = $campos ['nombre_usuario'];
			}
			if ($campos ['email'] != '') {
				$usuario->email = $campos ['email'];
			}
			if ($campos ['localidad'] != '') {
				$usuario->localidad = $campos ['localidad'];
			}
			if ($campos ['password'] != '') {
				$usuario->password = sha1 ( $campos ['password'] );
			}
			if ($campos ['foto'] != '') {
				$usuario->foto = $campos ['foto'];
			}
			if ($campos ['admin'] != '') {
				$usuario->admin = $campos ['admin'];
			}
			$us = $usuario->update ();
			if ($us != false) {
				return $us;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	public function deleteUsuario($id) {
		$repo = new Reporte ();
		$usuario = $this->find ( $id );
		if ($usuario == true) {
			$delRep = $repo->deleteUsuarioReportes ( $id );
			return $usuario->delete ( $id );
		} else {
			return false;
		}
	}
}