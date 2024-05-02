![Logo LyonPalme](/Images/readme_logo__1_.png)

# Gestion des Adhérents - LyonPalme

## Sommaire

# Gestion des Adhérents - LyonPalme

## Sommaire

- [Description](#description)
- [Technologies Utilisées](#techno)
- [Diagramme de cas d'utilisation](#utilisation)
- [Digramme de cas](#bdd)
- [Prérequis](#prerequis)
- [Installation](#installation)
- [Créer le premier user](#premieruser)
- [Utilisation](#utile)



## Description <a id="description"></a>

Le club "LyonPalme" est une association sportive de natation avec palmes : monopalme ou bi-palmes. Il compte une quarantaine d'adhérents et son siège est à Saint-Fons. Notre application de gestion des adhérents permet de gérer les comptes des membres du club. Seule la secrétaire est autorisée à créer et à modifier tous les comptes. Les adhérents, quant à eux, peuvent accéder à leur profil une fois leur compte créé et le modifier. Ils peuvent également consulter l'annuaire et le trombinoscope.



## Technologies Utilisées <a id="techno"></a>

| **Nom** | **Description** |
| ------- | ------------- |
| ![Laravel](https://img.shields.io/badge/laravel-%23FF2D20.svg?style=for-the-badge&logo=laravel&logoColor=white) | Framework. |
| ![Debian](https://img.shields.io/badge/Debian-D70A53?style=for-the-badge&logo=debian&logoColor=white) | Linux. |
| ![NodeJS](https://img.shields.io/badge/node.js-6DA55F?style=for-the-badge&logo=node.js&logoColor=white) | Utilisation de NodeJS pour NPM. |
| ![Git](https://img.shields.io/badge/git-%23F05033.svg?style=for-the-badge&logo=git&logoColor=white) | Contrôle de version. |
| ![PHP](https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white) | Language de code. |
| ![MariaDB](https://img.shields.io/badge/MariaDB-003545?style=for-the-badge&logo=mariadb&logoColor=white)| Système de gestion de base de données. |



## Diagramme de cas d'utilisation <a id="utilisation"></a>

![Diagramme de cas d'utilisation](/Images/activité.png)


## Base de données <a id="bdd"></a>

![Base de données](/Images/bdd.png)



## Prérequis <a id="prerequis"></a>

Pour exécuter ce projet, vous devez avoir Debian, Apache2, Mariadb, Laravel, NodeJS et Git.



## Installation <a id="installation"></a>

Tout d'abord, vous devez cloner le projet :

```git clone https://github.com/SonnyRu/gestion-adherents.git```

Puis vous devez vous placer dans le projet et accorder les droits à deux fichiers en utilisant les commandes ci-dessous. Assurez-vous de remplacer "votreusername" par votre nom d'utilisateur sur votre machine :

```xml
sudo chown -R votreusername:www-data bootstrap/cache/
sudo chown -R votreusername:www-data storage
sudo chmod -R 755 bootstrap/cache/
sudo chmod -R 755 storage/
```


Après cela, vous devrez exécuter les commandes : 
```xml
composer install
npm install
npm run build
```

Ensuite, copiez l'exemple de fichier .env et collez-le dans le même emplacement où il est situé, puis remplissez-le comme indiqué ci-dessous :

![.env](/Images/env.png)

Pour la base de données, vous devrez créer un utilisateur SQL et lui accorder des droits en utilisant les commandes suivantes :

```sql
CREATE DATABASE lyonpalme;
CREATE USER 'userDuEnv'@localhost IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON lyonpalme.* TO 'userDuEnv'@localhost;
FLUSH PRIVILEGES
```

## Créer le premier user <a id="premieruser"></a>

Pour créer le premier utilisateur, vous devez accéder au contrôleur "register" situé ici : 'app/http/controllers/auth/RegisteredUserController.php'. Ensuite, vous devez mettre en commentaire les lignes comme indiqué ci-dessous :

![commentaire](/Images/commentaire.png)

Rendez-vous sur ce lien pour créer votre compte président :

https://slam24-chassagnes.fr/register

Ou si vous êtes en local :

http://localhost/register

Une fois le compte créé, retournez dans le contrôleur "register" et enlevez les commentaires, puis enregistrez.



## Utilisation <a id="utile"></a>

Une fois l'installation terminée, vous pouvez vous connecter à l'application en utilisant les identifiants créés juste avant. Une fois connecté, vous pourrez y retrouver :

- L’accès a la modification de tout le compte.
- Trombinoscope.
- L'Annuaire.
- Création de comptes.

Ensuite, placez-vous dans le projet et exécutez la commande :

```xml
php artisan migrate
```

Ensuite, exécutez la commande ```npm run build```, démarrez le serveur Apache2 avec la commande ```sudo service apache2 start``` et vérifiez que votre serveur MariaDB est toujours en cours d'exécution. Après cela, vous pourrez accéder à l'application et vous connecter avec l'utilisateur que vous avez créé.

L'application étant déjà hébergée, vous pourrez vous connecter avec les identifiants suivants :

| **Login** | **Mot de passe** |
| ------- | ------------- |
| vromaine@gmail.com | C1Secret! |





