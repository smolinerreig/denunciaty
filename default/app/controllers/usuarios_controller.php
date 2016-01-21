<?php

/**
 * Controller por defecto si no se usa el routes
 *
 */
class UsuariosController extends AppController {
	public function index() {
		$usuario = new Usuario ();
		$this->data = $usuario->getTodos ();
	}
	/**
	 * Devuelve los datos del usuario
	 * Si no se pasa el parámetro $id devuelve todos los usuarios;
	 *
	 * Ejemplo: http://denunciaty/api/usuario/datos/3
	 *
	 * @param int $id        	
	 */
	public function ver($id = null) {
		$usuario = new Usuario ();
		
		// $this->data = $usuario->getUsuario ( $id );
		
		echo '<pre>';
		print_r ( $_GET );
		exit ();
	}
	/**
	 * Introduce un nuevo usuario en la base de datos
	 * El parámertro $foto es el path donde se encuentra la foto que el usuario elija subir.
	 * Todos los parámetros son necesarios
	 *
	 * Ejemplo: http://denunciaty/api/usuario/nuevo/Jonah/J. Jameson/jonahmson/j.jameson@gmail.com/notieneninguna/0/1/New+York
	 * Si no se quiere introducir foto, recomiendo escribir 0 como parámetro
	 *
	 * @param string $nombre        	
	 * @param string $apellidos        	
	 * @param string $nombre_usuario        	
	 * @param string $email        	
	 * @param string $password        	
	 * @param string $foto        	
	 * @param int $admin
	 *        	(0-1)
	 * @param string $localidad        	
	 */
	public function nuevo($nombre, $apellidos, $nombre_usuario, $email, $password, $foto, $admin, $localidad) {
		$usuario = new Usuario ();
		$this->data = $usuario->createUsuario ( $nombre, $apellidos, $nombre_usuario, $email, $password, $foto, $admin, $localidad );
	}
	/**
	 * Devuelve un array con los reportes creados por un usuario
	 *
	 * Ejemplo: http://denunciaty/api/usuario/reps/5
	 *
	 * @param int $id        	
	 */
	public function reps($id) {
		$reportes = new Reporte ();
		$this->data = $reportes->getReportesByUsuario ( $id );
	}
	
	/**
	 * Permite modificar ciertos datos en el registro de un usuario.
	 * Dichos datos son nombre, apellidos, nombre_usuario, email, localidad
	 * Ha de emplearse el protocolo get.
	 *
	 * Ejemplo: http://denunciaty/api/usuario/editar?nombre=Wade&apellidos=Wilson+Pooliard&nombre_usuario=&email=ded.pul@chimimail.com&localidad=New+York.
	 * Los espacios se traducen como '+' (localidad y apellidos en el ejemplo).
	 * Si un campo no desea cambiarse se dejará sin valor (nombre_usuario en el ejemplo).
	 * Password y foto no se pueden cambiar en esta función.
	 *
	 * @param int $id        	
	 */
	public function editar($id) {
		$usuario = new Usuario ();
		$this->data = $usuario->editUsuario ( $id, $_GET );
	}
	public function borrar($id) {
		$usuario = new Usuario ();
		$this->data = $usuario->deleteUsuario ( $id );
	}
	public function cambiarPass($id, $old_pass, $new_pass) {
		$usuario = new Usuario ();
		$this->data = $usuario->editPassword ( $id, $old_pass, $new_pass );
	}
}
