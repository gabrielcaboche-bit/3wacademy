# Analyse d'Impact relative à la Protection des Données (AIPD)

**Projet :** Formulaire d'inscription - Forum de jeux de rôles

## 1. Description du traitement

- **Nature du traitement :** Le traitement consiste à collecter les informations des utilisateurs lors de leur inscription sur le forum de jeux de rôles. Ces informations sont actuellement stockées de manière temporaire dans le navigateur via le `sessionStorage`.
- **Données à caractère personnel collectées :** 
    - Adresse Email
    - Nom du personnage (pouvant agir comme pseudonyme identifiant)
    - Mot de passe
- **Personnes concernées :** Les internautes et joueurs souhaitant s'inscrire pour participer au forum.
- **Destinataires des données :** L'administrateur du site (en l'état actuel, les données restent uniquement stockées localement sur la machine de l'utilisateur).

## 2. Appréciation de la nécessité et de la proportionnalité

- **Base légale :** Le consentement de l'utilisateur (recueilli lors de l'inscription via une case à cocher obligatoire "J'accepte la politique de confidentialité").
- **Finalité du traitement :** Permettre l'inscription, la création d'un compte utilisateur authentifié et la personnalisation du profil sur le forum de jeux de rôles.
- **Minimisation des données :** 
    - Email : Nécessaire pour l'identification, la récupération de compte et les notifications.
    - Mot de passe : Indispensable pour sécuriser l'accès au compte.
    - Nom du personnage : Nécessaire pour l'identification sur le forum.
- **Durée de conservation :** Actuellement, les données dans le `sessionStorage` sont supprimées à la fermeture du navigateur. Dans le cadre d'une future implémentation avec base de données, elles seraient conservées jusqu'à la demande de suppression du compte par l'utilisateur, ou après 3 ans d'inactivité.

## 3. Appréciation des risques pour les droits et libertés des personnes

### 3.1. Accès illégitime (Perte de confidentialité)
- **Description du risque :** Les mots de passe et emails sont actuellement stockés "en clair" dans le navigateur (sessionStorage). Une personne malveillante ayant accès physiquement à l'ordinateur de l'utilisateur ou exploitant une faille de sécurité (ex: faille XSS) pourrait récupérer ces identifiants pour usurper l'identité du joueur sur le forum ou sur d'autres sites.
- **Gravité :** Élevée (vol d'identifiants et compromission de mots de passe).
- **Probabilité :** Moyenne (dépend de l'environnement physique et de la sécurité anti-XSS du site).

### 3.2. Modification non désirée (Perte d'intégrité)
- **Description du risque :** L'altération des données locales en sessionStorage par un script malveillant tiers ou une manipulation accidentelle, modifiant le profil du joueur à son insu.
- **Gravité :** Faible (l'impact se limite à la modification du profil sur le forum).
- **Probabilité :** Faible.

### 3.3. Disparition des données (Perte de disponibilité)
- **Description du risque :** Effacement inévitable des données dû au fonctionnement normal du `sessionStorage` (fermeture de l'onglet, du navigateur).
- **Gravité :** Faible (l'utilisateur peut simplement recréer son profil ou s'inscrire à nouveau).
- **Probabilité :** Maximale (comportement par défaut du stockage de session).

## 4. Mesures prévues pour traiter les risques

- **Mesures de sécurité techniques :** 
    - Validation existante du format de l'email via expression régulière en JavaScript (regex).
- **Mesures de sécurité organisationnelles :** 
    - Restriction stricte des accès au futur serveur/base de données.
    - Audit régulier du code JavaScript pour vérifier l'absence d'inclusions malveillantes.
- **Gestion des droits des personnes (RGPD) :** 
    - Consentement explicite déjà en place.
    - Intégrer un bouton de suppression de compte pour honorer le droit d'effacement / droit de retrait du consentement.
    - Mise à disposition d'une page détaillant la politique de confidentialité (temps de conservation, contacts pour exercer ses droits d'accès et de rectification).
