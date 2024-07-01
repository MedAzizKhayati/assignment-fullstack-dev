[screen-capture.webm](https://github.com/MedAzizKhayati/assignment-fullstack-dev/assets/68187294/5cc56334-a1a4-4641-8878-a03e5f9b655d)# Library Management System

This assignment aims to assess your fullstack development skills. This will simulate a basic library management system. You will build both the backend (PHP with Symfony + DB schema) and frontend (React) functionalities.

## Demo
[screen-capture.webm](https://github.com/MedAzizKhayati/assignment-fullstack-dev/assets/68187294/2ac96e42-8c3b-421f-903b-95770f6a8395)

<!-- TODO: Add video demo link here -->

## Prerequisites

### Backend

Before running the Symfony application, make sure you have installed the following software:

- PHP 8.0+
- PHP Composer
- Symfony CLI
- Docker

### Frontend

Before running the React application, make sure you have installed the following software:

- yarn
- Node.js 18.0+

## Installation steps

### Backend setup

1. Navigate to the backend directory:
   ```bash
   cd backend
   ```
2. Install Symfony dependencies:
   ```bash
   composer install
   ```
3. Start the local database:
   ```bash
   docker compose up -d
   ```
4. Apply the Doctrine migrations:
   ```bash
   symfony console doctrine:migrations:migrate
   ```
5. Add some books to the database:
   ```bash
   symfony console add-books 500
   ```
6. Start the Symfony server:
   ```bash
   symfony server:start
   ```
7. Check if the API is working:
   - Open your browser and go to `http://localhost:8000/books`.
   - You should see a list of books.

### Frontend setup

1. Navigate to the frontend directory:
   ```bash
   cd frontend
   ```
2. Install the dependencies:
   ```bash
   yarn install
   ```
3. Start the frontend server:
   ```bash
   yarn dev
   ```
4. Check if the frontend is working:
   - Open your browser and go to `http://localhost:3000/`.

## Tools used

### Backend

- Symfony
- ORM Doctrine

### Frontend

- React
- Tailwind CSS
- Shadcn/ui
- Axios
- React Query
- Jest
- Cypress

## Tests

### Backend

```bash
php .\vendor\bin\phpunit .\tests\Controller\BookControllerTest.php
```

### Frontend

```bash
yarn test
```

## Miscellaneous
This `README.md` provides clear instructions, organized sections, and useful information to help users set up and run the project effectively.
