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
    echo "<h1>Produit récupéré :</h1>";
    var_dump($product);
} else {
    echo "Aucun produit trouvé avec l'ID 7.";
}
// ... votre code existant ...

echo "<h1>Catégorie associée :</h1>";

// On appelle la nouvelle méthode
$category = $product->getCategory();

if ($category) {
    echo "Nom : " . $category->getName() . "<br>";
    echo "Description : " . $category->getDescription();

    // Petit dump pour vérifier l'objet complet
    echo "<pre>";
    var_dump($category);
    echo "</pre>";
} else {
    echo "Aucune catégorie liée à ce produit.";
}
