# Botika Management Inventaris

Sistem manajemen inventaris untuk kantor IT yang memudahkan pengelolaan barang, pengguna, dan status inventaris secara terintegrasi.

## Deskripsi Proyek

**Botika Management Inventaris** adalah aplikasi web full-stack yang dirancang untuk membantu kantor IT mengelola inventaris peralatan dan aset teknologi. Sistem ini menyediakan fitur lengkap untuk pengelolaan data pengguna, inventaris, departemen, dan status barang dengan antarmuka yang user-friendly.

## Fitur Utama

- **Manajemen Pengguna**: Tambah, edit, hapus, dan kelola data pengguna dengan role-based access
- **Manajemen Inventaris**: Kelola data aset IT dengan kategori, status, dan informasi lengkap
- **Manajemen Departemen**: Organisasi departemen dalam kantor.
- **Analytics & Reporting**: Dashboard dengan visualisasi data inventaris menggunakan chart
- **Autentikasi & Autorisasi**: Sistem login dengan Sanctum Token untuk keamanan API
- **Responsive Design**: Antarmuka yang responsif dan modern dengan Tailwind CSS

## Tech Stack

### Backend

- **Framework**: Laravel 8+ (PHP)
- **Database**: MySQL/PostgreSQL
- **Authentication**: Laravel Sanctum
- **API Style**: REST API

### Frontend

- **Framework**: Vue 3 dengan Composition API
- **Language**: TypeScript
- **Build Tool**: Vite
- **Styling**: Tailwind CSS
- **HTTP Client**: Axios
- **Routing**: Vue Router
- **Charts**: Chart.js & Vue-ChartJS
- **Icons**: Heroicons

## Struktur Proyek

```
botika-management-inventaris/
├── backend/               # API Laravel
│   ├── app/
│   │   ├── Http/
│   │   │   ├── Controllers/
│   │   │   │   ├── Api/
│   │   │   │   │   ├── AuthController.php
│   │   │   │   │   ├── UserController.php
│   │   │   │   │   └── InventarisController.php
│   │   │   │   └── UtilityController.php
│   │   │   └── Middleware/
│   │   └── Models/
│   │       ├── User.php
│   │       ├── Inventaris.php
│   │       ├── Department.php
│   │       ├── Position.php
│   │       ├── Status_inventaris.php
│   │       └── type_inventaris.php
│   ├── database/
│   │   ├── migrations/
│   │   ├── seeders/
│   │   └── factories/
│   ├── routes/
│   │   ├── api.php
│   │   └── web.php
│   └── config/
│
└── frontend/             # Vue.js + TypeScript
    ├── src/
    │   ├── api/          # API services
    │   ├── pages/        # Page components
    │   ├── components/   # Reusable components
    │   ├── router/       # Vue Router configuration
    │   ├── types/        # TypeScript types
    │   ├── assets/       # Static assets
    │   └── App.vue
    └── public/
```

## API Endpoints

### Autentikasi

- `POST /api/login` - Login pengguna
- `POST /api/logout` - Logout pengguna (memerlukan token)

### Pengguna

- `GET /api/users` - Dapatkan semua pengguna
- `POST /api/users/create` - Buat pengguna baru
- `PUT /api/users/{id}` - Update pengguna
- `DELETE /api/users/{id}` - Hapus pengguna

### Inventaris

- `GET /api/inventaris` - Dapatkan semua inventaris
- `POST /api/inventaris/create` - Buat inventaris baru
- `PUT /api/inventaris/{id}` - Update inventaris
- `DELETE /api/inventaris/{id}` - Hapus inventaris
- `GET /api/inventaris/analytics` - Dapatkan data analytics

### Utility/Reference Data

- `GET /api/departments` - Dapatkan semua departemen
- `GET /api/positions` - Dapatkan semua posisi
- `GET /api/status/inventaris` - Dapatkan status inventaris
- `GET /api/assigns` - Dapatkan pengguna yang ditugaskan

**Catatan**: Semua endpoint kecuali login memerlukan autentikasi dengan Bearer token

## Instalasi

### Prasyarat

- PHP 8.0+
- Node.js 16+
- Composer
- MySQL/PostgreSQL

### Setup Backend

1. Masuk ke direktori backend:

```bash
cd backend
```

2. Install dependencies:

```bash
composer install
```

3. Copy file environment:

```bash
cp .env.example .env
```

4. Generate application key:

```bash
php artisan key:generate
```

5. Konfigurasi database di file `.env`:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=inventory_db
DB_USERNAME=root
DB_PASSWORD=
```

6. Jalankan migrations dan seeders:

```bash
php artisan migrate --seed
```

7. Jalankan server development:

```bash
php artisan serve
```

Server akan berjalan di `http://localhost:8000`

### Setup Frontend

1. Masuk ke direktori frontend:

```bash
cd frontend
```

2. Install dependencies:

```bash
npm install
```

3. Buat file `.env.local` (jika diperlukan):

```
VITE_API_URL=http://localhost:8000/api
```

4. Jalankan development server:

```bash
npm run dev
```

Aplikasi akan berjalan di `http://localhost:5173`

## Development

### Backend

```bash
cd backend
php artisan serve                  # Jalankan server
php artisan migrate               # Jalankan migrations
php artisan db:seed               # Jalankan seeders
php artisan tinker                # Interactive shell
```

### Frontend

```bash
cd frontend
npm run dev                        # Development server
npm run build                      # Production build
npm run preview                    # Preview production build
```

## Build & Deployment

### Frontend Build

```bash
cd frontend
npm run build
```

Output akan tersimpan di folder `dist/`

### Backend Deployment

1. Upload file ke server
2. Jalankan `composer install --no-dev`
3. Konfigurasi file `.env` untuk production
4. Jalankan `php artisan migrate --force`
5. Jalankan `php artisan config:cache`

## Database Models

### User

- id, name, email, password, position_id, department_id, role, created_at, updated_at

### Inventaris

- id, name, type_id, status_id, assigned_to, quantity, purchase_date, created_at, updated_at

### Department

- id, name, created_at, updated_at

### Position

- id, name, created_at, updated_at

### Status Inventaris

- id, name, created_at, updated_at

### Type Inventaris

- id, name, created_at, updated_at

## Kontribusi

Untuk berkontribusi pada proyek ini:

1. Fork repository
2. Buat branch feature (`git checkout -b feature/AmazingFeature`)
3. Commit perubahan (`git commit -m 'Add some AmazingFeature'`)
4. Push ke branch (`git push origin feature/AmazingFeature`)
5. Buat Pull Request
