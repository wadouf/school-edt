# Base de Données - Institut Polyvalent Bilingue Les Pintades

## 📊 Structure de la Base de Données

### Tables Principales

1. **users** - Utilisateurs du système (Admin, Chef, Enseignants)
2. **roles** & **permissions** - Système RBAC avec Spatie
3. **sections** - Francophone / Anglophone
4. **niveaux** - 6ème, 5ème, 4ème, 3ème, 2nde, 1ère, Tle, etc.
5. **filieres** - Scientifique, Littéraire, Technique Commercial
6. **classes** - Classes de l'établissement avec relations
7. **emplois_du_temps** - Emplois du temps (à développer)

## 🌱 Seeders Disponibles

### Ordre d'Exécution (Important)
```bash
php artisan db:seed --class=RolePermissionSeeder    # 1. Rôles et permissions
php artisan db:seed --class=SchoolDataSeeder        # 2. Données scolaires de base
php artisan db:seed --class=UserSeeder              # 3. Utilisateurs avec rôles
php artisan db:seed --class=ClassesTestDataSeeder   # 4. Classes de test
```

### Ou tout en une fois
```bash
php artisan db:seed
```

## 👥 Comptes de Test Créés

### Administrateur
- **Email :** admin@ecole.fr
- **Mot de passe :** admin123
- **Permissions :** Toutes (37 permissions)

### Chef d'Établissement
- **Email :** chef@ecole.fr
- **Mot de passe :** chef123
- **Permissions :** Gestion pédagogique (sans gestion utilisateurs)

### Enseignants
- **Emails :** marie.dubois@ecole.fr, jean.martin@ecole.fr, sophie.bernard@ecole.fr
- **Mot de passe :** password123
- **Permissions :** Consultation et gestion disponibilités

## 🏫 Données Scolaires

### Sections
- **Francophone** - Section française
- **Anglophone** - Section anglaise (Cambridge system)

### Niveaux (14 niveaux)
- **Francophone :** 6ème, 5ème, 4ème, 3ème, 2nde, 1ère C, 1ère D, Tle C, Tle D
- **Anglophone :** Form 1, Form 2, Form 3, Form 4, Form 5

### Filières (6 filières)
- **Scientifique (SCI)** - Mathématiques, Sciences
- **Littéraire (LIT)** - Langues, Littérature
- **Technique Commercial (TC)** - Commerce, Gestion
- **Sciences Économiques (ECO)** - Économie
- **Arts et Lettres (ART)** - Arts, Créativité
- **Technique Industriel (TI)** - Technique

## 🎓 Classes de Test Créées

| Code | Nom | Section | Niveau | Filière | Capacité | Salle |
|------|-----|---------|--------|---------|----------|-------|
| FR6EGENE | 6ème A Test | Francophone | 6ème | Scientifique | 30 | Salle A1 |
| FR6ESCI2 | 6ème A | Francophone | 6ème | Scientifique | 35 | Salle A1 |
| AN5ELIT3 | 5ème B | Anglophone | 5ème | Littéraire | 32 | Salle B2 |
| FR4ETC4 | Form 1 Sciences | Francophone | 4ème | Tech. Commercial | 28 | Lab Sciences |
| AN3ESCI5 | Form 2 Arts | Anglophone | 3ème | Scientifique | 30 | Salle Arts |
| FR2NDLIT6 | 4ème C | Francophone | 2nde | Littéraire | 33 | Salle C3 |

## 🔄 Réinitialisation de la Base

### Reset Complet
```bash
php artisan migrate:fresh --seed
```

### Reset avec Classes de Test
```bash
php artisan migrate:fresh
php artisan db:seed
```

### Ajout Classes de Test Uniquement
```bash
php artisan db:seed --class=ClassesTestDataSeeder
```

## 🚀 Prochaines Étapes

1. **Module Enseignants** - Ajouter données enseignants détaillées
2. **Module Matières** - Créer table et seeder matières
3. **Module Salles** - Créer table et seeder salles
4. **Module Emplois du Temps** - Relations complètes avec créneaux

## 📝 Notes Techniques

- **Route Model Binding** configuré avec paramètre `{classe}`
- **Colonnes BD :** `capacite_max` (non `effectif_max`), `salle_principale` (non `salle_attitre`)
- **Permissions RBAC** avec noms anglais : `view_classes`, `create_classes`, etc.
- **Codes classes générés automatiquement** : Section + Niveau + Filière + Compteur

## 🔗 Relations BD

```
sections (1) ← (n) classes
niveaux (1) ← (n) classes  
filieres (1) ← (n) classes
classes (1) ← (n) emplois_du_temps [à développer]
```

---
**Dernière mise à jour :** {{ date('Y-m-d H:i') }} - Module Classes 100% opérationnel