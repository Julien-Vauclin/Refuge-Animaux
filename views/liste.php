<?php include "components/head.php" ?>
<?php include "components/navbar.php" ?>


<!-- test -->
<div class="container">
    <h1>Liste des animaux de la SPA</h1>
    <div class="cartes">

        <?php
        function afficherPhoto($animalId)
        {
            $cheminJPG = "../assets/img/image" . $animalId . ".jpg";
            $cheminJPEG = "../assets/img/image" . $animalId . ".jpeg";
            $cheminWEBP = "../assets/img/image" . $animalId . ".webp";

            if (file_exists($cheminJPG)) {
                echo '<img src="' . $cheminJPG . '" alt="image" class="image-animal">' . PHP_EOL;
            } elseif (file_exists($cheminJPEG)) {
                echo '<img src="' . $cheminJPEG . '" alt="image" class="image-animal">' . PHP_EOL;
            } elseif (file_exists($cheminWEBP)) {
                echo '<img src="' . $cheminWEBP . '" alt="image" class="image-animal">' . PHP_EOL;
            } else {
                echo '<p>Aucune image disponible</p>' . PHP_EOL;
            }
        }
        ?>

        <?php foreach (Animal::getAllAnimals() as $animal) { ?>
            <div class="titrephoto">
                <h5 class="nom card-title"><?= $animal['Nom'] ?></h5>
                <h5 class="arrivee card-title">Date d'arrivée : <?= $animal['Date d\'arrivée'] ?></h5>
            </div>

            <div class="card">
                <div class="titrephoto">
                    <h5 class="puce card-title">Pucé : <?= $animal['Puce'] ?></h5>
                    <h5 class="puce card-title">Tatoué : <?= $animal['Tatouage'] ?></h5>
                </div>

                <div class="card-body">
                    <?php
                    afficherPhoto($animal['ID']);
                    ?>

                    <p class="card-text"><strong>Couleur :</strong> <?= $animal['Couleur'] ?> </p>
                    <p class="card-text"><strong>Race :</strong> <?= $animal['Race'] ?> </p>
                    <p class="card-text"><strong>Sexe :</strong> <?= $animal['Sexe'] ?> </p>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<!-- fin test -->

<?php include "components/footer.php" ?>