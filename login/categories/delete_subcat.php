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


$pdoQuery = "DELETE FROM `subcat` WHERE `subcat_id` = :subcat_id";

$pdoResult = $pdoConnect->prepare($pdoQuery);

$pdoExec = $pdoResult->execute(array(":subcat_id"=>$subcat_id));

if($pdoExec)
{
echo '<script>alert("Vous avez supprimer ce subcat!");
       window.location="sub-cat.php"; 
      </script>';
  }
  else{
    echo "<script>alert('Operation non reussie');</script>";
}

?>