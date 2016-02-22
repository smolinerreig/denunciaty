<?php
class Reporte extends ActiveRecord {
	function getReporte($id) {
		$repo = $this->find_by_sql ( 'SELECT * FROM reporte WHERE id = ' . $id . ';' );
		if (count ( $repo ) > 0) {
			return $repo;
		}
	}
	public function getTodos() {
		return $this->find_all_by_sql ( 'SELECT * FROM reporte' );
	}
	public function createReporte($titulo, $foto = null, $descripcion, $ubicacion, $longitud = null, $latitud = null, $tipo_id, $usuario_id) {
		$repo = new Reporte ();
		$repo->titulo = $titulo;
		$fecha = new DateTime ();
		
		if ($foto != '0') {
			$repo->foto = $foto;
		}
		$repo->descripcion = $descripcion;
		$repo->ubicacion = $ubicacion;
		$repo->longitud = $longitud;
		$repo->latitud = $latitud;
		$repo->tipo_id = $tipo_id;
		$repo->usuario_id = $usuario_id;
		$repo->solucionado = 0;
		$repo->caducidad_at = date_add ( $fecha, date_interval_create_from_date_string ( '10 days' ) );
		$rep = $repo->create ();
		if ($rep == true) {
			return true;
		} else {
			return '0';
		}
	}
	public function getReportesByUsuario($id) {
		return $this->find_all_by_sql ( 'SELECT * FROM reporte WHERE usuario_id = ' . $id . ' ORDER BY inicio_at DESC;' );
	}
	public function deleteUsuarioReportes($id) {
		$repo = $this->getReportesByUsuario ( $id );
		foreach ( $repo as $r ) {
			$this->delete ( $r->id );
		}
		return true;
	}
	public function getReporteByTipo($tipo_id) {
		$repo = $this->find_all_by_sql ( 'SELECT * FROM reporte WHERE tipo_id=' . $tipo_id );
		return $repo;
	}
	public static function getRandomCoordinates() {
		$long = rand ( - 18000000, 18000000 ) / 100000;
		$lat = rand ( - 9000000, 9000000 ) / 100000;
		$coord [] = $long;
		$coord [] = $lat;
		return $coord;
	}
}
?>