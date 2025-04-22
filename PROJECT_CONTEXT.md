# Motion Project Context

## Project Overview

This is a Laravel-based backend application that appears to be managing a recruitment/organization system with features for members, workshops, achievements, blogs, and user management.

## Project Structure

The project follows standard Laravel directory structure:

- **app/**: Contains the core code of the application
  - **Console/**: Console commands
  - **Exceptions/**: Exception handlers
  - **Export/**: Export functionality (RecruitationExport)
  - **Helper/**: Helper classes including API utilities
  - **Http/**: HTTP layer (Controllers, Middleware, Resources)
  - **Mails/**: Mail templates (RecruitationRegister, WorkshopInformation)
  - **Models/**: Database models
  - **Providers/**: Service providers
  - **Traits/**: Reusable traits

- **config/**: Configuration files
- **database/**: Database migrations, seeders, and factories
- **public/**: Publicly accessible files
- **resources/**: Frontend resources (views, language files, etc.)
- **routes/**: Route definitions
- **storage/**: File storage
- **tests/**: Application tests

## Docker Configuration

The project uses Docker for development with the following services:

- **webserver**: Nginx web server running on port 8001
- **app**: PHP application container
- **db**: MySQL 8.0.40 database
- **phpmyadmin**: Database administration tool accessible on port 8071

## Database

- Connection: MySQL
- Host: db (Docker service)
- Port: 3306
- Database name: motion
- Username: root
- No password set

## Development Setup

### Prerequisites

- Docker and Docker Compose
- Composer (PHP package manager)
- Node.js and npm (for frontend assets)

### Getting Started

1. Clone the repository
2. Navigate to the project directory
3. Start the Docker containers:
   ```
   docker-compose up -d
   ```
4. Install PHP dependencies:
   ```
   docker-compose exec app composer install
   ```
5. Set up the database:
   ```
   docker-compose exec app php artisan migrate
   ```
6. Access the application at http://localhost:8001
7. Access PHPMyAdmin at http://localhost:8071

## Key Features

Based on the project structure, the application appears to handle:

- User management and authentication
- Member management
- Blog functionality
- Recruitment processes
- Workshop registration and management
- Achievement tracking
- Team achievements

## Environment Configuration

The application uses standard Laravel environment variables for configuration.
Key settings include:

- Database connection details
- Logging configuration
- Session management
- Cache settings
- Mail configuration

## Additional Notes

- The project includes PHPUnit for testing
- Laravel Mix is used for asset compilation
- The application has Sentry integration for error tracking
- Mail templates are available for recruitment registration and workshop information