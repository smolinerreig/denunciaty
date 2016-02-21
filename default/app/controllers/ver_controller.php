<?php
Load::model('reporte','tipo');
 
class VerController extends AppController {
	public function index($id) {
		$rep=new Reporte();
		$this->data=$rep->getReporte($id);
	}
}
