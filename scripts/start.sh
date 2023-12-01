#!/bin/bash

if [ -f .env ]; then
  source .env
  source environments/local/.env.local
fi

if [ "$APP_ENV" == "local" ]; then
  docker compose \
   -f docker-compose.yml \
   -f environments/local/docker-compose.dev.yml \
   --env-file environments/local/.env.local \
   up --build --remove-orphans --force-recreate -d
else
  docker compose up --build --remove-orphans --force-recreate -d
fi
