<?php

class Team
{
  private $id;
  private $namaTim;
  private $negaraAsal;

  public function __construct($id, $namaTim, $negaraAsal)
  {
    $this->id = $id;
    $this->namaTim = $namaTim;
    $this->negaraAsal = $negaraAsal;
  }

  public function getId()
  {
    return $this->id;
  }
  public function getNamaTim()
  {
    return $this->namaTim;
  }
  public function getNegaraAsal()
  {
    return $this->negaraAsal;
  }
}