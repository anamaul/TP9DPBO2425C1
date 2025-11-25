<?php

include_once __DIR__ . "/KontrakView.php";
include_once __DIR__ . "/../models/Pembalap.php";

class ViewPembalap implements KontrakView
{
    public function tampilPembalap($listPembalap): string
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

            // Replace tbody
            $template = str_replace('<tbody></tbody>', '<tbody>' . $tbody . '</tbody>', $template);

            // Replace Total Data (HTML Anda: <div ...>Total:</div>)
            $template = str_replace('>Total:</div>', '>Total: ' . count($listPembalap) . '</div>', $template);

            return $template;
        }

        return "Template skin.html tidak ditemukan!";
    }

    public function tampilFormPembalap($data = null): string
    {
        $pembalap = $data['pembalap'] ?? null;
        $teams = $data['teams'] ?? [];

        $idVal = '';
        $namaVal = '';
        $teamIdVal = '';
        $negaraVal = '';
        $poinVal = '';
        $menangVal = '';
        $actionVal = 'add'; // Default add

        if ($pembalap) {
            $actionVal = 'edit';
            $idVal = $pembalap['id'];
            $namaVal = $pembalap['nama'];
            $teamIdVal = $pembalap['team_id'];
            $negaraVal = $pembalap['negara'];
            $poinVal = $pembalap['poinMusim'];
            $menangVal = $pembalap['jumlahMenang'];
        }

        $teamOptions = '<option value="">-- Pilih Tim --</option>';
        foreach ($teams as $team) {
            $selected = ($team['id'] == $teamIdVal) ? 'selected' : '';
            $teamOptions .= '<option value="' . $team['id'] . '" ' . $selected . '>' . htmlspecialchars($team['namaTim']) . '</option>';
        }

        $templatePath = __DIR__ . '/../template/form.html';
        if (!file_exists($templatePath))
            return "Template form.html missing!";

        $html = file_get_contents($templatePath);

        // --- PERBAIKAN DI SINI (Target Replace lebih aman) ---

        // 1. Mengganti Action (Cari name="action" value="add")
        $html = str_replace('name="action" value="add"', 'name="action" value="' . $actionVal . '"', $html);

        // 2. Mengganti ID (Cari name="id" value="")
        $html = str_replace('name="id" value=""', 'name="id" value="' . $idVal . '"', $html);

        // 3. Mengisi Nama
        $html = str_replace('placeholder="Nama pembalap"', 'placeholder="Nama pembalap" value="' . $namaVal . '"', $html);

        // 4. Dropdown Tim
        $html = str_replace('</select>', $teamOptions . '</select>', $html);

        // 5. Negara
        $html = str_replace('placeholder="Negara (mis. Indonesia)"', 'placeholder="Negara (mis. Indonesia)" value="' . $negaraVal . '"', $html);

        // 6. Poin & Menang (Kita replace name-nya untuk menyisipkan value)
        $html = str_replace('name="poinMusim"', 'name="poinMusim" value="' . $poinVal . '"', $html);
        $html = str_replace('name="jumlahMenang"', 'name="jumlahMenang" value="' . $menangVal . '"', $html);

        return $html;
    }
}
?>