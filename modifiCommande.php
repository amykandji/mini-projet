<?php
ob_start(); // Démarre la mise en tampon de sortie

$commande = true;
include_once("header.php");
include_once("main.php");

try {
    // Connexion à la base de données (Assurez-vous que $pdo est bien défini)
    $query = "SELECT idclient FROM client";
    $objstmt = $pdo->prepare($query);
    $objstmt->execute();
    $clients = $objstmt->fetchAll(PDO::FETCH_COLUMN);

    if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST["inputidclient"]) && !empty($_POST["inputdate"]) && !empty($_POST["myid"])) {
        // Vérification si l'ID client existe dans la base de données
        if (!in_array($_POST["inputidclient"], $clients)) {
            die("Erreur : L'ID client sélectionné n'existe pas.");
        }

        // Requête pour mettre à jour la commande
        $query = "UPDATE commande SET idclient=:idclient, date=:date WHERE idcommande=:id";
        $pdostmt = $pdo->prepare($query);
        $pdostmt->execute([
            "idclient" => $_POST["inputidclient"], 
            "date" => $_POST["inputdate"], 
            "id" => $_POST["myid"]
        ]);
        $pdostmt->closeCursor();
        header("Location: commandes.php");
        exit(); // IMPORTANT : Arrêter l'exécution après la redirection
    }

    if (!empty($_GET["id"])) {
        $query = "SELECT * FROM commande WHERE idcommande=:id";
        $pdostmt = $pdo->prepare($query);
        $pdostmt->execute(["id" => $_GET["id"]]);
        $row = $pdostmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$row) {
            die("Erreur : Commande introuvable.");
        }
?>
        <h1 class="mt-5">Modifier une commande</h1>
        <form class="row g-3" method="POST">
            <input type="hidden" name="myid" value="<?php echo htmlspecialchars($row["idcommande"]); ?>"/>
            <div class="col-md-6">
                <label for="inputidclient" class="form-label">ID client</label>
                <select class="form-control" name="inputidclient" required>
                <?php
                foreach ($clients as $client) {
                    $selected = ($row["idclient"] == $client) ? "selected" : "";
                    echo "<option value='".htmlspecialchars($client)."' $selected>".htmlspecialchars($client)."</option>";
                }
                ?>
                </select>
            </div>
            <div class="col-6">
                <label for="inputdate" class="form-label">Date</label>
                <input type="date" class="form-control" id="inputdate" name="inputdate" value="<?php echo htmlspecialchars($row["date"]); ?>" required>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Modifier</button>
            </div>
        </form>
<?php
        $pdostmt->closeCursor();
    }

} catch (PDOException $e) {
    die("Erreur SQL : " . $e->getMessage());
}

include_once("footer.php");
ob_end_flush(); // Envoie la sortie tamponnée
?>
