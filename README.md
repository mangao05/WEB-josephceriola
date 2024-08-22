# Appointment Booking for Pet Services

## Overview

This API allows users to book appointments for pet services. It supports creating appointments with detailed validation and error handling.

## Prerequisites

- PHP 8.0 or higher
- Composer
- Laravel 10.x
- MySQL

## Setup and Installation

### 1. Clone the Repository

Clone the repository to your local machine:

```bash
git clone https://github.com/yourusername/appointment-booking-pet-services.git
cd appointment-booking-pet-services
```


### 2. Install Dependencies

Install the necessary PHP packages using Composer:

```bash
composer install
```

### 3. Set Up Environment

Copy the example environment file and update your database configuration:

```bash
cp .env.example .env
```
Edit the .env file to configure your database connection:

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 4. Generate Application Key

Generate the application key required for encryption:

```bash
php artisan key:generate
```

### 5. Run Database Migrations

Create the necessary database tables by running migrations:

```bash
php artisan migrate
```

### 6. Start the Development Server

Start the Laravel development server:

```bash
php artisan serve
```


