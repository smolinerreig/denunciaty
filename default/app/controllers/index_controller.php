<?php

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
		} else {
			
		}
		
		Redirect::to ( 'index' );
	}
}
