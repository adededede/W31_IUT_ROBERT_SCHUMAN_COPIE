Laravel
=======

**Préférez une installation sur votre ordinateur... si vous disposez d'un OS digne de ce nom ;).**

Installation de composer sur votre ordi personnel
-------------------------------------------------

```
$ sudo apt install composer
```

Installation de Laravel
-----------------------

**Attention : ce qui suit est valable sur votre ordinateur personnel ET SUR WEBETU UNIQUEMENT.**

1. Initialisation d'un projet `[NOM_DU_PROJET]` :

```
$ composer create-project --prefer-dist laravel/laravel [NOM_DU_PROJET]
```

2. Lancement d'un serveur local :

```
$ cd [NOM_DU_PROJET]
$ php artisan serve
Starting Laravel development server: http://127.0.0.1:8000
```

Si tout s'est bien passé, votre navigateur affiche une page blanche avec le contenu suivant avec l'URL `http://127.0.0.1:8000` :

```
Laravel

|---------------|-------------------|
| Documentation | Laracasts         |
|---------------|-------------------|
| Laravel News  | Vibrant Ecosystem |
|---------------|-------------------|
```
