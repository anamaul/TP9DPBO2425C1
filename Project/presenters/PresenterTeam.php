<?php
include_once(__DIR__ . "/KontrakPresenter.php");
include_once(__DIR__ . "/../models/TabelTeam.php");
include_once(__DIR__ . "/../models/Team.php");
include_once(__DIR__ . "/../views/ViewTeam.php");
// Pastikan semua file yang diperlukan di-include
class PresenterTeam implements KontrakPresenterTeam
{//Tim
  private $tabelTeam;
  private $viewTeam;
// Inisialisasi dengan model dan view yang sesuai
  public function __construct(KontrakModelTeam $tabelTeam, KontrakViewTeam $viewTeam)
  {
    $this->tabelTeam = $tabelTeam;
    $this->viewTeam = $viewTeam;
  }
// Implementasi metode dari KontrakPresenterTeam
  public function tampilkanTeam()
  {
    $data = $this->tabelTeam->getAllTeam();
    $listTeam = [];
    foreach ($data as $row) {
      $listTeam[] = new Team($row['id'], $row['namaTim'], $row['negaraAsal']);
    }
    return $this->viewTeam->tampilTeam($listTeam);
  }
// Menampilkan form tambah/ubah team
  public function tampilkanFormTeam($id = null)
  {
    $data = null;
    if ($id) {
      $data = $this->tabelTeam->getTeamById($id);
    }
    return $this->viewTeam->tampilFormTeam($data);
  }
// Menambahkan team baru
  public function tambahTeam($nama, $negara)
  {
    $this->tabelTeam->addTeam($nama, $negara);
  }
// Mengubah data team
  public function ubahTeam($id, $nama, $negara)
  {
    $this->tabelTeam->updateTeam($id, $nama, $negara);
  }
// Menghapus team
  public function hapusTeam($id)
  {
    $berhasil = $this->tabelTeam->deleteTeam($id);

    if ($berhasil) {
      header("Location: index.php?page=team");
    } else {
      // Script alert sederhana lalu redirect
      echo "<script>
            alert('Gagal menghapus! Team ini sedang digunakan oleh Pembalap.');
            window.location.href = 'index.php?page=team';
        </script>";
    }
  }
}
?>