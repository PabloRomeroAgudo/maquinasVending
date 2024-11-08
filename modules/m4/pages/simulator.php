<?php
include_once '../DAO/IncidenciaDao.php';
include_once '../../../models/Incidencia.php';
$incidenciaDao = new IncidenciaDao();
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Simulador de incidencias</title>
</head>

<body>
  <form action="" method="post">
    <h1>Simulador de incidencias</h1>
    <h3 name="h3"></h3>
    <p name="p"></p>
    <button name="boton">Generar incidencias</button>
  </form>
  <?php
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $idMaquina = rand(0, 10);
    $idProducto = rand(0, 10);
    $idUbicacion = rand(0, 11);
    $categoriaArray = ['Producto', 'Equipo', 'Red'];
    $categoria = $categoriaArray[rand(0, 2)];
    $severidadArray = ['ALTA', 'MEDIA', 'BAJA'];
    $severidad = $severidadArray[rand(0, 2)];
    $estadoArray = ['Registrada', 'Revisada', 'En curso', 'Solucionada'];
    $estado = $estadoArray[rand(0, 3)];
    if ($categoria == 'Producto') {
      $stock = 0;
      $descripcion = 'relacionada con los productos (sin stock, debajo del umbral, etc)';
    } else {
      if ($categoria == 'Equipo') {
        $stock = rand(10, 50);
        $descripcion = 'relacionada con el funcionamiento del equipo : atasco, mensaje error algún componente';
      } else {
        $stock = rand(10, 50);
        $descripcion = 'cortes en la comunicación con la central o algún problema de conectividad';
      }
    }
    $fechaRegistro = date('Y-m-d H:i:s');
    $arrayFinal = [
      'idincidencia' => 0,
      'idmaquina' => $idMaquina,
      'idproducto' => $idProducto,
      'idubicacion' => $idUbicacion,
      'categoria' => $categoria,
      'stock' => $stock,
      'severidad' => $severidad,
      'estado' => $estado,
      'descripcion' => $descripcion,
      'fecharegistro' => $fechaRegistro,
      'solucion' => null
    ];

    $incidencia = new Incidencia($arrayFinal);

    print_r($incidencia);
  }
  ?>
</body>

</html>