<?php
Load::model('reporte');
/**
 * Controller por defecto si no se usa el routes
 *
 */
class VerController extends AppController {
	public function index($id) {
		$rep=new Reporte();
		$this->data=$rep->getReporte($id);
	}
}
