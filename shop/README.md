php version: 7.4.x
extension "extension=pdo_mysql" and "extension=gd2" must be enable

database login:
user: root
pass: root

(can be changed in .env)

install dependencies (using composer): 'composer install'

Once db server is started, create db with: 'php bin/console doctrine:database:create'
then add data fixtures with 'php bin/console doctrine:fixtures:load'

start project with 'symfony server:start'

Bonus réalisés:
-Sidebar "Top Ventes"
-Gestion des devises
-Back office (accessible seulement aux admins - tous les nouveaux comptes crées sont admin par défaut)
-Possibilité de valider les commandes (dans l'accueil du back office)
-Recherche de produit
-Captcha lors d'une inscription
