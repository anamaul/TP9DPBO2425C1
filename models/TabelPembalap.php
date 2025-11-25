<?php

include_once __DIR__ . "/DB.php";
include_once __DIR__ . "/../models/KontrakModel.php";

class TabelPembalap extends DB implements KontrakModel
{
    public function __construct($host, $db_name, $username, $password)
    {
        parent::__construct($host, $db_name, $username, $password);
    }

    // READ (List): Join agar mendapatkan nama tim, bukan cuma ID
    public function getAllPembalap(): array
    {
        // Kita ambil t.namaTim dan di-alias sebagai 'tim' untuk dimasukkan ke Objek Pembalap
        $query = "SELECT p.*, t.namaTim as tim 
                  FROM pembalap p 
                  LEFT JOIN team t ON p.team_id = t.id 
                  ORDER BY p.id ASC";
        $this->executeQuery($query);
        return $this->getAllResult();
    }

    // READ (Single): Mengambil data mentah (termasuk team_id) untuk form Edit
    public function getPembalapById($id): ?array
    {
        $query = "SELECT * FROM pembalap WHERE id = :id";
        $this->executeQuery($query, [':id' => $id]);
        $result = $this->getAllResult();
        return $result[0] ?? null;
    }

    // CREATE
    public function addPembalap($nama, $tim, $negara, $poinMusim, $jumlahMenang): void
    {
        // $tim di sini menerima Value dari Dropdown (yaitu team_id)
        $query = "INSERT INTO pembalap (nama, team_id, negara, poinMusim, jumlahMenang) 
                  VALUES (:nama, :team_id, :negara, :poin, :menang)";

        $params = [
            ':nama' => $nama,
            ':team_id' => $tim,
            ':negara' => $negara,
            ':poin' => $poinMusim,
            ':menang' => $jumlahMenang
        ];

        $this->executeQuery($query, $params);
    }

    // UPDATE
    public function updatePembalap($id, $nama, $tim, $negara, $poinMusim, $jumlahMenang): void
    {
        $query = "UPDATE pembalap 
                  SET nama = :nama, 
                      team_id = :team_id, 
                      negara = :negara, 
                      poinMusim = :poin, 
                      jumlahMenang = :menang 
                  WHERE id = :id";

        $params = [
            ':id' => $id,
            ':nama' => $nama,
            ':team_id' => $tim,
            ':negara' => $negara,
            ':poin' => $poinMusim,
            ':menang' => $jumlahMenang
        ];

        $this->executeQuery($query, $params);
    }

    // DELETE
    public function deletePembalap($id): void
    {
        $query = "DELETE FROM pembalap WHERE id = :id";
        $this->executeQuery($query, [':id' => $id]);
    }
}
?>