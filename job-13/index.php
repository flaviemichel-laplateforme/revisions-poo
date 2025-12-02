<?php

require_once __DIR__ . '/src/Category.php';
require_once __DIR__ . '/src/AbstractProduct.php';
require_once __DIR__ . '/src/Clothing.php';
require_once __DIR__ . '/src/Electronic.php';

$host = 'localhost';
$dbName = 'draft-shop';
$user = 'root';
$pass = '';

// try {
//     $pdo = new PDO("mysql:host=$host;dbname=$dbName;charset=utf8", $user, $pass);
//     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// } catch (PDOException $e) {
//     die("Erreur de connexion: " . $e->getMessage());
// }

// $sql = "SELECT * FROM product WHERE id = 7";
// $stmt = $pdo->prepare($sql);
// $stmt->execute();

// // On récupère le résultat sous forme de tableau associatif
// $productData = $stmt->fetch(PDO::FETCH_ASSOC);

// if ($productData) {
//     // 4. Création et Hydratation de l'instance Product [cite: 53]

//     // Note : Les dates arrivent en string depuis la BDD, il faut les convertir en DateTime
//     $createdAt = new DateTime($productData['created_at']);
//     $updatedAt = new DateTime($productData['updated_at']);

//     // Les photos arrivent en JSON (string), il faut les décoder en tableau
//     $photos = json_decode($productData['photos'], true);

//     // On utilise notre constructeur flexible
//     $product = new Product(
//         $productData['id'],
//         $productData['name'],
//         $photos,
//         $productData['price'],
//         $productData['description'],
//         $productData['quantity'],
//         $createdAt,
//         $updatedAt,
//         $productData['category_id']
//     );

// 5. TEST Affichage pour 
//!! TEST A SUPPRIMER APRES
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

// $product = new Product();

// // 2. On lui demande de aller chercher les infos du produit ID 7
// // La méthode va remplir l'objet $product directement
// $found = $product->findOneById(7);

// if ($found) {
//     echo "<h1>Produit chargé avec succès (Job 07)</h1>";
//     echo "Nom : " . $product->getName() . "<br>";
//     echo "Prix : " . $product->getPrice() . " €<br>";

//     // Test du Job 05 (Category) si vous l'avez toujours
//     if ($product->getCategory()) {
//         echo "Catégorie : " . $product->getCategory()->getName();
//     }

//     echo "<pre>";
//     var_dump($product);
//     echo "</pre>";
// } else {
//     echo "Erreur : Aucun produit trouvé avec cet ID.";
// }
// On utilise une instance vide pour appeler la méthode
//     $productManager = new Product();
//     $allProducts = $productManager->findAll();

//     echo "<h1>Liste de tous les produits (Job 08)</h1>";

//     if (!empty($allProducts)) {
//         echo "<ul>";
//         foreach ($allProducts as $product) {
//             echo "<li>";
//             echo "<strong>" . $product->getName() . "</strong> - " . $product->getPrice() . " € ";
//             // Petit bonus : afficher la catégorie si elle existe
//             if ($cat = $product->getCategory()) {
//                 echo "<em>(Catégorie : " . $cat->getName() . ")</em>";
//             }
//             echo "</li>";
//         }
//         echo "</ul>";
//     } else {
//         echo "Aucun produit en base de données.";
//     }
// }

//     // 1. On instancie un nouveau produit (sans ID pour l'instant)
//     $newProduct = new Product(
//         null,                   // id (null car pas encore en BDD)
//         "Super Vélo",           // name
//         ["https://image.com/velo.jpg"], // photos
//         45000,                  // price (450.00 €)
//         "Un vélo tout terrain incroyable", // description
//         5,                      // quantity
//         new DateTime(),         // createdAt
//         new DateTime(),         // updatedAt
//         2                       // category_id (supposons 2 = Électronique ou autre)
//     );

//     // Affichage avant insertion (ID est null)
//     echo "<h3>Avant insertion :</h3>";
//     var_dump($newProduct);

