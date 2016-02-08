<?php
class Tipo extends ActiveRecord{
    public function getTipos(){
        return $this->find_all_by_sql('SELECT * FROM tipo;');
    } 
    
    public function getNombre($id){
    	return $this->find_by_sql('SELECT nombre FROM tipo WHERE id='.$id);
    }
}