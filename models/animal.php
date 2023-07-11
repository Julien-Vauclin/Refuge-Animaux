<?php
class Animal
{
    private int $ID;
    private int $Date_de_naissance;
    private int $Date_d_arrivee;
    private int $Date_d_adoption;
    private bool $Tatouage;
    private bool $Puce;
    private bool $Sexe;
    private float $Poids;
    private string $Nom;
    private bool $Reserve;
    private int $ID_ESPECE;
    private int $ID_RACE;
    private int $ID_COULEUR;

    /** 
     * Méthode qui retourne tous les animaux
     * @return array tableau associatif de tous les animaux
     */
    public static function getAllAnimals(): array
    {
        // Je crée une instance PDO à l'aide de la méthode statique createInstancePDO() de la classe Database
        $pdo = Database::createInstancePDO();
        // Je prépare ma requête SQL
        $sql = "
        SELECT `animal`.`ID`,`Nom`, `Date_d_arrivee` AS 'Date d\'arrivée', CASE `Puce` WHEN 1 THEN 'Oui' ELSE 'Non' END AS 'Puce', CASE `Tatouage` WHEN 1 THEN 'Oui' ELSE 'Non' END AS 'Tatouage', CASE `Sexe` WHEN 1 THEN 'Femelle' ELSE 'Mâle' END AS 'Sexe', `race`.`Name` AS 'Race', `espece`.`Name` AS 'Espèce', `couleur`.`Name` AS 'Couleur' FROM `animal` INNER JOIN `race` ON `animal`.`ID_RACE` = `race`.`ID` INNER JOIN `couleur` ON `animal`.`ID_COULEUR` = `couleur`.`ID` INNER JOIN `espece` ON `animal`.`ID_ESPECE` = `espece`.`ID` ORDER BY `animal`.`ID`;
        ";
        // J'exécute ma requête SQL
        $pdo_statement = $pdo->query($sql);
        // Je récupère le résultat de ma requête SQL sous forme de tableau associatif
        $result = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
        // Je retourne le résultat
        return $result;
    }
}
