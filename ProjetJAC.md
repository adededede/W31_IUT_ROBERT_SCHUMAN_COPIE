JAC - Just Another CMS
======================

Vous devez développer une application de publication d'articles, c'est-à-dire un mini-[CMS](https://fr.wikipedia.org/wiki/Syst%C3%A8me_de_gestion_de_contenu).


Article
-------

Un **article** est constitué de ces éléments :

- un identifiant,
- un auteur,
- un titre,
- une phrase d'accroche,
- un contenu textuel,
- un statut indiquant s'il est publié ou non,
- la date de la dernière publication,
- la date de la dernière modification.

Un **résumé d'un article** sera constitué de son titre, sa date de publication et sa phrase d'accroche.


Partie publique
---------------

La partie publique doit proposer les 3 vues principales :

- la page principale avec **le résumé** des 3 derniers articles publiés,
- un formulaire de création de compte "auteur",
- un formulaire d'authentification comme auteur.

Sur chaque vue, un menu doit permettre de naviguer vers les autres vues.

Sur la page principale, un clic sur le titre d'un article doit mener à la page de l'intégralité de l'article.


Compte "Auteur"
---------------

Un utilisateur authentifié, i.e; un auteur, doit pouvoir :

- changer son mot de passe
- supprimer son compte : tous ses articles sont supprimés
- se déconnecter

mais aussi :

- créer un nouvel article
- voir la liste de ses articles, publiés et non publiés
- modifier un article qu'il a lui-même créé
- publier/dé-publier un article

Un article non publié n'est donc visible que pour son auteur s'il est authentifié.


Conseils
--------

- Nous vous recommandons de réaliser ce projet en partant de la base de code obtenue à l'issue du TP n°8.
- Fixez-vous des objectifs progressifs : il n'est pas nécessaire que votre application soit entièrement fonctionnelle pendant son développement.
- Ne passez pas trop de temps sur le CSS : gardez à l'esprit que l'aspect esthétique ne sera pas évalué lors du TP noté.


Bonus pour les plus rapides
---------------------------

Ça tient en 5 mots mais cela devrait largement vous occuper : ajoutez la catégorisation des articles.

Cela signifie qu'un article peut appartenir à une ou plusieurs catégories, modifiables à tout instant. Il faudra donc ajouter une vue publique permettant d'afficher les articles d'une catégorie donnée.
