<?php

namespace Controllers;

use App\Router;
use Models\Categoria;

class CategoriaController {
    public static function admin(Router $router){
        $categorias = Categoria::listar();
        $router->renderView('admin/categoria/index', [
            'categorias' => $categorias
        ]);
    }

    public static function crear(Router $router) {
        $router->renderView('admin/categoria/crear');
    }

    public static function procesar() {
        if($_SERVER['REQUEST_METHOD'] === "POST"){
            $accion = $_POST['accion'];
            if($accion == "new"){
                $categoria = new Categoria($_POST);
                $codigo = Categoria::generarCodigo();
                $codigo = (int)$codigo + 1;
                $codigo = str_repeat('0', 4 - strlen($codigo)) . $codigo;
                $categoria->codigo = $codigo;
                $categoria->crear();
                $resultado = crearMensajeResultado(true, "Datos registrados");
            } else {
                $resultado = crearMensajeResultado(mensaje: "La acción no se encuentra disponible");
            }
        } else {
            $resultado = crearMensajeResultado(mensaje: "Método no disponible");
        }
        echo json_encode($resultado);
    }
}