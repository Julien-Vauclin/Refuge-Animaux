<?php include "components/head.php" ?>
<?php include "components/navbar.php" ?>

<?php
// Variables pour stocker les erreurs et les messages de succès
$errors = [];
$successMessage = "";

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Fonction pour nettoyer et valider les entrées utilisateur
    function cleanInput($input) {
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);
        return $input;
    }

    // Nettoyer et valider les entrées utilisateur
    $name = cleanInput($_POST['name']);
    $email = cleanInput($_POST['email']);
    $message = cleanInput($_POST['message']);

    // Valider le nom (lettres et espaces uniquement)
    if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
        $errors['name'] = "Le nom ne peut contenir que des lettres et des espaces";
    }

    // Valider l'adresse e-mail
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Adresse e-mail invalide";
    }

    // Valider le message (peut contenir des lettres, des espaces, des chiffres et des caractères spéciaux)
    if (!preg_match("/^[a-zA-Z0-9\s.,!?]+$/", $message)) {
        $errors['message'] = "Le message contient des caractères non autorisés";
    }

    // Vérifier s'il n'y a pas d'erreurs
    if (empty($errors)) {
        // Envoyer le message ou effectuer d'autres actions (par exemple, enregistrer dans une base de données)
        // ...

        // Afficher un message de succès
        $successMessage = "Votre message a été envoyé avec succès !";
    }
}
?>

    <div class="container mt-5">
        <h1>Contactez-nous</h1>

        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <?php if (!empty($successMessage)): ?>
            <div class="alert alert-success"><?php echo $successMessage; ?></div>
        <?php endif; ?>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <div class="mb-3">
                <label for="name" class="form-label">Nom</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo isset($name) ? $name : ''; ?>">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Adresse e-mail</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo isset($email) ? $email : ''; ?>">
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Message</label>
                <textarea class="form-control" id="message" name="message"><?php echo isset($message) ? $message : ''; ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
    </div>



<?php include "components/footer.php" ?>