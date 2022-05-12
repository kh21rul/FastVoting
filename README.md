# FastVoting TODO list

## Landing Page
- [ ] Verifikasi session #F
- [ ] Redirect ke dashboard jika sudah login #F
- [ ] Menampilkan halaman home jika belum login #F
- [ ] Menu login
- [ ] Menu register
- [ ] Menu about

## About
- [ ] Menampilkan informasi tentang aplikasi #F
## Register
- [ ] Form register
  - [ ] Menampilkan form register #F
  - [ ] Validasi user input sisi klien #F
  - [ ] Membuat endpoint POST /register #B
  - [ ] Mengirimkan request registrasi #F
  - [ ] Validasi request registrasi #B
  - [ ] Menyimpan data registrasi ke DB #B
- [ ] Kode verifikasi
  - [ ] Membuat kode verifikasi dan menyimpannya ke DB #B
  - [ ] Mengirim email konfirmasi jika sukses #B
- [ ] Respon
  - [ ] Memberi respon jika gagal #B
  - [ ] Menampilkan respon jika gagal #F
- [ ] Redirect ke halaman konfirmasi email jika sukses #F

## Konfirmasi Email
- [ ] Form konfirmasi
  - [ ] Menampilkan form konfirmasi #F
  - [ ] Validasi kode konfirmasi sisi klien #F
  - [ ] Membuat endpoint POST /verify #B
- [ ] Respon
  - [ ] Memberi respon sukses/gagal #B
  - [ ] Menampilkan respon jika gagal #F
- [ ] Redirect ke halaman login jika sukses #F

## Login
- [ ] Verifikasi session #F
- [ ] Redirect ke halaman dashboard jika sudah login #F
- [ ] Form login
  - [ ] Menampilkan form login #F
  - [ ] Validasi user input sisi klien #F
  - [ ] Membuat endpoint POST /login #B
  - [ ] Mengirimkan login request #F
  - [ ] Otentikasi login #B
- [ ] Respon
  - [ ] Memberi respon jika gagal #B
  - [ ] Menampilkan respon jika gagal #F
- [ ] Kredensial
  - [ ] Memberi kredensial jika sukses #B
  - [ ] Menyimpan kredensial ke session #F
- [ ] Menambahkan cookies session login
- [ ] Redirect ke halaman dashboard jika sukses #F

## Dashboard User
- [ ] Verifikasi session #F
- [ ] Redirect ke halaman login jika session invalid #F
- [ ] Menampilkan profil user berdasarkan session #F
- [ ] Daftar voting
  - [ ] Membuat endpoint GET /votes #B
  - [ ] Mengambil daftar voting user #F
  - [ ] Menampilkan daftar voting user #F
- [ ] Buat voting baru
  - [ ] Menampilkan tombol buat voting #F
  - [ ] Menampilkan form buat voting baru #F
  - [ ] Validasi form buat voting baru sisi klien #F
  - [ ] Membuat endpoint POST /newvotes #B
  - [ ] Mengirimkan request voting baru #F
  - [ ] Validasi request voting baru #B
  - [ ] Menampilkan respon jika gagal #F
  - [ ] Redirect ke halaman detail voting jika sukses #F

# Detail Voting
- [ ] Verifikasi session #F
- [ ] Redirect ke halaman login jika session invalid #F
- [ ] Set waktu voting (mulai dan selesai)
- [ ] Daftar pemilih
  - [ ] Membuat endpoint GET /votes/{voteId}/voter #B
  - [ ] Mengambil daftar pemilih #F
- [ ] Tambah pemilih
  - [ ] Menampilkan tombol tambah pemilih #F
  - [ ] Menampilkan form tambah pemilih #F
  - [ ] Validasi form tambah pemilih sisi klien #F
  - [ ] Membuat endpoint POST /votes/{voteId}/voter #B
  - [ ] Mengirimkan request tambah pemilih #F
  - [ ] Validasi request tambah pemilih #B
  - [ ] Menampilkan respon sukses/gagal #F
  - [ ] Mengirim email ke pemilih dengan info :
    1) Waktu voting
    2) Link voting
- [ ] Opsi voting
  - [ ] Menambahkan opsi voting (teks & gambar)
- [ ] Hasil voting
  - [ ] Membuat endpoint GET /votes/{voteId}/result #B
  - [ ] Menampilkan hasil voting real-time setelah waktu voting dimulai #F

# Vote
- [ ] Verifikasi link
- [ ] Mengirim vote
- [ ] Menampilkan hasil voting real-time jika sudah vote

# Dashboard Admin
- [ ] Verifikasi session #F
- [ ] Menampilkan daftar user
- [ ] Menghapus user
