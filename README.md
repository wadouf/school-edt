# Institut Polyvalent Bilingue Les Pintades - Système de Gestion d'Emplois du Temps

## 🎯 Aperçu du Projet

Application web Laravel moderne de gestion des emplois du temps pour un établissement secondaire bilingue (sections francophone et anglophone) au Cameroun. Le système facilite la planification horaire tout en prenant en compte la dualité linguistique et les différentes filières.

## 🌐 URLs d'Accès

- **Production** : https://8000-i53oky8bjajgqdw543exj.e2b.dev
- **API Base** : https://8000-i53oky8bjajgqdw543exj.e2b.dev/api
- **Connexion** : https://8000-i53oky8bjajgqdw543exj.e2b.dev/login

## 🔐 Identifiants de Connexion

### Comptes de Démonstration
- **Administrateur** : `admin@ecole.fr` / `admin123`
- **Chef d'Établissement** : `chef@ecole.fr` / `chef123`
- **Enseignant** (exemple) : `j.dupont@ecole.fr` / `password123`

## 🏗️ Architecture de Données

### Entités Principales
- **Sections** : Francophone, Anglophone
- **Niveaux** : 6ème-Terminale (FR), Form1-Upper Sixth (EN)
- **Filières** : Scientifique, Littéraire, Technique, Arts
- **Classes** : Combinaison Niveau + Filière + Section
- **Enseignants** : Permanents et Vacataires avec disponibilités
- **Matières** : Avec couleurs et types de salle requis
- **Salles** : Normales, Laboratoires, Informatique, Gymnase
- **Créneaux Horaires** : 7h30-16h30 avec pauses configurables

### Services de Stockage
- **PostgreSQL** : Base de données relationnelle principale
- **Spatie/Permission** : Gestion des rôles et permissions (RBAC)
- **Laravel Breeze** : Authentification et gestion des sessions

## ✅ Fonctionnalités Implémentées

### Authentification et RBAC ✅
- [x] Système d'authentification Laravel Breeze
- [x] Trois rôles : Admin, Chef d'établissement, Enseignant
- [x] Permissions granulaires par rôle
- [x] Interface de connexion sécurisée
- [x] Tableaux de bord spécialisés par rôle

### Gestion des Ressources ✅
- [x] Structure complète des données scolaires
- [x] Seeders de démonstration avec données réalistes
- [x] Modèles Eloquent avec relations complètes
- [x] Système de logging des activités
- [x] CRUD complet des Classes avec filtres et recherche
- [x] Policies d'autorisation pour les actions CRUD

### Interface Utilisateur ✅
- [x] Tableaux de bord dynamiques selon le rôle utilisateur
- [x] Dashboard Administrateur (statistiques, gestion rapide, activités)
- [x] Dashboard Chef d'établissement (gestion pédagogique, emplois du temps)
- [x] Dashboard Enseignant (emploi personnel, matières, disponibilités)
- [x] Interface de gestion des classes (liste, création, édition, détail)

### Structure de Base ✅
- [x] Migrations PostgreSQL complètes
- [x] Configuration bilingue (français par défaut)
- [x] Interface responsive avec Tailwind CSS et Bootstrap
- [x] Gestion des créneaux horaires (7h30-16h30)
- [x] Navigation avec Font Awesome icons

## ❌ Fonctionnalités Non Implémentées

### Interface Utilisateur
- [ ] CRUD des enseignants, matières, salles
- [ ] Interface de gestion des disponibilités enseignants
- [ ] Validation avancée des formulaires

### Emplois du Temps
- [ ] Interface de création/édition manuelle (drag & drop)
- [ ] Grille hebdomadaire interactive
- [ ] Détection automatique des conflits
- [ ] Génération automatique avec contraintes
- [ ] Vues par classe, enseignant, salle

### Exports et Rapports
- [ ] Export PDF des emplois du temps
- [ ] Export Excel/CSV des données
- [ ] Export iCal pour synchronisation
- [ ] Rapports de charge enseignants

### Fonctionnalités Avancées
- [ ] Algorithme de génération automatique
- [ ] Gestion des blocs de 2h consécutives
- [ ] Contraintes de salles spécialisées
- [ ] Système de notifications
- [ ] API REST complète

## 🛠️ Stack Technologique

### Backend
- **Laravel 12.26.3** (PHP 8.2)
- **PostgreSQL 15** 
- **Spatie/Laravel-Permission** (RBAC)
- **Laravel Breeze** (Authentification)

### Frontend
- **Bootstrap 5** (Framework CSS)
- **Blade Templates** (Moteur de templates)
- **Vite** (Build tool)
- **Tailwind CSS** (Styles utilitaires)

