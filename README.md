<h1>🧾 Janji</h1>
Saya Muhammad Maulana Adrian dengan NIM 2408647 mengerjakan Tugas Praktikum 9
dalam mata kuliah Desain Pemrograman Berbasis Objek untuk keberkahanNya maka
saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin

---

<h2>🌐 Deskripsi Proyek</h2>

Proyek ini adalah implementasi aplikasi **CRUD (Create, Read, Update, Delete)** untuk mengelola data **Pembalap** dan **Tim Balap**. Proyek ini secara ketat menerapkan arsitektur **Model–View–Presenter (MVP)**, dengan fokus utama pada modul **Tim (Team)**, untuk mencapai **pemisahan tanggung jawab (Separation of Concerns)** yang jelas.

**Poin Utama Implementasi MVP:**
* **Model** (`TabelTeam.php`): Bertanggung jawab atas semua operasi database CRUD.
* **View** (`ViewTeam.php`): Bertanggung jawab atas tampilan UI (`skin_team.html`, `form_team.html`). **View tidak memiliki pengetahuan langsung tentang Model.**
* **Presenter** (`PresenterTeam.php`): Bertindak sebagai **perantara** data dan logika kontrol antara View dan Model.
* **Kontrak/Interface** (`KontrakModel.php`, `KontrakPresenter.php`, `KontrakView.php`): Digunakan untuk mendefinisikan interaksi yang wajib dipenuhi oleh setiap komponen, memastikan **decoupling** antar komponen.

---

<h2>📚 Hubungan Antar Entitas (Relasi One-to-Many)</h2>

Skema database menunjukkan relasi **One-to-Many** antara **Tim (`team`)** dan **Pembalap (`pembalap`)**.

* Satu **Tim** (PK: `team.id`) dapat diacu oleh banyak **Pembalap** (FK: `pembalap.team_id`).
* Pada operasi **DELETE** Tim, logika di **PresenterTeam** akan menampilkan *alert* jika Tim tersebut masih memiliki Pembalap yang terdaftar (mencegah pelanggaran *Foreign Key*).

<h2>🖼️ Design Database</h2>

<img width="793" height="250" alt="Skema database untuk tabel pembalap dan team dengan relasi foreign key" src="https://github.com/user-attachments/assets/941e7d0e-5a5f-4d37-97d8-f864147c2d2d" />

> **Keterangan Tabel:**
> 1.  `pembalap`: Menyimpan data Pembalap (id, nama, negara, poinMusim, jumlahMenang). Memiliki Foreign Key `team_id`.
> 2.  `team`: Menyimpan data Tim Balap (id, namaTim, negaraAsal). Ini adalah tabel target untuk implementasi **CRUD MVP**.

---

<h2>🛠️ Persyaratan Sistem</h2>

* Web Server: **Apache** atau **Nginx**
* Database: **MySQL / MariaDB**
* Bahasa Pemrograman: **PHP** (Versi 7.4 ke atas disarankan)

---

<h2>📝 Desain Program & Struktur File (MVP)</h2>

Aplikasi ini menggunakan struktur yang memisahkan tanggung jawab, dengan fokus utama pada pemisahan View dari Model menggunakan Presenter.

| Folder/File | Peran Utama | Keterangan |
| :--- | :--- | :--- |
| `index.php` | Entry Point & Router | Mengatur *routing* halaman (`page=team` atau `pembalap`) dan inisialisasi Presenter. |
| `models/DB.php` | Koneksi Database | Class dasar untuk koneksi **PDO**. |
| `models/TabelTeam.php` | **Model CRUD Tim** | Melakukan semua operasi CRUD ke tabel `team`. Mengimplementasikan `KontrakModelTeam`. |
| `presenters/PresenterTeam.php` | **Presenter Tim (MVP)** | Implementasi `KontrakPresenterTeam`. Menerima *action* dari View, memanggil Model, dan mengarahkan hasil ke View. |
| `views/ViewTeam.php` | **View Tim** | Implementasi `KontrakViewTeam`. Hanya bertanggung jawab pada logika rendering HTML/UI (`skin_team.html`, `form_team.html`). **Tidak ada logika CRUD atau pemanggilan Model di sini.** |
| `contracts/KontrakModel.php` | Interface Model | Mendefinisikan kontrak untuk Model Pembalap dan Tim. |
| `contracts/KontrakPresenter.php` | Interface Presenter | Mendefinisikan kontrak untuk Presenter Pembalap dan Tim. |
| `contracts/KontrakView.php` | Interface View | Mendefinisikan kontrak untuk View Pembalap dan Tim. |
| `template/skin_team.html` | Template View | HTML/UI untuk daftar Tim. |
| `template/form_team.html` | Template View | HTML/UI untuk form Tambah/Ubah Tim. |

---

<h2>🚀 Fitur CRUD Tim Balap (MVP)</h2>

Modul Tim Balap (`index.php?page=team`) mengimplementasikan fitur CRUD lengkap dengan arsitektur MVP:

* ✅ **Read/List (Tabel)**: Menampilkan data Tim (`skin_team.html`).
* ✅ **Create (Form)**: Menyediakan form untuk menambahkan Tim baru (`form_team.html`).
* ✅ **Update (Form Prefill)**: Menyediakan form yang sudah terisi (*prefill*) data Tim yang akan diubah.
* ✅ **Delete (Tombol)**: Menghapus data Tim. Dilengkapi *alert* di Presenter jika Tim memiliki Pembalap aktif (*Foreign Key constraint*).

---

<h2>⚙️ Cara Menjalankan</h2>
<ol>
    <li>**Setup Database**: Impor file `mvp_db.sql` ke server MySQL/MariaDB lokal Anda.</li>
    <li>**Konfigurasi PHP**: Sesuaikan kredensial database di file `index.php` pada bagian **Konfigurasi Database** (terutama `$dbPass`).</li>
    <li>**Akses Aplikasi**: Tempatkan semua file proyek di folder root server web lokal Anda.</li>
    <li>Akses melalui browser: `http://localhost/[nama_folder]/index.php?page=team` untuk modul Tim (MVP) atau `http://localhost/[nama_folder]/index.php` untuk modul Pembalap.</li>
</ol>

---

<h2>🎮 Tampilan Program & Demo</h2>

**(Harap Sisipkan Tangkapan Layar Tampilan CRUD Tim Anda di sini)**

<img width="1919" height="1047" alt="Contoh tampilan list Tim Balap menggunakan skin_team.html" src="[Link Gambar Tampilan List CRUD Tim Anda]" />

**(Harap Sisipkan Video Demo Anda di sini)**

[Video Demo Fitur CRUD Tim Balap (MVP)]
