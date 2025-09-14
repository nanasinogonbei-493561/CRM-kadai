# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is a Laravel CRM system built with Laravel 12.0, utilizing Livewire + Flux UI components, Tailwind CSS 4.0, and SQLite database. The project implements customer relationship management functionality with authentication, company management, and user settings.

## Development Commands

### Starting Development Environment
```bash
# Start full development environment (server, queue, logs, vite)
composer dev
```

### Individual Services
```bash
# Laravel development server
php artisan serve

# Frontend asset compilation (development)
npm run dev

# Frontend asset compilation (production)
npm run build

# Queue worker
php artisan queue:listen --tries=1

# Real-time logs
php artisan pail --timeout=0
```

### Database Management
```bash
# Run migrations
php artisan migrate

# Fresh migration with seeding
php artisan migrate:fresh --seed

# Create new migration
php artisan make:migration create_table_name
```

### Code Quality & Testing
```bash
# Run Pest tests
composer test
# or
php artisan test

# Run specific test
php artisan test --filter TestName

# Code formatting with Pint
vendor/bin/pint

# Clear application caches
php artisan config:clear
php artisan cache:clear
php artisan view:clear
```

## Architecture Overview

### Tech Stack
- **Backend**: Laravel 12.0 with PHP 8.2+
- **Frontend**: Livewire + Flux UI components
- **Styling**: Tailwind CSS 4.0
- **Database**: SQLite (development), designed for easy PostgreSQL/MySQL migration
- **Testing**: Pest framework
- **Build Tool**: Vite with Laravel plugin

### Key Components

#### Livewire Integration
- Uses Livewire Volt for component-based development
- Settings pages are implemented as Volt routes (resources/views/livewire/settings/)
- Authentication flows use traditional Livewire components

#### Database Models
- `User`: Standard Laravel authentication model
- `Company`: CRM company management with fields for name, contact info, address, industry, notes

#### Route Structure
- `/` - Welcome page
- `/dashboard` - Main dashboard (auth required)
- `/dashboard/companies` - Company management (CompanyController@index)
- `/settings/*` - User settings (Volt routes for profile, password, appearance)

### Directory Structure
```
app/
├── Http/Controllers/
│   └── CompanyController.php - CRUD operations for companies
├── Models/
│   ├── User.php - Authentication model
│   └── Company.php - CRM company model
└── Livewire/Actions/
    └── Logout.php - Livewire logout action

resources/
├── views/
│   ├── livewire/
│   │   ├── auth/ - Authentication components
│   │   └── settings/ - Settings Volt components
│   ├── components/layouts/ - Layout components
│   └── dashboard/ - Dashboard views
└── js/app.js, css/app.css - Frontend assets
```

### Database Schema
- `users` table: Standard Laravel auth fields
- `companies` table: name (required), email, phone, website, address, postal_code, city, industry, description, notes
- Standard Laravel system tables (cache, jobs, sessions, password_reset_tokens)

### Testing Setup
- Pest framework configured in tests/Pest.php
- Uses SQLite in-memory database for testing
- Test suites: Feature (tests/Feature/), Unit (tests/Unit/)
- TestCase.php extends Laravel's base test case

## Development Guidelines

### Code Style
- Follow Laravel conventions and PSR standards
- Use Livewire/Volt for interactive components
- Leverage Flux UI components for consistent styling
- Company model uses mass assignment protection with $fillable array

### UI/UX Patterns
- Flux UI components provide consistent design system
- Tailwind CSS 4.0 for styling
- Responsive design with mobile-first approach
- Split/Card/Simple auth layouts available in components/layouts/auth/

### Database Patterns
- Eloquent models with appropriate fillable fields
- Migration files follow Laravel timestamp naming
- SQLite for development, easily switchable to PostgreSQL/MySQL

### Testing Patterns
- Feature tests for HTTP endpoints
- Unit tests for model logic
- Use factories for test data generation
- Pest's Laravel plugin provides useful helpers

## Common Tasks

### Adding New Company Fields
1. Create migration: `php artisan make:migration add_field_to_companies_table`
2. Update Company model's $fillable array
3. Update CompanyController validation rules in store() and update() methods
4. Update views in resources/views/dashboard/

### Creating New Livewire Components
- For Volt components: Create in resources/views/livewire/
- Add route in routes/web.php using Volt::route()
- Follow existing patterns in settings/ directory

### Database Changes
- Always create migrations for schema changes
- Update model $fillable arrays when adding new fields
- Test migrations both up and down

## Project-Specific Notes

### Requirements Document
- Detailed requirements in 要件定義書.md (Japanese specifications)
- Defines CRM functionality, database schema, and development phases
- Current phase: Basic company management implemented

### Future Enhancements
- Individual customer (person) management
- Deal/opportunity tracking  
- Activity history logging
- API development
- External system integrations