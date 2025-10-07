<?php

namespace Model;

class Desayuno extends ActiveRecord {
    protected static $tabla = "desayunos";
    protected static $columnasDB = ["id", "horaSalida", "asistenciaId", "horaEntrada"];

    public $id;
    public $horaSalida;
    public $asistenciaId;
    public $horaEntrada;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->horaSalida = $args['horaSalida'] ?? '';
        $this->asistenciaId = $args['asistenciaId'] ?? '';
        $this->horaEntrada = $args['horaEntrada'] ?? '00:00:00';
        
    }
}