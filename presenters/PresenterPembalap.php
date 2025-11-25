<?php

include_once __DIR__ . "/KontrakPresenter.php";
include_once __DIR__ . "/../models/KontrakModel.php"; // Pastikan path ini benar
include_once __DIR__ . "/../views/KontrakView.php";   // Pastikan path ini benar
include_once __DIR__ . "/../models/TabelPembalap.php";
include_once __DIR__ . "/../models/TabelTeam.php";
include_once __DIR__ . "/../models/Pembalap.php";
include_once __DIR__ . "/../views/ViewPembalap.php";

class PresenterPembalap implements KontrakPresenter
{
    private $tabelPembalap;
    private $viewPembalap;
    private $tabelTeam;
    private $listPembalap = [];

    // Menggunakan Type Hinting seperti di PresenterTeam
    // Asumsi: TabelTeam mengimplementasikan KontrakModelTeam atau sejenisnya, 
    // jika error, hilangkan type hint pada $tabelTeam
    public function __construct(KontrakModel $tabelPembalap, KontrakView $viewPembalap, $tabelTeam)
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
        // Ambil data team untuk dropdown
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
        // Bisa tambahkan header location jika ingin auto redirect di sini
    }

    public function ubahPembalap($id, $nama, $tim, $negara, $poinMusim, $jumlahMenang): void
    {
        $this->tabelPembalap->updatePembalap($id, $nama, $tim, $negara, $poinMusim, $jumlahMenang);
        // Bisa tambahkan header location jika ingin auto redirect di sini
    }

    // Disamakan dengan PresenterTeam: Cek keberhasilan hapus
    public function hapusPembalap($id): void
    {
        $berhasil = $this->tabelPembalap->deletePembalap($id);

        if ($berhasil) {
            header("Location: index.php"); // Kembali ke halaman utama
        } else {
            echo "<script>
                alert('Gagal menghapus data pembalap!');
                window.location.href = 'index.php';
            </script>";
        }
    }
}
?>