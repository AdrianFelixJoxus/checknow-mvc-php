<?php

namespace Model;

class Salida extends ActiveRecord {
    protected static $tabla = "salidas";
    protected static $columnasDB = ["id", "horaSalida", "asistenciaId", "comidaId"];

    public $id;
    public $horaSalida;
    public $asistenciaId;
    public $comidaId;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->horaSalida = $args['horaSalida'] ?? '';
        $this->asistenciaId = $args['asistenciaId'] ?? '';
        $this->comidaId = $args['comidaId'] ?? '';
        
    }
}