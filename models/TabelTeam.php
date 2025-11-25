<?php
include_once __DIR__ . "/DB.php";
include_once __DIR__ . "/KontrakModel.php"; // Load Interface

class TabelTeam extends DB implements KontrakModelTeam
{
  public function __construct($host, $db_name, $username, $password)
  {
    parent::__construct($host, $db_name, $username, $password);
  }

  public function getAllTeam(): array
  {
    $this->executeQuery("SELECT * FROM team ORDER BY id ASC");
    return $this->getAllResult();
  }

  public function getTeamById($id): ?array
  {
    $this->executeQuery("SELECT * FROM team WHERE id = :id", [':id' => $id]);
    $result = $this->getAllResult();
    return $result[0] ?? null;
  }

  public function addTeam($namaTim, $negaraAsal): void
  {
    $query = "INSERT INTO team (namaTim, negaraAsal) VALUES (:nama, :negara)";
    $this->executeQuery($query, [':nama' => $namaTim, ':negara' => $negaraAsal]);
  }

  public function updateTeam($id, $namaTim, $negaraAsal): void
  {
    $query = "UPDATE team SET namaTim = :nama, negaraAsal = :negara WHERE id = :id";
    $this->executeQuery($query, [':id' => $id, ':nama' => $namaTim, ':negara' => $negaraAsal]);
  }

  public function deleteTeam($id): bool
  {
    try {
      $query = "DELETE FROM team WHERE id = :id";
      $this->executeQuery($query, [':id' => $id]);
      return true;
    } catch (Exception $e) {
      // Gagal jika ID sedang dipakai di tabel pembalap (Foreign Key constraint)
      return false;
    }
  }
}
?>