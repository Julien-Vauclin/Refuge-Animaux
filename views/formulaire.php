<?php include "components/head.php" ?>
<?php include "components/navbar.php" ?>
<?php
// Variables pour stocker les valeurs des champs
$nom = $couleur = $race = $espece = $age = $date_naissance = $date_arrivee = "";

// Variables pour stocker les messages d'erreur
$nom_err = $couleur_err = $race_err = $espece_err = $age_err = $date_naissance_err = $date_arrivee_err = "";

// Fonction de validation des champs avec des expressions régulières
function validerChamp($champ, $regex, &$valeur, &$erreur)
{
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
    // $couleur_regex = "/^(?!.*(.)\1\1)[a-zA-Z]{3,}$/";
    // $race_regex = "/^(?!.*(.)\1\1)[a-zA-Z]{3,}$/";
    // $espece_regex = "/^(?!.*(.)\1\1)[a-zA-Z]{3,}$/";
    $age_regex = "/^\d+$/";
    $date_naissance_regex = "/^\d{4}-\d{2}-\d{2}$/";
    $date_arrivee_regex = "/^\d{4}-\d{2}-\d{2}$/";

    validerChamp($_POST["nom"], $nom_regex, $nom, $nom_err);
    // validerChamp($_POST["couleur"], $couleur_regex, $couleur, $couleur_err);
    // validerChamp($_POST["race"], $race_regex, $race, $race_err);
    // validerChamp($_POST["espece"], $espece_regex, $espece, $espece_err);
    validerChamp($_POST["age"], $age_regex, $age, $age_err);
    validerChamp($_POST["date_naissance"], $date_naissance_regex, $date_naissance, $date_naissance_err);
    validerChamp($_POST["date_arrivee"], $date_arrivee_regex, $date_arrivee, $date_arrivee_err);

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
        <!-- Nom de l'animal -->
        <div class="mb-3 titreform">
            <label for="nom_animal" class="form-label">Nom de l'animal:</label>
            <input type="text" class="form-control" id="nom_animal" name="nom_animal" value="<?php echo isset($_POST['nom_animal']) ? htmlspecialchars($_POST['nom_animal']) : ''; ?>">
            <?php if (isset($nom_animal_err)) : ?>
                <div class="text-danger"><?php echo $nom_animal_err; ?></div>
            <?php endif; ?>
        </div>
        <!-- Label age -->
        <div class="mb-3 titreform">
            <label for="age" class="form-label">Âge:</label>
            <input type="text" class="form-control" id="age" name="age" value="<?php echo htmlspecialchars($age); ?>">
            <div class="text-danger"><?php echo $age_err; ?></div>
        </div>
        <!-- Date de naissance -->
        <div class="mb-3 titreform">
            <label for="date_naissance" class="form-label">Date de naissance:</label>
            <input type="date" class="form-control" id="date_naissance" name="date_naissance" value="<?php echo htmlspecialchars($date_naissance); ?>">
            <div class="text-danger"><?php echo $date_naissance_err; ?></div>
        </div>
        <!-- Date d'arrivée -->
        <div class="mb-3 titreform">
            <label for="date_arrivee" class="form-label">Date d'arrivée:</label>
            <input type="date" class="form-control" id="date_arrivee" name="date_arrivee" value="<?php echo htmlspecialchars(date('Y-m-d')); ?>">
            <div class="text-danger"><?php echo $date_arrivee_err; ?></div>
        </div>
        <!-- Select couleur -->
        <div class="mb-3 titreform">
            <select id="couleur" name="couleur">
                <option value="" disabled>Choisir une couleur</option>
                <option value="blanc" <?php if (isset($_POST['couleur']) && $_POST['couleur'] === 'blanc') echo 'selected'; ?>>Blanc</option>
                <option value="noir" <?php if (isset($_POST['couleur']) && $_POST['couleur'] === 'noir') echo 'selected'; ?>>Noir</option>
                <option value="gris" <?php if (isset($_POST['couleur']) && $_POST['couleur'] === 'gris') echo 'selected'; ?>>Gris</option>
                <option value="brun" <?php if (isset($_POST['couleur']) && $_POST['couleur'] === 'brun') echo 'selected'; ?>>Brun</option>
                <option value="sable" <?php if (isset($_POST['couleur']) && $_POST['couleur'] === 'sable') echo 'selected'; ?>>Sable</option>
                <option value="roux" <?php if (isset($_POST['couleur']) && $_POST['couleur'] === 'roux') echo 'selected'; ?>>Roux</option>
            </select>
        </div>

        <!-- Select espèce -->
        <div class="mb-3 titreform">
            <select id="select1" name="espece" onchange="updateSelect2()">
                <option value="" disabled>Choisir une espèce</option>
                <option value="1" <?php if (isset($_POST['espece']) && $_POST['espece'] === '1') echo 'selected'; ?>>Chien</option>
                <option value="2" <?php if (isset($_POST['espece']) && $_POST['espece'] === '2') echo 'selected'; ?>>Chat</option>
            </select>
        </div>

        <!-- Select race -->
        <div class="mb-3 titreform">
            <select id="select2" name="race">
                <option value="" disabled>Choisir une race</option>
                <option value="A" data-group="1" <?php if (isset($_POST['race']) && $_POST['race'] === 'A') echo 'selected'; ?>>Labrador</option>
                <option value="B" data-group="1" <?php if (isset($_POST['race']) && $_POST['race'] === 'B') echo 'selected'; ?>>Bulldog</option>
                <option value="C" data-group="1" <?php if (isset($_POST['race']) && $_POST['race'] === 'C') echo 'selected'; ?>>Caniche</option>
                <option value="D" data-group="1" <?php if (isset($_POST['race']) && $_POST['race'] === 'D') echo 'selected'; ?>>Chihuahua</option>
                <option value="E" data-group="1" <?php if (isset($_POST['race']) && $_POST['race'] === 'E') echo 'selected'; ?>>Yorkshire</option>
                <option value="F" data-group="2" <?php if (isset($_POST['race']) && $_POST['race'] === 'F') echo 'selected'; ?>>Maine Coon</option>
                <option value="G" data-group="2" <?php if (isset($_POST['race']) && $_POST['race'] === 'G') echo 'selected'; ?>>Bengal</option>
                <option value="H" data-group="2" <?php if (isset($_POST['race']) && $_POST['race'] === 'H') echo 'selected'; ?>>Sphynx</option>
                <option value="I" data-group="2" <?php if (isset($_POST['race']) && $_POST['race'] === 'I') echo 'selected'; ?>>Siamois</option>
                <option value="J" data-group="2" <?php if (isset($_POST['race']) && $_POST['race'] === 'J') echo 'selected'; ?>>Persan</option>
            </select>
        </div>
        <!-- Script qui adapte le select race en fonction du select espece -->
        <script>
            function updateSelect2() {
                var select1 = document.getElementById("select1");
                var select2 = document.getElementById("select2");

                var selectedValue = select1.value;

                // Réinitialiser le select2 à son état initial
                select2.innerHTML = "";

                // Ajouter les options en fonction de la sélection
                if (selectedValue === "1") {
                    var optionA = new Option("Labrador", "A");
                    var optionB = new Option("Bulldog", "B");
                    var optionC = new Option("Caniche", "C");
                    var optionD = new Option("Chihuahua", "D");
                    var optionE = new Option("Yorkshire", "E");

                    select2.add(optionA);
                    select2.add(optionB);
                    select2.add(optionC);
                    select2.add(optionD);
                    select2.add(optionE);
                } else if (selectedValue === "2") {
                    var optionF = new Option("Maine Coon", "F");
                    var optionG = new Option("Bengal", "G");
                    var optionH = new Option("Sphynx", "H");
                    var optionI = new Option("Siamois", "I");
                    var optionJ = new Option("Persan", "J");

                    select2.add(optionF);
                    select2.add(optionG);
                    select2.add(optionH);
                    select2.add(optionI);
                    select2.add(optionJ);
                }
            }
        </script>
        <!-- Bouton puce -->
        <div class="radiopuce text-start">
            <h3 class="titreform d-inline">Pucé</h3>
            <div class="divpuce d-inline">
                <div class="boutonpuce ms-2 d-inline">
                    <input type="radio" id="ouiradio" name="funradio" value="oui">
                    <label for="oui">Oui</label>
                </div>
                <div class="boutonpuce ms-2 d-inline">
                    <input type="radio" id="nonradio" name="funradio" value="non">
                    <label for="non">Non</label>
                </div>
            </div>
        </div>
        <!-- Bouton tatouage -->
        <div class="radiopuce text-start">
            <h3 class="titreform d-inline">Tatoué</h3>
            <div class="divpuce d-inline">
                <div class="boutonpuce ms-2 d-inline">
                    <input type="radio" id="ouiradio" name="tattooradio" value="oui"> <label for="oui">Oui</label>
                </div>
                <div class="boutonpuce ms-2 d-inline">
                    <input type="radio" id="nonradio" name="tattooradio" value="non">
                    <label for="non">Non</label>
                </div>
            </div>
        </div>
        <!-- Bouton sexe -->
        <div class="radiopuce text-start">
            <h3 class="titreform d-inline">Sexe</h3>
            <div class="divpuce d-inline">
                <div class="boutonpuce ms-2 d-inline">
                    <input type="radio" id="ouiradio" name="radiosexe" value="oui">
                    <label for="oui">Mâle</label>
                </div>
                <div class="boutonpuce ms-2 d-inline">
                    <input type="radio" id="nonradio" name="radiosexe" value="non">
                    <label for="non">Femelle</label>
                </div>
            </div>
        </div>
        <button type="submit" class="btn boutonform">Envoyer</button>
    </form>
</div>

<?php include "components/footer.php" ?>