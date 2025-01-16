<?php
namespace App\Controllers;

use App\Models\Proyectos;
use App\Models\Skills;
use App\Models\RedesSociales;
use App\Models\Trabajos;

class PorfolioController extends BaseController {
    public function indexAction() {
        $usuario = $_SESSION['usuario'];
        $porfolio = [
            'id' => $usuario['id'],
            'titulo' => $usuario['nombre'] . ' ' . $usuario['apellidos'],
            'proyectos' => Proyectos::getInstancia()->getAll($usuario['id']),
            'skills' => Skills::getInstancia()->getAll($usuario['id']),
            'redes' => RedesSociales::getInstancia()->getAll($usuario['id']),
            'trabajos' => Trabajos::getInstancia()->getAll($usuario['id'])
        ];

        $data = [
            'usuario' => $usuario['nombre'],
            'porfolio' => $porfolio
        ];
        $this->renderHTML("../app/Views/porfolio.php", $data);
    }

    public function addAction($request) {
        $id_usuario = $_SESSION['usuario']['id'];

        $partes = explode('/', $request);
        $tipo = end($partes);

        if (isset($_POST) && !empty($_POST)) {
            switch ($tipo) {
                case 'proyecto':
                    $proyecto = Proyectos::getInstancia();
                    $datos = [
                        'titulo' => $_POST['titulo'],
                        'descripcion' => $_POST['descripcion'],
                        'tecnologias' => $_POST['tecnologias'],
                        'url' => $_POST['url'],
                        'id_usuario' => $id_usuario
                    ];
                    $proyecto->set($datos);
                    break;
                case 'skill':
                    $skill = Skills::getInstancia();
                    $datos = [
                        'nombre' => $_POST['nombre'],
                        'id_usuario' => $id_usuario
                    ];
                    $skill->set($datos);
                    break;
                case 'redesSociales':
                    $redes = RedesSociales::getInstancia();
                    $datos = [
                        'nombre' => $_POST['nombre'],
                        'url' => $_POST['url'],
                        'id_usuario' => $id_usuario
                    ];
                    $redes->set($datos);
                    break;
                case 'trabajo':
                    $trabajo = Trabajos::getInstancia();
                    $datos = [
                        'titulo' => $_POST['titulo'],
                        'descripcion' => $_POST['descripcion'],
                        'fecha_inicio' => $_POST['fecha_inicio'],
                        'fecha_fin' => $_POST['fecha_fin'],
                        'logo' => $_POST['logo'],
                        'id_usuario' => $id_usuario
                    ];
                    $trabajo->set($datos);
                    break;
            }
            header('Location: /');
        }

        switch ($tipo) {
            case 'proyecto':
                $data = [
                    'usuario' => $_SESSION['usuario']['nombre'],
                    'tipo' => 'proyecto'
                ];
                break;
            case 'skill':
                $data = [
                    'usuario' => $_SESSION['usuario']['nombre'],
                    'tipo' => 'skill'
                ];
                break;
            case 'redesSociales':
                $data = [
                    'usuario' => $_SESSION['usuario']['nombre'],
                    'tipo' => 'redesSociales'
                ];
                break;
            case 'trabajo':
                $data = [
                    'usuario' => $_SESSION['usuario']['nombre'],
                    'tipo' => 'trabajo'
                ];
                break;
        }
        $this->renderHTML("../app/Views/agregar.php", $data);
    }

    public function delAction($request) {
        $partes = explode('/', $request);
        $tipo = $partes[2];
        $id = end($partes);

        switch ($tipo) {
            case 'proyecto':
                Proyectos::getInstancia()->delete($id);
                break;
            case 'skill':
                Skills::getInstancia()->delete($id);
                break;
            case 'redesSociales':
                RedesSociales::getInstancia()->delete($id);
                break;
            case 'trabajo':
                Trabajos::getInstancia()->delete($id);
                break;
        }
        header('Location: /');
    }

    public function editAction($request) {
        $partes = explode('/', $request);
        $tipo = $partes[2];
        $id = end($partes);

        if (isset($_POST) && !empty($_POST)) {
            switch ($tipo) {
                case 'proyecto':
                    $proyecto = Proyectos::getInstancia();
                    $datos = [
                        'titulo' => $_POST['titulo'],
                        'descripcion' => $_POST['descripcion'],
                        'tecnologias' => $_POST['tecnologias'],
                        'url' => $_POST['url']
                    ];
                    $proyecto->edit($id, $datos);
                    break;
                case 'skill':
                    $skill = Skills::getInstancia();
                    $datos = [
                        'nombre' => $_POST['nombre']
                    ];
                    $skill->edit($id, $datos);
                    break;
                case 'redesSociales':
                    $redes = RedesSociales::getInstancia();
                    $datos = [
                        'nombre' => $_POST['nombre'],
                        'url' => $_POST['url']
                    ];
                    $redes->edit($id, $datos);
                    break;
                case 'trabajo':
                    $trabajo = Trabajos::getInstancia();
                    $datos = [
                        'titulo' => $_POST['titulo'],
                        'descripcion' => $_POST['descripcion'],
                        'fecha_inicio' => $_POST['fecha_inicio'],
                        'fecha_fin' => $_POST['fecha_fin'],
                        'logo' => $_POST['logo']
                    ];
                    $trabajo->edit($id, $datos);
                    break;
            }
            header('Location: /');
        }

        switch ($tipo) {
            case 'proyecto':
                $proyecto = Proyectos::getInstancia()->get($id);
                $data = [
                    'usuario' => $_SESSION['usuario']['nombre'],
                    'tipo' => 'proyecto',
                    'proyecto' => $proyecto
                ];
                break;
            case 'skill':
                $skill = Skills::getInstancia()->get($id);
                $data = [
                    'usuario' => $_SESSION['usuario']['nombre'],
                    'tipo' => 'skill',
                    'skill' => $skill
                ];
                break;
            case 'redesSociales':
                $redes = RedesSociales::getInstancia()->get($id);
                $data = [
                    'usuario' => $_SESSION['usuario']['nombre'],
                    'tipo' => 'redesSociales',
                    'redes' => $redes
                ];
                break;
            case 'trabajo':
                $trabajo = Trabajos::getInstancia()->get($id);
                $data = [
                    'usuario' => $_SESSION['usuario']['nombre'],
                    'tipo' => 'trabajo',
                    'trabajo' => $trabajo
                ];
                break;
            }
            $this->renderHTML("../app/Views/editar.php", $data);
        }
    }
?>