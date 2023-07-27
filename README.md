<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:
## Pengingat
### php version create
composer create-project --prefer-dist laravel/laravel:^9.0 attendance app


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



