<?php
Load::models ( 'usuario', 'reporte' );
/**
 * Controller por defecto si no se usa el routes
 */
class UsuariosController extends AppController {
	public function index() {
		$usuario = new Usuario ();
		$this->data = $usuario->getTodos ();
	}
	public function ver($id = null) {
		$usuario = new Usuario ();
		$this->data = $usuario->getUsuario ( $id );
	}
	public function editar($id = null) {
		$usuario = new Usuario ();
		if (! $_POST) {
			$this->data = $usuario->getUsuario ( $id );
		} else {
			if ($usuario->editUsuario ( $id, $_POST ) == 1) {
				Flash::valid ( 'Los datos de usuario se han actualizado con éxito.' );
				Redirect::to ( 'index' );
			} else {
				Flash::error ( 'No se ha podido actualizar los datos. Reinténtelo de nuevo.' );
				Redirect::to ( 'usuarios/index' );
			}
		}
	}
	public function nuevo() {
		$usuario = new Usuario ();
		if ($_POST) {
			if ($usuario->createUsuario ( $_POST ) == 1) {
				Flash::valid ( 'El nuevo usuario ha sido creado.' );
				Redirect::to ( 'index' );
			} else {
				Flash::error ( 'No se ha podido crear el nuevo usuario' );
				Redirect::to ( 'usuarios/index' );
			}
		}
	}
	public function reps($id) {
		$reportes = new Reporte ();
		if ($reportes->getReportesByUsuario ( $id )) {
		}
	}
	public function eliminar($id) {
		View::select ( null );
		$usuario = new Usuario ();
		if ($usuario->deleteUsuario ( $id ) == 1) {
			Flash::valid ( 'El usuario ha sido eliminado.' );
			Redirect::to ( 'index' );
		} else {
			Flash::error ( 'No se ha podido eliminar el usuario. Reintentelo de nuevo.' );
			Redirect::to ( 'usuarios/index' );
		}
	}
}
