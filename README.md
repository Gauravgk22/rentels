# AWISH RENTALS — Unified AI-Powered Rental Ecosystem Platform

## Overview
AWISH RENTALS is an enterprise-grade, scalable unified rental infrastructure platform designed to handle both Property and Vehicle rentals in a single ecosystem.

## Local Setup Guide (XAMPP / Manual Installation)

### 1. Prerequisites
- **XAMPP** (PHP 8.3+, MySQL)
- **Composer** (PHP Package Manager)
- **Node.js & npm** (v20+)

### 2. Database Setup
1. Open XAMPP Control Panel and start **Apache** and **MySQL**.
2. Open **phpMyAdmin** (`http://localhost/phpmyadmin`).
3. Create a new database named `awish_rentals`.

### 3. Backend Setup (Laravel)
1. Open your terminal in the `backend` directory.
2. Copy the environment file:
   ```bash
   cp .env.example .env
   ```
3. Update `.env` with your database credentials (usually `root` and empty password for XAMPP):
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=awish_rentals
   DB_USERNAME=root
   DB_PASSWORD=
   ```
4. Install dependencies and generate keys:
   ```bash
   composer install
   php artisan key:generate
   php artisan jwt:secret
   php artisan migrate
   ```
5. Start the backend server:
   ```bash
   php artisan serve --port=7000
   ```

### 4. Frontend Setup (Next.js)
1. Open a new terminal in the `frontend` directory.
2. Install dependencies:
   ```bash
   npm install
   ```
3. Start the development server:
   ```bash
   npm run dev -- -p 4000
   ```

## Testing Functionality

### API Documentation (Swagger)
- **URL:** `http://localhost:7000/api/documentation`
- Use this to test all endpoints (Auth, Properties, Vehicles, Bookings, Wallet) interactively.

### Core Flows to Test
1. **User Auth:** Register a new user at `POST /api/auth/register`, then login at `POST /api/auth/login` to get your JWT token.
2. **Postings:** Create a Property or Vehicle using the authenticated token.
3. **Search:** Filter rentals by city or type.
4. **GPS Tracking:** Send a POST request to `/api/vehicles/{id}/gps` to simulate real-time location updates.
5. **Wallet:** Deposit "money" and check balance.

### Automated Tests
Run the following in the `backend` folder to verify the entire core logic:
```bash
php artisan test
```

## Tech Stack
- **Backend:** Laravel 11, PHP 8.3, Modular Monolith.
- **Frontend:** Next.js 15, TypeScript, Tailwind CSS.
- **Realtime:** Laravel Reverb (WebSockets).
- **Auth:** JWT with RBAC.
