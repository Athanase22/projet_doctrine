<?php
//$entityManager = require_once join(DIRECTORY_SEPARATOR, [__DIR__, 'bootstrap.php']);
$entityManager = require_once '../../../bootstrap.php';

use projet_doctrine\Entity\Filiere;

$filiereRepository = $entityManager->getRepository(Filiere::class);

if (isset($_POST['action']) && !empty($_POST['action'])) {
    $action = htmlspecialchars($_POST['action']);

    switch ($action) {
        case 'add': //On veut faire l'insertion
            if (
                isset($_POST['libelle']) && !empty($_POST['libelle']) 
            ) {
                $libelle = htmlspecialchars($_POST['libelle']);

                $data = [
                    "libelle" => $libelle
                ];

                $filiere = new Filiere($data);

                //Prépare une requête de type INSERT INTO filie$filiere ....
                $entityManager->persist($filiere);
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
                isset($_POST['libelle']) && !empty($_POST['libelle'])
            ) {
                $id = htmlspecialchars($_POST['id']);
                $libelle = htmlspecialchars($_POST['libelle']);

                $filiere = $filiereRepository->find($id);

                if ($filiere) {
                    $filiere->setLibelle($libelle);

                    //Prépare une requête de type UPDATE filie$filiere .... car l'entité existe deja en BD
                    $entityManager->persist($filiere);
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

                $filiere = $filiereRepository->find($id);

                if ($filiere) {
                    //Préparer une requête de type DELETE FROM filie$filiere ...
                    $entityManager->remove($filiere);
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
