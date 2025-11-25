<?php
include_once __DIR__ . "/../models/Team.php";
include_once __DIR__ . "/KontrakView.php"; // Load Interface

class ViewTeam implements KontrakViewTeam
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

    // Replace Values
    $template = str_replace('name="action" value="add_team"', 'name="action" value="' . $actionVal . '"', $template);
    $template = str_replace('name="id" value=""', 'name="id" value="' . $idVal . '"', $template);

    // Replace logic agar value masuk ke input
    $template = str_replace('value=""', '', $template); // Bersihkan value kosong default dulu jika ada konflik
    $template = str_replace('name="namaTim"', 'name="namaTim" value="' . $namaVal . '"', $template);
    $template = str_replace('name="negaraAsal"', 'name="negaraAsal" value="' . $negaraVal . '"', $template);

    return $template;
  }
}
?>