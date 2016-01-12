<?php

/**
 * Controller por defecto si no se usa el routes
 *
 */
class UsuarioController extends AppController
{

    public function before_filter(){
        View::template("json");
        View::select(null);
    }

    public function index(){
        $usuario=new Usuario();
        $this->data=$usuario->getTodos();
    }

    public function datos($id=null)
    {
        $usuario=new Usuario();
            if($id==0 || $id==null){
                $this->data=$usuario->getTodos();
            }else{
                 $this->data=$usuario->getUsuario($id);
            }
    }

    public function nuevo($nombre, $apellidos, $nombre_usuario, $email, $password, $foto, $admin){
        $usuario=new Usuario();

        $crear=$usuario->createUsuario($nombre, $apellidos, $nombre_usuario, $email, $password, $foto, $admin);
        if($crear==false){
            $this->data="Ha habido un error procesando su solicitud.";
        }else{
            $this->data=$crear;
        }

    }



}
