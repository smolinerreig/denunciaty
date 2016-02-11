<?php
class Reporte extends ActiveRecord {
	function getReporte($id) {
		$repo = $this->find_by_sql ( 'SELECT * FROM reporte WHERE id = ' . $id . ';' );
		if (count ( $repo ) > 0) {
			return $repo;
		}
	}
    public function getTodosSinPaginar() {
		$reps=$this->find_all_by_sql ( 'SELECT * FROM reporte ORDER BY inicio_at ASC');
        return $reps;
	}
    
	public function getTodos($page) {
		return $this->paginate_by_sql ( 'SELECT * FROM reporte','per_page:10',"page: $page");
	}
	
	public function getReportesByUsuario($id) {
		return $this->find_all_by_sql ( 'SELECT * FROM reporte WHERE usuario_id = ' . $id . ' ORDER BY inicio_at DESC;' );
	}
	
	public function deleteReporte($id){
		if($this->exists($id)){
			return $this->delete($id);
		}else{
			return false;
		}
		
	}

	public function deleteUsuarioReportes($id) {
		$repo = $this->getReportesByUsuario ( $id );
		foreach ( $repo as $r ) {
			$this->delete( $r->id );
		}
		return true;
	}
	
	public function updateReporte($id, $campos){
		$rep=$this->find($id);
		if (isset ( $campos )) {
			if ($campos ['titulo'] != '') {
				$rep->titulo = $campos ['titulo'];
			}
			if ($campos ['foto'] != '') {
				$rep->foto = $campos ['foto'];
			}
			if ($campos ['descripcion'] != '') {
				$rep->descripcion = $campos ['descripcion'];
			}
			if ($campos ['longitud'] != '') {
				$rep->longitud = $campos ['longitud'];
			}
			if ($campos ['latitud'] != '') {
				$rep->latitud = $campos ['latitud'];
			}
			if ($campos ['ubicacion'] != '') {
				$rep->ubicacion = $campos ['ubicacion'];
			}
			if ($campos ['tipo'] != '') {
				$rep->tipo_id = $campos ['tipo'];
			}
			if ($campos ['solucionado'] != '') {
				$rep->solucionado = $campos ['solucionado'];
			}
			if ($campos ['caducidad'] != '') {
				$rep->caducidad_at = $campos ['caducidad'];
			}
			$r = $rep->update ();
			if ($r != false) {
				return $r;
			} else {
				return false;
			}
		} else {
			return false;
		}
		
	}
}
?>