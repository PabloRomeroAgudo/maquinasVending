<?php

declare(strict_types=1);

class Incidencia {
  private int $idincidencia;
  private int $idmaquina;
  private int $idproducto;
  private int $idubicacion;
  private string $categoria;
  private int $stock;
  private string $severidad;
  private string $estado;
  private string $descripcion;
  private DateTime $fecharegistro;
  private DateTime|null $fecharesolucion;
  private string|null $solucion;

  public function __construct(array $data) {
    $this->setIdIncidencia($data["idincidencia"]);
    $this->setIdMaquina($data["idmaquina"]);
    $this->setIdProducto($data["idproducto"]);
    $this->setIdUbicacion($data["idubicacion"]);
    $this->setCategoria($data["categoria"]);
    $this->setStock($data["stock"]);
    $this->setSeveridad($data["severidad"]);
    $this->setEstado($data["estado"]);
    $this->setDescripcion($data["descripcion"]);
    $this->setFechaRegistro(new DateTime($data["fecharegistro"]));
    $this->setFechaResolucion(isset($data["fecharesolucion"])  ? new DateTime($data["fecharesolucion"]) : null);
    $this->setSolucion($data["solucion"]);
  }

  public function setIdIncidencia(int $idIncidencia) {
    $this->idincidencia = $idIncidencia;
  }

  public function getIdIncidencia(): int {
    return $this->idincidencia;
  }

  public function setIdMaquina(int $idMaquina) {
    $this->idmaquina = $idMaquina;
  }

  public function getIdMaquina(): int {
    return $this->idmaquina;
  }

  public function setIdProducto(int $idProducto) {
    $this->idproducto = $idProducto;
  }

  public function getIdProducto(): int {
    return $this->idproducto;
  }

  public function setIdUbicacion(int $idUbicacion) {
    $this->idubicacion = $idUbicacion;
  }

  public function getIdUbicacion(): int {
    return $this->idubicacion;
  }

  public function setCategoria(string $categoria) {
    $this->categoria = $categoria;
  }

  public function getCategoria(): string {
    return $this->categoria;
  }

  public function setStock(int $stock) {
    $this->stock = $stock;
  }

  public function getStock(): int {
    return $this->stock;
  }

  public function setSeveridad(string $severidad) {
    $this->severidad = $severidad;
  }

  public function getSeveridad(): string {
    return $this->severidad;
  }

  public function setEstado(string $estado) {
    $this->estado = $estado;
  }

  public function getEstado(): string {
    return $this->estado;
  }

  public function setDescripcion(string $descripcion) {
    $this->descripcion = $descripcion;
  }

  public function getDescripcion(): string {
    return $this->descripcion;
  }

  public function setFechaRegistro(DateTime $fechaRegistro) {
    $this->fecharegistro = $fechaRegistro;
  }

  public function getFechaRegistro(): string {

    return $this->fecharegistro->format('Y-m-d H:i:s');
  }

  public function setFechaResolucion(DateTime|null $fechaResolucion) {
    $this->fecharesolucion = $fechaResolucion;
  }

  public function getFechaResolucion(): string|null {
    return isset($this->fecharesolucion) ? $this->fecharesolucion->format('Y-m-d H:i:s') : null;
  }

  public function setSolucion(string|null $solucion) {
    $this->solucion = $solucion;
  }

  public function getSolucion(): string|null {
    return $this->solucion;
  }
}