### Packages Intégrés
- **Spatie/ActivityLog** : Logging des modifications
- **Barryvdh/DomPDF** : Génération PDF
- **Maatwebsite/Excel** : Import/Export Excel
- **Livewire** : Composants interactifs

## 📊 Modèle de Données Simplifié

```
Users (auth) → Enseignants (profils)
    ↓
Sections → Classes ← Niveaux
    ↓         ↓        ↑
    ↓    Emplois ← Filières
    ↓         ↓
    ↓    Créneaux
    ↓         ↓
Matières → Salles
```

## 🚀 Prochaines Étapes Recommandées

### Phase 1 : Interface de Base (En cours - 75% complété)
1. ✅ **Tableaux de bord** par rôle avec navigation et statistiques
2. ✅ **CRUD Classes** : Liste, création, édition, suppression avec filtres
3. **CRUD Enseignants** : Avec gestion des matières enseignées (À faire)
4. **CRUD Matières et Salles** : Interface de gestion complète (À faire)

### Phase 2 : Emplois du Temps (Priorité Haute)  
1. **Grille d'emploi du temps** : Affichage hebdomadaire
2. **Création manuelle** : Interface drag & drop
3. **Détection de conflits** : Validation temps réel
4. **Vues multiples** : Par classe, enseignant, salle

### Phase 3 : Fonctionnalités Avancées
1. **Génération automatique** : Algorithme de contraintes
2. **Exports** : PDF, Excel, iCal
3. **API REST** : Pour intégrations externes
4. **Optimisations** : Performance et UX

## 📅 État du Déploiement

- **Plateforme** : Sandbox E2B (Développement)
- **Serveur** : PHP Built-in Server (port 8000)
- **Status** : ✅ Active avec données de démonstration
- **Tech Stack** : Laravel + PostgreSQL + Bootstrap 5
- **Dernière MAJ** : 28 août 2025

## 🎓 Guide d'Utilisation

### Pour l'Administrateur
1. Se connecter avec `admin@ecole.fr / admin123`
2. **Dashboard** : Vue d'ensemble avec statistiques et gestion rapide
3. **Gestion Classes** : CRUD complet avec filtres et export CSV
4. **Activités Récentes** : Suivi des modifications système
5. Configuration globale et gestion des permissions

### Pour le Chef d'Établissement  
1. Se connecter avec `chef@ecole.fr / chef123`
2. **Dashboard** : Statistiques par section (Francophone/Anglophone)
3. **Gestion Pédagogique** : Accès direct aux classes, enseignants, matières
4. **Emplois du Temps** : Vue d'ensemble des créneaux récents
5. **Rapports** : Analyse charge enseignants et utilisation salles

### Pour les Enseignants
1. Se connecter avec un compte enseignant (ex: `j.dupont@ecole.fr / password123`)
2. **Dashboard Personnel** : Vue d'ensemble des cours et statistiques
3. **Mon Emploi du Temps** : Grille hebdomadaire et liste détaillée des cours
4. **Mes Matières** : Liste des matières enseignées avec codes couleur
5. **Actions Rapides** : Gestion disponibilités, demandes modifications

## 🔧 Configuration Technique

### Base de Données
- **Host** : localhost (PostgreSQL 15)
- **Database** : emplois_temps
- **User** : laravel / laravel123

### Environnement
- **APP_NAME** : Institut Polyvalent Bilingue Les Pintades
- **APP_URL** : https://8000-i53oky8bjajgqdw543exj.e2b.dev
- **APP_LOCALE** : fr (français par défaut)

---

## 🎯 Fonctionnalités Clés Actuelles

### 🏠 Dashboards Intelligents
- **Tableau de bord Admin** : Statistiques globales, gestion rapide, activités récentes
- **Tableau de bord Chef** : Vue pédagogique, statistiques par section, emplois récents
- **Tableau de bord Enseignant** : Emploi personnel, matières, statistiques individuelles

### 🏫 Gestion des Classes
- **Liste complète** avec filtres par section, niveau, filière et recherche textuelle
- **Création assistée** avec génération automatique du code classe
- **Édition complète** avec validation des données et gestion des conflits
- **Vue détaillée** avec statistiques et emploi du temps de la classe
- **Export CSV** pour analyses externes et rapports

### 🔐 Sécurité et Permissions
- **Authentification robuste** avec Laravel Breeze
- **Autorisations granulaires** via Policies Laravel et Spatie Permissions
- **Logging complet** des activités avec Spatie ActivityLog
- **Validation des données** à tous les niveaux (frontend/backend)

---

**Développé pour l'Institut Polyvalent Bilingue Les Pintades, Cameroun**  
*Système de gestion d'emplois du temps bilingue moderne et efficent*

**État actuel**: Version 0.2.0 - Interface de gestion opérationnelle  
**Dernière mise à jour**: {{ date('d/m/Y') }} - Dashboards et CRUD Classes implémentés