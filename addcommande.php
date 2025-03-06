<?php
$commande = true;
include_once("header.php");
include_once("main.php");

$query = "SELECT idclient FROM client";
$objstmt = $pdo->prepare($query);
$objstmt->execute();

// Gérer l'ajout de la commande
if (!empty($_POST["inputclient"]) && !empty($_POST["inputdate"])) {
    $query = "INSERT INTO commande (idclient, date) VALUES (:idclient, :date)";
    $pdostmt = $pdo->prepare($query);
    
    try {
        $pdostmt->execute([
            "idclient" => $_POST["inputclient"],
            "date" => $_POST["inputdate"]
        ]);
        $pdostmt->closeCursor(); // Ferme le curseur
        header("Location: commandes.php"); // Redirection vers la page des commandes
        exit(); // Assurez-vous d'appeler exit() après header()
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage(); // Affichage des erreurs
        exit(); // Arrête le script en cas d'erreur
    }
}
?>

<h1 class="mt-5">Ajouter une commande</h1>

<form class="row g-3" method="POST">
    <div class="col-md-6">
        <label for="inputclient" class="form-label">ID Client</label>
        <select class="form-control" name="inputclient" required> <!-- Correction de l'espace ici -->
            <?php
            foreach ($objstmt->fetchAll(PDO::FETCH_NUM) as $tab) {
                foreach ($tab as $elmt) {
                    echo "<option value='" . htmlspecialchars($elmt) . "'>" . htmlspecialchars($elmt) . "</option>"; // Échappement des valeurs
                }
            }
            ?>
        </select>
    </div>
    <div class="col-6">
        <label for="inputdate" class="form-label">Date</label>
        <input type="date" class="form-control" id="inputdate" name="inputdate" required>
    </div>
    <div class="col-12">
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </div>
</form>

<?php
include_once("footer.php"); // Assurez-vous d'avoir une balise de fermeture ici
?>