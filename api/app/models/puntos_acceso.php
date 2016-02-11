<?php class Puntos_acceso extends ActiveRecord {
    public function getJson($json) {
        foreach($json->features as $j) {
            $p=new Puntos_acceso();
            $p->descripcion=$j->properties->descripcion;
            $p->latitud=$j->geometry->coordinates[0];
            $p->longitud=$j->geometry->coordinates[1];
            $p->create();
        }
    }
}