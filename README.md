# Monorepo Project

This repository hosts a microservices-based architecture for a grocery price comparison platform. It aggregates product data from multiple external retailers to give to the end-user the ability to compare prices.

## Tech Stack 💻

### Core

![PHP](https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white)
![Laravel](https://img.shields.io/badge/laravel-%23FF2D20.svg?style=for-the-badge&logo=laravel&logoColor=white)
![MySQL](https://img.shields.io/badge/mysql-%2300f.svg?style=for-the-badge&logo=mysql&logoColor=white)
</br>
![NodeJS](https://img.shields.io/badge/node.js-6DA55F?style=for-the-badge&logo=node.js&logoColor=white)
![TypeScript](https://img.shields.io/badge/typescript-%23007ACC.svg?style=for-the-badge&logo=typescript&logoColor=white)
![PostgreSQL](https://img.shields.io/badge/postgresql-%23316192.svg?style=for-the-badge&logo=postgresql&logoColor=white)
</br>
![.NET Core](https://img.shields.io/badge/.net%20core-%230db7ed.svg?style=for-the-badge&logo=.net&logoColor=white)
![C#](https://img.shields.io/badge/c%23-%230db7ed.svg?style=for-the-badge&logo=csharp&logoColor=white)
![Entity Framework](https://img.shields.io/badge/entity%20framework-%230db7ed.svg?style=for-the-badge&logo=.net&logoColor=white)
![SQL Server](https://img.shields.io/badge/sql%20server-%230db7ed.svg?style=for-the-badge&logo=.net&logoColor=white)

### Infrastructure

![Docker](https://img.shields.io/badge/docker-%230db7ed.svg?style=for-the-badge&logo=docker&logoColor=white)
![Nginx](https://img.shields.io/badge/nginx-%23009639.svg?style=for-the-badge&logo=nginx&logoColor=white)

### Observability

![Grafana](https://img.shields.io/badge/grafana-%23F46800.svg?style=for-the-badge&logo=grafana&logoColor=white)
![Loki](https://img.shields.io/badge/loki-%23F46800.svg?style=for-the-badge&logo=grafana&logoColor=white)

## Project Structure

- **apps/comparator**: Responsible for get data from external APIs, normalize it and save it in database, and compare data from different retailers. Plus, it has a web interface to show the results, give the user the ability to search for products and compare prices.
  - `comparator-api`: (under development).
  - `comparator-web`: (under development).
- **apps/external-apis**: Contains API services. Dedicated services for fetching and normalizing data from specific retailers:
  - `continente-api`: Laravel 12 API service.
  - `aldi-api`: Node.js/TypeScript API service using Drizzle ORM.
  - `lidl-api`: .NET Core API service using Entity Framework with SQL Server.
- **infra**: Infrastructure configurations (Docker Compose, Nginx, Observability).

## How to Run

To run the project, ensure you have **Docker** and **Docker Compose** installed.

### Application Stack

#### Continente API

Start the service:

```bash
docker-compose -f infra/docker-compose.continente.yml up -d --build --scale continente-api=3
```

Access the application at [http://localhost:3001](http://localhost:3001).

#### Aldi API

Start the service:

```bash
docker-compose -f infra/docker-compose.aldi.yml up -d --build
```

Access the application at [http://localhost:3333](http://localhost:3333).

#### Lidl API

Start the service:

```bash
docker-compose -f infra/docker-compose.lidl.yml up -d --build
```

Access the application at [http://localhost:3004](http://localhost:3004).

### Observability Stack

To run the observability stack (Loki, Promtail, Grafana):

```bash
docker-compose -f infra/docker-compose.observability.yml up -d
```

- **Grafana**: [http://localhost:3000](http://localhost:3000) (User: `admin`, Password: `admin`)
- **Loki**: [http://localhost:3100](http://localhost:3100)

1. Access `http://localhost:3000`.
2. Go to Connections -> **Data sources**.
3. Search for *Loki*, and set `http://loki:3100` in the URL field.
