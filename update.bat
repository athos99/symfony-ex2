
rmdir /Q vendor\mopa\bootstrap-bundle\Mopa\Bundle\BootstrapBundle\Resources\public\bootstrap
mklink /D vendor\mopa\bootstrap-bundle\Mopa\Bundle\BootstrapBundle\Resources\public\bootstrap ..\..\..\..\..\..\..\twbs\bootstrap


rmdir /Q/S web\bundles\mopabootstrap
mklink /D web\bundles\mopabootstrap ..\..\vendor\mopa\bootstrap-bundle\Mopa\Bundle\BootstrapBundle\Resources\public




php bin/console assets:install
php bin/console assetic:dump



php bin/console doctrine:generate:entities AppBundle