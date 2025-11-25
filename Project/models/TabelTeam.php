<?php
include_once __DIR__ . "/DB.php";// Load DB class
include_once __DIR__ . "/KontrakModel.php"; // Load KontrakModelTeam interface

class TabelTeam extends DB implements KontrakModelTeam
{// Model untuk tabel team yang mengimplementasikan KontrakModelTeam
  public function __construct($host, $db_name, $username, $password)
  {
    parent::__construct($host, $db_name, $username, $password);
  }
// CRUD methods for Team
  public function getAllTeam(): array
  {
    $this->executeQuery("SELECT * FROM team ORDER BY id ASC");
    return $this->getAllResult();
  }
// READ (Single)
  public function getTeamById($id): ?array
  {
    $this->executeQuery("SELECT * FROM team WHERE id = :id", [':id' => $id]);
    $result = $this->getAllResult();
    return $result[0] ?? null;
  }
// CREATE
  public function addTeam($namaTim, $negaraAsal): void
  {
    $query = "INSERT INTO team (namaTim, negaraAsal) VALUES (:nama, :negara)";
    $this->executeQuery($query, [':nama' => $namaTim, ':negara' => $negaraAsal]);
  }
// UPDATE
  public function updateTeam($id, $namaTim, $negaraAsal): void
  {
    $query = "UPDATE team SET namaTim = :nama, negaraAsal = :negara WHERE id = :id";
    $this->executeQuery($query, [':id' => $id, ':nama' => $namaTim, ':negara' => $negaraAsal]);
  }
// DELETE
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