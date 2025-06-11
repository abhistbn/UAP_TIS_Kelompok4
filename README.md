# UAP TIS: REST API Sistem Akademik (Tema Expert)

Berikut ini adalah proyek Ujian Akhir Praktikum untuk mata kuliah Teknologi Integrasi Sistem. Proyek ini mengimplementasikan sebuah REST API fungsional untuk sistem akademik sederhana menggunakan Lumen Framework, dengan fokus pada pengelolaan data Mahasiswa, Prodi, dan Mata Kuliah, serta relasi kompleks di antaranya.

## 👥 Anggota Kelompok

| No. | Nama | NIM |
| --- | --- | --- |
| 1. | Vonny Lorenza A. | [235150707111051] |
| 2. | Amelinda Devota | [235150701111043] |
| 3. | Abhista Tabina W | [235150701111044] |
| 4. | Adinda Febyola | [235150707111055] |
| 5. | Atha Azzahra K.N | [235150701111048] |
| 6. | Fiony Safa A | [235150701111053] |

## ⚙️ Teknologi yang Digunakan
* Lumen Framework 
* MySQL
* Tymon JWT-Auth untuk autentikasi berbasis token


## 🛠️ Kontribusi & Pembagian Tugas
Berikut adalah rincian kontribusi file kode oleh setiap anggota tim:

* **Vonny (API Integrator)**
    * `app/Http/Controllers/ApiController.php`: Mengimplementasikan seluruh logika bisnis untuk fitur-fitur setelah login.
    * `routes/web.php`: Mendaftarkan semua *endpoint* API dan mengelompokkannya sesuai dengan proteksi *middleware*.

* **Amel (Ketua Kelompok, Spesialis User & Autentikasi)**
    * `app/Models/Mahasiswa.php`: Membangun model User kompleks, lengkap dengan implementasi `JWTSubject`.
    * `app/Http/Controllers/AuthController.php`: Menangani seluruh logika untuk proses registrasi dan login user.
    * Pembuatan `README.md`

* **Nawa (Manajer Konfigurasi & Middleware)**
    * `bootstrap/app.php`: Mengonfigurasi dan mengaktifkan *service provider*, *facades*, dan *middleware*.
    * `config/auth.php`: Mengatur konfigurasi *guard* dan *provider* untuk autentikasi JWT.
    * `app/Http/Middleware/Authenticate.php`: Mengimplementasikan middleware untuk memproteksi *endpoint*.

* **Adin (Developer Modul Prodi)**
    * `app/Models/Prodi.php`: Membuat model untuk entitas Prodi beserta relasinya.
    * `database/migrations/..._create_prodi_table.php`: Mendefinisikan struktur tabel `prodi`.
    * `database/seeders/ProdiSeeder.php`: Menyediakan data awal untuk program studi.
    * `ERD`

* **Zara (Developer Modul Mata Kuliah)**
    * `app/Models/Matakuliah.php`: Membuat model untuk entitas Mata Kuliah beserta relasinya.
    * `database/migrations/..._create_matakuliah_table.php`: Mendefinisikan struktur tabel `matakuliah`.
    * `database/seeders/MatakuliahSeeder.php`: Menyediakan data awal untuk mata kuliah.
    * `ERD`

* **Fiony (Arsitek Relasi & Database)**
    * `database/migrations/..._create_mahasiswa_table.php`: Mendefinisikan struktur tabel `mahasiswa` dengan *foreign key*.
    * `database/migrations/..._create_mahasiswa_matakuliah_table.php`: Mendefinisikan struktur tabel pivot untuk relasi *many-to-many*.
    * `database/seeders/DatabaseSeeder.php`: Mengorkestrasi semua proses *seeding*.
    * `ERD`

## 📊 Dokumentasi & Demo Endpoint (Postman)

ERD 
![ERD](assets/ERD.png)

DATABASE
![DATABASE](assets/DATABASE.png)

Berikut adalah alur pengujian API dari awal hingga akhir.

---
### **BAGIAN 1: AUTENTIKASI (TANPA TOKEN)**
---

