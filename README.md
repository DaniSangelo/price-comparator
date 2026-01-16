# Monorepo Project

This repository contains the source code for the External APIs and Comparator services.

## Tech Stack

### Core

![PHP](https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white)
![Laravel](https://img.shields.io/badge/laravel-%23FF2D20.svg?style=for-the-badge&logo=laravel&logoColor=white)
![MySQL](https://img.shields.io/badge/mysql-%2300f.svg?style=for-the-badge&logo=mysql&logoColor=white)

### Infrastructure

![Docker](https://img.shields.io/badge/docker-%230db7ed.svg?style=for-the-badge&logo=docker&logoColor=white)
![Nginx](https://img.shields.io/badge/nginx-%23009639.svg?style=for-the-badge&logo=nginx&logoColor=white)

### Observability

![Grafana](https://img.shields.io/badge/grafana-%23F46800.svg?style=for-the-badge&logo=grafana&logoColor=white)
![Loki](https://img.shields.io/badge/loki-%23F46800.svg?style=for-the-badge&logo=grafana&logoColor=white)

## Project Structure

- **apps/external-apis**: Contains API services.
  - `continente-api`: Laravel 12 API service.
- **infra**: Infrastructure configurations (Docker Compose, Nginx, Observability).

## How to Run

To run the project, ensure you have **Docker** and **Docker Compose** installed.

### Application Stack

1. Clone the repository.
2. Start the main services using Docker Compose from the root directory:

```bash
docker-compose -f infra/docker-compose.yml up -d --build
```

3. Access the applications:
   - **Continente API**: [http://localhost:3001](http://localhost:3001)

### Observability Stack

To run the observability stack (Loki, Promtail, Grafana):

```bash
docker-compose -f infra/docker-compose.observability.yml up -d
```

- **Grafana**: [http://localhost:3000](http://localhost:3000) (User: `admin`, Password: `admin`)
- **Loki**: [http://localhost:3100](http://localhost:3100)

## Development

Currently, the `continente-api` service is the primary active application.
