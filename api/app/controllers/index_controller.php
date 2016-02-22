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

    /*
    *Devuelve todo los puntos de acceso WIFI.
    *Ejemplo: http://denunciaty/api/index/puntos
    */
    public function puntos(){
        $puntos=new PuntosAcceso();
        $this->data=$puntos->getTodos();
    }

}
