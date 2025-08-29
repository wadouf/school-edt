# Configuration et Installation - Institut Les Pintades

## Configuration Environnement

### 1. Fichier .env
Après clonage du projet, configurez l'environnement :

```bash
# Copier le fichier d'exemple
cp .env.example .env

# Générer la clé d'application Laravel
php artisan key:generate

# Configuration recommandée pour développement
APP_NAME="Institut Polyvalent Bilingue Les Pintades"
APP_ENV=local
APP_DEBUG=true
APP_URL=https://votre-url-sandbox.e2b.dev

# Localisation française
APP_LOCALE=fr
APP_FALLBACK_LOCALE=fr

# Base de données SQLite (par défaut)
DB_CONNECTION=sqlite
```

### 2. Installation des dépendances

```bash
# Installer les dépendances PHP
composer install

# Installer les extensions PHP requises (sur Ubuntu/Debian)
sudo apt-get install php8.2-cli php8.2-gd php8.2-pgsql php8.2-sqlite3 php8.2-mbstring php8.2-xml php8.2-curl php8.2-zip
```

### 3. Base de données

```bash
# Créer le fichier de base de données SQLite
touch database/database.sqlite

# Exécuter les migrations et seeders
php artisan migrate --seed --force
```

### 4. Démarrage du serveur

```bash
# Avec PM2 (recommandé pour sandbox)
pm2 start ecosystem.config.cjs

# Ou avec Artisan (développement local)
php artisan serve --host=0.0.0.0 --port=3000
```

## Comptes de test

- **Admin** : admin@lespintades.cm / password
- **Secrétaire** : secretaire@lespintades.cm / password
- **Directeur** : directeur@lespintades.cm / password

## Données de test

- ✅ 2 Sections (Francophone, Anglophone)
- ✅ 14 Niveaux (6ème-Terminale, Form1-Upper Sixth)
- ✅ 8 Filières par section
- ✅ 6 Classes de test avec relations complètes
- ✅ 10 Salles (normale, laboratoire, informatique, gymnase)

## Modules implémentés

- ✅ **Authentication** (Laravel Breeze)
- ✅ **Gestion des Classes** (CRUD complet + export)
- ✅ **Gestion des Salles** (CRUD complet + export)
- ✅ **Permissions et Rôles** (Spatie Laravel-Permission)
- ⏳ **Enseignants** (à implémenter)
- ⏳ **Matières** (à implémenter)
- ⏳ **Emplois du Temps** (à implémenter)

## Troubleshooting

### Erreur "No application encryption key"
```bash
php artisan key:generate
php artisan config:clear
```

### Erreur de permissions base de données
```bash
chmod 664 database/database.sqlite
```

### Cache et configuration
```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
```