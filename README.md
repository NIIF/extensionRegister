ExtensionRegister

Install
-----------

```
git clone https://dev.niif.hu/gyufi/extensionregister.git
cd extensionregister
composer install
```

The configuration

* database host, port, credentials,
* logging parameters,
* first and last extenension to define the pool,
* permitted IP addresses.

Database initialization:

```
app/console doctrine:database:create
app/console doctrine:schema:create
```

Usage
------

Install simplesamlphp in VidyoProxy role, install and config the https://github.com/NIIF/simplesamlphp-module-attributefromrestapi module and you can register and send extensions of your authenticated users to Vidyo.

URL: /getExtension/{nameId}

Maintenance
----------------

The /getHealth URL provide the number of remain extenstions in the pool. You can use it in your monitoring system.


Testing
------------------

In development environment:

```
bin/behat
```