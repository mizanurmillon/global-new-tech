# Laravel & Bootstrap Admin Dashboard Stater kit

[![Youtube][youtube-shield]][youtube-url]
[![Facebook][facebook-shield]][facebook-url]
[![Instagram][instagram-shield]][instagram-url]
[![LinkedIn][linkedin-shield]][linkedin-url]

Thank you for visiting this repository.

## Project Overview

### Backend

|                                                    ||
| :------------------------------------------------: | :------------------------------------------------: |
|                 Dashboard Preview                  | Table Demo|
| ![Admin Dashboard](/screenshort/dashboard.png) |![User table demo](/screenshort/demo.png)|

<!-- ### Frontend APP -->

<!-- 
|                                                  |
| :----------------------------------------------: |
|                   APP Preview                    |
| ![Admin Dashboard](/screenshort/app-preview.jpg) | -->


## Installation Guide

### 1. Clone Repository

```bash
git clone https://github.com/learnwithfair/laravel-stater-kit.git
cd laravel-stater-kit
```

### 2. Install Dependencies

```bash
composer install
npm install && npm run dev
```

### 3. Configure Environment

Copy `.env.example` to `.env` and update database credentials:

```env
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```

### 4. Generate Application Key

```bash
php artisan key:generate
```

### 5. Run Migrations & Seed Data

```bash
php artisan migrate:fresh --seed
```

### 6. Optimize & Autoload

```bash
composer dump-autoload
php artisan optimize:clear
```

### 7. Start Development Server

```bash
php artisan serve
```

Visit **[http://127.0.0.1:8000](http://127.0.0.1:8000)**

---

## Default Credentials

### Admin Panel

* **URL**: `http://127.0.0.1:8000/admin/dashboard`
* **Email**: `admin@gmail.com`
* **Password**: `12345678`

### User Panel

* **URL**: `http://127.0.0.1:8000`
* **Email**: `user@gmail.com`
* **Password**: `12345678`

---

## API Usage (Sanctum)

Use **Bearer Token** authentication for protected routes.

* **Register:** `POST /api/register`
* **Login:** `POST /api/login`
* **Verify OTP:** `POST /api/verify-otp`
* **Forgot Password:** `POST /api/forgot-password`
* **Reset Password:** `POST /api/reset-password`
* **Logout:** `POST /api/logout`

---

## Design System

### Button and Banner Color
- `#D92D20` → `#0F2847`
- Button info `#35E07Be6` → `#0F2847`
- Link `#0d6efd` → `#0F2847`
- Text muted `#a4abc5` → `#818898`

### Sidebar
- `#27282D` → `#ffffff`

### Container
- `#0B0B0D` → `#F5F5F5`

### Table Border
- `#59595A`

### Guest Background (Linear)
- `#D92D20` = `#090909`

### Typography
- **Black**: `#0B0B0D`
- **Graphite**: `#16171A`
- **Text**: `#F2F3F5` / `#A9AFBB`

### Action Colors
- **CTA Green**: `#35E07B`
- **Alert Red**: `#E04747`
- **Rank Gold**: `#E2B84B`

---

## Deployment Commands

```bash
php artisan key:generate
php artisan storage:link
php artisan migrate --force
php artisan config:cache
php artisan route:cache
```

---

<div align="center">

**Developed by [MD. RAHATUL RABBI](https://github.com/learnwithfair)**

If you find this repository helpful, please consider starring it.

</div>

## Connect

[<img src='https://cdn.jsdelivr.net/npm/simple-icons@3.0.1/icons/github.svg' alt='github' height='40'>](https://github.com/learnwithfair) [<img src='https://cdn.jsdelivr.net/npm/simple-icons@3.0.1/icons/facebook.svg' alt='facebook' height='40'>](https://www.facebook.com/learnwithfair/) [<img src='https://cdn.jsdelivr.net/npm/simple-icons@3.0.1/icons/instagram.svg' alt='instagram' height='40'>](https://www.instagram.com/learnwithfair/) [<img src='https://cdn.jsdelivr.net/npm/simple-icons@3.0.1/icons/twitter.svg' alt='twitter' height='40'>](https://www.twiter.com/learnwithfair/) [<img src='https://cdn.jsdelivr.net/npm/simple-icons@3.0.1/icons/youtube.svg' alt='YouTube' height='40'>](https://www.youtube.com/@learnwithfair)

<!-- MARKDOWN LINKS & IMAGES -->

[youtube-shield]: https://img.shields.io/badge/-Youtube-black.svg?style=flat-square&logo=youtube&color=555&logoColor=white
[youtube-url]: https://youtube.com/@learnwithfair
[facebook-shield]: https://img.shields.io/badge/-Facebook-black.svg?style=flat-square&logo=facebook&color=555&logoColor=white
[facebook-url]: https://facebook.com/learnwithfair
[instagram-shield]: https://img.shields.io/badge/-Instagram-black.svg?style=flat-square&logo=instagram&color=555&logoColor=white
[instagram-url]: https://instagram.com/learnwithfair
[linkedin-shield]: https://img.shields.io/badge/-LinkedIn-black.svg?style=flat-square&logo=linkedin&colorB=555
[linkedin-url]: https://linkedin.com/company/learnwithfair

---

#learnwithfair #rahtulrabbi #rahatul-rabbi #learn-with-fair