<?php
//$entityManager = require_once join(DIRECTORY_SEPARATOR, [__DIR__, 'bootstrap.php']);
$entityManager = require_once '../../../bootstrap.php';

use projet_doctrine\Entity\User;

$userRepository = $entityManager->getRepository(User::class);

if (isset($_POST['action']) && !empty($_POST['action'])) {
    $action = htmlspecialchars($_POST['action']);

    switch ($action) {
        case 'add': //On veut faire l'insertion
            if (
                isset($_POST['username']) && !empty($_POST['username']) &&
                isset($_POST['password']) && !empty($_POST['password']) &&
                isset($_POST['role']) && !empty($_POST['role'])
            ) {
                $username = htmlspecialchars($_POST['username']);
                $password = htmlspecialchars($_POST['password']);
                $role = htmlspecialchars($_POST['role']);

                $data = [
                    "username" => $username,
                    "password" => $password,
                    "role" => $role
                ];

                $user = new User($data);

                //Prépare une requête de type INSERT INTO USER ....
                $entityManager->persist($user);
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
                isset($_POST['username']) && !empty($_POST['username']) &&
                isset($_POST['password']) && !empty($_POST['password']) &&
                isset($_POST['role']) && !empty($_POST['role'])
            ) {
                $id = htmlspecialchars($_POST['id']);
                $username = htmlspecialchars($_POST['username']);
                $password = htmlspecialchars($_POST['password']);
                $role = htmlspecialchars($_POST['role']);

                $user = $userRepository->find($id);

                if ($user) {
                    $user->setusername($username);
                    $user->setpassword($password);
                    $user->setRole($role);

                    //Prépare une requête de type UPDATE USER .... car l'entité existe deja en BD
                    $entityManager->persist($user);
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

                $user = $userRepository->find($id);

                if ($user) {
                    //Préparer une requête de type DELETE FROM User ...
                    $entityManager->remove($user);
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
