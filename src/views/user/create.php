<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <title>User</title>
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
                <a class="nav-link" href="index.php">User</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="../enseignant">Enseignant</a>
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
        <form method="post" action="save.php">
            <fieldset>
                <legend>
                    <h1>Ajout d'un utilisateur</h1>
                </legend>
                <div class="form-group">
                    <label for="username" class="form-label mt-4">username</label>
                    <input type="text" class="form-control" name="username" id="username" placeholder="username">
                </div>
                <div class="form-group">
                    <label for="password" class="form-label mt-4">password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="password">
                </div>
                <div class="form-group">
                    <label for="role" class="form-label mt-4">Rôle</label>
                    <select name="role" id="role">
                        <option value="admin">Admin</option>
                        <option value="etudiant">Etudiant</option>
                        <option value="enseignant">Enseignant</option>
                    </select>
                </div>
                <hr>
                <button type="submit" name="action" value="add" class="btn btn-primary">Submit</button>
            </fieldset>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
</body>

</html>