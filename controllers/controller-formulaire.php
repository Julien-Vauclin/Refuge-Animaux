<?php
require_once "../config.php";
require_once "../helpers/database.php";
require_once "../models/animal.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Obtenez les valeurs du formulaire
    $nom_animal = $_POST['nom_animal'];
    $date_arrivee = $_POST['date_arrivee'];
    $puce = $_POST['funradio'];
    $tatouage = $_POST['tattooradio'];
    $sexe = $_POST['radiosexe'];
    $id_race = $_POST['race'];
    $id_couleur = $_POST['couleur'];
    $id_espece = $_POST['espece'];

    try {
        // Créez une instance de la classe Database
        $db = new Database();

        // Obtenez une instance de la classe PDO
        $pdo = $db->createInstancePDO();

        // Requête SQL avec les valeurs
        $sql = "INSERT INTO animal (Nom, Date_d_arrivee, Puce, Tatouage, Sexe, ID_RACE, ID_COULEUR, ID_ESPECE)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        // Préparez la requête
        $stmt = $pdo->prepare($sql);

        // Exécutez la requête avec les valeurs
        $stmt->execute([$nom_animal, $date_arrivee, $puce, $tatouage, $sexe, $id_race, $id_couleur, $id_espece]);

        echo "L'animal a été inséré avec succès.";
    } catch (PDOException $exception) {
        echo "Erreur lors de l'insertion de l'animal : " . $exception->getMessage();
    }
}

include "../views/formulaire.php";
