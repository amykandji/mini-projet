<?php
ob_start(); // Démarre le tampon de sortie
$article = true;
include_once("header.php");
include_once("main.php");

if (!empty($_POST)) {
    // Correction de la requête UPDATE, avec un nom de paramètre cohérent
    $query = "UPDATE article SET description=:description, prix_unitaire=:pu WHERE idarticle=:id";
    $pdostmt = $pdo->prepare($query);
    $pdostmt->execute([
      "description" => $_POST["inputdesc"], // Assurez-vous que le nom de paramètre correspond à celui de la requête SQL
      "pu" => $_POST["inputpu"],
      "id" => $_POST["myid"]
    ]);
  
    header("Location: Articles.php");
    exit(); // IMPORTANT : Arrêter l'exécution après la redirection
}

if (!empty($_GET["id"])) {
    $query = "SELECT * FROM article WHERE idarticle=:id";
    $pdostmt = $pdo->prepare($query);
    $pdostmt->execute(["id" => $_GET["id"]]);

    // Ajouter l'accolade fermante ici
    while ($row = $pdostmt->fetch(PDO::FETCH_ASSOC)) :
?>

<h1 class="mt-5">Modifier un article</h1>
<form class="row g-3" method="POST">
    <input type="hidden" name="myid" value="<?php echo $row["idarticle"] ?>"/>
    <div class="col-md-6">
        <textarea class="form-control" placeholder="mettre la description" id="inputdesc" name="inputdesc" required><?php echo $row["description"] ?></textarea>
        <label for="inputdesc">Description</label>
    </div>
    <div class="col-md-6">
        <label for="inputpu" class="form-label">PU</label>
        <input type="text" class="form-control" id="inputpu" name="inputpu" value="<?php echo $row["prix_unitaire"] ?>" required>
    </div>
    <div class="col-12">
        <button type="submit" class="btn btn-primary">Modifier</button>
    </div>
</form>
</main> <!-- Fermeture du main -->

<?php
    endwhile; // Ferme la boucle while ici
} // Ferme le if ($_GET["id"])
include_once("footer.php");
ob_end_flush(); // Vide et envoie le tampon
?>
