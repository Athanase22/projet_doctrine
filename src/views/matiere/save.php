<?php
//$entityManager = require_once join(DIRECTORY_SEPARATOR, [__DIR__, 'bootstrap.php']);
$entityManager = require_once '../../../bootstrap.php';

use projet_doctrine\Entity\Matiere;

$matiereRepository = $entityManager->getRepository(Matiere::class);

if (isset($_POST['action']) && !empty($_POST['action'])) {
    $action = htmlspecialchars($_POST['action']);

    switch ($action) {
        case 'add': //On veut faire l'insertion
            if (
                isset($_POST['libelle']) && !empty($_POST['libelle']) &&
                isset($_POST['credit']) && !empty($_POST['credit']) 
            ) {
                $libelle = htmlspecialchars($_POST['libelle']);
                $credit = htmlspecialchars($_POST['credit']);

                $data = [
                    "libelle" => $libelle,
                    "credit" => $credit
                ];

                $matiere = new Matiere($data);

                //Prépare une requête de type INSERT INTO USER ....
                $entityManager->persist($matiere);
                //Réellement exécuter la requête
                $entityManager->flush();

                header('location:index.php?action=insertion');
            } else {
                echo 'Il manque des données';
            }

            break;
        case 'update': //On veut faire la mise à jour
            if (
                isset($_POST['id']) && !empty($_POST['id']) &&
                isset($_POST['libelle']) && !empty($_POST['libelle']) &&
                isset($_POST['credit']) && !empty($_POST['credit'])
            ) {
                $id = htmlspecialchars($_POST['id']);
                $libelle = htmlspecialchars($_POST['libelle']);
                $credit = htmlspecialchars($_POST['credit']);
                

                $matiere = $matiereRepository->find($id);

                if ($matiere) {
                    $matiere->setlibelle($libelle);
                    $matiere->setcredit($credit);

                    //Prépare une requête de type UPDATE USER .... car l'entité existe deja en BD
                    $entityManager->persist($matiere);
                    //Réellement exécuter la requête
                    $entityManager->flush();
                }

                header('location:index.php?action=update');
            } else {
                echo 'Il manque des données pour faire la mise à jour';
            }


            break;
        case 'delete': //On veut faire la suppression
            if (isset($_POST['id']) && !empty($_POST['id'])) {
                $id = htmlspecialchars($_POST['id']);

                $matiere = $matiereRepository->find($id);

                if ($matiere) {
                    //Préparer une requête de type DELETE FROM User ...
                    $entityManager->remove($matiere);
                    //Réellement exécuter la requête
                    $entityManager->flush();
                }
                header('location:index.php?action=delete');
            }

            break;
        default: //Aucune action
            echo 'Aucune action';
    }
}
