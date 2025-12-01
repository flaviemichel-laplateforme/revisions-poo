<?php

require_once __DIR__ . '/src/Category.php';
require_once __DIR__ . '/src/Product.php';

$host = 'localhost';
$dbName = 'draft-shop';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbName;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion: " . $e->getMessage());
}

$sql = "SELECT * FROM product WHERE id = 7";
$stmt = $pdo->prepare($sql);
$stmt->execute();

// On récupère le résultat sous forme de tableau associatif
$productData = $stmt->fetch(PDO::FETCH_ASSOC);

if ($productData) {
    // 4. Création et Hydratation de l'instance Product [cite: 53]

    // Note : Les dates arrivent en string depuis la BDD, il faut les convertir en DateTime
    $createdAt = new DateTime($productData['created_at']);
    $updatedAt = new DateTime($productData['updated_at']);

    // Les photos arrivent en JSON (string), il faut les décoder en tableau
    $photos = json_decode($productData['photos'], true);

    // On utilise notre constructeur flexible
    $product = new Product(
        $productData['id'],
        $productData['name'],
        $photos,
        $productData['price'],
        $productData['description'],
        $productData['quantity'],
        $createdAt,
        $updatedAt,
        $productData['category_id']
    );

    // 5. TEST Affichage pour 
    //!! A SUPPRIMER APRES
    //     echo "<h1>Produit récupéré :</h1>";
    //     var_dump($product);
    // } else {
    //     echo "Aucun produit trouvé avec l'ID 7.";
    // }
    // // ... votre code existant ...

    // echo "<h1>Catégorie associée :</h1>";

    // // On appelle la nouvelle méthode
    // $category = $product->getCategory();

    // if ($category) {
    //     echo "Nom : " . $category->getName() . "<br>";
    //     echo "Description : " . $category->getDescription();

    //     // Petit dump pour vérifier l'objet complet
    //     echo "<pre>";
    //     var_dump($category);
    //     echo "</pre>";
    // } else {
    //     echo "Aucune catégorie liée à ce produit.";
    // }

    // ... Code précédent ...

    //     echo "<hr>"; // Une ligne de séparation
    //     echo "<h1>Test Job 06 : Produits de la catégorie 1</h1>";

    //     // 1. On récupère manuellement la catégorie 1 pour tester (simulé)
    //     // Dans un vrai cas, on ferait une requête pour hydrater la catégorie, 
    //     // mais ici on peut instancier une catégorie fictive juste avec l'ID 1 pour tester la méthode.
    //     $categoryTest = new Category(1, "Vêtements", "Description test");

    //     // 2. On appelle la méthode getProducts()
    //     $productsList = $categoryTest->getProducts();

    //     // 3. Affichage des résultats
    //     if (!empty($productsList)) {
    //         foreach ($productsList as $prod) {
    //             echo "Produit trouvé : " . $prod->getName() . " (" . $prod->getPrice() . " €)<br>";
    //         }
    //     } else {
    //         echo "Aucun produit trouvé dans cette catégorie.";
    //     }
    // }

    $product = new Product();

    // 2. On lui demande de aller chercher les infos du produit ID 7
    // La méthode va remplir l'objet $product directement
    $found = $product->findOneById(7);

    if ($found) {
        echo "<h1>Produit chargé avec succès (Job 07)</h1>";
        echo "Nom : " . $product->getName() . "<br>";
        echo "Prix : " . $product->getPrice() . " €<br>";

        // Test du Job 05 (Category) si vous l'avez toujours
        if ($product->getCategory()) {
            echo "Catégorie : " . $product->getCategory()->getName();
        }

        echo "<pre>";
        var_dump($product);
        echo "</pre>";
    } else {
        echo "Erreur : Aucun produit trouvé avec cet ID.";
    }
}
