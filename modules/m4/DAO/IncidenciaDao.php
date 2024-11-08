<?php

declare(strict_types=1);
require_once '../../../models/Incidencia.php';
require_once '../../../models/BD/BD.php';
require_once '../utils/functions.php';

class IncidenciaDao {

  public function __construct() {
  }

  public function insert(Incidencia $incidencia): bool {
    try {
      $dbh = BD::getInstance();
      $stmt = $dbh->prepare(
        "INSERT INTO incidencias 
        ( idmaquina
        , idproducto
        , idubicacion
        , categoria
        , stock
        , severidad
        , estado
        , descripcion
        , fecharegistro
        ) VALUES (
          :idmaquina
        , :idproducto
        , :idubicacion
        , :categoria
        , :stock
        , :severidad
        , :estado
        , :descripcion
        , :fecharegistro
        )"
      );

      $stmt->bindValue(":idmaquina",      $incidencia->getIdIncidencia());
      $stmt->bindValue(":idproducto",     $incidencia->getIdProducto());
      $stmt->bindValue(":idubicacion",    $incidencia->getIdUbicacion());
      $stmt->bindValue(":categoria",      $incidencia->getCategoria());
      $stmt->bindValue(":stock",          $incidencia->getStock());
      $stmt->bindValue(":severidad",      $incidencia->getSeveridad());
      $stmt->bindValue(":estado",         $incidencia->getEstado());
      $stmt->bindValue(":descripcion",    $incidencia->getDescripcion());
      $stmt->bindValue(":fecharegistro",  $incidencia->getFechaRegistro());

      $insert = $stmt->execute();

      BD::close();
      return $insert;
    } catch (Throwable $e) {
      print_r(mostrar_error($e));
      BD::close();

      return false;
    }
  }

  public function findAll(): array|null {
    try {
      $dbh = BD::getInstance();
      $stmt = $dbh->prepare("SELECT * FROM incidencias");
      $stmt->execute();

      $fetch = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $incidencias = [];

      foreach ($fetch as $incidencia) {
        $incidencias[] = new Incidencia($incidencia);
      }

      BD::close();
      return $incidencias;
    } catch (Throwable $e) {
      print_r(mostrar_error($e));

      BD::close();
      return null;
    }
  }

  public function findById(int $id): Incidencia|null {
    try {
      $dbh = BD::getInstance();
      $stmt = $dbh->prepare("SELECT * FROM incidencias WHERE idincidencia = :id");
      $stmt->bindValue(":id", $id);
      $stmt->execute();

      $incidencia = new Incidencia($stmt->fetch(PDO::FETCH_ASSOC));

      BD::close();
      return $incidencia;
    } catch (Throwable $e) {
      print_r(mostrar_error($e));

      BD::close();
      return null;
    }
  }

  public function update(Incidencia $incidencia): Incidencia|null {
    try {
      $dbh = BD::getInstance();
      $id = $incidencia->getIdIncidencia();
      $incidenciaPrevia = $this->findById($id);
      $stmt = $dbh->prepare(
        "UPDATE incidencias 
        set
          estado = :estado,
          fecharesolucion = :fecharesolucion,
          solucion = :solucion
        WHERE 
          idincidencia = :id"
      );
      $stmt->bindValue(":estado", $incidencia->getEstado());
      $stmt->bindValue(":fecharesolucion", date("Y-m-d H:i:s"));
      $stmt->bindValue(":solucion", $incidencia->getSolucion());
      $stmt->bindValue(":id", $id);

      return ["antiguo" => $incidenciaPrevia, "nuevo" => $this->findById($id)];
      BD::close();
      return $incidencia;
    } catch (Throwable $e) {
      print_r(mostrar_error($e));
      BD::close();

      return null;
    }
  }

  public function delete(int $id): Incidencia|null {
    try {
      $dbh = BD::getInstance();
      $incidencia = $this->findById($id);
      $stmt = $dbh->prepare("DELETE FROM incidencias WHERE idincidencia = :id");
      $stmt->bindValue(":id", $id);
      $stmt->execute();


      BD::close();
      return $incidencia;
    } catch (Throwable $e) {
      print_r(mostrar_error($e));
      BD::close();

      return null;
    }
  }


  // TODO
  public function findByFiltros() {
  }
}
