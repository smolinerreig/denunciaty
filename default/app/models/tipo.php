<?php
class Tipo extends ActiveRecord{
    public function getTipos(){
        return $this->find_all_by_sql('SELECT * FROM tipo;');
    } 
}