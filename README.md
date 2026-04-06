# Global New Tech — Corporate Website & CMS

[![Youtube][youtube-shield]][youtube-url]
[![Facebook][facebook-shield]][facebook-url]
[![Instagram][instagram-shield]][instagram-url]
[![LinkedIn][linkedin-shield]][linkedin-url]

Thanks for visiting my GitHub account!

A full-stack corporate website and content management system built for **Global New Tech**, a managed SOC, AI-driven cybersecurity, and DevOps solutions company. The platform includes a public-facing multi-page website, a role-based admin dashboard, and a structured CMS for managing page content across sections.

---

## Table of Contents

- [Project Overview](#project-overview)
- [Tech Stack](#tech-stack)
- [Features](#features)
- [Architecture](#architecture)
- [Installation](#installation)
- [Environment Configuration](#environment-configuration)
- [Default Credentials](#default-credentials)
- [CMS Structure](#cms-structure)
- [API Reference](#api-reference)
- [Role-Based Access Control](#role-based-access-control)
- [Design System](#design-system)
- [Deployment](#deployment)
- [Live Demo](#live-demo)

---

## Project Overview

This project delivers a production-ready website and back-office system for Global New Tech. It covers:

- A public website with pages for Home, Services, About, Blog, Contact, and Partner
- A content management system (CMS) allowing admins to manage per-page, per-section content without code changes
- A role-based admin dashboard for managing team members, services, blogs, testimonials, brands, and technologies
- A RESTful API consumed by a React.js frontend

**Investment Plan:** $1,000 USD  
**Estimated Timeline:** 50 Days

---

## Tech Stack

| Layer | Technology |
|---|---|
| UI/UX Design | Figma |
| Backend Framework | Laravel (Latest Version) |
| Backend Language | PHP |
| Database | MySQL |
| Frontend | React.js |
| Deployment | Vercel / Netlify / AWS |

---

### Backend

|                                                    |                                                   |
| :------------------------------------------------: |:------------------------------------------------: |
|                 Team Preview                  |                 Brand Preview                 |
| ![1](/screenshort/8.png) |![2](/screenshort/9.png) |
|                 Testimonial Preview                  |                 Dashboard Preview                 |
| ![1](/screenshort/10.png) |![2](/screenshort/11.png) |
|                 Blog Preview                  |                 CMS Preview                 |
| ![1](/screenshort/13.png) |![2](/screenshort/14.png) |


### Frontend APP


|                                                    |                                                   |
| :------------------------------------------------: |:------------------------------------------------: |
|                 Home Preview                  |                 Service Preview                 |
| ![1](/screenshort/1.png) |![2](/screenshort/2.png) |
|                 Service Details                 |                 Service Details                  |
| ![1](/screenshort/3.png) |![2](/screenshort/4.png) |
|                 Service Details                 |                Service Details                  |
| ![1](/screenshort/5.png) |![2](/screenshort/6.png) |
|                 Partner                |                 Create Service                 |
| ![1](/screenshort/7.png) |![2](/screenshort/12.png) |



## Features

### Public Website

- Multi-page layout: Home, Services, About, Blog, Contact, Partner
- Hero sections with dynamic background images and configurable CTAs
- Services listing with sub-services support
- Blog and articles section with individual post pages
- Client testimonials and trusted partner ecosystem display
- Statistics / numbers section with configurable items
- Sub-footer call-to-action section
- Footer with navigation links and contact details

### Admin Dashboard

- Secure authentication with role-based access (Admin and Team roles)
- Dashboard metrics with sales charts and transaction history
- Full CRUD management for: Blogs, Testimonials, Brands, Technologies, Core Services, Sub-Services, Comprehensive Services, Team Members
- Status toggle (activate/deactivate) for all major entities
- Security Assessment management
- CMS content editor: update any page section's fields and items from the dashboard
- Profile Settings, System Settings, and Social Media Settings
- Dynamic sidebar that renders navigation items based on the authenticated user's role

### CMS System

- Structured page-section-field mapping for all pages
- Supports both scalar fields (title, subtitle, description, image, button text/link) and repeatable items
- Admin can update content per page and per section without touching code
- Section access is filterable by page via the `getSectionsByPage` endpoint

### API

- RESTful endpoints for CMS content, blogs, and services
- Consumed by the React.js frontend
- Structured JSON responses for all resources

---

## Architecture

```
├── Backend (Laravel)
│   ├── Authentication & Authorization (Admin / Team middleware)
│   ├── CMS Content Management (per-page, per-section)
│   ├── Blog Management
│   ├── Service & Sub-Service Management
│   ├── Team Member Management
│   ├── Testimonial Management
│   ├── Brand & Technology Management
│   └── RESTful API
│
├── Frontend (React.js)
│   └── Consumes Laravel API
│
└── Database (MySQL)
    └── Migrations & Seeders included
```

---

## Installation

### 1. Clone the Repository

```bash
git clone https://github.com/learnwithfair/willfils
cd willfils
```

### 2. Install Dependencies

```bash
composer install
npm install && npm run dev
```

### 3. Configure Environment

Copy `.env.example` to `.env` and update your database credentials:

```env
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```

### 4. Generate Application Key

```bash
php artisan key:generate
```

### 5. Run Migrations and Seed Data

```bash
php artisan migrate:fresh --seed
```

### 6. Optimize Autoload and Cache

```bash
composer dump-autoload
php artisan optimize:clear
```

### 7. Start Development Server

```bash
php artisan serve
```

The application will be available at [http://127.0.0.1:8000](http://127.0.0.1:8000).

---

## Environment Configuration

The following variables must be set in `.env`:

```env
APP_NAME=GlobalNewTech
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```

---

## Default Credentials

### Admin Panel

| Field | Value |
|---|---|
| URL | `http://127.0.0.1:8000/admin/dashboard` |
| Email | `admin@admin.com` |
| Password | `12345678` |

### Team Panel (Scoped Access)

| Field | Value |
|---|---|
| URL | `http://127.0.0.1:8000` |
| Email | `david.lee@globalnewtech.com` |
| Password | `12345678` |

---

## CMS Structure

The CMS maps each page to a set of sections. Each section defines the scalar `fields` it supports and any repeatable `items`.

| Page | Sections |
|---|---|
| Home | Hero, About, Services, Trusted Partners, Blog, Testimonials, Sub-Footer, Footer |
| Services | Hero, Services, Comprehensive Services, Numbers, Contact |
| About | Hero, About, Numbers, Our Story, Core Values, Team, Trusted Partners |
| Blog | Hero, Blog |
| Contact | Hero, Contact, Services |
| Partner | Hero, Trusted Partners, Sub-Footer |

**Supported field types:** `title`, `subtitle`, `description`, `image`, `background_image`, `button_text`, `button_link`

**Supported item types:** `title`, `subtitle`, `description`, `icon`, `image`

---

## API Reference

### CMS Endpoints

| Method | Endpoint | Description |
|---|---|---|
| GET | `/api/cms/page/{page}` | Get all section content for a page |
| GET | `/api/cms/page/{page}/section/{section}` | Get content for a specific section |
| POST | `/api/admin/cms-contents/get-sections-by-page` | Get available sections for a given page |

### Blog Endpoints

| Method | Endpoint | Description |
|---|---|---|
| GET | `/api/blogs` | List all published blogs |
| GET | `/api/blogs/{blog}` | Get a single blog post |

### Service Endpoints

| Method | Endpoint | Description |
|---|---|---|
| GET | `/api/services` | List all services |
| GET | `/api/services/{service}` | Get a single service |

### Admin CMS Endpoints

| Method | Endpoint | Description |
|---|---|---|
| GET | `/admin/cms-contents` | List all CMS content entries |
| POST | `/admin/cms-contents` | Create a CMS content entry |
| PATCH | `/admin/cms-contents/{id}` | Update a CMS content entry |
| DELETE | `/admin/cms-contents/{id}` | Delete a CMS content entry |
| PATCH | `/admin/cms-contents/{id}/status` | Toggle active status |

---

## Role-Based Access Control

The system defines two access levels:

### Team Role (`middleware: team`)

Accessible by both Admin and Team members:

- Dashboard (metrics, sales charts, transaction history)
- Blog management (CRUD + status toggle)
- Testimonial management (CRUD + status toggle)
- Brand management (CRUD + status toggle)
- Technology management (CRUD + status toggle)
- Settings: Profile Settings, System Settings, Social Media Settings

### Admin Role (`middleware: admin`)

Accessible by Admin only, in addition to all Team-level access:

- Team member management (CRUD + status toggle)
- Core Service management (CRUD + status toggle)
- Sub-Service management (CRUD)
- Comprehensive Service management (CRUD)
- Security Assessment management
- CMS content management (CRUD + status toggle + section filter by page)

---

## Design System

### Colors

| Usage | Value |
|---|---|
| Button / Banner Primary | `#D92D20` to `#0F2847` |
| Button Info | `#35E07Be6` to `#0F2847` |
| Link | `#0d6efd` to `#0F2847` |
| Text Muted | `#a4abc5` to `#818898` |
| Sidebar Background | `#ffffff` |
| Container Background | `#F5F5F5` |
| Table Border | `#59595A` |
| Guest Background | `#090909` (linear) |

### Typography

| Role | Value |
|---|---|
| Black | `#0B0B0D` |
| Graphite | `#16171A` |
| Text Light | `#F2F3F5` |
| Text Secondary | `#A9AFBB` |

---

## Deployment

Run the following commands on the production server:

```bash
php artisan key:generate
php artisan storage:link
php artisan migrate --force
php artisan config:cache
php artisan route:cache
```

Supported deployment targets: Vercel, Netlify, AWS, or any standard PHP/MySQL hosting.

---

## Live Demo

| Role | URL | Email | Password |
|---|---|---|---|
| Admin | [https://willfils.thewarriors.team/login](https://willfils.thewarriors.team/login) | `admin@admin.com` | `12345678` |
| Team | [https://willfils.thewarriors.team/login](https://willfils.thewarriors.team/login) | `david.lee@globalnewtech.com` | `12345678` |

---

## Author

Developed by [MD. Rahatul Rabbi](https://github.com/learnwithfair)

GitHub: [https://github.com/learnwithfair](https://github.com/learnwithfair)



## Follow Me

[<img src='https://cdn.jsdelivr.net/npm/simple-icons@3.0.1/icons/github.svg' alt='github' height='40'>](https://github.com/learnwithfair) [<img src='https://cdn.jsdelivr.net/npm/simple-icons@3.0.1/icons/facebook.svg' alt='facebook' height='40'>](https://www.facebook.com/learnwithfair/) [<img src='https://cdn.jsdelivr.net/npm/simple-icons@3.0.1/icons/instagram.svg' alt='instagram' height='40'>](https://www.instagram.com/learnwithfair/) [<img src='https://cdn.jsdelivr.net/npm/simple-icons@3.0.1/icons/twitter.svg' alt='twitter' height='40'>](https://www.twiter.com/learnwithfair/) [<img src='https://cdn.jsdelivr.net/npm/simple-icons@3.0.1/icons/youtube.svg' alt='YouTube' height='40'>](https://www.youtube.com/@learnwithfair)

 <!-- MARKDOWN LINKS & IMAGES  -->

[youtube-shield]: https://img.shields.io/badge/-Youtube-black.svg?style=flat-square&logo=youtube&color=555&logoColor=white
[youtube-url]: https://youtube.com/@learnwithfair
[facebook-shield]: https://img.shields.io/badge/-Facebook-black.svg?style=flat-square&logo=facebook&color=555&logoColor=white
[facebook-url]: https://facebook.com/learnwithfair
[instagram-shield]: https://img.shields.io/badge/-Instagram-black.svg?style=flat-square&logo=instagram&color=555&logoColor=white
[instagram-url]: https://instagram.com/learnwithfair
[linkedin-shield]: https://img.shields.io/badge/-LinkedIn-black.svg?style=flat-square&logo=linkedin&colorB=555
[linkedin-url]: https://linkedin.com/company/learnwithfair

#learnwithfair #rahtulrabbi #rahatul-rabbi #learn-with-fair
