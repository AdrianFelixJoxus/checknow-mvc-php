<?php

namespace Model;

class Comida extends ActiveRecord {
    protected static $tabla = "comidas";
    protected static $columnasDB = ["id", "horaEntrada", "asistenciaId", "horaSalida", "desayunoId"];

    public $id;
    public $horaEntrada;
    public $asistenciaId;
    public $horaSalida;
    public $desayunoId;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->horaEntrada = $args['horaEntrada'] ?? '';
        $this->asistenciaId = $args['asistenciaId'] ?? '';
        $this->horaSalida = $args['horaSalida'] ?? '';
        $this->desayunoId = $args['desayunoId'] ?? '';
        
    }
}