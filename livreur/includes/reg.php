<?php 

include 'config/db.php';

if (isset($_POST['save_select'])) {

    $msg = "";

    $prenom = mysqli_real_escape_string($conn, $_POST['prenom']);
    $nom = mysqli_real_escape_string($conn, $_POST['nom']);
    $tel = mysqli_real_escape_string($conn, $_POST['tel']);
    $pseudo = mysqli_real_escape_string($conn, $_POST['pseudo']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $mdp = mysqli_real_escape_string($conn, md5($_POST['mdp']));
    $mdpConf = mysqli_real_escape_string($conn, md5($_POST['mdpConf']));
    $civilite = mysqli_real_escape_string($conn, $_POST['civilite']);
    $ville = mysqli_real_escape_string($conn, $_POST['ville']);
    $code_postal = mysqli_real_escape_string($conn, $_POST['code_postal']);
    $adresse = mysqli_real_escape_string($conn, $_POST['adresse']);

    if ($mdp === $mdpConf)
    {

    }
    else
    {
       $msg = "<div class='alert alert danger'>le mot de passe et le mot de passe de confirmation ne correspondaient pas</div>";
    }



}

?>