//     // 2. On lance la création en base
//     $createdProduct = $newProduct->create();

//     if ($createdProduct) {
//         echo "<h3>Succès ! Produit inséré.</h3>";
//         echo "Nouvel ID généré : " . $createdProduct->getId() . "<br>";

//         // Vérification finale de l'objet mis à jour
//         echo "<pre>";
//         var_dump($createdProduct);
//         echo "</pre>";
//     } else {
//         echo "Erreur lors de l'insertion.";
//     }
// }

// $product = new Product();
// $found = $product->findOneById(7);

// if ($found) {
//     echo "<h3>Avant modification : </h3>";
//     echo "nom : " . $product->getName() . "<br>";
//     echo "prix : " . $product->getPrice() . " €<br>";
//     echo "Dernière MAJ : " . $product->getUpdatedAt()->format('H:i:s') . "<br>";

//     $product->setName("Produit modifié" . rand(1, 100));
//     $product->setPrice(100);

//     $success = $product->update();

//     if ($success) {
//         echo "<hr><h3>Succès ! Produit mis à jour (job 10).</h3>";
//         echo "Nouveau Nom : " . $product->getName() . "<br>";
//         echo "Nouveau Prix : " . $product->getPrice() . "<br>";
//         echo "Nouvelle Maj : " . $product->getUpdatedAt()->format('H:i:s') . "<br>";
//     } else {
//         echo "Produit ID 7 introuvable.";
//     }
// }
// $tshirt = new Clothing(
//     null,
//     "T-shirt Geek",
//     ["photo.jpg"],
//     2000,
//     "Un super t-shirt",
//     10,
//     null,
//     null,
//     1,
//     "L",
//     "Bleu",
//     "Coton",
//     5 // Infos spécifiques
// );

// // 2. Insertion en BDD (Cela doit remplir 'product' ET 'clothing')
// if ($tshirt->create()) {
//     echo "<h1>Vêtement créé avec ID : " . $tshirt->getId() . "</h1>";
// } else {
//     echo "Erreur création";
// }

// // 3. Récupération (Vérification que size/color reviennent bien)
// $verif = new Clothing();
// if ($verif->findOneById($tshirt->getId())) {
//     echo "Vêtement récupéré : " . $verif->getName() . "<br>";
//     echo "Taille : " . $verif->getSize() . "<br>"; // Doit afficher "L"
//     echo "Couleur : " . $verif->getColor() . "<br>"; // Doit afficher "Bleu"
// }

// TEST JOB 12 Création d'un smartphone
// $phone = new Electronic(
//     null,
//     "iPhone Test",
//     ["img.jpg"],
//     90000,
//     "Smartphone puissant",
//     5,
//     null,
//     null,
//     2,
//     "Apple",
//     50 // Marque et Frais de garantie
// );

// // Insertion
// if ($phone->create()) {
//     echo "<h1>Électronique créé ! ID: " . $phone->getId() . "</h1>";
//     echo "Marque : " . $phone->getBrand();
// } else {
//     echo "Erreur lors de la création.";
// }

try {
    // $p = new AbstractProduct(); // Decommenter cette ligne doit provoquer une erreur fatale
    echo "Impossible d'instancier AbstractProduct directement (C'est normal !)<br>";
} catch (Error $e) {
    echo "Erreur attendue : " . $e->getMessage();
}
// Test 2 : Utiliser Clothing (Doit fonctionner comme avant)
$pull = new Clothing();
// On hydrate avec un ID existant (celui créé au Job 12, ex: 8 ou 9)
// Remplacez l'ID par un ID qui existe dans votre table clothing
$res = $pull->findOneById(9);

if ($res) {
    echo "<h1>Vêtement récupéré via AbstractProduct : " . $pull->getName() . "</h1>";
    echo "Type : " . $pull->getType();
} else {
    echo "Vêtement non trouvé (vérifiez l'ID).";
}
// }
