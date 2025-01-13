<?php
namespace App\Models;
use App\Models\DBAbstractModel;

class Usuario extends DBAbstractModel {
    private static $instancia;

    public static function getInstancia() {
            if (!isset(self::$instancia)) {
                $miclase = __CLASS__;
                self::$instancia = new $miclase();
            }
            return self::$instancia;
        }
    
    public function login($datos) {
        foreach ($datos as $key => $value) {
            $this->parametros[$key] = $value;
        }

        $this->query = "SELECT * FROM usuarios WHERE email = :email AND password = :password";

        $this->get_results_from_query();

        if (count($this->rows) == 1) {
            foreach ($this->rows[0] as $campo => $valor) {
                $this->$campo = $valor;
            }
        }

        return $this->rows[0] ?? null;
    }

    public function registrar($datos) {
        foreach ($datos as $key => $value) {
            $this->parametros[$key] = $value;
        }

        $this->query = "INSERT INTO usuarios (nombre, email, password) VALUES (:nombre, :apellidos, :email, :password)";

        $this->get_results_from_query();
    }

    public function get($id) {
        $this->query = "SELECT * FROM usuarios WHERE id = :id";

        $this->parametros['id'] = $id;

        $this->get_results_from_query();
        return $this->rows ?? "";
    }

    public function set($datos) {
        foreach ($datos as $key => $value) {
            $this->parametros[$key] = $value;
        }

        $this->query = "INSERT INTO usuarios (nombre, apellidos, email, password) VALUES (:nombre, :apellidos, :email, :password)";

        $this->get_results_from_query();
    }

    public function edit($id, $datos) {
        $this->query = "UPDATE usuarios SET nombre = :nombre, apellidos = :apellidos, email = :email, password = :password WHERE id = :id";

        $this->parametros = [
            'nombre' => $datos['nombre'],
            'apellidos' => $datos['apellidos'],
            'email' => $datos['email'],
            'password' => $datos['password']
        ];

        $this->get_results_from_query();
    }

    public function delete($id) {
        $this->query = "DELETE FROM usuarios WHERE id = :id";

        $this->parametros['id'] = $id;

        $this->get_results_from_query();
        }
    }
?>