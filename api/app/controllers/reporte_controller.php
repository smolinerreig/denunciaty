<?php 
Load::models('usuario', 'reporte', 'puntos_acceso');

/**
 * Controller por defecto si no se usa el routes
 */
class ReporteController extends AppController {
    /**
     * Carga el template y elimina las vistas
     */
    public function before_filter() {
        View::template("json");
        View::select(null);
    }
    /**
     * Accion por defecto, devuelve todos los reportes
     *
     * Ejemplo: http://denunciaty/api/reporte
     */
    public function index() {
        $repo = new Reporte();
        $this->data = $repo->getTodos();
    }
    /**
     * Devuelve los datos del reporte
     * Ejemplo: http://denunciaty/api/reporte/datos/2
     * 
     * Para recibir reportes por tipo, poner 0 como valor de id y la id del tipo en $tipo_id
     * Ejemplo: http://denunciaty/api/reporte/datos/0/1
     *
     * @param int $id        	
     */
    public function datos($id = null, $tipo_id = null) {
        $repo = new Reporte();
        if ($id == 0 || $id == null) {
            if ($tipo_id != null) {
                $this->data = $repo->getReporteByTipo($tipo_id);
            }
        } else {
            $this->data = $repo->getReporte($id);
        }
    }
    /**
     * Inserta un nuevo reporte en la base de datos
     * El parámertro $foto es el path donde se encuentra la foto que el usuario elija subir.
     * Todos los parámetros son necesarios
     *
     * Ejemplo: http://denunciaty/api/reporte/nuevo/Masacre en Fuentelidiota/Han palmado chorrocientos gatos al indigestarse comiendo conejo/1/Fuentelidiota/2/5/0
     * Si no se desea subir foto se recomiento dar valor 0.
     * 
     * Si se quisiera obtener longitud y latitud aleatorios habría que insertar "x" en el campo longitud y "y en latitud"
     * Ejemplo: http://denunciaty/api/reporte/nuevo/Accidente/Uno muy gordo/2/Una calle/x/y/1/23/foto 
     *
     * @param string $titulo        	
     * @param string $foto        	
     * @param string $descripcion        	
     * @param int $gravedad_id        	
     * @param string $ubicacion        	
     * @param int $tipo_id        	
     * @param int $usuario_id        	
     */
    public function nuevo($titulo, $descripcion, $ubicacion, $longitud = null, $latitud = null, $tipo_id, $usuario_id, $foto) {
        $repo = new Reporte();
        if ($longitud == 'x') {
            $longitud = Reporte::getRandomCoordinates()[0];
        }
        if ($latitud == 'y') {
            $latitud = Reporte::getRandomCoordinates()[1];
        }
        $crear = $repo->createReporte($titulo, str_replace('+', '/', $foto), $descripcion, $ubicacion, $longitud, $latitud, $tipo_id, $usuario_id);
        if ($crear == false) {
            $this->data = '0';
        } else {
            $this->data = $crear;
        }
    }
}