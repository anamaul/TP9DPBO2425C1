<?php

interface KontrakModel//Pembalap
{
    // --- PEMBALAP ---
    public function getAllPembalap(): array;
    public function getPembalapById($id): ?array;
    public function addPembalap($nama, $tim, $negara, $poinMusim, $jumlahMenang): void;
    public function updatePembalap($id, $nama, $tim, $negara, $poinMusim, $jumlahMenang): void;
    public function deletePembalap($id): bool;
}

interface KontrakModelTeam//Tim
{
    // --- TEAM ---
    public function getAllTeam(): array;
    public function getTeamById($id): ?array;
    public function addTeam($namaTim, $negaraAsal): void;
    public function updateTeam($id, $namaTim, $negaraAsal): void;
    public function deleteTeam($id): bool; 
}
?>