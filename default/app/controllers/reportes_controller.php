<?php
Load::models ( 'usuario', 'reporte' );
/**
 * Controller por defecto si no se usa el routes
 */
class ReportesController extends AppController {
	public function index($page = null) {
		
	}
    
    public function usuario($id, $page=null){
        if($page==null){
            $page=1;
        }
        $us=new Usuario();
        $rep=new Reporte();
        $this->data=$us->getReportes($id,$page);
    }
}
