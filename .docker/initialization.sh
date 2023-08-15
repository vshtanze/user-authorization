#!/bin/bash -ex

composer install --no-interaction --no-scripts
php bin/console assets:install --no-interaction
php bin/console cache:warmup --no-interaction --no-optional-warmers

php bin/console doctrine:database:create --if-not-exists
php bin/console doctrine:migrations:migrate --no-interaction
php bin/console doctrine:fixtures:load --append