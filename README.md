# Symfony Training Project

Symfony 7.4 training application.

## Prerequisites

- [Symfony CLI](https://symfony.com/download)
- PHP 8.2+

## Installation

### 1. Create the local environment file

Create a `.env.local` file at the project root with the following content:

```dotenv
DATABASE_URL="sqlite:///%kernel.project_dir%/var/data_%kernel.environment%.db"
```

### 2. Install PHP dependencies

```bash
symfony composer install
```

### 3. Set up the database

Create the database:

```bash
symfony console doctrine:database:create
```

> **Note:** With SQLite, this command may fail. That's fine — skip it and proceed to the next step; the migration will create the database file automatically.

Run migrations:

```bash
symfony console doctrine:migrations:migrate
```

Load fixtures:

```bash
symfony console doctrine:fixtures:load
```

### 4. Start the development server

```bash
symfony server:start
```

The application is available at <http://localhost:8000>.
