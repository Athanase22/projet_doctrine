<?php
//$entityManager = require_once join(DIRECTORY_SEPARATOR, [__DIR__, 'bootstrap.php']);
$entityManager = require_once '../../../bootstrap.php';

use projet_doctrine\Entity\Enseignant;

$enseignantRepository = $entityManager->getRepository(Enseignant::class);

$enseignants = $enseignantRepository->findAll();

$i = 1;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <title>Enseignant</title>
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
                <a class="nav-link" href="index.php">Enseignant</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="../etudiant">Etudiant</a>
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
                case 'delete':
                ?>
                    <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
                        <strong>Suppression réussie</strong>
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
        <h1>Liste des enseignants</h1>
        <a href="create.php" class="btn btn-primary btn-sm">Nouveau</a>

        <table class="table table-condensed table-striped">
            <tr>
                <td>#</td>
                <td>Nom</td>
                <td>Prenom</td>
                <td>Grade</td>
                <td>Contact</td>
                <td>Actions</td>
            </tr>
            <?php foreach ($enseignants as $enseignant) : ?>
                <tr>
                    <td><?= $i ?></td>
                    <td><?= $enseignant->getNom() ?></td>
                    <td><?= $enseignant->getPrenom() ?></td>
                    <td><?= $enseignant->getGrade() ?></td>
                    <td><?= $enseignant->getContact() ?></td>
                    <td>
                        <a href="detail.php?id=<?= $enseignant->getId() ?>" class="btn btn-sm btn-success">Détails</a>
                        <a href="update.php?id=<?= $enseignant ? $enseignant->getId() : " " ?>" class="btn btn-sm btn-warning">Editer</a>

                        <form action="save.php" method="post" style="display:inline" id="delete">
                            <input type="hidden" name="id" value="<?= $enseignant ? $enseignant->getId() : " " ?>">
                            <input type="hidden" name="action" value="delete">
                            <input type="submit" value="Supprimer" class="btn btn-danger btn-sm">
                        </form>

                    </td>
                </tr>

            <?php
                $i++;
            endforeach
            ?>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
    <script>
        $(function() {
            $("#delete").on("submit", function(event) {
                if (confirm("Voulez vous supprimer cet enregistrement")) {
                    alert("Cet enregistrement va être supprimé")
                } else {
                    event.preventDefault()
                }
            });
        })
    </script>
</body>

</html>