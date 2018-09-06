php bin/console doctrine:mapping:import App\\Entity annotation --path=src/Entity
php bin/console make:entity --regenerate App
php bin/console doctrine:schema:update --force --complete
php bin/console doctrine:schema:validate

