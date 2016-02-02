<?php
Load::model('usuario');
/**
 * Controller por defecto si no se usa el routes
 *
 */
class IndexController extends AppController {
	public function index() {
	}
	
	public function login() {
		View::select ( 'null' );
		
		if (Input::hasPost ( 'usuario' ) && Input::hasPost ( 'password' )) {
			$us = new Usuario ();
			$log=$us->login ($_POST);
			if($log){
				Flash::valid('Bienvenido a la administración de Denúnciaty.');
			}else{
				Flash::error('Sus datos no constan en el registro de administradores');
			}
		} else {
			Flash::error('Introduzca usuario y contraseña válidos para hacer login.');
		}
		
		Redirect::to ( 'index' );
	}
	
	public function logout(){
		View::select ( 'null' );
		$us = new Usuario ();
		if($us->logout()==true){
			Flash::valid('Se ha cerrado su sesión.');
		}else{
			Flash::error('No ha podido cerrarse la sesión. Inténtelo de nuevo.');
		}
		Redirect::to ( 'index' );
		
	}
}
