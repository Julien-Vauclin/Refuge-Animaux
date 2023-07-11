<?php include "components/head.php" ?>
<?php include "components/navbar.php" ?>

<?php
// Variables pour stocker les valeurs des champs
$nom = $couleur = $race = $espece = $age = $date_naissance = "";

// Variables pour stocker les messages d'erreur
$nom_err = $couleur_err = $race_err = $espece_err = $age_err = $date_naissance_err = "";

// Fonction de validation des champs avec des expressions régulières
function validerChamp($champ, $regex, &$valeur, &$erreur) {
    if (!empty($champ)) {
        if (preg_match($regex, $champ)) {
            $valeur = $champ;
            return true;
        } else {
            $erreur = "Format invalide.";
        }
    } else {
        $erreur = "Ce champ est obligatoire.";
    }
    return false;
}

// Traitement du formulaire lors de la soumission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Valider chaque champ avec les expressions régulières
    $nom_regex = "/^(?!.*(.)\1\1)[a-zA-Z]{3,}$/";
    $couleur_regex = "/^(?!.*(.)\1\1)[a-zA-Z]{3,}$/";
    $race_regex = "/^(?!.*(.)\1\1)[a-zA-Z]{3,}$/";
    $espece_regex = "/^(?!.*(.)\1\1)[a-zA-Z]{3,}$/";
    $age_regex = "/^\d+$/";
    $date_naissance_regex = "/^\d{2}\/\d{2}\/\d{2}$/";
    
    validerChamp($_POST["nom"], $nom_regex, $nom, $nom_err);
    validerChamp($_POST["couleur"], $couleur_regex, $couleur, $couleur_err);
    validerChamp($_POST["race"], $race_regex, $race, $race_err);
    validerChamp($_POST["espece"], $espece_regex, $espece, $espece_err);
    validerChamp($_POST["age"], $age_regex, $age, $age_err);
    validerChamp($_POST["date_naissance"], $date_naissance_regex, $date_naissance, $date_naissance_err);

    // Si tous les champs sont valides, effectuer le traitement supplémentaire ici
    if (!empty($nom) && !empty($couleur) && !empty($race) && !empty($espece) && !empty($age) && !empty($date_naissance)) {
        // Traitement supplémentaire ici (par exemple, enregistrement dans une base de données)
        echo "Formulaire valide. Traitement en cours...";
        exit;
    }
}
?>
    <div class="container">
        <h2>Réservation Spa</h2>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="mb-3">
                <label for="nom" class="form-label">Nom de l'animal:</label>
                <input type="text" class="form-control" id="nom" name="nom" value="<?php echo htmlspecialchars($nom); ?>">
                <div class="text-danger"><?php echo $nom_err; ?></div>
            </div>
            <div class="mb-3">
                <label for="couleur" class="form-label">Couleur:</label>
                <input type="text" class="form-control" id="couleur" name="couleur" value="<?php echo htmlspecialchars($couleur); ?>">
                <div class="text-danger"><?php echo $couleur_err; ?></div>
            </div>
            <div class="mb-3">
                <label for="race" class="form-label">Race:</label>
                <input type="text" class="form-control" id="race" name="race" value="<?php echo htmlspecialchars($race); ?>">
                <div class="text-danger"><?php echo $race_err; ?></div>
            </div>
            <div class="mb-3">
                <label for="espece" class="form-label">Espèce:</label>
                <input type="text" class="form-control" id="espece" name="espece" value="<?php echo htmlspecialchars($espece); ?>">
                <div class="text-danger"><?php echo $espece_err; ?></div>
            </div>
            <div class="mb-3">
                <label for="age" class="form-label">Âge:</label>
                <input type="text" class="form-control" id="age" name="age" value="<?php echo htmlspecialchars($age); ?>">
                <div class="text-danger"><?php echo $age_err; ?></div>
            </div>
            <div class="mb-3">
                <label for="date_naissance" class="form-label">Date de naissance:</label>
                <input type="text" class="form-control" id="date_naissance" name="date_naissance" value="<?php echo htmlspecialchars($date_naissance); ?>">
                <div class="text-danger"><?php echo $date_naissance_err; ?></div>
            </div>
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
    </div>














<?php include "components/footer.php" ?>