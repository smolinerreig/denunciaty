<?php
Load::models ( 'usuario', 'reporte', 'tipo' );
/**
 * Controller por defecto si no se usa el routes
 */
class ReportesController extends AppController {
	public function index($page = null) {
		if ($page == null) {
			$page = 1;
		}
		$rep = new Reporte ();
		$tip = new Tipo ();
		$this->data = $rep->getTodos ( $page );
	}
	public function usuario($id, $page = null) {
		if ($page == null) {
			$page = 1;
		}
		$us = new Usuario ();
		$rep = new Reporte ();
		$this->data=$us->getReportes ( $id, $page );
		
	}
	public function ver($id) {
		$us = new Usuario ();
		$rep = new Reporte ();
		$this->data = $rep->getReporte ( $id );
		$this->usuario = $us->getUsuario ( $this->data->usuario_id );
	}
	public function editar($id) {
		$rep = new Reporte ();
		$us = new Usuario ();
		$tip = new Tipo ();
		if (! $_POST) {
			$this->data = $rep->getReporte ( $id );
			$this->usuario = $us->getUsuario ( $this->data->usuario_id );
			$this->tipos = $tip->getTipos ();
		} else {
			$r=$rep->updateReporte($id, $_POST);
			if($r!=false){
				Flash::success('Los datos del reporte han sido modificados.');
				Redirect::to('');
			}else{
				Flash::error('No han podido modificarse los datos del reporte.');
				Redirect::to('');
			}
		}
	}
	public function eliminar($id) {
		View::select ( null );
		$reporte = new Reporte ();
		$rep = $reporte->deleteReporte ( $id );
		if ($rep == false) {
			Flash::error ( 'No ha podido eliminarse el reporte.' );
			Redirect::to ( '' );
		} else {
			Flash::success ( 'El reporte se ha eliminado con éxito' );
			Redirect::to ( '' );
		}
	}
}