#### 1. Registrasi Mahasiswa Baru
* **Deskripsi**: Endpoint ini digunakan untuk membuat user (mahasiswa) baru.
* **Method**: `POST`
* **URL**: `/api/register`
* **Body**: `nim`, `nama`, `angkatan`, `password`, `prodi_id`

![Registrasi](path/ke/assets/01-register.png)

#### 2. Login & Mendapatkan Token JWT
* **Deskripsi**: Setelah berhasil mendaftar, user dapat login untuk mendapatkan token autentikasi. Token ini wajib digunakan untuk mengakses endpoint yang diproteksi.
* **Method**: `POST`
* **URL**: `/api/login`
* **Body**: `nim`, `password`

![Login](path/ke/assets/02-login.png)

---
### **BAGIAN 2: FITUR UTAMA (MEMERLUKAN TOKEN)**
---

#### 3. Lihat Semua Mahasiswa
* **Deskripsi**: Menampilkan daftar seluruh mahasiswa yang terdaftar beserta data prodinya.
* **Method**: `GET`
* **URL**: `/api/mahasiswa`

![Get Semua Mahasiswa](assets/03-get-mahasiswa.png)

Jika tidak menginputkan token atau token salah
![Failed](assets/get-mahasiswa-failed-token.png)

#### 4. Lihat Semua Prodi
* **Deskripsi**: Menampilkan daftar seluruh program studi yang tersedia dari database.
* **Method**: `GET`
* **URL**: `/api/prodi`

![Get Semua Prodi](/assets/04-get-prodi.png)

Jika tidak menginputkan token atau token salah
![Failed](assets/get-prodi-failed-token.png)

#### 5. Filter Mahasiswa Berdasarkan Prodi
* **Deskripsi**: Menampilkan daftar mahasiswa yang hanya berasal dari prodi tertentu.
* **Method**: `GET`
* **URL**: `/api/mahasiswa/prodi/{id}` (Contoh: `/api/mahasiswa/prodi/1`)

![Filter Mahasiswa](assets/05-filter-mahasiswa.png)

Jika tidak menginputkan token atau token salah
![Failed](assets/filter-mahasiswa-failed-token.png)

#### 6. Lihat Semua Daftar Mata Kuliah
* **Deskripsi**: Menampilkan seluruh mata kuliah yang tersedia di universitas (dari seeder).
* **Method**: `GET`
* **URL**: `/api/matkul`

![Get Semua Matkul](assets/06-get-matkul.png)

Jika tidak menginputkan token atau token salah
![Failed](assets/get-matkul-failed-token.png)

#### 7. Menambahkan Mata Kuliah ke Mahasiswa (KRS)
* **Deskripsi**: Mahasiswa yang login dapat "mengambil" atau mendaftarkan mata kuliah ke dalam rencanan studinya.
* **Method**: `POST`
* **URL**: `/api/matkul/tambah`
* **Body**: `mkId` (ID dari mata kuliah yang ingin diambil, contohnya (1))

![Tambah Matkul](assets/07-tambah-matkul.png)

Jika mencoba menambahkan mata kuliah yang telah diambil
![Tambah Matkul Failed](assets/tambah-matkul-failed.png)

Jika tidak menginputkan token atau token salah
![Failed](assets/tambah-matkul-failed-token.png)

#### 8. Lihat Daftar Mata Kuliah Milik Mahasiswa
* **Deskripsi**: Menampilkan detail mata kuliah spesifik yang telah diambil oleh mahasiswa yang sedang login.
* **Method**: `GET`
* **URL**: `/api/matkul/{id}` (Contoh: `/api/matkul/1`)

![Get Matkul Milik Sendiri](assets/08-get-matkul-by-id.png)

Apabila mencari id matkul yang tidak ditambah sebelumnya
![Get Matkul Failed](assets/get-matkul-by-id-failed.png)

Jika tidak menginputkan token atau token salah
![Failed](assets/get-matkul-by-id-failed-token.png)

## 🎥 Video Presentasi
Untuk penjelasan yang lebih detail dan demonstrasi langsung, berikut saya lampirkan video presentasi kami melalui tautan berikut:

**[Video Presentasi](https://drive.google.com/drive/folders/1AFExNi6jHWsZeu-HGSGa3gtHtMa7xb-N?usp=sharing)**