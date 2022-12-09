
<?php
try{

    $server = "localhost";
    $db_username = "root";
    $db_password = "";
    $db_name = "articles";

$db = new PDO("mysql:host=$server;dbname=$db_name",$db_username,$db_password);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
return $db;

}catch(PDOException $e) {
    echo "erreur de la connexion a la base de donnes" .$e->getMessage();
}

?>