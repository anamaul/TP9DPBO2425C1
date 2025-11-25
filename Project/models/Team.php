<?php

class Team//Model Team
{
  private $id;
  private $namaTim;
  private $negaraAsal;
// Constructor
  public function __construct($id, $namaTim, $negaraAsal)
  {
    $this->id = $id;
    $this->namaTim = $namaTim;
    $this->negaraAsal = $negaraAsal;
  }
// Getter methods
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