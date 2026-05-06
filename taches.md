# Repartition des taches (3 personnes)

Objectif: se repartir le travail proprement sur GitHub en evitant les conflits et les doublons.

## Principes de collaboration

- Une personne est responsable d'un module de bout en bout (controller, model, vues).
- Chaque feature passe par une branche Git dediee (feature/xxx), puis une PR.
- Le responsable du module choisit les noms des routes, controllers et vues pour eviter les collisions.
- Les autres personnes revoient la PR (au moins 1 review) avant merge.

## Conventions (a valider entre vous)

- Dossier controllers: app/Controllers/
- Dossier models: app/Models/
- Dossier vues: app/Views/
- Prefix des routes pour chaque module:
	- Auth: /auth/*
	- Notes: /notes/*
	- Etudiants: /etudiants/*

## Decoupage recommande

### Personne 1: Auth + base UI

- Controllers
	- AuthController (login, logout)
- Models
	- UserModel (authentification)
- Vues
	- auth/login
	- layouts/base (layout commun)
- Taches techniques
	- Gestion session
	- Middleware/filters pour proteger les routes
	- Messages d'erreur/succes

### Personne 2: Formulaire ajout de notes

- Controllers
	- NotesController (formulaire, enregistrement)
- Models
	- NoteModel (insert note)
	- EtudiantModel (liste pour select)
	- MatiereModel (liste pour select)
- Vues
	- notes/create
- Taches techniques
	- Permettre plusieurs saisies (verifier contrainte UNIQUE)
	- Validation valeur (ex: 0-20)
	- Feedback utilisateur

### Personne 3: Liste etudiants + moyennes

- Controllers
	- EtudiantsController (liste, detail)
- Models
	- EtudiantModel (liste)
	- NoteModel (requete de moyennes)
	- ParcoursModel / SemestreModel (liaisons)
- Vues
	- etudiants/index
	- etudiants/show
- Taches techniques
	- Moyenne par semestre
	- Moyenne par annee
	- Presentation claire (tableaux)

## Process Git propose

1. Creer une branche par feature: feature/auth, feature/notes, feature/etudiants.
2. Chaque personne travaille sur son module, commits reguliers.
3. Ouvrir une PR quand la feature est fonctionnelle.
4. Review par au moins une autre personne.
5. Merge dans main apres validation.

## Points a decider rapidement

- Faut-il autoriser plusieurs notes par etudiant et matiere?
	- Si oui: enlever la contrainte UNIQUE (etudiant_id, matiere_id) dans schema.
- Nom exact des routes et vues pour chaque module.
- Format d'affichage des moyennes (table, cartes, etc.).
