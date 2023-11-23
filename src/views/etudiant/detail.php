<?php
//$entityManager = require_once join(DIRECTORY_SEPARATOR, [__DIR__, 'bootstrap.php']);
$entityManager = require_once '../../../bootstrap.php';

use projet_doctrine\Entity\Etudiant;


$etudiantRepository = $entityManager->getRepository(Etudiant::class);

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = htmlspecialchars($_GET['id']);
    $etudiant = $etudiantRepository->find($id);
} else {
    $etudiant = null;
}

$i = 1;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <title>Etudiant</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor04" aria-controls="navbarColor04" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarColor04">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                <a class="nav-link active" href="../../../index.php">Acceuil
                    <span class="visually-hidden">(current)</span>
                </a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="../user">User</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="../enseignant">Enseignant</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="index.php">Etudiant</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="../filiere">Filiere</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="../matiere">Matiere</a>
                </li>
            </ul>
            <form class="d-flex">
                <input class="form-control me-sm-2" type="search" placeholder="Search">
                <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
            </form>
            </div>
        </div>
    </nav>  
    <div class="container">
        <?php
        if (isset($_GET['action']) && !empty($_GET['action'])) {
            $action = htmlspecialchars($_GET['action']);

            switch ($action) {
                case 'insertion':
        ?>
                    <div class="alert alert-primary alert-dismissible fade show mt-4" role="alert">
                        <strong>Insertion réussie</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php
                    break;
                case 'update':
                ?>
                    <div class="alert alert-warning alert-dismissible fade show mt-4" role="alert">
                        <strong>Mise à jour réussie</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
        <?php
                    break;
                default:
            }
        }
        ?>
        <h1>Liste des Etudiants</h1>
        <a href="index.php" class="btn btn-primary btn-sm">Liste</a>
        <a href="update.php?id=<?= $etudiant ? $etudiant->getId() : " " ?>" class="btn btn-warning btn-sm">Editer</a>
        <table class="table table-condensed table-striped">
            <tr>
                <td>nom</td>
                <td><?= $etudiant ? $etudiant->getNom() : " " ?></td>
            </tr>
            <tr>
                <td>prenom</td>
                <td><?= $etudiant ? $etudiant->getPrenom() : " " ?></td>
            </tr>

            </tr>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
</body>

</html>