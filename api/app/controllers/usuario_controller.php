<?php

/**
 * Controller por defecto si no se usa el routes
 *
 */
class UsuarioController extends AppController {
	/**
	 * Carga el template y elimina las vistas
	 */
	public function before_filter() {
		View::template ( "json" );
		View::select ( null );
	}
	/**
	 * Accion por defecto, revuelve todos los usuarios
	 */
	public function index() {
		$usuario = new Usuario ();
		$this->data = $usuario->getTodos ();
	}
	/**
	 * Devuelve los datos del usuario
	 *
	 * @param int $id        	
	 */
	public function datos($id = null) {
		$usuario = new Usuario ();
		if ($id == 0 || $id == null) {
			$this->data = $usuario->getTodos ();
		} else {
			$this->data = $usuario->getUsuario ( $id );
		}
	}
	/**
	 * Introduce un nuevo usuario en la base de datos
	 * Todos los parámetros son necesarios
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
		
		$crear = $usuario->createUsuario ( $nombre, $apellidos, $nombre_usuario, $email, $password, $foto, $admin, $localidad );
		if ($crear == false) {
			$this->data = "Ha habido un error procesando su solicitud.";
		} else {
			$this->data = $crear;
		}
	}
	/**
	 * Devuelve un array con los reportes creados por el usuario
	 * 
	 * @param int $id        	
	 */
	public function reps($id) {
		$reportes = new Reporte ();
		$this->data = $reportes->getReportesByUsuario ( $id );
	}
}
