# Job 15 - Projet POO E-Commerce avec Autoloading PSR-4

## 📋 Description

Ce projet est une application e-commerce en PHP orienté objet utilisant l'autoloading PSR-4 avec Composer. Il implémente une architecture professionnelle avec des classes abstraites, des interfaces et l'héritage.

## 🏗️ Structure du projet

```
job-15/
├── composer.json           # Configuration Composer et autoloading PSR-4
├── database.sql            # Script SQL pour créer la base de données
├── index.php               # Point d'entrée de l'application
├── README.md               # Documentation du projet
├── src/                    # Code source
│   ├── Abstract/
│   │   └── AbstractProduct.php    # Classe abstraite Product
│   ├── Interface/
│   │   └── StockableInterface.php # Interface pour la gestion des stocks
│   ├── Category.php        # Classe Category
│   ├── Clothing.php        # Classe Clothing (hérite d'AbstractProduct)
│   └── Electronic.php      # Classe Electronic (hérite d'AbstractProduct)
└── vendor/                 # Dépendances Composer (autoloader)
```

## 🔧 Prérequis

- PHP 8.0 ou supérieur
- MySQL 8.0 ou supérieur
- Composer
- Laragon (ou autre serveur local)

## 🚀 Installation

### 1. Cloner le projet

```bash
cd C:\laragon\www\revisions-poo\job-15
```

### 2. Installer les dépendances Composer

```bash
composer install
```

Ou si vous n'avez pas encore de vendor :

```bash
composer dump-autoload
```

### 3. Créer la base de données

Importez le fichier `database.sql` dans phpMyAdmin ou via la ligne de commande :

```bash
mysql -u root -p < database.sql
```

La base de données `draft-shop` sera créée avec les tables suivantes :
- `category` - Catégories de produits
- `product` - Produits (table principale)
- `clothing` - Données spécifiques aux vêtements
- `electronic` - Données spécifiques à l'électronique

### 4. Lancer l'application

Accédez à l'URL : `http://localhost/revisions-poo/job-15/`

## 📦 Autoloading PSR-4

Le projet utilise l'autoloading PSR-4 configuré dans `composer.json` :

```json
{
    "autoload": {
        "psr-4": {
            "App\\": "src/"
        }
    }
}
```

### Correspondance Namespace / Dossiers

| Namespace | Dossier |
|-----------|---------|
| `App\` | `src/` |
| `App\Abstract\` | `src/Abstract/` |
| `App\Interface\` | `src/Interface/` |

### Utilisation dans le code

```php
<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Clothing;
use App\Electronic;
use App\Category;

// Les classes sont chargées automatiquement
$clothing = new Clothing();
$electronic = new Electronic();
```

## 🏛️ Architecture des classes

### Diagramme UML simplifié

```
┌─────────────────────────────┐
│   StockableInterface        │
│─────────────────────────────│
│ + addStocks(int): self      │
│ + removeStocks(int): self   │
└─────────────────────────────┘
              ▲
              │ implements
              │
┌─────────────────────────────┐
│   AbstractProduct           │
│─────────────────────────────│
│ # id: ?int                  │
│ # name: string              │
│ # photos: array             │
│ # price: int                │
│ # description: string       │
│ # quantity: int             │
│ # createdAt: DateTime       │
│ # updatedAt: DateTime       │
│ # category_id: ?int         │
│─────────────────────────────│
│ + getters/setters           │
│ + create(): bool            │
│ + update(): bool            │
│ + findOneById(int): ?self   │
│ + findAll(): array          │
└─────────────────────────────┘
          ▲           ▲
          │           │
          │ extends   │ extends
          │           │
┌─────────────┐  ┌─────────────┐
│  Clothing   │  │ Electronic  │
│─────────────│  │─────────────│
│ - size      │  │ - brand     │
│ - color     │  │ - waranty_fee│
│ - type      │  │─────────────│
│ - material_fee│ │ + create()  │
│─────────────│  │ + update()  │
│ + create()  │  └─────────────┘
│ + update()  │
└─────────────┘
```

### Classes

| Classe | Type | Description |
|--------|------|-------------|
| `AbstractProduct` | Abstraite | Classe de base pour tous les produits |
| `Clothing` | Concrète | Vêtements (taille, couleur, matière) |
| `Electronic` | Concrète | Électronique (marque, garantie) |
| `Category` | Concrète | Catégories de produits |
| `StockableInterface` | Interface | Gestion des stocks |

## 📝 Exemples d'utilisation

### Créer un vêtement

```php
$tshirt = new Clothing(
    null,                           // id
    "T-Shirt Premium",              // name
    ["tshirt.jpg"],                 // photos
    2500,                           // price (25.00 €)
    "T-shirt 100% coton bio",       // description
    50,                             // quantity
    null,                           // createdAt
    null,                           // updatedAt
    1,                              // category_id
    "L",                            // size
    "Bleu",                         // color
    "Coton",                        // type
    5                               // material_fee
);

$tshirt->create();
```

### Créer un produit électronique

```php
$phone = new Electronic(
    null,
    "iPhone 15",
    ["iphone.jpg"],
    99900,                          // 999.00 €
    "Dernier iPhone",
    10,
    null,
    null,
    2,                              // category_id (Électronique)
    "Apple",                        // brand
    50                              // waranty_fee
);

$phone->create();
```

### Gérer les stocks

```php
// Ajouter du stock
$tshirt->addStocks(10);

// Retirer du stock
$tshirt->removeStocks(5);
```

## 🗄️ Base de données

### Tables

#### `product`
| Colonne | Type | Description |
|---------|------|-------------|
| id | INT | Clé primaire |
| name | VARCHAR(255) | Nom du produit |
| photos | JSON | Photos du produit |
| price | INT | Prix en centimes |
| description | TEXT | Description |
| quantity | INT | Quantité en stock |
| created_at | DATETIME | Date de création |
| updated_at | DATETIME | Date de modification |
| category_id | INT | FK vers category |

#### `clothing`
| Colonne | Type | Description |
|---------|------|-------------|
| product_id | INT | FK vers product |
| size | VARCHAR(255) | Taille (S, M, L, XL) |
| color | VARCHAR(255) | Couleur |
| type | VARCHAR(255) | Type de tissu |
| material_fee | INT | Frais matière |

#### `electronic`
| Colonne | Type | Description |
|---------|------|-------------|
| product_id | INT | FK vers product |
| brand | VARCHAR(255) | Marque |
| waranty_fee | INT | Frais de garantie |

## ⚙️ Configuration

Le fuseau horaire est configuré sur `Europe/Paris` dans `AbstractProduct.php` :

```php
date_default_timezone_set('Europe/Paris');
```

## 📚 Concepts POO utilisés

- ✅ **Encapsulation** : Propriétés privées/protégées avec getters/setters
- ✅ **Héritage** : Clothing et Electronic héritent d'AbstractProduct
- ✅ **Abstraction** : Classe abstraite AbstractProduct
- ✅ **Polymorphisme** : Méthodes create() et update() redéfinies
- ✅ **Interface** : StockableInterface pour la gestion des stocks
- ✅ **Namespaces** : Organisation du code avec PSR-4
- ✅ **Autoloading** : Chargement automatique des classes avec Composer

## 👤 Auteur

Flavie Michel - La Plateforme

## 📄 Licence

Projet éducatif - Révisions POO
