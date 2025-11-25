<?php

// Pastikan DB.php ada (user biasanya punya file ini, jika tidak buat class DB sederhana)
include_once("models/DB.php");
include_once("models/TabelPembalap.php");
include_once("models/TabelTeam.php");

include_once("views/ViewPembalap.php");
include_once("presenters/PresenterPembalap.php");

include_once("views/ViewTeam.php");
include_once("presenters/PresenterTeam.php");

// Konfigurasi DB Sesuai Dump
$dbHost = 'localhost';
$dbName = 'mvp_db';
$dbUser = 'root';
$dbPass = ''; // Sesuaikan dengan XAMPP kamu

$tabelPembalap = new TabelPembalap($dbHost, $dbName, $dbUser, $dbPass);
$tabelTeam = new TabelTeam($dbHost, $dbName, $dbUser, $dbPass);

// Router Sederhana
$page = isset($_GET['page']) ? $_GET['page'] : 'pembalap';

if ($page == 'team') {
    // --- MODUL TEAM ---
    $viewTeam = new ViewTeam();
    $presenter = new PresenterTeam($tabelTeam, $viewTeam);

    if (isset($_GET['screen'])) {
        if ($_GET['screen'] == 'add') {
            echo $presenter->tampilkanFormTeam();
        } elseif ($_GET['screen'] == 'edit' && isset($_GET['id'])) {
            echo $presenter->tampilkanFormTeam($_GET['id']);
        }
    } elseif (isset($_POST['action'])) {
        // Handling Form Submit Team
        if ($_POST['action'] == 'add_team') {
            $presenter->tambahTeam($_POST['namaTim'], $_POST['negaraAsal']);
        } elseif ($_POST['action'] == 'edit_team') {
            $presenter->ubahTeam($_POST['id'], $_POST['namaTim'], $_POST['negaraAsal']);
        } elseif ($_POST['action'] == 'delete_team') {
            $presenter->hapusTeam($_POST['id']); // Logic alert ada di presenter
        }
        // Jika bukan delete (yang punya logic redirect sendiri), redirect manual
        if ($_POST['action'] != 'delete_team') {
            header("Location: index.php?page=team");
        }
    } else {
        echo $presenter->tampilkanTeam();
    }

} else {
    // --- MODUL PEMBALAP ---
    $viewPembalap = new ViewPembalap();
    $presenter = new PresenterPembalap($tabelPembalap, $viewPembalap, $tabelTeam);

    if (isset($_GET['screen'])) {
        if ($_GET['screen'] == 'add') {
            echo $presenter->tampilkanFormPembalap();
        } elseif ($_GET['screen'] == 'edit' && isset($_GET['id'])) {
            echo $presenter->tampilkanFormPembalap($_GET['id']);
        }
    } elseif (isset($_POST['action'])) {
        // Handling Form Submit Pembalap
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