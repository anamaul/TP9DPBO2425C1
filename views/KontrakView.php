<?php

interface KontrakView//Pembalap
{
    public function tampilPembalap($listPembalap): string;//Memanggil view tampil pembalap
    public function tampilFormPembalap($data = null): string;//Memanggil view form pembalap
}

interface KontrakViewTeam//Tim
{
    public function tampilTeam($listTeam);//Memanggil view tampil team
    public function tampilFormTeam($data = null);//Memanggil view form team
}
?>