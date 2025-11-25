<?php

include_once __DIR__ . "/KontrakPresenter.php";
include_once __DIR__ . "/../models/TabelPembalap.php";
include_once __DIR__ . "/../models/TabelTeam.php";
include_once __DIR__ . "/../models/Pembalap.php"; // Load Class Pembalap
include_once __DIR__ . "/../views/ViewPembalap.php";

class PresenterPembalap implements KontrakPresenter
{
    private $tabelPembalap;
    private $tabelTeam;
    private $viewPembalap;
    private $listPembalap = [];

    public function __construct($tabelPembalap, $viewPembalap, $tabelTeam)
    {
        $this->tabelPembalap = $tabelPembalap;
        $this->viewPembalap = $viewPembalap;
        $this->tabelTeam = $tabelTeam;
    }

    public function initListPembalap()
    {
        $data = $this->tabelPembalap->getAllPembalap();
        $this->listPembalap = [];
        foreach ($data as $item) {
            // 'tim' di sini diambil dari alias query (t.namaTim as tim)
            $pembalap = new Pembalap(
                $item['id'],
                $item['nama'],
                $item['tim'],
                $item['negara'],
                $item['poinMusim'],
                $item['jumlahMenang']
            );
            $this->listPembalap[] = $pembalap;
        }
    }

    // ... sisa method sama persis dengan file aslimu ...
    // Pastikan tampilkanPembalap, tampilkanFormPembalap, CRUD ada di sini

    public function tampilkanPembalap(): string
    {
        $this->initListPembalap();
        return $this->viewPembalap->tampilPembalap($this->listPembalap);
    }

    public function tampilkanFormPembalap($id = null): string
    {
        $dataPembalap = null;
        if ($id !== null) {
            $dataPembalap = $this->tabelPembalap->getPembalapById($id);
        }
        $listTeam = $this->tabelTeam->getAllTeam();
        $paketData = [
            'pembalap' => $dataPembalap,
            'teams' => $listTeam
        ];
        return $this->viewPembalap->tampilFormPembalap($paketData);
    }

    public function tambahPembalap($nama, $tim, $negara, $poinMusim, $jumlahMenang): void
    {
        $this->tabelPembalap->addPembalap($nama, $tim, $negara, $poinMusim, $jumlahMenang);
    }

    public function ubahPembalap($id, $nama, $tim, $negara, $poinMusim, $jumlahMenang): void
    {
        $this->tabelPembalap->updatePembalap($id, $nama, $tim, $negara, $poinMusim, $jumlahMenang);
    }

    public function hapusPembalap($id): void
    {
        $this->tabelPembalap->deletePembalap($id);
    }
}
?>