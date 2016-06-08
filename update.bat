php bin/console doctrine:generate:entities AppBundle
rmdir /Q/S var\cache
php bin/console assets:install
php bin/console assetic:dump





