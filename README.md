# Book Management Laravel

This is a Laravel application for book management

## Prerequisites

Before you can run this application, make sure you have the following installed:

-   Docker (https://www.docker.com/get-started)
-   Docker Compose (https://docs.docker.com/compose/install/)

## Setup

1. Clone this repository to your local machine:

```bash
git clone https://github.com/umaporn/laravel-app.git
```

2. Navigate to the project directory:

```bash
cd laravel-app
```

3. Copy the `.env.example` file to `.env` and configure database environment:

```bash
cp .env.example .env
```

4. Configure database environment and firebase function

```bash
DB_CONNECTION=
DB_HOST=
DB_PORT=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=

FIREBASE_CLOUD_FUNCTION_URL=
```

5. Generate the application key:

```bash
docker-compose run --rm app php artisan key:generate
```

6. Build and start the Docker containers:

```bash
docker-compose up -d
```

This command will build the necessary Docker images and start the containers in detached mode.

7. Install the project dependencies:

```bash
docker-compose run --rm app composer install
```

8. Run the database migrations:

```bash
docker-compose run --rm app php artisan migrate
```

9. you can seed the database with initial data:

```bash
docker-compose run --rm app php artisan db:seed
```

Your Laravel application should now be up and running! You can access it at `http://localhost:8000`.
