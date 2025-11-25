<?php

class Pembalap//Model Pembalap
{
    private $id;
    private $nama;
    private $tim;
    private $negara;
    private $poinMusim;
    private $jumlahMenang;
// Constructor
    public function __construct($id, $nama, $tim, $negara, $poinMusim, $jumlahMenang)
    {
        $this->id = $id;
        $this->nama = $nama;
        $this->tim = $tim;
        $this->negara = $negara;
        $this->poinMusim = $poinMusim;
        $this->jumlahMenang = $jumlahMenang;
    }
// Getter methods
    public function getId()
    {
        return $this->id;
    }
    public function getNama()
    {
        return $this->nama;
    }
    public function getTim()
    {
        return $this->tim;
    }
    public function getNegara()
    {
        return $this->negara;
    }
    public function getPoinMusim()
    {
        return $this->poinMusim;
    }
    public function getJumlahMenang()
    {
        return $this->jumlahMenang;
    }
}