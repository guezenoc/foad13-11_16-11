<?php

require_once "class-singleton.php";

class Utilisateur {
    public $id;
    public $nom;
    public $email;
    public $password;


public function __construct (){
    $this->id = 0; 
    $this->nom = "";
    $this->email = "";
    $this->password = "";
}

public function save(){
    $db_connect = db_connect::construit("localhost", "root", "", "anonforum");

    $stmt= $db_connect->connexion->prepare('SELECT utilisateur.id FROM utilisateur WHERE utilisateur.email = ?');
    $stmt->bind_param('s', $res_email);
    $res_email = $this->email;
    $stmt->execute();
    

    if (!$stmt->fetch()) {
        $stmt1= $db_connect->connexion->prepare('INSERT INTO utilisateur (utilisateur.nom, utilisateur.email, utilisateur.password) VALUES (?,?,?)');
        $stmt1->bind_param('sss', $resultat_nom, $resultat_email, $resultat_password);
        $resultat_nom =$this->nom;
        $resultat_email=$this->email;
        $resultat_password=$this->password;
        return $stmt1->execute();
    }
    return false;
}


public static function connexion($email, $password){
    $db_connect = db_connect::construit("localhost", "root", "", "anonforum");

    $stmt=$db_connect->connexion->prepare('SELECT utilisateur.id, utilisateur.email, utilisateur.password FROM utilisateur WHERE utilisateur.email = ?');
    $stmt->bind_param('s', $resultat_email);
    $resultat_email = $email;
    $stmt->execute();
    $stmt->bind_result($utilisateur_id, $utilisateur_email, $utilisateur_hash_password);

    if ($stmt->fetch()) {
        return password_verify($password, $utilisateur_hash_password);
    }
    return false;
}
}


