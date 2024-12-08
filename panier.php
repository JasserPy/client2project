<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'boutique';

$connect = mysqli_connect($host, $username, $password, $database);

if (!$connect) {
    die('Erreur de connexion : ' . mysqli_connect_error());
}

$user_id = 1;

// Gestion des actions
if (isset($_GET['remove_id']) && is_numeric($_GET['remove_id'])) {
    $product_id = (int)$_GET['remove_id'];
    $query = "DELETE FROM panier WHERE id_utilisateur = $user_id AND id_produit = $product_id";
    mysqli_query($connect, $query);
}

if (isset($_POST['update_quantity']) && isset($_POST['quantity']) && is_array($_POST['quantity'])) {
    foreach ($_POST['quantity'] as $product_id => $new_quantity) {
        $product_id = (int)$product_id;
        $new_quantity = (int)$new_quantity;

        if ($new_quantity <= 0) {
            $query = "DELETE FROM panier WHERE id_utilisateur = $user_id AND id_produit = $product_id";
        } else {
            $query = "UPDATE panier SET quantite = $new_quantity WHERE id_utilisateur = $user_id AND id_produit = $product_id";
        }
        mysqli_query($connect, $query);
    }
}

// Récupération des produits du panier
$query = "
    SELECT 
        p.id AS product_id, 
        p.nom AS name, 
        p.prix AS price, 
        p.image AS image, 
        pa.quantite AS quantity 
    FROM panier pa 
    JOIN produits p ON pa.id_produit = p.id 
    WHERE pa.id_utilisateur = $user_id";

$result = mysqli_query($connect, $query);

$panier =array();
$total = 0;

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $panier[] = $row;
        $total += $row['price'] * $row['quantity'];
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre Panier</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
    body {
        font-family: 'Poppins', sans-serif;
        /* Police moderne pour le corps de la page */
        background-color: #FBE8EB;
        margin: 0;
        padding: 0;
    }

    /* En-tête */
    header {
        background-color: #F5E0D4;
        /* Beige clair */
        color: #333;
        padding: 20px;
        text-align: center;
        font-family: 'Dancing Script', cursive;
        /* Police élégante pour le titre */
    }

    /* Titre principal */
    h1 {
        margin: 0;
        font-size: 2.5em;
        color: #5A4F44;
        /* Beige foncé pour le titre */
    }

    nav a {
        margin: 0 15px;
        text-decoration: none;
        color: #5A4F44;
        font-weight: bold;
    }

    nav a:hover {
        color: #E06277;
    }

    .panier {
        margin: 20px;
        padding: 20px;
        background-color: #F5E0D4;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .product-list {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        margin-bottom: 80px;
        /* Add space for total at the bottom */
    }

    .product {
        background-color: #F5E0D4;
        padding: 20px;
        width: 30%;
        margin: 10px 0;
        border-radius: 8px;
        text-align: center;
        box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
    }

    .product img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
    }

    .product h2 {
        font-size: 1.3em;
        color: #5A4F44;
    }

    .product p {
        color: #888;
    }

    .total {
        background-color: #F5E0D4;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
        width: 100%;
        margin-top: 20px;
        text-align: center;
    }

    .total p {
        font-size: 1.5em;
        color: #5A4F44;
    }

    .total a {
        display: inline-block;
        background-color: #E06277;
        padding: 10px 20px;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        margin-top: 15px;
    }

    .total a:hover {
        background-color: #D04E64;
    }

    .total button {
        padding: 10px 20px;
        margin-top: 15px;
        background-color: #5A4F44;
        color: white;
        border: none;
        border-radius: 5px;
    }

    .total button:hover {
        background-color: #E06277;
    }

    .remove-button {
        display: inline-block;
        margin-top: 10px;
        color: #E06277;
        text-decoration: none;
    }

    .remove-button:hover {
        text-decoration: underline;
    }
    </style>
</head>

<body>
    <header>
        <h1>Panier</h1>
        <nav>
            <a href="home.php">Accueil</a>
            <a href="contact.php">Contactez-nous</a>
            <a href="panier.php">Mon panier</a>
        </nav>
    </header>
    <div class="panier">
        <form method="POST">
            <div class="product-list">
                <?php
            if (!empty($panier)) {
                foreach ($panier as $product) {
                    echo '<div class="product">';
                    echo '<img src="images/' . htmlspecialchars($product['image'], ENT_QUOTES, 'UTF-8') . '" alt="' . htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8') . '">';
                    echo '<h2>' . htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8') . '</h2>';
                    echo '<p>Prix : ' . number_format($product['price'], 2, ',', ' ') . '€</p>';
                    echo '<p>Quantité : <input type="number" name="quantity[' . $product['product_id'] . ']" value="' . $product['quantity'] . '" min="1"></p>';
                    echo '<a href="panier.php?remove_id=' . $product['product_id'] . '" class="remove-button">Supprimer</a>';
                    echo '</div>';
                }
                
                echo "<div class='total'>
                        <p>Total : " . number_format($total, 2, ',', ' ') . "€</p>
                        <a href='confirmation.html'>Confirmer la commande</a>
                        <button type='submit' name='update_quantity'>Mettre à jour</button>
                      </div>";
            } else {
                echo '<p>Votre panier est vide.</p>';
            }
            ?>
            </div>
        </form>
    </div>
</body>

</html>