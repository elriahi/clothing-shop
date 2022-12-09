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
$cat_id = $_POST['cat_id'];
// MySQL Delete Query


$pdoQuery = "DELETE FROM `categories` WHERE `cat_id` = :cat_id";

$pdoResult = $pdoConnect->prepare($pdoQuery);

$pdoExec = $pdoResult->execute(array(":cat_id"=>$cat_id));

if($pdoExec)
{
echo '<script>alert("Vous avez supprimer ce catégorie!");
       window.location="addcat.php"; 
      </script>';
  }
  else{
    echo "<script>alert('Operation non reussie');</script>";
}

?>