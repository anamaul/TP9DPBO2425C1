<?php

interface KontrakPresenter
{
    // --- PEMBALAP ---
    public function tampilkanPembalap(): string;
    public function tampilkanFormPembalap($id = null): string;
    public function tambahPembalap($nama, $tim, $negara, $poinMusim, $jumlahMenang): void;
    public function ubahPembalap($id, $nama, $tim, $negara, $poinMusim, $jumlahMenang): void;
    public function hapusPembalap($id): void;
}

interface KontrakPresenterTeam
{
    // --- TEAM ---
    public function tampilkanTeam();
    public function tampilkanFormTeam($id = null);
    public function tambahTeam($nama, $negara);
    public function ubahTeam($id, $nama, $negara);
    public function hapusTeam($id);
}
?>