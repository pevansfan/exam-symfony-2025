# Symfony Docker Project Setup

This repository contains a Docker-based development environment for Symfony applications.

## Prerequisites

- Docker
- Docker Compose
- Git

## Environment Setup

1. Clone this repository:
```bash
git clone git@github.com:pevansfan/exam-symfony-2025.git
cd exam-symfony-2025
```

2. Start the Docker environment:
```bash
docker compose up -d --build
```

3. Set proper permissions:
```bash
docker compose exec php chown -R www-data:www-data var
```

## Accessing the Application

- Symfony application: http://localhost:8080
- phpMyAdmin: http://localhost:8081 (database management)
- MailHog: http://localhost:8025 (email testing interface)


## Docker Services

The environment includes the following services:
- **PHP (8.2-FPM)**: PHP service with all necessary extensions for Symfony
- **Nginx**: Web server
- **MariaDB (10.11.2)**: Database server
- **phpMyAdmin**: Database management tool
- **MailHog**: Email testing tool

### Database Credentials
- Database: symfony
- Username: symfony
- Password: symfony
- Root Password: root

## Common Commands

Start the environment:
```bash
docker compose up -d
```

Stop the environment:
```bash
docker compose down
```

Access PHP container:
```bash
docker compose exec php bash
```

Install Symfony dependencies:
```bash
docker compose exec php composer install
```

Clear Symfony cache:
```bash
docker compose exec php php bin/console cache:clear
```

## Development

The project directory is mounted as a volume in the PHP container. Any changes you make to your local files will be reflected immediately in the container.

## Troubleshooting

1. If you encounter permission issues:
```bash
docker compose exec php chown -R www-data:www-data var
```

2. If Composer runs out of memory:
```bash
docker compose exec php php -d memory_limit=-1 /usr/bin/composer install
```

3. To view logs:
```bash
docker compose logs -f
```
