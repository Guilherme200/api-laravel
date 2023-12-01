#!/bin/bash

if [ -f .env ]; then
  source .env
fi

if [ "$APP_ENV" == "local" ]; then
  docker compose -f docker-compose.yml -f docker-compose.dev.yml up --build --remove-orphans --force-recreate -d
else
  docker compose up --build --remove-orphans --force-recreate -d
fi
