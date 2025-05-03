<?php
function registrarEvento($mensaje)
{
    $archivo = '../logs/sesion.log';
    if (!is_dir('../logs')) {
        mkdir('../logs', 0777, true); // Crear el directorio si no existe
    }
    $fecha = date('Y-m-d H:i:s');
    $mensajeCompleto = "[$fecha] $mensaje" . PHP_EOL;
    file_put_contents($archivo, $mensajeCompleto, FILE_APPEND);
}
