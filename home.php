<?php
$host = 'localhost';
$username = 'root';
$password = '';  // Ajoutez votre mot de passe si nécessaire
$database = 'boutique';

// Connexion à la base de données
$connect = mysqli_connect($host, $username, $password, $database);

if (!$connect) {
    die('Erreur de connexion : ' . mysqli_connect_error());
}

$query = "SELECT * FROM produits";
$req = mysqli_query($connect, $query);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produits de Maquillage</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&family=Dancing+Script:wght@400&display=swap" rel="stylesheet">
        <style>
    /* Mise en page générale */
    body {
            font-family: 'Poppins', sans-serif;
            background-color: #FBE8EB;
            margin: 0;
            padding: 0;
        }

        header {
        background-color: #F5E0D4; /* Beige clair */
        color: #333;
        padding: 20px;
        text-align: center;
        font-family: 'Dancing Script', cursive; /* Police élégante pour le titre */
    }

    /* Liste des produits */
    .product-list {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        margin: 20px;
    }

    /* Style des produits */
    .product {
        background-color: #F5E0D4; /* Beige clair */
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin: 10px;
        padding: 20px;
        width: 250px;
        text-align: center;
        border-radius: 8px;
        transition: transform 0.3s;
    }

    /* Image des produits */
    .product img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
    }

    /* Nom du produit */
    .product h2 {
        font-size: 1.3em;
        color: #5A4F44; /* Beige foncé */
        margin: 10px 0;
        font-weight: 600; /* Mettre en valeur le nom du produit */
        font-family: 'Dancing Script', cursive; /* Police cursive pour un effet élégant */
    }

    /* Description du produit */
    .product p {
        color: #888; /* Gris clair pour la description */
        font-size: 1em;
    }

    /* Bouton d'ajout au panier */
    .add-to-cart {
        display: inline-block;
        padding: 10px 20px;
        background-color: #FFB6C1; /* Rose clair */
        color: white;
        text-decoration: none;
        border-radius: 5px;
        margin-top: 10px;
        font-weight: 500; /* Poids de texte moyen */
    }

    /* Hover sur le bouton */
    .add-to-cart:hover {
        background-color: #FF7F9F; /* Rose plus intense au survol */
    }

    /* Effet de survol sur le produit */
    .product:hover {
        transform: scale(1.05);
    }
</style>

    </style>
</head>
<body>
<header>
    <h1>Bienvenue sur notre boutique de maquillage</h1>
    <nav>
        <a href="home.php">Accueil</a>
        <a href="contact.php">Contactez-nous</a>
        <a href="panier.php">Mon panier</a>
    </nav>
</header>
<section class="product-list">
    <?php
    if (mysqli_num_rows($req) > 0) {
        while ($row = mysqli_fetch_array($req)) {
            echo '<div class="product">';
            echo '<img src="images/' . htmlspecialchars($row['image'], ENT_QUOTES, 'UTF-8') . '" alt="' . htmlspecialchars($row['nom'], ENT_QUOTES, 'UTF-8') . '">';
            echo '<h2>' . htmlspecialchars($row['nom'], ENT_QUOTES, 'UTF-8') . '</h2>';
            echo '<p>Prix : ' . htmlspecialchars($row['prix'], ENT_QUOTES, 'UTF-8') . '€</p>';
            echo '<p>' . htmlspecialchars($row['description']) . '</p>';
            echo "<a href='ajouter_au_panier.php?id=$row[id]' class='add-to-cart'>Ajouter au panier</a>";
            echo '</div>';
        }
    } else {
        echo '<p>Aucun produit trouvé dans la base de données.</p>';
    }
    mysqli_close($connect);
    ?>
</section>
</body>
</html>
