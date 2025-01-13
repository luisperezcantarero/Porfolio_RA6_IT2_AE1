<?php
namespace App\Models;

class Proyectos extends DBAbstractModel {
    private static $instancia;

    public static function getInstancia() {
            if (!isset(self::$instancia)) {
                $miclase = __CLASS__;
                self::$instancia = new $miclase();
            }
            return self::$instancia;
    }

    public function getAll($id) {
        $this->query = "SELECT * FROM proyectos WHERE id_usuario = :id";
        $this->parametros['id'] = $id;
        $this->get_results_from_query();
        return $this->rows ?? "";
    }

    public function get($id) {
        $this->query = "SELECT * FROM proyectos WHERE id = :id";
        $this->parametros['id'] = $id;
        $this->get_results_from_query();
        return $this->rows ?? "";
    }

    public function set($datos) {
        $this->query = "INSERT INTO proyectos (titulo, descripcion, tecnologias, url, id_usuario) VALUES (:titulo, :descripcion, :tecnologias, :url, :id_usuario)";
        $this->parametros = [
            'titulo' => $datos['titulo'],
            'descripcion' => $datos['descripcion'],
            'tecnologias' => $datos['tecnologias'],
            'url' => $datos['url'],
            'id_usuario' => $datos['id_usuario']
        ];
        $this->get_results_from_query();
    }
    
    public function edit($id, $datos) {
        $this->query = "UPDATE proyectos SET titulo = :titulo, descripcion = :descripcion, tecnologias = :tecnologias, url = :url WHERE id = :id";
        $this->parametros = [
            'id' => $id,
            'titulo' => $datos['titulo'],
            'descripcion' => $datos['descripcion'],
            'tecnologias' => $datos['tecnologias'],
            'url' => $datos['url']
        ];
        $this->get_results_from_query();
    }

    public function delete($id) {
        $this->query = "DELETE FROM proyectos WHERE id = :id";
        $this->parametros['id'] = $id;
        $this->get_results_from_query();
    }
}
?>