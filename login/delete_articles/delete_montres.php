<?php
if(isset($_POST['delete']))
{
    try {
        $pdoConnect = new PDO("mysql:host=localhost;dbname=articles","root","");
    } catch (PDOException $exc) {
        echo $exc->getMessage();
        exit();
    }
}
// Get ID to delete
$id_produit = $_POST['id_produit'];
// MySQL Delete Query


$pdoQuery = "DELETE FROM `montres` WHERE `id_produit` = :id_produit";

$pdoResult = $pdoConnect->prepare($pdoQuery);

$pdoExec = $pdoResult->execute(array(":id_produit"=>$id_produit));

if($pdoExec)
{
    header("Location: http://127.0.0.1/projet/login/check_articles/list_articles_montres.php");
}else{
    echo "<script>alert('Operation non reussie');</script>";
}

?>