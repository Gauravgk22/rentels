# AWISH RENTALS — Unified AI-Powered Rental Ecosystem Platform

## Overview
AWISH RENTALS is an enterprise-grade, scalable unified rental infrastructure platform designed to handle both Property and Vehicle rentals in a single ecosystem. It provides a robust foundation for marketplace operations, fleet management, and property ERP.

## Tech Stack
- **Backend:** Laravel 11.x, PHP 8.3+, Modular Monolith Architecture.
- **Frontend:** Next.js 15, TypeScript, Tailwind CSS, Framer Motion.
- **Database:** MySQL 8+ (Optimized schema with proper indexing).
- **Realtime:** Laravel Reverb (WebSockets) for GPS tracking and live updates.
- **Cache & Queues:** Redis, Laravel Horizon.
- **Auth:** JWT (JSON Web Tokens) with Centralized RBAC.
- **API Doc:** Swagger/OpenAPI.

## System Architecture

### Modular Monolith
The backend is organized into functional modules to ensure high cohesion and low coupling, allowing for future microservices migration:
- **Auth:** Identity management and RBAC.
- **Property:** Residential and Commercial property management.
- **Vehicle:** Cars, Bikes, and EV fleet management.
- **Booking:** Unified reservation engine with state machine logic.
- **Wallet:** Financial ledger, escrow, and payment settlements.
- **Notification:** Multi-channel (Email, SMS, Push, In-app).
- **Core:** Shared infrastructure (Repositories, Services, AI Gateway).

### Database Architecture
Designed for high performance and scalability.
- **Users/Roles/Permissions:** Polymorphic RBAC.
- **Properties/Vehicles:** Specialized schemas with geographic indexing.
- **Bookings:** Morphic relationships to handle any "bookable" entity.
- **Wallets/Transactions:** Double-entry bookkeeping principle for financial integrity.
- **GPS Logs:** Time-series optimized logs for real-time tracking.

## AI Infrastructure
The platform includes an `AiGateway` service designed to integrate with LLMs and Machine Learning models for:
- Smart Pricing Recommendations.
- Fraud Detection in Transactions.
- Personalized User Recommendations.
- Occupancy and Demand Prediction.

## Development & Deployment

### Local Setup
1. **Backend:**
   ```bash
   cd backend
   composer install
   php artisan migrate
   php artisan jwt:secret
   php artisan serve
   ```
2. **Frontend:**
   ```bash
   cd frontend
   npm install
   npm run dev
   ```

### Docker Support
A `docker-compose.yml` is provided in the `backend` directory for a full-stack environment including MySQL, Redis, and Mailpit.

### Deployment Guide
- **VPS:** Recommended Ubuntu 22.04+ with NGINX and Supervisor for Horizon/Reverb.
- **cPanel:** Supported via standard PHP/MySQL deployment with shell access for artisan commands.
- **CI/CD:** Pipelines ready for GitHub Actions or GitLab CI.

## Future Scalability
- **Mobile Apps:** APIs are designed with an API-first approach, ready for Flutter/React Native integration.
- **Microservices:** Modules can be extracted into independent services thanks to the Repository/Service pattern separation.
