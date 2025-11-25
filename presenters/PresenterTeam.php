<?php
include_once(__DIR__ . "/KontrakPresenter.php"); // Load Interface
include_once(__DIR__ . "/../models/TabelTeam.php");
include_once(__DIR__ . "/../models/Team.php");
include_once(__DIR__ . "/../views/ViewTeam.php");

class PresenterTeam implements KontrakPresenterTeam
{
  private $tabelTeam;
  private $viewTeam;

  // Type Hinting untuk memaksa Contract
  public function __construct(KontrakModelTeam $tabelTeam, KontrakViewTeam $viewTeam)
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