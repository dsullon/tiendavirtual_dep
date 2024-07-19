<?php

namespace Models;

class Categoria extends ActiveRecord {
    protected static $tabla = 'categorias';
    protected static $columnasDB = ['id', 'codigo', 'nombre', 'estado'];

    public $id;
    public $codigo;
    public $nombre;
    public $estado;
    
    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->codigo = $args['codigo'] ?? '';
        $this->nombre = $args['nombre'] ?? '';
        $this->estado = $args['estado'] ?? '';
    }

    public static function generarCodigo() {
        $query = "SELECT MAX(codigo) FROM " . static::$tabla;
        $resultado = self::$db->query($query);
        $codigo = $resultado->fetch_array();
        return array_shift($codigo);
    }
}