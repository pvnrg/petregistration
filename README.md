# 🐾 Pet Registration - Symfony Full Stack Coding Challenge

This is a Symfony-based Pet Owner Registration application built for the full-stack coding challenge. It allows users to register pets with details like name, breed, age, sex, and identifies dangerous breeds (e.g., Pitbull, Mastiff). The application supports form submission, listing, and deletion of pets, styled with Bootstrap 5.

> 🧑‍💻 Maintained by: [pvnrg](https://github.com/pvnrg)  
> 📦 Repository: https://github.com/pvnrg/petregistration

---

## 📦 Features

- Symfony 6.1.12
- Bootstrap 5 form design
- Add, list, and delete pets
- Danger indicator for specific breeds
- Form with validation
- Data fixtures for sample data
- PHPUnit tests (Entity + Controller)
- Docker-ready structure

---

## 🚀 Getting Started

### 🔧 Requirements

- PHP 8.1+
- Composer
- MySQL or SQLite
- Docker (optional but recommended)
- Node.js + npm (only if using Tailwind version)

---

### 📂 Clone the repository


```bash
git clone https://github.com/pvnrg/petregistration.git
cd petregistration


## Requirements
- Docker
- Docker Compose

## Setup

docker-compose up --build

## create .env if it is not there

cp .env .env.local

## For MySQL

DATABASE_URL="mysql://username:password@127.0.0.1:3306/petdb?serverVersion=8.0"

## Install dependancies

composer install

## run below command for database setup

```bash
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate

## to run the server run below command:

symfony server:start

```
## Project Structure:
src/
├── Controller/
│   └── PetController.php
├── Entity/
│   └── Pet.php
├── Form/
│   └── PetType.php
├── Repository/
│   └── PetRepository.php
├── DataFixtures/
│   └── AppFixtures.php
templates/
├── pet/
│   ├── index.html.twig
│   ├── new.html.twig
│   └── summary.html.twig
tests/
├── Entity/
│   └── PetTest.php


## Some Screenshot of project
## Listing Of Records
URL: http://localhost:8000/pets
![List View](docs/list.png)

## Create Record Form
URL: http://localhost:8000/pet/new
![Create Form](docs/form.png)

## Summary Page
URL: 
![Summary Page](/docs/summary.png)

## docker containers
![Docker](docs/docker.png)