<?php
include_once __DIR__ . "/../models/Team.php";

class ViewTeam
{
  public function tampilTeam($listTeam)
  {
    $tbody = '';
    foreach ($listTeam as $team) {
      $tbody .= '<tr>';
      $tbody .= '<td class="col-id">' . $team->getId() . '</td>';
      $tbody .= '<td>' . htmlspecialchars($team->getNamaTim()) . '</td>';
      $tbody .= '<td>' . htmlspecialchars($team->getNegaraAsal()) . '</td>';
      $tbody .= '<td class="col-actions">
                        <a href="index.php?page=team&screen=edit&id=' . $team->getId() . '" class="btn btn-edit">Edit</a>
                        <button data-id="' . $team->getId() . '" class="btn btn-delete">Hapus</button>
                       </td>';
      $tbody .= '</tr>';
    }

    $templatePath = __DIR__ . '/../template/skin_team.html';
    if (file_exists($templatePath)) {
      $template = file_get_contents($templatePath);
      $template = str_replace('<tbody></tbody>', '<tbody>' . $tbody . '</tbody>', $template);
      // Update Total
      $template = str_replace('Total Data Team', 'Total Data Team: ' . count($listTeam), $template);
      return $template;
    }
    return "Template skin_team.html hilang!";
  }

  public function tampilFormTeam($data = null)
  {
    $idVal = '';
    $namaVal = '';
    $negaraVal = '';
    $actionVal = 'add_team';

    if ($data) {
      $actionVal = 'edit_team';
      $idVal = $data['id'];
      $namaVal = $data['namaTim'];
      $negaraVal = $data['negaraAsal'];
    }

    $templatePath = __DIR__ . '/../template/form_team.html';
    if (!file_exists($templatePath))
      return "Template form_team.html hilang!";

    $template = file_get_contents($templatePath);

    // --- PERBAIKAN DI SINI ---

    // 1. Action (Cari name="action" value="add_team")
    $template = str_replace('name="action" value="add_team"', 'name="action" value="' . $actionVal . '"', $template);

    // 2. ID (Cari name="id" value="")
    $template = str_replace('name="id" value=""', 'name="id" value="' . $idVal . '"', $template);

    // 3. Nama Tim
    $searchNama = 'placeholder="Contoh: Red Bull Racing" required value=""';
    $replaceNama = 'placeholder="Contoh: Red Bull Racing" required value="' . $namaVal . '"';
    $template = str_replace($searchNama, $replaceNama, $template);

    // 4. Negara Asal
    $searchNegara = 'placeholder="Contoh: Austria" required value=""';
    $replaceNegara = 'placeholder="Contoh: Austria" required value="' . $negaraVal . '"';
    $template = str_replace($searchNegara, $replaceNegara, $template);

    return $template;
  }
}
?>