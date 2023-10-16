# SymphArt
A basic Symfony 5 CRUD application used in the tutorial series "Up & Running With Symfony 5"

# Quick Start

```
# Install dependencies
composer install

# Edit the env file and add DB params

# Create Article schema
php bin/console doctrine:migrations:diff
# Run migrations
php bin/console doctrine:migrations:migrate

# Build for production
npm run build

# Run symfony server
symfony server:start
```

# App Info
- Author: Anastasiya Ovchinnikova
- Version: 1.0.0