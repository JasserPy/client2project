<?php
if (isset($_POST['envoyer_message'])) {
    echo "<script>alert('Merci de nous avoir contactés ! Nous reviendrons vers vous sous peu.');</script>";
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contactez-nous</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&family=Dancing+Script:wght@400&display=swap" rel="stylesheet">
    <style>
        body {
        font-family: 'Poppins', sans-serif; /* Police moderne pour le corps de la page */
        background-color: #FBE8EB;
        margin: 0;
        padding: 0;
    }

    /* En-tête */
    header {
        background-color: #F5E0D4; /* Beige clair */
        color: #333;
        padding: 20px;
        text-align: center;
        font-family: 'Dancing Script', cursive; /* Police élégante pour le titre */
    }

    /* Titre principal */
    h1 {
        margin: 0;
        font-size: 2.5em;
        color: #5A4F44; /* Beige foncé pour le titre */
    }
        form {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #F5E0D4;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        button{
            background-color: #5A4F44;
            color: #fff;
            position: relative;
            border-radius: 5px;
        }
        button:hover {
            background-color: #FBE8EB;
            color: #5A4F44;
        }
        input[type="text"],
        input[type="email"],
        textarea {
            border-radius: 5px;
            background-color: #FBE8EB;
        }
    </style>
</head>
<body>
<header>
    <h1>Contactez-nous</h1>
</header>
<section class="container">
    <form method="post" class="needs-validation" novalidate>
        <div class="mb-3">
            <label for="nom" class="form-label">Nom :</label>
            <input type="text" class="form-control" id="nom" name="nom" required>
            <div class="invalid-feedback">Veuillez entrer votre nom.</div>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email :</label>
            <input type="email" class="form-control" id="email" name="email" required>
            <div class="invalid-feedback">Veuillez entrer une adresse email valide.</div>
        </div>
        <div class="mb-3">
            <label for="message" class="form-label">Message :</label>
            <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
            <div class="invalid-feedback">Veuillez entrer un message.</div>
        </div>
        <center><button type="submit" name="envoyer_message">Envoyer</button></center>
    </form>
</section>

<!-- Bootstrap JS (pour les fonctionnalités dynamiques comme les feedbacks) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Activer les feedbacks Bootstrap
    (() => {
        'use strict';
        const forms = document.querySelectorAll('.needs-validation');
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    })();
</script>
</body>
</html>
