<?php

include_once __DIR__ . "/../models/Pembalap.php";
include_once __DIR__ . "/KontrakView.php";
// Pastikan semua file yang diperlukan di-include
class ViewPembalap implements KontrakView
{//Pembalap
    public function tampilPembalap($listPembalap): string//Memanggil view tampil pembalap
    {
        $tbody = '';
        foreach ($listPembalap as $pembalap) {
            $tbody .= '<tr>';
            $tbody .= '<td class="col-id">' . $pembalap->getId() . '</td>';
            $tbody .= '<td>' . htmlspecialchars($pembalap->getNama()) . '</td>';
            $tbody .= '<td>' . htmlspecialchars($pembalap->getTim()) . '</td>';
            $tbody .= '<td>' . htmlspecialchars($pembalap->getNegara()) . '</td>';
            $tbody .= '<td>' . htmlspecialchars($pembalap->getPoinMusim()) . '</td>';
            $tbody .= '<td>' . htmlspecialchars($pembalap->getJumlahMenang()) . '</td>';
            $tbody .= '<td class="col-actions">
                    <a href="index.php?screen=edit&id=' . $pembalap->getId() . '" class="btn btn-edit">Edit</a>
                    <button data-id="' . $pembalap->getId() . '" class="btn btn-delete">Hapus</button>
                  </td>';
            $tbody .= '</tr>';
        }

        $templatePath = __DIR__ . '/../template/skin.html';
        if (file_exists($templatePath)) {
            $template = file_get_contents($templatePath);

            $template = str_replace('<tbody></tbody>', '<tbody>' . $tbody . '</tbody>', $template);
            $template = str_replace('>Total:</div>', '>Total: ' . count($listPembalap) . '</div>', $template);

            return $template;
        }

        return "Template skin.html tidak ditemukan!";
    }

    public function tampilFormPembalap($data = null): string
    {//Memanggil view form pembalap
        $pembalap = $data['pembalap'] ?? null;
        $teams = $data['teams'] ?? [];

        $idVal = '';
        $namaVal = '';
        $teamIdVal = '';
        $negaraVal = '';
        $poinVal = '';
        $menangVal = '';
        $actionVal = 'add';

        if ($pembalap) {
            $actionVal = 'edit';
            $idVal = $pembalap['id'];
            $namaVal = $pembalap['nama'];
            $teamIdVal = $pembalap['team_id'];
            $negaraVal = $pembalap['negara'];
            $poinVal = $pembalap['poinMusim'];
            $menangVal = $pembalap['jumlahMenang'];
        }

        // Logic Dropdown
        $teamOptions = '<option value="">-- Pilih Tim --</option>';
        foreach ($teams as $team) {
            // Perhatikan penggunaan 'namaTim' sesuai database tabel team
            $selected = ($team['id'] == $teamIdVal) ? 'selected' : '';
            $teamOptions .= '<option value="' . $team['id'] . '" ' . $selected . '>' . htmlspecialchars($team['namaTim']) . '</option>';
        }
// Load Template
        $templatePath = __DIR__ . '/../template/form.html';
        if (!file_exists($templatePath))//jika file tidak ada
            return "Template form.html hilang!";//kembalikan pesan error

        $html = file_get_contents($templatePath);//baca isi file template

        // Replace Values seperti ViewTeam
        $html = str_replace('name="action" value="add"', 'name="action" value="' . $actionVal . '"', $html);
        $html = str_replace('name="id" value=""', 'name="id" value="' . $idVal . '"', $html);

        // Bersihkan placeholder/value default jika ada
        $html = str_replace('value=""', '', $html);

        // Inject Values
        $html = str_replace('name="nama"', 'name="nama" value="' . $namaVal . '"', $html);
        $html = str_replace('name="negara"', 'name="negara" value="' . $negaraVal . '"', $html);
        $html = str_replace('name="poinMusim"', 'name="poinMusim" value="' . $poinVal . '"', $html);
        $html = str_replace('name="jumlahMenang"', 'name="jumlahMenang" value="' . $menangVal . '"', $html);

        // Inject Dropdown
        $html = str_replace('</select>', $teamOptions . '</select>', $html);

        return $html;//kembalikan html hasil render
    }
}
?>