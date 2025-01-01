# Mini Blog Application

## Overview

This is a simple blog application built with PHP and MySQL, designed to be run in a Docker environment. It provides a RESTful API for managing blog posts.

## Prerequisites

- Docker
- Docker Compose

## Setup Instructions

1. **Clone the Repository**

   ```bash
   git clone https://github.com/zulficarjoy/coolcards.git
   cd miniblog
   ```

2. **Environment Configuration**

   Create a `.env` file based on the `.env.example` file provided in the repository. This file should contain your database credentials and API keys.

   ```plaintext
   DB_HOST=dbhost
   DB_NAME=dbname
   DB_USER=dbuser
   DB_PASS=dbpass
   API_KEY=your_api_key_here
   ```

3. **Build and Run the Application**

   Use Docker Compose to build and start the application:

   ```bash
   docker-compose up --build
   ```

   This command will build the Docker images and start the containers for the web application and the MySQL database.

4. **Access the Application**

   Once the containers are running, you can access the application at:

   ```
   http://localhost:8000
   ```

## API Endpoints

- **GET /api/posts**: Retrieve all posts.
- **POST /api/posts**: Create a new post. Requires a JSON body with `title` and `content`.
- **PUT /api/posts/{id}**: Update an existing post. Requires a JSON body with `title` and `content`.
- **DELETE /api/posts/{id}**: Delete a post.

## Security

- Database credentials and API keys are stored in environment variables.
- API requests must include a valid API key in the `API_KEY` header.

## Troubleshooting

- **Internal Server Error**: Check the Apache and PHP error logs for more details.
- **Database Connection Issues**: Ensure the database service is running and the environment variables are set correctly.

## CI/CD Setup

- The application uses docker compose to run locally.

## License

This project is licensed under the MIT License. 