# Codepi : Test technique Laravel

Le test suivant consiste à développer une micro-application Laravel de recherche
de Concerts.

N'hésitez pas à appliquer les meilleures pratiques que vous connaissez à tout
moment du développement.
Pensez au fait que le code d'une application est voué à être récupéré par
d'autres développeurs, et qu'un autre développeur doit pouvoir rapidement
le comprendre, l'étendre et le modifier.

Il vous est fourni les éléments suivant :

- Le plan du site souhaité (dans le README.md plus bas)
- Des wireframes pour chaque page du site afin que vous n'ayez pas à vous
concentrer sur l'architecture des pages mais sur celle de votre code (resources/assets/wireframes-codepi.pdf)
- Des données d'exemple :
    - un fichier CSV contenant la liste des artistes
    - un fichier CSV contenant la liste des concerts
    - un dossier d'images, chacune correspondant à une ligne du CSV

## A - Le site

Le site permet de consulter, filtrer et trier des concerts en fonction de
plusieurs paramètres.

### A.1 - Page d'accueil

Le filtrage doit se faire sans rechargement de page, à l'aide de requêtes
asynchrones (AJAX) pour rafraîchir les éléments de la page et s'assurer que les
produits affichés sont toujours ceux trouvés par les filtres de recherche.

De la même manière, la navigation entre les pages des résultats devra se faire
sans rechargement de la page.

Les concerts pourront être filtrés en fonction des paramètres suivants :

- Ville du concert
- Tags associés à l'artiste (Rock, Pop, Soul, Funk etc.)
- Prix du concert
- Date du concert : le visiteur pourra choisir une fourchette entre deux dates

Pour chaque concert, les vignettes devront être recadrées de manière à ne
pas être écrasées et conserver l'homotéthie de l'image.

### A.2 - Page de détails d'un concert

La page de détail d'un concert permet d'afficher le détail de l'artiste et du
concert, divisé en deux colonnes.

La première colonne montre les informations de l'artiste, dont son nom, son
image de couverture, sa déscription.
Une vidéo récupérée via l'API Youtube sera aussi affichée.
Le détail de la récupération de la vidéo et de l'utilisation de l'API Youtube
est fourni dans la section III.

La seconde colonne quant à elle affichera le détail de l'évènement, dont sa
date, le nom du lieu, l'adresse et la Ville.
Une carte Google Map récupérée à partir de l'API Google Maps devra aussi être
affichée.

Important : Le bouton "Pré-commander" ne fonctionnera pas, et n'est présent que
pour que la page soit complète. Mais bien évidemment, il ne faudra pas
implémenter de système de commande !

## A.3.Intro - Administration

L'administration de l'application est une interface simple permettant d'ajouter,
modifier et supprimer des concerts dans la base de données.

Il n'est pas nécessaire d'administrer les autres ressources. Les concerts
suffiront à nous permettre de voir les choix techniques que vous prendrez pour
proposer une telle interface.

### A.3 - Page de login

Afin de protéger l'interface d'admin, il sera nécessaire de se connecter à
l'interface d'administration avec les identifiants suivants :

- E-mail   : user@codepi.com
- Password : pwd2015

### A.4 - Page d'accueil de l'administration

Une simple liste des concerts existants disposant d'une pagination suffira
à la navigation. Il ne sera pas nécessaire de créer des filtres ou des tris ici.

Il faudra pouvoir créer, éditer et supprimer des concerts.

### A.5 - Page d'édition de concert

Cette page sera la même pour l'ajout et l'édition de concerts.
La présentation donnée dans la page 5 des Wireframes est un présentation
d'exemple et pourra dépendre de la manière dont vous aurez géré l'architecture
de vos ressources.


### A.6 - Plan du site

Voici le plan du site présenté dans les Wireframes afin de vous donner une idée
générale des sections de l'application.

```

|--- Homepage (Page de liste des concerts)
|  |
|  |--- Liste simple de produits avec pagination (9 par page)
|  |
|  |--- Filtres de recherche
|  |
|  |--- Affichage du détails des concerts, de la vidéo associée à l'artiste
|  |    et des informations d'accès au concert
|
|
|--- Administration (utilisateur admin)
|  |
|  |--- Connexion à l'administration
|  |
|  |--- Liste des produits
|  |  |
|  |  |--- Ajout / Modification / Suppression

```

## B - Les données

Il vous faudra importer les données contenues dans les fichiers CSV, mais aussi
écrire des scripts de synchronisation avec des APIs simples d'utilisation.

Tous les scripts d'imports devront pouvoir être utilisés depuis la ligne de
commande, de préférence avec les outils courants pour ce genre de tâches pour
Laravel.

### B.1 - L'import des données CSV

Un simple script d'import des données devra permettre en une commande d'importer
la liste des artistes et des concerts fournies au format CSV, afin de remplir
la base de données de l'application.

Les fichiers CSV se trouvent dans le dossier `resources/assets`.

Le fichier `resources/assets/artistes.csv` contient des noms d'images à relier aux
artistes. Ces images se trouvent dans le dossier `resources/assets/images`.

Vous ferez attention à ne pas générer de doublons et que toutes les ressources
générées soient valides pour l'application et ne génèrent pas d'erreur au niveau
de la navigation du site.

### B.2 - La synchronisation des données à partir d'APIs

L'application devra se synchroniser avec l'API Youtube pour récupérer les vidéos
associées aux artistes des concerts.

Vous ferez une recherche via l'API Youtube avec le nom de l'artiste et
récupérerez les données nécessaire à générer le player vidéo pour les pages
de concert de l'artiste à partir du premier résultat de cette recherche.

### B.3 - Les cartes Google Maps

Afin de générer les cartes Google maps, vous disposez dans les fichiers
CSVs de toutes les informations nécessaires à la localistation de l'endroit
où ils ont lieu. Notez que tous les concerts sont en France, et qu'il peut être
utile de le préciser à Google Maps lors de l'utilisation de l'API.

Il vous faudra ainsi générer dynamiquement des cartes Google Maps grâce à l'API
Javascript Google Maps v3.

### B.4 - API Key Google

Pour utiliser les APIs Youtube et Google Maps, vous pourrez utiliser l'API Key
suivante afin d'authentifier votre application :

```
AIzaSyD0HX0kSeMKR_QWBYx-HE-6Wui9zL66ePU
```


## Intégration

Le design du site n'est pas le point principal, cependant, les éléments devront
être organisés comme sur les wireframes. Un framework front-end peut être
utilisé et devrait vous simplifier la tâche pour organiser les éléments, mais
une solution à la main est parfaitement acceptable.

Un nommage sémantique et en anglais de vos conteneurs à l'aide de classes sera
aussi apprécié. L'exemple ci-dessous est à titre indicatif, et un autre choix
dans la structure des noms est tout à fait acceptable, tant que la structure du
HTML est lisible.

```html
  <div class="user-container">
    <div class="user-avatar">
      <img src="avatar.gif">
    <div class="user-name">
      {{ user.name }}
    </div>
    </div>
  </div>
```

## Utilisation de librairies

Pour ce test, certaines librairies pourront vous être utiles. N'hésitez pas à
ne pas faire à la main l'authentification, la pagination et autres
fonctionnalités pour lesquelles des librairies très répandues existent.


## Bonne chance !