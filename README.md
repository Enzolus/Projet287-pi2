# Projet Pi² - Groupe 287

Ce projet est développé par l'équipe 287, avec une contribution principale de LUSARDI. Le but de ce projet est de créer un système intégré qui comprend une interface utilisateur, une API Python pour la réception de données, une base de données MariaDB pour le stockage des données, et l'utilisation de Google Colab pour la création d'utilisateurs.

## Composants du Projet

### Bouton Simulation

- **Version :** 2v
- **Dernière mise à jour :** 8 minutes ago
- **Description :** Module de simulation d'un bouton qui déclenche un processus au sein de notre système. Utilisé pour simuler des actions utilisateur et tester la réactivité de notre système.

### Conteneur API Python

- **Version :** 2v
- **Dernière mise à jour :** 8 minutes ago
- **Description :** Un conteneur Docker qui héberge notre API Python. Cette API est conçue pour recevoir des déclenchements du bouton de simulation et traiter ces événements en conséquence.

### Conteneur BDD MariaDB

- **Version :** final
- **Dernière mise à jour :** Maintenant
- **Description :** Conteneur Docker contenant la base de données MariaDB. Cette base de données stocke toutes les informations pertinentes traitées par notre système, y compris les actions des utilisateurs simulées par le bouton.

### Conteneur Interface Site et Lien BDD

- **Version :** final
- **Dernière mise à jour :** Maintenant
- **Description :** Ce conteneur héberge l'interface utilisateur de notre projet et gère la connexion à la base de données MariaDB. Il fournit une interface visuelle pour interagir avec le système et visualiser les données.

### Création Utilisateur avec Google Colab et DB MariaDB

- **Premier commit :** 7 minutes ago
- **Description :** Utilisation de Google Colab pour créer des scripts permettant de générer des utilisateurs dans la base de données MariaDB. Facilite la gestion des utilisateurs et leur intégration dans le système.

## Comment démarrer

1. **Clonez le dépôt du projet :**
   ```bash
   git clone https://github.com/Enzolus/Projet287-pi2.git
