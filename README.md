**Morning Soul — Site Vitrine & Forum Communautaire**

*Projet réalisé dans le cadre de la soutenance du Titre Professionnel DWWM*

Morning Soul est un site web hybride combinant une vitrine immersive dédiée à un jeu vidéo indépendant et un forum communautaire complet.
Le projet met en avant une identité visuelle sombre et narrative, un espace éditorial (actualités, devblog, changelog) et un forum structuré avec gestion des rôles, sécurité avancée et outils de modération.  

------------------------------------------------------------
<img width="2480" height="3508" alt="Couverture v2" src="https://github.com/user-attachments/assets/076bcb06-0e83-4684-be35-fce3f3fe298f" />  

  
**Fonctionnalités principales**
- Présentation de l’univers du jeu (lore, mécaniques, inspirations)
- Pages éditoriales : Actualités, Devblog, Changelog
- Page de présentation du projet
- Formulaire de contact + support

**Forum communautaire complet**
- Catégories, topics, posts, tags
- Pagination (KnpPaginator)
- Système de favoris & historique
- Gestion des topics (édition, suppression, épinglage, quarantaine)
- Comptes utilisateurs avec rôles
- API TinyMCE

**Sécurité et gestion des accès**
- Authentification Symfony (Authenticator)
- CSRF tokens sur tous les formulaires
- Validation avancée (Assert)
- Gestion des bans, tokens de reset, expiration
- Protection XSS / SQLi via Doctrine & validation

