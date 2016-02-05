<?php
Load::model('reporte');
class Usuario extends ActiveRecord {
	public function login($post) {
		$usuario = $post ['usuario'];
		$password = sha1 ( $post ['password'] );
		$auth = new Auth ( "model", "class: Usuario", "nombre_usuario: {$usuario}", "password: {$password}" );
		$admin = $this->find_by_sql ( 'SELECT * FROM usuario WHERE nombre_usuario="' . $usuario . '"' );
		if ($admin->admin == 1) {
			if ($auth->authenticate ()) {
				if (Auth::get ( 'admin' ) == 1) {
					return true;
				}
			} else {
				return false;
			}
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
	public function getTodos($page, $per_page) {
		$sql = 'SELECT * FROM usuario';
		return $this->paginate_by_sql ( 'SELECT * FROM usuario', "per_page: $per_page", "page: $page" );
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
	public function banear($id) {
		$usuario = $this->find ( $id );
		$fecha = date ( 'Y-m-j' );
		$nuevafecha = strtotime ( '+30 day', strtotime ( $fecha ) );
		$nuevafecha = date ( 'Y-m-j', $nuevafecha );
		
		$usuario->dac = $nuevafecha;
		$usuario->update ();
		return $nuevafecha;
	}
	public function getdac($id) {
		$usuario = $this->find ( $id );
		if ($usuario->dac == null) {
			return false;
		} else {
			return $usuario->dac;
		}
	}
	public function operatedac($id, $dac) {
		$usuario=$this->find($id);
		$datedac=explode('-', date('Y-m-j',$dac));
		$date=explode('-',date('Y-m-j'));
		$fechadac=gregoriantojd(intval($datedac[1]), intval($datedac[2]), intval($datedac[0]));
		$fecha=gregoriantojd(intval($date[1]), intval($date[2]), intval($date[0]));
		if($fechadac-$fecha<=0){
			$usuario->dac='';
			return $usuario->update();
		}else{
			return false;
		}
	}
     
    public function getReportes($id, $page){
        return $this->paginate_by_sql ( 'SELECT * FROM reporte WHERE usuario_id='.$id, "per_page: 10", "page: $page" );
    }
}