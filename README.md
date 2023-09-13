<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>


Halo semuanya,
Pada kesempatan kali ini, saya ingin mengumumkan bahwa saya telah memperbaharui API aplikasi absensi online yang sebelumnya sudah pernah saya bagikan. Penambahan terbaru ini mencakup beberapa fitur keamanan yang akan membuat absensi menjadi semakin sulit untuk dicurangi.
Berikut adalah beberapa fitur keamanan baru yang telah ditambahkan:

- **Cek lokasi user:** Fitur ini memungkinkan Anda untuk melacak lokasi user pada saat melakukan absensi. Hal ini dapat membantu untuk mencegah absensi fiktif.
- **Cek status user pada hari ini:** Fitur ini memungkinkan Anda untuk melihat status absensi user pada hari ini. Hal ini dapat membantu untuk memantau kehadiran user secara lebih akurat.
- **Cek in berdasarkan area yang ditentukan:** Fitur ini memungkinkan Anda untuk menentukan area tertentu di mana user dapat melakukan absensi. Hal ini dapat membantu untuk mencegah absensi di luar jam kerja atau di luar area yang ditentukan.
- **Cek in dan menambahkan bukti kehadiran dengan foto:** Fitur ini memungkinkan user untuk menambahkan foto sebagai bukti kehadiran. Hal ini dapat membantu untuk mencegah absensi fiktif.
- **Cek out berdasarkan area yang ditentukan:** Fitur ini memungkinkan Anda untuk menentukan area tertentu di mana user dapat melakukan cek out. Hal ini dapat membantu untuk mencegah absensi di luar jam kerja atau di luar area yang ditentukan.

Framework yang saya gunakan dalam pengembangan API ini adalah Laravel. Setelah ini, saya akan mengkonsumsi API ini menggunakan Flutter untuk membuat aplikasi absensi lengkap.

Terima kasih atas perhatiannya.




## Authentification
## Basis URL

Base url tergantung dengan setting pada komputer teman teman, disini karna masih menggunakan local maka base url yang saya gunakan sebagai berikut:
```
http://127.0.0.1:8000
```
## Authentification
### Login 

**Deskripsi**: Melakukan login ke dalam sistem.

**URL**: `api/auth/login`

**Metode**: POST

**Parameter Wajib Di Isi**:

- `email` (wajib): admin@admin.com
- `password` (wajib): password

**Contoh Permintaan**:
```http
POST /api/auth/login
Content-Type: application/json

{
  "email": "admin@admin.com",
  "password": "password"
}
```
**Contoh Respons**:

```json
{
  "status": "success",
  "data": {
    "token": "8|dCBn36JNlXgpUDmX4O6vm5CXTslKWmdgrTO9PtVb",
    "user": {
      "id": 11,
      "email": "admin@admin.com",
      "avatar": null
    }
  }
}

```

### Register 

**Deskripsi**: Melakukan login ke dalam sistem.

**URL**: `api/auth/login`

**Metode**: POST

**Parameter Wajib Di Isi**:

- `email` (wajib): admin@admin.com
- `password` (wajib): password,
- `name` (wajib): admin ganteng,
- `tanggal_lahir` (wajib): 2016-08-05,
- `nomor_telp` (wajib): 083333333,
- `alamat` (wajib): jalan keuning,
- `avatar` (optional): file,

**Contoh Permintaan**:
```http
POST /api/auth/register
Content-Type: application/json

{
  "email": "admin@admin.com",
  "password" : "password",
  "name": "zulkarnaen",
  "tanggal_lahir": "2016-08-05",
  "nomor_telp": "083333333",
  "alamat":  "jalan keuning"
}
```
**Contoh Respons**:

```json
{
  "message": "User registered successfully"
}

```

### Logout

