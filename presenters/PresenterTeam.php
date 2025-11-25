<?php
include_once(__DIR__ . "/../models/TabelTeam.php");
include_once(__DIR__ . "/../models/Team.php");
include_once(__DIR__ . "/../views/ViewTeam.php");

class PresenterTeam
{
  private $tabelTeam;
  private $viewTeam;

  public function __construct($tabelTeam, $viewTeam)
  {
    $this->tabelTeam = $tabelTeam;
    $this->viewTeam = $viewTeam;
  }

  public function tampilkanTeam()
  {
    $data = $this->tabelTeam->getAllTeam();
    $listTeam = [];
    foreach ($data as $row) {
      $listTeam[] = new Team($row['id'], $row['namaTim'], $row['negaraAsal']);
    }
    return $this->viewTeam->tampilTeam($listTeam);
  }

  public function tampilkanFormTeam($id = null)
  {
    $data = null;
    if ($id) {
      $data = $this->tabelTeam->getTeamById($id);
    }
    return $this->viewTeam->tampilFormTeam($data);
  }

  public function tambahTeam($nama, $negara)
  {
    $this->tabelTeam->addTeam($nama, $negara);
  }

  public function ubahTeam($id, $nama, $negara)
  {
    $this->tabelTeam->updateTeam($id, $nama, $negara);
  }

  public function hapusTeam($id)
  {
    // Panggil method delete di model yang sekarang mengembalikan true/false
    $berhasil = $this->tabelTeam->deleteTeam($id);

    if ($berhasil) {
      // Jika berhasil, redirect seperti biasa
      header("Location: index.php?page=team");
    } else {
      // Jika gagal (karena masih dipakai pembalap), tampilkan Alert
      echo "<script>
                alert('Gagal menghapus! Team ini sedang digunakan oleh Pembalap. Silakan hapus atau pindahkan pembalapnya terlebih dahulu.');
                window.location.href = 'index.php?page=team';
            </script>";
    }
  }
}
?>