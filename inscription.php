<?php

require_once "inc/class-utilisateur.php";
$erreurs = [];

//Traiter les POST
if (isset($_POST['inscription'])) {
    if(!empty($_POST)){
        $password= password_hash($_POST['password'], PASSWORD_DEFAULT);
        if (password_verify($_POST['password_confirmed'], $password)) {
            $user = new Utilisateur();
            $user->nom = $_POST['nom'];
            $user->email = $_POST['email'];
            $user->password = $password;

            if ($user->save()) {
                header('Location: index.php');
                die();
            }
            $erreurs[] = 'email deja utilisé';
            } else {
                $erreurs[] = 'les mots de passe ne match pas';
            }
            } else {
                $erreurs[] = 'les champ sont vide';
            }
}

if (isset($_POST['connexion'])) {
if (!empty($_POST)) {
    if (Utilisateur::connexion($_POST['email'],$_POST['password'])) {
        session_start();
        $_SESSION['connecter'] = true;
        header('Location: index.php');
        die();
    }
}else {
    $erreurs[]= "les champs sont vides";
}
}
    





//Rendu
?>
<html>
    <head>
        <script src="lib/jquery-3.5.1.min.js"></script>
        <script src="lib/jquery.validate.min.js"></script>
        <script src="js/validate-form.js"></script>
    </head>
    <body>
<?php
    if (count($erreurs)) {
        echo "<ul>";
        for ($i=0; $i<count($erreurs); $i++) {
            echo "<li>".$erreurs[$i]."</li>";
        }
        echo "</ul>";
    }
?>
        <form method="POST" id ="form-inscription">
            <h2>Inscription</h2>
            
            <input type="text" name="nom" placeholder="nom" value="" id="nom" />
            <input type="email" name="email" placeholder="mail@example.com" value="" id="email"/>
            <input type="password" name="password" placeholder="Mot de passe" id="password"/>
            <input type="password" name="password_confirmed" placeholder="Repeter mot de passe" id="password_confirmed"/>
            <input type="submit" name="inscription" value="Inscription"/>
        </form>
        <form method="POST" id ="form-connexion">
            <h2>Connexion</h2>
            <input type="email" name="email" placeholder="mail@example.com" value="" id="email"/>
            <input type="password" name="password" placeholder="Mot de passe" id="password"/>
            <input type="submit" name="connexion" value="Connexion"/>
        </form>
            
            
            

    </body>
</html>