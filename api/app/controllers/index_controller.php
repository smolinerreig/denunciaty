<?php
Load::model('puntos_acceso');
/**
 * Controller por defecto si no se usa el routes
 * 
 */
class IndexController extends AppController
{
public function before_filter() {
		View::template ( "json" );
		View::select ( null );
	}
    
    public function puntos(){
        $puntos=new PuntosAcceso();
        $this->data=$puntos->getTodos();
    }

}
