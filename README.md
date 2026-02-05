# CV Generator Docker Setup

A multi-container application for generating CVs with AI assistance using Gemini API.

## Architecture

- **PHP Frontend**: Bootstrap-based UI for CV generation and management
- **Flask API**: Backend service handling Gemini API integration
- **MySQL Database**: Persistent data storage
- **PHPMyAdmin**: Database management interface

## Prerequisites

- Docker Desktop installed and running
- Gemini API key from Google
- Git (for cloning the repository)

## Quick Start

### 1. Clone the Repository
```bash
git clone <your-repo-url>
cd cv_gen
```

### 2. Set Up Environment Variables
Create a `.env` file in the root directory:
```bash
GEMINI_API_KEY=your_gemini_api_key_here
```

### 3. Build and Start Containers
```bash
docker-compose up -d --build
```

This will:
- Build and start the PHP application on `http://localhost:8080`
- Build and start the Flask API on `http://localhost:5000`
- Start MySQL database
- Start PHPMyAdmin on `http://localhost:8081`

### 4. Access the Services

| Service | URL | Credentials |
|---------|-----|-------------|
| CV Generator (PHP) | http://localhost:8080 | - |
| Flask API | http://localhost:5001 | - |
| PHPMyAdmin | http://localhost:8081 | Username: `cvgen_user`, Password: `cvgen_password` |
| Database | localhost:3306 | User: `cvgen_user`, Password: `cvgen_password` |

## Project Structure

```
cv_gen/
├── docker-compose.yml
├── .env
├── src/
│   ├── php/          # PHP frontend (Bootstrap-based)
│   └── flask/        # Flask API backend
├── docker/
│   ├── php/
│   │   ├── Dockerfile
│   │   └── php.ini
│   ├── flask/
│   │   └── Dockerfile
│   └── db/
│       └── init.sql   # Database initialization script
```

## Common Commands

### Stop Containers
```bash
docker-compose down
```

### View Logs
```bash
docker-compose logs -f [service_name]
```

### Rebuild Services
```bash
docker-compose up -d --build
```

### Access Container Shell
```bash
# PHP container
docker-compose exec app bash

# Flask container
docker-compose exec flask-api bash

# Database container
docker-compose exec db bash
```
