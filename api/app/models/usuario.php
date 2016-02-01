<?php

class Usuario extends ActiveRecord {
	public function getUsuario($id) {
		$us = $this->find_by_sql ( 'SELECT * FROM usuario WHERE id = ' . $id . '' );
		if (count ( $us ) > 0) {
			return $us;
		}
	}
	public function getUsuarioByEmail($email){
		$us = $this->find_by_sql ( 'SELECT * FROM usuario WHERE email = "' . $email . '"' );
		if (count ( $us ) > 0) {
			return $us;
		}
	}
	public function getTodos() {
		return $this->find_all_by_sql ( 'SELECT * FROM usuario' );
	}
	public function createUsuario($nombre, $apellidos, $nombre_usuario, $email, $password, $foto = null, $admin, $localidad) {
		if($this->checkUsuario($nombre_usuario, $email)==0){
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
			$us = $usuario->create ();
			if ($us == true) {
				return $us;
			} else {
				return '0';
			}
		}else{
			return '00';
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
	public function deleteUsuario($id) {
		$repo = new Reporte ();
		$usuario = $this->find ( $id );
		if ($usuario == true) {
			$delRep = $repo->deleteUsuarioReportes ( $id );
			return $usuario->delete ( $id );
		} else {
			return '0';
		}
	}
	public function editPassword($id, $old_pass, $new_pass) {
		$usuario = $this->find ( $id );
		if (sha1 ( $old_pass ) == $usuario->password) {
			$usuario->password = sha1 ( $new_pass );
			if ($usuario->update () == true) {
				return $usuario->update ();
			} else {
				return '00';
			}
		} else {
			return '0';
		}
	}
	public function checkUsuario($nombre_usuario, $email){
		$us1=$this->exists('email="'.$email.'"');
		$us2=$this->exists('nombre_usuario="'.$nombre_usuario.'"');
		$error=[];
		$cont=0;
		if($us1!=0){
			$error[]='email';
			$cont++;
		}
		if($us2!=0){
			$error[]='nombre_usuario';
			$cont++;			
		}
		if($cont==0){
			return 0;
		}else{
			return $error;
		}
		
	}
}
?>
