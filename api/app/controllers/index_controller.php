<?php
Load::model ( 'puntos_acceso' );
/**
 * Controller por defecto si no se usa el routes
 */
class IndexController extends AppController {
	public function before_filter() {
		View::template ( "json" );
		View::select ( null );
	}
	public function index() {
		View::select ( null, null );
		$fecha2 = new DateTime ();
		$fecha1 = new DateTime ();
		$fecha2->add ( new DateInterval ( 'P30D' ) );
		print_r ( $fecha2->format ( 'Y-m-d' ) . "\n" );
		print_r ( $fecha1->format ( 'Y-m-d' ) . "\n" );
	}
	/*
	 * Devuelve todo los puntos de acceso WIFI.
	 * Ejemplo: http://denunciaty/api/index/puntos
	 */
	public function puntos() {
		$puntos = new PuntosAcceso ();
		$this->data = $puntos->getTodos ();
	}
}
