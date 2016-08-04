Familys-Team
============

A Symfony project created on July 19, 2016, 10:48 am.

=====================================================

INSTALLATION

1 - git clone https://github.com/Millambeur/Familys-Team.git
2 - bash : Familys-Team~ php composer.phar update
3 - bash : Familys-Team~ php bin/console doctrine:schema:update --dump-sql
4 - bash : Familys-Team~ php bin/console doctrine:schema:update --force
5 - bash : Familys-Team~ php bin/console assets:install --symlink
6 - bash : Familys-Team~ php bin/console assetic:dump --env=prod

CACHE CLEARING

7 - bash : Familys-Team~ php bin/console cache:clear --env=dev
8 - bash : Familys-Team~ php bin/console cache:clear --env=prod