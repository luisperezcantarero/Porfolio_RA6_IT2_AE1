<?php
namespace App\Models;

class Skills extends DBAbstractModel {
    private static $instancia;

    public static function getInstancia() {
            if (!isset(self::$instancia)) {
                $miclase = __CLASS__;
                self::$instancia = new $miclase();
            }
            return self::$instancia;
    }

    public function getAll($id) {
        $this->query = "SELECT * FROM skills WHERE id_usuario = :id";
        $this->parametros['id'] = $id;
        $this->get_results_from_query();
        return $this->rows ?? "";
    }

    public function get($id) {
        $this->query = "SELECT * FROM skills WHERE id = :id";
        $this->parametros['id'] = $id;
        $this->get_results_from_query();
        return $this->rows ?? "";
    }

    public function set($datos) {
        $this->query = "INSERT INTO skills (nombre, id_usuario) VALUES (:nombre, :id_usuario)";
        $this->parametros = [
            'nombre' => $datos['nombre'],
            'id_usuario' => $datos['id_usuario']
        ];
        $this->get_results_from_query();
    }

    public function edit($id, $datos) {
        $this->query = "UPDATE skills SET nombre = :nombre WHERE id = :id";
        $this->parametros = [
            'id' => $id,
            'nombre' => $datos['nombre']
        ];
        $this->get_results_from_query();
    }

    public function delete($id) {
        $this->query = "DELETE FROM skills WHERE id = :id";
        $this->parametros['id'] = $id;
        $this->get_results_from_query();
    }
}
?>