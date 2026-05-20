# Initialisation

## installer sur pc 
- regarder version php (ex: PHP 8.3.6)

- installer sqlite :
``` sudo apt update```
``` sudo apt install php8.3-sqlite3```

## configurer sur le projet 
- aller a la racine du projet 
``` php -m | grep -i sqlite```
-> doit donner pdo_sqlite et sqlite3

``` touch writable/database.sqlite ```
``` chmod 777 writable/database.sqlite ```

## creation de fichier 
``` php spark make:migration CreateDepartements ```

## verification 
``` php spark migrate ```

## ouvrir / quitter la base 
``` sqlite3 writable/fitspace.db ```
``` .exit```

## remettre a zero => drop database
- supprimer wrtitable/fitspace.db
- ```php spark migrate```



# debug
``` 
unning all new migrations...
[CodeIgniter\Database\Exceptions\DatabaseException]
near "CONSTRAINT": syntax error
at SYSTEMPATH/Database/BaseConnection.php:865

  Caused by:
  [CodeIgniter\Database\Exceptions\DatabaseException]
  near "CONSTRAINT": syntax error
  at SYSTEMPATH/Database/SQLite3/Connection.php:174

  Caused by:
  [SQLite3Exception]
  near "CONSTRAINT": syntax error
  at SYSTEMPATH/Database/SQLite3/Connection.php:163
```
-> dans Datapase.php : 'foreignKeys'  => true,
-> simplifier les foreign keys

## recup le resultat d une requete CI

``` CRITICAL - 2026-05-20 08:37:27 --> Error: Call to undefined method CodeIgniter\Database\SQLite3\Result::result() ```

-> la methode result n'existe pas 
``` $query->resultArray() ```

-> 

#SQLITE

## creer seeders
```php spark make:seeder DepartementSeeder```

## lancer seeders
``` php spark db:seed MainSeeder ```


## telecharger js depuis terminal
``` wget https://cdn.exemple.com/script.js ```
ou
``` curl -O https://cdn.exemple.com/script.js ```


