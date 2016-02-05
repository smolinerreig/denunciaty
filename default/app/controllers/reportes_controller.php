<?php
Load::models ( 'usuario', 'reporte','tipo' );
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
    
    public function ver($id){
        $us=new Usuario();
        $rep= new Reporte();
        $this->data=$rep->getReporte($id);
        $this->usuario=$us->getUsuario($this->data->usuario_id);
    }
    
    public function editar($id){
        $rep=new Reporte();
        $us=new Usuario();
        $tip=new Tipo();
        if(!$_POST){
           $this->data=$rep->getReporte($id);
           $this->usuario=$us->getUsuario($this->data->usuario_id);
           $this->tipos=$tip->getTipos();
        }else{
            
        }
    }
}
