## About 
REST API E-Learning Kampus berbasis Laravel untuk mengelola:

- Autentikasi Mahasiswa & Dosen (token)
- Mata Kuliah & Enrollment
- Materi Perkuliahan (upload & download)
- Tugas & Submission
- Penilaian
- Forum Diskusi
- Laporan & Statistik

Menggunakan:

- Laravel 12
- Sanctum Token Auth
- MySQL
- Laravel Storage
- Soft Delete
- Email Notification
- WebSocket (reverb)
- postman

---

## Instalasi

Clone repository:

```
git clone https://github.com/mujaddid298/E-LEARNING.git
cd elearning
composer install
npm install
````
Copy env dan Key generate:

```
cp .env.example .env
php artisan key:generate
````
## Endpoint Utama

Course
GET    /api/courses
POST   /api/courses
PUT    /api/courses/{id}
DELETE /api/courses/{id}
POST   /api/courses/{id}/enroll

Materials
POST /api/materials
GET  /api/materials/{id}/download

Assignments & Submission
POST /api/assignments
POST /api/submissions
POST /api/submissions/{id}/grade

Discussion Forum
POST /api/discussions
POST /api/discussions/{id}/replies

Reports & Statistik
GET /api/reports/courses
GET /api/reports/assignments
GET /api/reports/students/{id}


Aktifkan link storage:

```
php artisan storage:link
````

## Setup Reverb

Install package:

```
composer require laravel/reverb
````

Publish config:

```
php artisan reverb:install
````

## Menjalankan Reverb Server

Jalankan server websocket:
```
php artisan reverb:start
````
Jalankan juga queue & app server:
```
php artisan queue:work
php artisan serve
npm run dev
````

## Test realtime
akses:
```
http://127.0.0.1:8000/test/discussion
http://127.0.0.1:8000/test/replies
````
dan coba lakukan pembuatan Discussion dan Rieplai di postman dengan endpoint:
```
POST /api/discussions
POST /api/discussions/{id}/replies
````






