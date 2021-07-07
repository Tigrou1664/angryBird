# Exercice Symfony > Getting started

Vous allez mettre en place un site de fan sur les Angry Birds ! Analysons les contenus fournis pour entrevoir les fonctionnalités attendues. Les étapes de l'exercice sont détaillées ensuite.

## Intégration fournie

### 1. Liste

<kbd>![](README/01-list.png)</kbd>

### 2. Oiseau

<kbd>![](README/02-bird.png)</kbd>

---

### Objectifs

- Installer Symfony Skeleton
- L'enrichir au besoin via la documentation de Symfony section _Getting Started_
- Parcourir la documentation Twig (moteur de templating)
- Créer un site de fans sur les Angry Birds !

Vous travaillerez à partir de [la documentation Symfony : Getting Started](https://symfony.com/doc/current/index.html).

> :hand: **Toutes les infos sont contenues dans les chapitres du _Getting Started_**. Pas besoin d'aller chercher les infos ailleurs pour le moment.

## Etapes de l'exercice

**Installation**

Installer un nouveau projet Symfony "skeleton", avec Composer : 
- `composer create-project symfony/skeleton`
- Puis déplacer tout le contenu du dossier à la racine de votre repo via la commande :
  - `mv skeleton/* skeleton/.* .`
  - (cela évite d'avoir un sous-dossier en plus dans le projet !).

> :hand: Si besoin de passer par Apache, on installe le `.htaccess` via `composer require apache-pack`, on n'oublie pas de répondre `y` à la question posée :warning:
> 
> :hand: Sinon, on peut utiliser le serveur PHP `php -S 0.0.0.0:8000 -t public`.

**Les routes**

> :hand: Les routes (URL, contrôleur, méthode, paramètres, description) sont listées dans un fichier markdown.

**Les assets**

Nous allons copier les ressources fournies avec le projet, dans les dossiers adéquats.

Dans le dossier `public` créer un sous-dossier `images` et y copier les fichiers images.

> On s'occupera du fichier `data.php` dans quelques minutes.

> :hand: A ce stade la structure de notre site est en place, il ne nous reste plus qu'à coder les fonctionnalités !

---

:hand: Pour ce premier challenge, je vous demande de créer deux routes, avec 2 templates qui héritent du layout de base. Ne cherchez pas à rendre la seconde route dynamique pour le moment.

⚠️ L'intégration est fournie et se trouve dans le dossier `sources/html-css` ! Vous devez "importer" cette inté dans des templates Twig

- Créer une route : https://symfony.com/doc/current/page_creation.html

Vous trouverez comment lier des CSS ou afficher des images ici : 
- https://symfony.com/doc/current/templates.html
  - > Linking to CSS, JavaScript and Image Assets

Vous trouverez comment utiliser l'héritage Twig ici (mot-clé `extends`) : 
- https://symfony.com/doc/current/templates.html
  - > Template Inheritance and Layouts

Et ce sera déjà bien pour ce challenge 😉

La suite demain !

---

**Liste des oiseaux**

Aux étapes suivantes, créer les contrôleurs, méthodes et templates nécessaires.

- Bien que le _yaml_ reste possible pour l'écriture des routes, les annotations sont recommandées : les inclure au projet via `composer require annotations`
- Vous pourrez afficher les routes dans le terminal avec `debug:router`.


1. Récupérer la liste des oiseaux et la dumper via `dump()` depuis la page d'accueil.
   - **`data.php` (Model)** : Pour ce faire, trouver le moyen d'intégrer les données fournies dans le projet Symfo (on cherchera une solution en PHP objet de préféfence :wink:). Pas de bases de données pour le moment, on voit ça en S02 :wink:
2. Créer la vue associée avec l'héritage du layout principal (Twig) d'après la capture fournie (rubrique _Templates_).
   - Si besoin de Twig, l'inclure au projet via `composer require twig` :paintbrush:
3. Afficher les données brutes dans la vue (on affichera les images et on créera les liens ensuite). Cf : Boucle [for de Twig](https://twig.symfony.com/doc/3.x/tags/for.html)

> Vous souhaitez des infos sur l'exécution de votre code ? => `composer require profiler` :tada:

**Liens et images**

Dans la boucle du template de liste :

1. Afficher l'image de chaque oiseau (rubrique _Templates > Linking to Assets_).
2. Générer des liens avec l'id de l'oiseau concerné (rubrique _Templates > Linking to Pages_). Trouver le moyen d'identifier un oiseau depuis le tableau.

**Show bird**

1. Récupérer l'index de l'oiseau à afficher depuis l'URL et le dumper pour vérification (rubrique _Routing_).
2. Récupérer le data de l'oiseau, le donner à la vue et afficher le détail complet (rubrique _Templates_).
   - Créer la vue associée avec l'héritage du layout principal d'après la capture fournie.
3. Que faire si l'index n'existe pas dans les data ? (pensez _"HTTP"_ cf rubrique _Controllers_)
4. Créer le lien vers la page d'accueil.

**Routes (suite)**

Que faire si le paramètre `id` de la route `bird_show` n'est pas au format numérique ? Essayez de passer une chaine de caractères dans l'URL pour voir.

- Trouver le moyen de mettre des contraintes sur les paramètres de routes, ici sur l'id de l'oiseau qui doit être un entier (rubrique _Routing > Parameters Validation_).

**API**

Cela n'est pas précisé dans les captures mais vous pourriez proposer un accès API/JSON qui renvoie les données des oiseaux vers une appli front.
- Récupérer l'ensemble des data et les encoder en JSON (rubrique _Controllers > Returning JSON Response_).

## Lectures

- Parcourir [les conventions de codage et de nommage de Symfony](https://symfony.com/doc/current/contributing/code/standards.html).  
Elles vous permettront d'avoir **une base pour l'écriture de votre code**.
- [Les fondamentaux HTTP, vus par Symfony](https://symfony.com/doc/current/introduction/http_fundamentals.html).
