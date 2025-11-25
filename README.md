<h1>🧾 Janji</h1>

> Saya Muhammad Maulana Adrian dengan NIM 2408647 mengerjakan Tugas Praktikum 9
> dalam mata kuliah Desain Pemrograman Berbasis Objek untuk keberkahanNya maka
> saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin

---

<h2>🌐 Deskripsi Proyek</h2>

Proyek ini adalah aplikasi web sederhana untuk memanajemen data **F1 (Formula 1)** yang terdiri dari data **Pembalap (Drivers)** dan **Tim (Teams)**. Aplikasi ini dibangun menggunakan bahasa pemrograman **PHP Native** dan database **MySQL**.

Secara arsitektur, proyek ini menerapkan pola **Model–View–Presenter (MVP)** untuk memisahkan logika bisnis (Model), tampilan antarmuka (View), dan logika presentasi (Presenter). Hal ini dilakukan untuk menjaga kode tetap rapi, terstruktur, dan mudah dikembangkan.

### Cakupan Proyek
1.  **Manajemen Data Pembalap:** CRUD lengkap untuk data pembalap dengan fitur relasi ke Tim (dropdown).
2.  **Manajemen Data Team:** CRUD lengkap untuk data tim balap yang menjadi referensi bagi data pembalap.

---

<h2>📚 Hubungan Antar Entitas</h2>

Aplikasi ini menggunakan relasi **One-to-Many** antara tabel `team` dan `pembalap`.

* **1 Tim** dapat menaungi **Banyak Pembalap**.
* **1 Pembalap** hanya dapat tergabung dalam **1 Tim**.
* Relasi diimplementasikan melalui kolom `team_id` pada tabel `pembalap` yang merujuk ke `id` pada tabel `team`.

---

<h2>🖼️ Desain Database</h2>



| Tabel | Kolom | Keterangan |
| :--- | :--- | :--- |
| `team` | `id`, `namaTim`, `negaraAsal` | Tabel induk. Menyimpan informasi tim konstruktor. |
| `pembalap` | `id`, `nama`, `negara`, `poinMusim`, `jumlahMenang`, `team_id` | Tabel anak. Kolom `team_id` adalah *Foreign Key*. |

---

<h2>📝 Struktur Program (Arsitektur MVP)</h2>

Struktur kode dipisahkan berdasarkan tanggung jawabnya masing-masing sesuai pola MVP.

### 1. Contracts (Interface)
Mendefinisikan kontrak agar komunikasi antar komponen (Model, View, Presenter) terstandarisasi.
* `contracts/KontrakModel.php`: Interface untuk operasi data Pembalap & Team.
* `contracts/KontrakView.php`: Interface untuk tampilan Pembalap & Team.
* `contracts/KontrakPresenter.php`: Interface untuk logika presentasi Pembalap & Team.

### 2. Models (Logika Data)
Bertanggung jawab mengelola akses ke database.
* `models/DB.php`: Wrapper untuk koneksi database menggunakan PDO.
* `models/Pembalap.php`: Class representasi objek Pembalap.
* `models/Team.php`: Class representasi objek Team.
* `models/TabelPembalap.php`: Menangani Query CRUD tabel `pembalap`.
* `models/TabelTeam.php`: Menangani Query CRUD tabel `team`.

### 3. Views (Tampilan)
Bertanggung jawab menampilkan data ke pengguna (HTML). **View tidak boleh akses database langsung.**
* `views/ViewPembalap.php`: Mengurus tampilan list dan form pembalap.
* `views/ViewTeam.php`: Mengurus tampilan list dan form team.
* `template/skin.html`: Template HTML daftar pembalap.
* `template/form.html`: Template HTML form tambah/edit pembalap.
* `template/skin_team.html`: Template HTML daftar team.
* `template/form_team.html`: Template HTML form tambah/edit team.

### 4. Presenters (Penghubung)
Perantara yang mengambil data dari Model dan memberikannya ke View.
* `presenters/PresenterPembalap.php`: Mengatur logika halaman pembalap (termasuk mengambil data Team untuk dropdown).
* `presenters/PresenterTeam.php`: Mengatur logika halaman team.

### 5. Main
* `index.php`: Entry point aplikasi yang mengatur routing halaman (`?page=team` atau default).

---

<h2>🚀 Fitur Aplikasi</h2>

### A. Manajemen Pembalap (Racers)
* **Read:** Menampilkan daftar pembalap beserta nama timnya (hasil JOIN tabel).
* **Create:** Menambah pembalap baru dengan memilih Tim dari *dropdown* (data diambil dinamis dari tabel Team).
* **Update:** Mengedit data pembalap (form terisi otomatis/prefill).
* **Delete:** Menghapus data pembalap.

### B. Manajemen Team (Teams)
* **Read:** Menampilkan daftar tim yang terdaftar.
* **Create:** Menambah tim baru.
* **Update:** Mengedit informasi tim.
* **Delete:** Menghapus tim.
    * *Validasi:* Sistem akan mencegah/memberi alert jika menghapus Tim yang masih memiliki anggota Pembalap (menjaga integritas referensi).

---

<h2>⚙️ Cara Menjalankan</h2>

1.  **Persiapan Database:**
    * Buat database baru di MySQL (misal: `mvp_db`).
    * Impor file `mvp_db.sql` yang disertakan dalam proyek ini.

2.  **Konfigurasi Koneksi:**
    * Buka file `index.php`.
    * Sesuaikan konfigurasi database berikut dengan server Anda:
        ```php
        $dbHost = 'localhost';
        $dbName = 'mvp_db';
        $dbUser = 'root';
        $dbPass = ''; // Sesuaikan password mysql Anda
        ```

3.  **Jalankan:**
    * Buka browser dan akses: `http://localhost/folder_proyek/index.php`.
    * Gunakan navigasi tab di atas tabel untuk berpindah antara menu **Data Pembalap** dan **Data Team**.

---

<h2>🎮 Tampilan Program</h2>

**(Silakan ganti bagian ini dengan screenshot aplikasi Anda)**

<img width="1919" height="1047" alt="Tampilan Data Pembalap" src="[Link Gambar List Pembalap]" />
<br>
<img width="1919" height="1047" alt="Tampilan Data Team" src="[Link Gambar List Team]" />
