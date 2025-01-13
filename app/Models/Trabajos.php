<?php
namespace App\Models;

class Trabajos extends DBAbstractModel {
    private static $instancia;

    public static function getInstancia() {
            if (!isset(self::$instancia)) {
                $miclase = __CLASS__;
                self::$instancia = new $miclase();
            }
            return self::$instancia;
        }
    
    public function getAll($id) {
        $this->query = "SELECT * FROM trabajos WHERE id_usuario = :id";
        $this->parametros['id'] = $id;
        $this->get_results_from_query();
        return $this->rows ?? "";
    }

    public function get($id) {
        $this->query = "SELECT * FROM trabajos WHERE id = :id";
        $this->parametros['id'] = $id;
        $this->get_results_from_query();
        return $this->rows ?? "";
    }

    public function set($datos) {
        $this->query = "INSERT INTO trabajos (titulo, descripcion, fecha_inicio, fecha_final, logos, id_usuario) VALUES (:titulo, :descripcion, :fecha_inicio, :fecha_final, :logos, :id_usuario)";
        $this->parametros = [
            'titulo' => $datos['titulo'],
            'descripcion' => $datos['descripcion'],
            'fecha_inicio' => $datos['fecha_inicio'],
            'fecha_final' => $datos['fecha_final'],
            'logos' => $datos['logos'],
            'id_usuario' => $datos['id_usuario']
        ];
        $this->get_results_from_query();
    }

    public function edit($id, $datos) {
        $this->query = "UPDATE trabajos SET titulo = :titulo, descripcion = :descripcion, fecha_inicio = :fecha_inicio, fecha_final = :fecha_final, logos = :logos WHERE id = :id";
        $this->parametros = [
            'titulo' => $datos['titulo'],
            'descripcion' => $datos['descripcion'],
            'fecha_inicio' => $datos['fecha_inicio'],
            'fecha_final' => $datos['fecha_final'],
            'logos' => $datos['logos'],
        ];
        $this->get_results_from_query();
    }

    public function delete($id) {
        $this->query = "DELETE FROM trabajos WHERE id = :id";
        $this->parametros['id'] = $id;
        $this->get_results_from_query();
    }
}
?>