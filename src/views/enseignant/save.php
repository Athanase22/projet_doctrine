<?php
//$entityManager = require_once join(DIRECTORY_SEPARATOR, [__DIR__, 'bootstrap.php']);
$entityManager = require_once '../../../bootstrap.php';

use projet_doctrine\Entity\Enseignant;

$enseignantRepository = $entityManager->getRepository(Enseignant::class);

if (isset($_POST['action']) && !empty($_POST['action'])) {
    $action = htmlspecialchars($_POST['action']);

    switch ($action) {
        case 'add': //On veut faire l'insertion
            if (
                isset($_POST['nom']) && !empty($_POST['nom']) &&
                isset($_POST['prenom']) && !empty($_POST['prenom']) &&
                isset($_POST['grade']) && !empty($_POST['grade']) &&
                isset($_POST['contact']) && !empty($_POST['contact'])
            ) {
                $nom = htmlspecialchars($_POST['nom']);
                $prenom = htmlspecialchars($_POST['prenom']);
                $grade = htmlspecialchars($_POST['grade']);
                $contact = htmlspecialchars($_POST['contact']);

                $data = [
                    "nom" => $nom,
                    "prenom" => $prenom,
                    "grade" => $grade,
                    "contact" => $contact
                ];

                $enseignant = new Enseignant($data);

                //Prépare une requête de type INSERT INTO USER ....
                $entityManager->persist($enseignant);
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
                isset($_POST['prenom']) && !empty($_POST['prenom']) &&
                isset($_POST['grade']) && !empty($_POST['grade']) &&
                isset($_POST['contact']) && !empty($_POST['contact'])
            ) {
                $id = htmlspecialchars($_POST['id']);
                $nom = htmlspecialchars($_POST['nom']);
                $prenom = htmlspecialchars($_POST['prenom']);
                $grade = htmlspecialchars($_POST['grade']);
                $contact = htmlspecialchars($_POST['contact']);

                $enseignant = $enseignantRepository->find($id);

                if ($enseignant) {
                    $enseignant->setNom($nom);
                    $enseignant->setPrenom($prenom);
                    $enseignant->setGrade($grade);
                    $enseignant->setContact($contact);

                    //Prépare une requête de type UPDATE USER .... car l'entité existe deja en BD
                    $entityManager->persist($enseignant);
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

                $enseignant = $enseignantRepository->find($id);

                if ($enseignant) {
                    //Préparer une requête de type DELETE FROM User ...
                    $entityManager->remove($enseignant);
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
