<?php

namespace Model;

class Asistencia extends ActiveRecord {
    protected static $tabla = "asistencias";
    protected static $columnasDB = ["id", "usuarioId", "fecha", "hora"];

    public $id;
    public $usuarioId;
    public $fecha;
    public $hora;

    // Propiedades temporales
    public $usuario;
    public $comida;
    public $salida;
    public $asistencia;
    public $diferiencia;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->usuarioId = $args['usuarioId'] ?? '';
        $this->fecha = $args['fecha'] ?? '';
        $this->hora = $args['hora'] ?? '';
        
    }
}