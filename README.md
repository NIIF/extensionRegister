ExtensionRegister

Install
-----------
git clone https://dev.niif.hu/gyufi/extensionregister.git
cd extensionregister
composer install

Ebben a lépésben konfigurációra is van lehetőség:

* adatbázis kapcsolat értékei,
* logolás,
* az első és utolsó extension értékei,
* valamint azon IP címek, amiknek válaszol a szoftver.

inicializáljuk az adatbázist:

app/console doctrine:database:create
app/console doctrine:schema:create

Üzemeltetés
----------------

A /getHealth URL-en visszaadjuk a fennmaradó extension-ök számát. Icingába való.


Testing
------------------

devel környezetben:

bin/behat
