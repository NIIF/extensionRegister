ExtensionRegister

Install
-----------
composer install

Configure
-------------
Töltsük ki a parameters.yml-ban

* adatbázis kapcsolat értékeit,
* logolást,
* az első és utolsó extension értékét,
* valamint azon IP címeket, amiknek válaszol a szoftver.

Üzemeltetés
----------------

A /getHealth URL-en visszaadjuk a fennmaradó extension-ök számát. Icingába való.


Testing
------------------

devel környezetben:

bin/behat