**Responsive et Accessibilité**
- Design responsive (Bootstrap + CSS custom, @mediaqueries)
- Contrastes adaptés à l’univers sombre
- Labels ARIA, structure sémantique
- Navigation fluide mobile/tablette
- Outils de vérification (HTML Check, Lecteur d'écran NVDA)

**Emails transactionnels**
- Envoi d’emails via Symfony Mailer
- Templates HTML personnalisés
- Notifications : création de compte, reset password, contact support, sécurité admin
- Intégration SendGrid (avec difficultés documentées)

------------------------------------------------------------
<img width="1024" height="1024" alt="devblog_09" src="https://github.com/user-attachments/assets/3ad89e4c-363c-4ef8-ab55-4b80bdbdeea6" />  


**Stack**
**Front-end**
- HTML5 / CSS3 / JavaScript
- Bootstrap 5
- Twig (templating)
- SELECT2 (tags dynamiques)
- TinyMCE (éditeur riche intégré en local)

**Back-end**
- PHP 8+
- Symfony 7.3.1
- Doctrine ORM
- Services, Events, Repositories, FormTypes
- MySQL
- MCD/MLD/MPD en cours de correction *(le jury n'en demande pas tant pour cette épreuve, mais à noter que ceux présents dans le projet sont incorrects)*
- Dictionnaire des données (impératif)

**Outils et workflow**
- Git / GitHub
- Symfony CLI
- MySQL Workbench / DBeaver
- Figma (maquettes & identité visuelle)
- Photoshop & Illustrator
- Docker, Docker Desktop (déploiement)
- OVH + GitHub Actions
- WinSCP (transfert, interface graphique côté serveur)
- Le projet est également documenté à quasiment chaque étape de sa conception, les difficultés rencontrées sont également détaillées ainsi que leur résolution

------------------------------------------------------------
<img width="1024" height="1024" alt="devblog_05" src="https://github.com/user-attachments/assets/49b4a96d-57e3-4bd3-97d6-febfd6a82f2e" />  


**Sécurité : un pilier central du projet**  

*La sécurité a été un axe majeur du développement de Morning Soul.
L’objectif était de garantir un environnement fiable pour les utilisateurs, protéger les données sensibles et assurer l’intégrité du forum.*

**Authentification et gestion des sessions**
- Authenticator Symfony (système moderne et robuste)
- Symfony Security (firewall, access control)
- Hashage sécurisé des mots de passe (bcrypt)
- Gestion des rôles (ROLE_USER, ROLE_ADMIN, ROLE_SUPERADMIN)
- Une multitude de logs (connexion, tentative, déconnexion, changement de mpd, etc.)
- Système de bannissement (ban_until)

**Protection des formulaires**
- CSRF tokens sur toutes les actions sensibles
- Validation stricte via Assert (email, longueur, formats, contraintes personnalisées)
- Nettoyage du HTML provenant de TinyMCE pour éviter les injections XSS
- Vérification serveur systématique (zero trust)

**Sécurité des données et ORM**
- Doctrine ORM pour éviter les injections SQL
- Relations strictes, contraintes d’intégrité, clés étrangères
- Suppression sécurisée via interface administrateur (soft delete pour certains contenus)
- Gestion des tokens de réinitialisation avec expiration (token_expires_at)

**Sécurité des emails**
- Envoi via Symfony Mailer
- Templates HTML contrôlés
- Protection contre les injections dans les champs de contact
- Gestion des erreurs et logs d’envoi

**Architecture sécurisée et modulaire**
- Séparation stricte des responsabilités (Controller / Service / Repository)
- Routes protégées par firewall (security.yaml)
- Accès conditionnel selon les rôles, configuré à plusieurs niveaux
- Vérification systématique des permissions (édition, suppression, modération)

------------------------------------------------------------
<img width="200" height="200" alt="discord_seo" src="https://github.com/user-attachments/assets/eb75ca39-e549-43ca-814d-ea8ccdac53bb" />  


**Référencement naturel (SEO)**
- Le SEO a été travaillé pour assurer une bonne visibilité du site, optimiser l’indexation et améliorer l’expérience utilisateur.

**Structure HTML sémantique**
- Utilisation de balises structurantes : header, main, article, section, nav, footer
- Hiérarchie logique des titres (h1 → h2 → h3)
- Contenu éditorial optimisé (Actualités, Devblog, Changelog)

**Métadonnées & OpenGraph**
- Balises <meta> optimisées : description, keywords, robots
- Intégration OpenGraph pour un partage propre sur les réseaux sociaux
- Titres dynamiques via Twig ({% block title %})

**Performance et accessibilité**
- Optimisation des images (compression, formats adaptés)
- Lazy loading sur les visuels lourds
- Minification CSS/JS via Symfony Asset
- Contrastes adaptés à un thème sombre (a11y)
- Navigation fluide mobile/tablette
- Slugs uniques pour les différentes catégories (Topics, Devblogs, Changelogs, etc.)

**Sitemap & robots**
- Préparation d’un sitemap XML
- Configuration robots.txt pour guider les crawlers

------------------------------------------------------------
**Tips pour l'épreuve et retour du jury :** 
- Pour le **Dossier de Projet**, ne pas hésiter à faire plus de 50 pages.
- Pour le **Dossier Professionnel**, l'épreuve étant, l'année de mon passage, séparée en deux grands axes (activité-type) pouvant être résumés par : Front-end sécurisé et Back-end sécurisé; vous devez expliquer comment vous sécurisez votre appli sur ces deux plans, n'évoquez pas que la sécurité côté back. **// Vous devez répondre point par point à l'axe d'évaluation, si vous n'avez qu'un seul projet, n'hésitez pas à le diviser en plusieurs points //**.
- Vous devez utiliser un **framework**.
- Si vous n'utilisez pas de **NoSQL** et que vous vous contentez du **SQL**, vous allez peut être devoir le justifier (plus d'expérience dessus, vous estimez que c'est tout aussi scalable, sécurité, etc.)
- Pour le **MCD, MLD, MPD**, renseignez vous correctement sur leur fonction initiale, une légère erreur et vous vous retrouver avec quelque chose qui n'a rien à voir.
- Faites des **Wireframes** c'est impératif, utilisez **Figma** ou **Photoshop** par exemple.
- Faites un **Cahier des Charges**, même si celui-ci est fictif (attention si vous décidez de faire une **Identité Visuelle** à ne pas empiéter sur le domaine du **Design System**, la nuance est dans le nombre d'éléments que vous précisez).
- N'oubliez pas de faire un **Dictionnaire des Données**.
- Faites également une **Présentation** type **PowerPoint** pour le jour de l'épreuve, entrainez vous à passer via ce support.  

Si vous souhaitez un accès aux pdf des livrables présentés au jury, contactez moi : vincentpeltier.pro@outlook.fr

------------------------------------------------------------
<img width="200" height="198" alt="logo_ms_01" src="https://github.com/user-attachments/assets/3d2dc9a0-f19c-4a4d-8b90-7508d151d92a" />

|
**Vincent Peltier**  
|
**Développeur Web & Web Mobile, Technicien Informatique & Réseaux.**  
|
*Merci au Studio Vesperveil pour leur confiance ainsi que cette opportunité de travailler avec eux.*

------------------------------------------------------------
**Quelques screenshots du site :**

<img width="1901" height="857" alt="MS_HOMEPAGE" src="https://github.com/user-attachments/assets/382d67f2-fafb-41e3-8b1a-7184f12acc24" />

------------------------------------------------------------

<img width="1900" height="855" alt="MS_DEVBLOG" src="https://github.com/user-attachments/assets/c9411573-1fb1-463c-b152-ee138c168cc5" />

------------------------------------------------------------

<img width="1902" height="859" alt="MS_FORUM" src="https://github.com/user-attachments/assets/8ecd862e-95d4-48ec-b6da-024fdc6b8792" />

------------------------------------------------------------

<img width="1903" height="857" alt="MS_SUPPORT" src="https://github.com/user-attachments/assets/b53f63b6-42c6-49cd-942f-4c0300dcb651" />

------------------------------------------------------------

<img width="484" height="814" alt="MS_HOMEPAGE_RESPONSIVE" src="https://github.com/user-attachments/assets/110b6e5a-819f-4898-a80e-2e9fb48a28b2" />

------------------------------------------------------------

<img width="481" height="819" alt="MS_DEVBLOG_RESPONSIVE" src="https://github.com/user-attachments/assets/e517ba65-6e2a-4680-bc28-f8d6b516ad2a" />

------------------------------------------------------------

<img width="484" height="821" alt="MS_FORUM_RESPONSIVE" src="https://github.com/user-attachments/assets/1ba2be3d-4245-404c-8218-51a8ed4eb0a7" />

------------------------------------------------------------

<img width="485" height="818" alt="MS_SUPPORT_RESPONSIVE" src="https://github.com/user-attachments/assets/60491446-9b39-4239-89d1-fc634c4ede9f" />

------------------------------------------------------------








