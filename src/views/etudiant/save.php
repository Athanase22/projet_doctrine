<?php
//$entityManager = require_once join(DIRECTORY_SEPARATOR, [__DIR__, 'bootstrap.php']);
$entityManager = require_once '../../../bootstrap.php';

use projet_doctrine\Entity\Etudiant;

$etudiantRepository = $entityManager->getRepository(Etudiant::class);

if (isset($_POST['action']) && !empty($_POST['action'])) {
    $action = htmlspecialchars($_POST['action']);

    switch ($action) {
        case 'add': //On veut faire l'insertion
            if (
                isset($_POST['nom']) && !empty($_POST['nom']) &&
                isset($_POST['prenom']) && !empty($_POST['prenom'])
            ) {
                $nom = htmlspecialchars($_POST['nom']);
                $prenom = htmlspecialchars($_POST['prenom']);
              
                $data = [
                    "nom" => $nom,
                    "prenom" => $prenom
                ];

                $etudiant = new Etudiant($data);

                //Prépare une requête de type INSERT INTO Etudiant ....
                $entityManager->persist($etudiant);
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
                isset($_POST['nom']) && !empty($_POST['nom']) &&
                isset($_POST['prenom']) && !empty($_POST['prenom']) 
            ) {
                $id = htmlspecialchars($_POST['id']);
                $nom = htmlspecialchars($_POST['nom']);
                $prenom = htmlspecialchars($_POST['prenom']);
              
                $etudiant = $etudiantRepository->find($id);

                if ($etudiant) {
                    $etudiant->setnom($nom);
                    $etudiant->setprenom($prenom);
                    

                    //Prépare une requête de type UPDATE Etudiant .... car l'entité existe deja en BD
                    $entityManager->persist($etudiant);
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

                $etudiant = $etudiantRepository->find($id);

                if ($etudiant) {
                    //Préparer une requête de type DELETE FROM Etudiant ...
                    $entityManager->remove($etudiant);
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
