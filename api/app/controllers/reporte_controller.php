<?php

/**
 * Controller por defecto si no se usa el routes
 *
 */
class ReporteController extends AppController {
	/**
	 * Carga el template y elimina las vistas
	 */
	public function before_filter() {
		View::template ( "json" );
		View::select ( null );
	}
	/**
	 * Accion por defecto, revuelve todos los reportes
	 */
	public function index() {
		$repo = new Reporte ();
		$this->data = $repo->getTodos ();
	}
	/**
	 * Devuelve los datos del reporte
	 * 
	 * @param int $id        	
	 */
	public function datos($id = null) {
		$repo = new Reporte ();
		if ($id == 0 || $id == null) {
			$this->data = $repo->getTodos ();
		} else {
			$this->data = $repo->getReporte ( $id );
		}
	}
	/**
	 * Inserta un nuevo reporte en la base de datos
	 * El parámertro $foto es el path donde se encuentra la foto que el usuario elija subir.
	 * Todos los parámetros son necesarios
	 * 
	 * @param string $titulo        	
	 * @param string $foto        	
	 * @param string $descripcion        	
	 * @param int $gravedad_id        	
	 * @param string $ubicacion        	
	 * @param int $tipo_id        	
	 * @param int $usuario_id        	
	 */
	public function nuevo($titulo, $descripcion, $gravedad_id, $ubicacion, $tipo_id, $usuario_id, $foto) {
		$repo = new Reporte ();
				
		$crear = $repo->createReporte ( $titulo, str_replace('+', '/',$foto), $descripcion, $gravedad_id, $ubicacion, $tipo_id, $usuario_id );
		if ($crear == false) {
			$this->data = '0';
		} else {
			$this->data = $crear;
		}
	}
}
