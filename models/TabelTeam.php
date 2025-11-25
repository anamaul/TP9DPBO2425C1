<?php
include_once __DIR__ . "/DB.php";

class TabelTeam extends DB
{
  public function __construct($host, $db_name, $username, $password)
  {
    parent::__construct($host, $db_name, $username, $password);
  }

  public function getAllTeam()
  {
    $this->executeQuery("SELECT * FROM team ORDER BY id ASC");
    return $this->getAllResult();
  }

  public function getTeamById($id)
  {
    $this->executeQuery("SELECT * FROM team WHERE id = :id", [':id' => $id]);
    $result = $this->getAllResult();
    return $result[0] ?? null;
  }

  public function addTeam($namaTim, $negaraAsal)
  {
    $query = "INSERT INTO team (namaTim, negaraAsal) VALUES (:nama, :negara)";
    $this->executeQuery($query, [':nama' => $namaTim, ':negara' => $negaraAsal]);
  }

  public function updateTeam($id, $namaTim, $negaraAsal)
  {
    $query = "UPDATE team SET namaTim = :nama, negaraAsal = :negara WHERE id = :id";
    $this->executeQuery($query, [':id' => $id, ':nama' => $namaTim, ':negara' => $negaraAsal]);
  }

  public function deleteTeam($id)
  {
    try {
      $query = "DELETE FROM team WHERE id = :id";
      $this->executeQuery($query, [':id' => $id]);
      return true;
    } catch (Exception $e) {
      // Akan gagal jika Tim masih dipakai di tabel Pembalap (Foreign Key)
      return false;
    }
  }
}
?>