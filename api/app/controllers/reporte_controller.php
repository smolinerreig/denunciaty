<?php

/**
 * Controller por defecto si no se usa el routes
 *
 */
class ReporteController extends AppController
{

    public function before_filter(){
        View::template("json");
        View::select(null);
    }

    public function index(){
        $repo=new Reporte();
        $this->data=$repo->getTodos();
    }

    public function datos($id=null)
    {
        $repo=new Reporte();
            if($id==0 || $id==null){
                $this->data=$repo->getTodos();
            }else{
                 $this->data=$repo->getReporte($id);
            }
    }

    public function nuevo(){
        $repo=new Reporte();
        $crear=$repo->createReporte();

        if($crear==false){
            $this->data="Ha habido un error procesando su solicitud.";
        }else{
            $this->data=$crear;
        }

    }



}
