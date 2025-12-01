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

    // 5. Affichage pour vérifier
    echo "<h1>Produit récupéré :</h1>";
    var_dump($product);
} else {
    echo "Aucun produit trouvé avec l'ID 7.";
}
