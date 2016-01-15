<?php
class Reporte extends ActiveRecord {
	function getReporte($id) {
		$repo = $this->find_by_sql ( 'SELECT * FROM reporte WHERE id = ' . $id . ';' );
		if (count ( $repo ) > 0) {
			return $repo;
		}
	}
	public function getTodos() {
		return $this->find_by_sql ( 'SELECT * FROM reporte;' );
	}
	public function createReporte($titulo, $foto = null, $descripcion, $gravedad_id, $ubicacion, $tipo_id, $usuario_id) {
		$repo = new Reporte ();
		$repo->titulo = $titulo;
		if ($foto != '0') {
			$repo->foto = $foto;
		}
		$repo->descripcion = $descripcion;
		$repo->gravedad_id = $gravedad_id;
		$repo->ubicacion = $ubicacion;
		$repo->tipo_id = $tipo_id;
		$repo->usuario_id = $usuario_id;
		$repo->solucionado = 0;
		return $repo->create ();
	}
	public function getReportesByUsuario($id) {
		return $this->find_all_by_sql ( 'SELECT * FROM reporte WHERE usuario_id = ' . $id . ' ORDER BY inicio_at DESC;' );
	}
}
?>