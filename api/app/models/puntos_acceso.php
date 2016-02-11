<?php class PuntosAcceso extends ActiveRecord {
    public function getTodos() {
        return $this->find_all_by_sql('SELECT * FROM puntos_acceso');
    }
}