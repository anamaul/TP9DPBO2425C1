<?php

// Models
include_once("models/DB.php");
include_once("models/TabelPembalap.php");
include_once("models/TabelTeam.php");

// Views
include_once("views/ViewPembalap.php");
include_once("views/ViewTeam.php");

// Presenters
include_once("presenters/PresenterPembalap.php");
include_once("presenters/PresenterTeam.php");

// Konfigurasi Database
$dbHost = 'localhost';
$dbName = 'mvp_db';
$dbUser = 'root';
$dbPass = ''; // Kosongkan jika pakai XAMPP default

// Inisialisasi Model
$tabelPembalap = new TabelPembalap($dbHost, $dbName, $dbUser, $dbPass);
$tabelTeam = new TabelTeam($dbHost, $dbName, $dbUser, $dbPass);

// Router
$page = isset($_GET['page']) ? $_GET['page'] : 'pembalap';

if ($page == 'team') {
    // --- MODUL TEAM ---
    $viewTeam = new ViewTeam();
    $presenter = new PresenterTeam($tabelTeam, $viewTeam);

    if (isset($_GET['screen'])) {
        // Layar Form (Add/Edit)
        if ($_GET['screen'] == 'add') {
            echo $presenter->tampilkanFormTeam();
        } elseif ($_GET['screen'] == 'edit' && isset($_GET['id'])) {
            echo $presenter->tampilkanFormTeam($_GET['id']);
        }
    } elseif (isset($_POST['action'])) {
        // Handling Action (CRUD)
        if ($_POST['action'] == 'add_team') {
            $presenter->tambahTeam($_POST['namaTim'], $_POST['negaraAsal']);
            header("Location: index.php?page=team");
        } elseif ($_POST['action'] == 'edit_team') {
            $presenter->ubahTeam($_POST['id'], $_POST['namaTim'], $_POST['negaraAsal']);
            header("Location: index.php?page=team");
        } elseif ($_POST['action'] == 'delete_team') {
            $presenter->hapusTeam($_POST['id']);
            // Tidak perlu header() disini karena hapusTeam punya logic alert sendiri
        }
    } else {
        // Layar Utama (List)
        echo $presenter->tampilkanTeam();
    }

} else {
    // --- MODUL PEMBALAP ---
    $viewPembalap = new ViewPembalap();
    // Presenter Pembalap butuh TabelTeam juga untuk Dropdown Tim
    $presenter = new PresenterPembalap($tabelPembalap, $viewPembalap, $tabelTeam);

    if (isset($_GET['screen'])) {
        if ($_GET['screen'] == 'add') {
            echo $presenter->tampilkanFormPembalap();
        } elseif ($_GET['screen'] == 'edit' && isset($_GET['id'])) {
            echo $presenter->tampilkanFormPembalap($_GET['id']);
        }
    } elseif (isset($_POST['action'])) {
        if ($_POST['action'] == 'add') {
            $presenter->tambahPembalap($_POST['nama'], $_POST['tim'], $_POST['negara'], $_POST['poinMusim'], $_POST['jumlahMenang']);
        } elseif ($_POST['action'] == 'edit') {
            $presenter->ubahPembalap($_POST['id'], $_POST['nama'], $_POST['tim'], $_POST['negara'], $_POST['poinMusim'], $_POST['jumlahMenang']);
        } elseif ($_POST['action'] == 'delete') {
            $presenter->hapusPembalap($_POST['id']);
        }
        header("Location: index.php");
    } else {
        echo $presenter->tampilkanPembalap();
    }
}
?>