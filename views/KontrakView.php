<?php

interface KontrakView
{
    public function tampilPembalap($listPembalap): string;
    public function tampilFormPembalap($data = null): string;
}

interface KontrakViewTeam
{
    public function tampilTeam($listTeam);
    public function tampilFormTeam($data = null);
}
?>