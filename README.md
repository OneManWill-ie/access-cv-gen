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

### 3. Create Directory Structure
Ensure you have the required directories:
```bash
mkdir -p src/php src/flask docker/php docker/flask docker/db
```

### 4. Build and Start Containers
```bash
docker-compose up -d --build
```

This will:
- Build and start the PHP application on `http://localhost:8080`
- Build and start the Flask API on `http://localhost:5000`
- Start MySQL database
- Start PHPMyAdmin on `http://localhost:8081`

### 5. Access the Services

| Service | URL | Credentials |
|---------|-----|-------------|
| CV Generator (PHP) | http://localhost:8080 | - |
| Flask API | http://localhost:5000 | - |
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

## Development Notes

- **PHP Frontend**: Place your Bootstrap-based UI files in `src/php/`
- **Flask API**: Place your Python files in `src/flask/`. The API will handle Gemini API calls
- **Database**: Initial SQL scripts go in `docker/db/init.sql`
- **API Communication**: Flask API runs on port 5000, accessible from PHP at `http://flask-api:5000`

## Troubleshooting

### Containers won't start
- Check Docker Desktop is running
- Verify `.env` file has valid `GEMINI_API_KEY`
- Run `docker-compose logs` to see error messages

### Database connection issues
- Ensure MySQL container is running: `docker-compose ps`
- Check database credentials match in `docker-compose.yml`
- Wait a few seconds for MySQL to initialize on first startup

### Port conflicts
- If ports 8080, 5000, 3306, or 8081 are in use, modify the port mappings in `docker-compose.yml`

## Notes

- Change `MYSQL_ROOT_PASSWORD` to a secure password
- Keep your `.env` file secure and don't commit it to version control
- Add `.env` to `.gitignore`