API ini memerlukan autentikasi menggunakan token. Untuk mengakses endpoint ini, Anda perlu menyertakan token autentikasi dalam header permintaan. untuk mendapatkan token nya ketika di akses pada end point [login](#login) di atas.

**Deskripsi**: Melakukan logout dari sistem.

**URL**: `api/auth/login`

**Metode**: GET

```http
GET /api/auth/logout
Authorization: Bearer {token}

```
**Contoh Respons**:

```json
{
  "status": "success",
  "message": "berhasil logout"
}

```

### Profile

API ini memerlukan autentikasi menggunakan token. Untuk mengakses endpoint ini, Anda perlu menyertakan token autentikasi dalam header permintaan. untuk mendapatkan token nya ketika di akses pada end point [login](#login) di atas.

**Deskripsi**: Melihat profile user yang sedang login dengan token yang tersedia

**URL**: `api/auth/profile`

**Metode**: GET

```http
GET /api/auth/profile
Authorization: Bearer {token}

```
**Contoh Respons**:

```json
{
  {
  "id": 1,
  "role_id": 1,
  "name": "Admin",
  "email": "admin@admin.com",
  "avatar": "users/default.png",
  "tanggal_lahir": null,
  "alamat": null,
  "nomor_telp": null,
  "email_verified_at": null,
}
}

```


### Absen Masuk 

**Deskripsi**: Absen masuk

**URL**: `api/attendance/absenMasuk`

**Metode**: POST

**Parameter Wajib Di Isi**:

- `lokasi_masuk` (wajib): wakatobi
- `user_id` (wajib): 1,

**Contoh Permintaan**:
```http
POST /api/auth/register
Content-Type: application/json

{
  "lokasi_masuk" : "wakatobi",
  "user_id": 1
}
```
**Contoh Respons**:
- Response true
```json
{
  {
  "message": "berhasil absen masuk",
  "data": {
    "id": 75,
    "user_id": "1",
    "waktu_masuk": "16:54:06",
    "waktu_keluar": null,
    "lokasi_masuk": "wakatobi",
    "lokasi_keluar": null,
    "created_at": "2023-07-27T09:54:06.000000Z",
    "updated_at": "2023-07-27T09:54:06.000000Z",
    "tanggal": "2023-07-27",
    "waktu_kerja": null
  },
  "status": 201
}
}

```

- Response false (409)
```json
{
  "status": false,
  "message": "anda sudah absen masuk, harap tunggu absen keluar"
}

```


### Absen Keluar 

**Deskripsi**: Absen Keluar

**URL**: `api/attendance/absenKeluar`

**Metode**: POST

**Parameter Wajib Di Isi**:

- `lokasi_keluar` (wajib): wakatobi
- `user_id` (wajib): 1,

**Contoh Permintaan**:
```http
POST /api/attendance/absenKeluar
Content-Type: application/json

{
  "lokasi_keluar" : "wakatobi",
  "user_id" : 1
}
```
**Contoh Respons**:
- Response true
```json
{
  "message": "Berhasil absen Keluar",
  "status": 200
}
```

- Response false (409)
```json
{
  "status": false,
  "message": "Anda sudah menyelesaikan pekerjaan hari ini"
}
```


### Cek data absen

**Deskripsi**: untuk mendapatkan data dari user setelah absen masuk dan keluar

**URL**: `api/attendance/getAttendance/1`

**Metode**: GET

```http
GET /api/attendance/getAttendance/{id_user}
```
**Contoh Respons**:

```json
{
  "status": true,
  "message": "Get Data Attandace",
  "data": {
    "id": 75,
    "user_id": "1",
    "waktu_masuk": "16:54:06",
    "waktu_keluar": "16:59:30",
    "lokasi_masuk": "wakatobi",
    "lokasi_keluar": "wakatobi",
    "created_at": "2023-07-27T09:54:06.000000Z",
    "updated_at": "2023-07-27T09:59:30.000000Z",
    "tanggal": "2023-07-27",
    "waktu_kerja": "00:05:24"
  }
}
```