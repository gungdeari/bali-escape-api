# BaliEscape API

REST API for BaliEscape — a full-stack travel booking platform for exploring and booking curated Bali travel packages.

**Live API:** ``
**Frontend repo:** [bali-escape-frontend](https://github.com/gungdeari/bali-escape-frontend)

## Tech Stack

- **Framework:** Laravel 11 (PHP 8.3)
- **Database:** MySQL 8
- **Cache/Queue:** Redis
- **Web server:** Nginx (PHP-FPM)
- **Auth:** Laravel Sanctum (token-based)
- **Roles & Permissions:** Spatie Laravel Permission
- **Local environment:** Docker Compose

## Architecture

This API follows a strict layered architecture for separation of concerns:

Request → Controller → Service → Repository → Model

                    ↓

        Resource (response shaping)

| Layer           | Responsibility |            
| **Controller**  | Receives the request, calls the service, returns a response. No business logic. |
| **Request**     | Validates incoming data before it reaches the controller. |
| **Service**     | Contains all business logic — the "what should happen" layer. |
| **Repository**  | Handles all database queries — the only layer that talks to Eloquent directly. |
| **Resource**    | Shapes the JSON response sent back to the client. |

This structure keeps each piece testable, swappable, and easy to reason about in isolation.

### Local Docker setup
┌─────────────────────────────────────────────────┐
│                  Docker Network                  │
│                                                  │
│   nginx (port 8000)                              │
│       │  routes *.php → fastcgi_pass app:9000    │
│       ▼                                          │
│   app — PHP 8.3-FPM, runs Laravel                │
│       │                                          │
│       ▼                                          │
│   mysql (port 3307 → 3306)   redis (port 6379)   │
│                                                  │
└─────────────────────────────────────────────────┘

Three containers, one shared Docker network:

| Container      | Image                             | Role |
|----------------|-----------------------------------|------|
| `travel_app`   | `php:8.3-fpm` (custom Dockerfile) | Runs the Laravel application |
| `travel_nginx` | `nginx:latest`                    | Web server — routes requests to PHP-FPM |
| `travel_mysql` | `mysql:8`                         | Primary database |
| `travel_redis` | `redis:latest`                    | Available for caching/queues (not yet used in app logic) |

Nginx listens on host port `8000` and forwards all `.php` requests to the `app` container over FastCGI on port `9000`. Everything else is served from `public/`.

---

## Features

- **Authentication** — register, login, logout, token-based session via Sanctum
- **Role-based access control** — separate permissions for `user` and `admin`
- **Travel packages** — browse, filter, view details, image galleries
- **Destinations** — curated Bali locations
- **Bookings** — multi-item booking creation with automatic expiry
- **Payments** — manual bank transfer / e-wallet flow with proof-of-payment upload
- **Admin payment confirmation** — admin reviews proof and confirms or cancels bookings
- **Invoice generation** — downloadable PDF invoice after payment confirmation
- **Reviews & ratings** — one review per user per package, with aggregated average rating
- **Auto-cancellation** — scheduled command cancels expired unpaid bookings

---

## Project Structure
app/

├── Http/
│   ├── Controllers/Api/    # Thin controllers — request in, response out
│   ├── Requests/           # Form validation rules
│   └── Resources/          # API response shaping
├── Services/               # Business logic
├── Repositories/           # Database queries
├── Models/                 # Eloquent models
└── Console/Commands/       # Scheduled tasks (e.g. auto-cancel bookings)

database/
├── migrations/
└── seeders/                # Roles, users, destinations, packages, reviews

docker/
├── php/Dockerfile
└── nginx/default.conf

routes/
└── api.php


## Local Development Setup
### Prerequisites

- Docker & Docker Compose
- Git

### Setup

```bash
# 1. Clone the repo
git clone https://github.com/yourusername/bali-escape-api.git
cd bali-escape-api

# 2. Copy environment file
cp .env.example .env

# 3. Start containers (app, nginx, mysql, redis)
docker compose up -d

# 4. Install PHP dependencies
docker exec -it travel_app composer install

# 5. Generate app key
docker exec -it travel_app php artisan key:generate

# 6. Run migrations and seed the database
docker exec -it travel_app php artisan migrate:fresh --seed

# 7. Create storage symlink (for uploaded payment proofs)
docker exec -it travel_app php artisan storage:link
```

The API is now running at `http://localhost:8000/api/v1`

### Test Accounts (after seeding)

| Role | Email | Password |
|---|---|---|
| Admin | admin@mail.com | password |
| User | user@trvl.com | password |

---

## Environment Variables

See `.env.example` for the full list. Key variables:

```env
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=travel_db
DB_USERNAME=travel_user
DB_PASSWORD=secret

REDIS_HOST=redis
REDIS_PORT=6379

SANCTUM_STATEFUL_DOMAINS=localhost:5173
```

> Note: `DB_HOST=mysql` and `REDIS_HOST=redis` because the app talks to other containers by their Docker Compose service name, not `localhost`.

---

## Key API Endpoints

| Method | Endpoint | Auth | Description |
|---|---|---|---|
| POST | `/v1/auth/register` | Public | Create an account |
| POST | `/v1/auth/login` | Public | Get auth token |
| GET | `/v1/auth/user` | User | Get current authenticated user |
| GET | `/v1/travel-packages` | Public | List all packages (paginated) |
| GET | `/v1/travel-packages/{id}` | Public | Package detail |
| GET | `/v1/travel-packages/{id}/reviews` | Public | Package reviews |
| POST | `/v1/travel-packages/{id}/reviews` | User | Submit a review |
| POST | `/v1/user/bookings` | User | Create a booking |
| GET | `/v1/user/bookings` | User | List my bookings |
| POST | `/v1/user/payments` | User | Submit payment + proof of transfer |
| GET | `/v1/user/payments/{id}/invoice` | User | Download invoice PDF |
| GET | `/v1/admin/bookings` | Admin | All bookings |
| PATCH | `/v1/admin/bookings/{id}/status` | Admin | Confirm/cancel booking |

All endpoints return a consistent response shape:

```json
{
  "success": true,
  "message": "...",
  "data": { ... }
}
```

---

## Deployment

Deployed on [Railway](https://railway.app) using Nixpacks auto-detection (no Docker required in production — Railway builds Laravel directly).