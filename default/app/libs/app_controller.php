<?php
/**
 * @see Controller nuevo controller
 */
require_once CORE_PATH . 'kumbia/controller.php';

/**
 * Controlador principal que heredan los controladores
 *
 * Todas las controladores heredan de esta clase en un nivel superior
 * por lo tanto los metodos aqui definidos estan disponibles para
 * cualquier controlador.
 *
 * @category Kumbia
 * @package Controller
 */
class AppController extends Controller {
	final protected function initialize() {
		if(Router::get('controller')!='index' && !Auth::is_valid()){
			Flash::error('Necesita ser un administrador e iniciar sesión para acceder a esta zona.');
			Redirect::to('index');
		}
	}
	final protected function finalize() {
	}
}
