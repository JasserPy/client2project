<?php
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'boutique';

    $connect = mysqli_connect($host, $username, $password, $database);

    if (!$connect) {
        die('Erreur de connexion : ' . mysqli_connect_error());
    }

    $query = "INSERT INTO panier (id_utilisateur, id_produit, quantite, date_ajout) VALUES (1, $id, 1, NOW())";

    if (mysqli_query($connect, $query)) {
        header('Location: panier.php');
        exit();
    } else {
        echo "Erreur lors de l'ajout au panier : " . mysqli_error($connect);
    }
    mysqli_close($connect);
} else {
    echo "Une erreur s'est produite. Veuillez recharger la page.";
}
?>
