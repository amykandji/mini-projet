<?php 
// Initialisation des variables pour éviter les erreurs PHP
$index = isset($index) ? $index : "";
$article = isset($article) ? $article : "";
$client = isset($client) ? $client : "";
$commande = isset($commande) ? $commande : "";
?>

<!doctype html>
<html lang="en" class="h-100" data-bs-theme="auto">
<head>
    <script src="/docs/5.3/assets/js/color-modes.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestion commandes</title>

    <link href="https://getbootstrap.com/docs/5.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>  
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
    <script>
        $(document).ready(function () {
            $('#datatable').DataTable();
        });
    </script>
    <link href="css/style.css" rel="stylesheet">
</head>
<body class="d-flex flex-column h-100">

<header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Application commandes</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link <?php echo !empty($index) ? "active" : ""; ?>" href="index.php">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo !empty($article) ? "active" : ""; ?>" href="articles.php">Articles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo !empty($client) ? "active" : ""; ?>" href="clients.php">Clients</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo !empty($commande) ? "active" : ""; ?>" href="commandes.php">Commandes</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
</header>

</body>
</html>
