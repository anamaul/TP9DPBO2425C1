<?php

interface KontrakModel
{
    // --- PEMBALAP ---
    public function getAllPembalap(): array;
    public function getPembalapById($id): ?array;
    public function addPembalap($nama, $tim, $negara, $poinMusim, $jumlahMenang): void;
    public function updatePembalap($id, $nama, $tim, $negara, $poinMusim, $jumlahMenang): void;
    public function deletePembalap($id): bool;
}

interface KontrakModelTeam
{
    // --- TEAM ---
    public function getAllTeam(): array;
    public function getTeamById($id): ?array;
    public function addTeam($namaTim, $negaraAsal): void;
    public function updateTeam($id, $namaTim, $negaraAsal): void;
    public function deleteTeam($id): bool; // Return bool untuk cek constraint
}
?>