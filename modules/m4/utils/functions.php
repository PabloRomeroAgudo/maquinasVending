<?php
function mostrar_error($e) {
  $fichero = $e->getFile();
  $linea = $e->getLine();
  return "<br>MENSAJE: {$e->getMessage()}<br>FICHERO: $fichero en LINEA: $linea";
}
