rmdir /Q/S var\cache


rem rmdir /Q vendor\mopa\bootstrap-bundle\Mopa\Bundle\BootstrapBundle\Resources\public\bootstrap
rem mklink /D vendor\mopa\bootstrap-bundle\Mopa\Bundle\BootstrapBundle\Resources\public\bootstrap ..\..\..\..\..\..\..\twbs\bootstrap


rem rmdir /Q/S web\bundles\mopabootstrap
rem mklink /D web\bundles\mopabootstrap ..\..\vendor\mopa\bootstrap-bundle\Mopa\Bundle\BootstrapBundle\Resources\public




php bin/console assets:install
php bin/console assetic:dump



php bin/console doctrine:generate:entities AppBundle


