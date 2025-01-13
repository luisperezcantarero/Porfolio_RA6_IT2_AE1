<?php
namespace App\Models;

class RedesSociales extends DBAbstractModel {
    private static $instancia;

    public static function getInstancia() {
            if (!isset(self::$instancia)) {
                $miclase = __CLASS__;
                self::$instancia = new $miclase();
            }
            return self::$instancia;
    }

    public function getAll($id) {
        $this->query = "SELECT * FROM redes_sociales WHERE id_usuario = :id";
        $this->parametros['id'] = $id;
        $this->get_results_from_query();
        return $this->rows ?? "";
    }

    public function get($id) {
        $this->query = "SELECT * FROM redes_sociales WHERE id = :id";
        $this->parametros['id'] = $id;
        $this->get_results_from_query();
        return $this->rows ?? "";
    }

    public function set($datos) {
        $this->query = "INSERT INTO redes_sociales (nombre, url, id_usuario) VALUES (:nombre, :url, :id_usuario)";
        $this->parametros = [
            'nombre' => $datos['nombre'],
            'url' => $datos['url'],
            'id_usuario' => $datos['id_usuario']
        ];
        $this->get_results_from_query();
    }

    public function edit($id, $datos) {
        $this->query = "UPDATE redes_sociales SET nombre = :nombre, url = :url WHERE id = :id";
        $this->parametros = [
            'id' => $id,
            'nombre' => $datos['nombre'],
            'url' => $datos['url']
        ];
        $this->get_results_from_query();
    }

    public function delete($id) {
        $this->query = "DELETE FROM redes_sociales WHERE id = :id";
        $this->parametros['id'] = $id;
        $this->get_results_from_query();
    }
}
?>