<?php

namespace App\Controllers;

use App\Models\Usuario;

class AuthController extends BaseController {
    public function loginAction() {
        if (isset($_POST) && !empty($_POST)) {
            $usuario = Usuario::getInstancia();
            if ($usuario->login($_POST) != null) {
                $_SESSION['perfil'] = 'usuario';
                $_SESSION['usuario'] = [
                    'id' => $usuario->id,
                    'nombre' => $usuario->nombre,
                    'apellidos' => $usuario->apellidos,
                    'foto' => $usuario->foto,
                    'categoria' => $usuario->categoria,
                    'email' => $usuario->email,
                    'resumen' => $usuario->resumen,
                    'visible' => $usuario->visible,
                    'updated_at' => $usuario->updated_at
                ];
                header('Location: /');
            } else {
                $message = 'El Usuario o la contraseña son incorrectos.';
            }
        }
        $data = [
            'message' => $message ?? ''
        ];
        $this->renderHTML("../app/Views/login.php", $data);
    }

    public function registerAction() {
        if (isset($_POST) && !empty($_POST)) {
            $usuario = Usuario::getInstancia();
            $usuario->registrar($_POST);
            header('Location: /login');
        }
        $this->renderHTML("../app/Views/registro.php");
    }

    public function logoutAction() {
        session_unset();
        session_destroy();
        header('Location: /login');
    }
}
?>