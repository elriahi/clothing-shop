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
$order_id = $_POST['order_id'];
// MySQL Delete Query


$pdoQuery = "DELETE FROM `pending_order` WHERE `order_id` = :order_id";

$pdoResult = $pdoConnect->prepare($pdoQuery);

$pdoExec = $pdoResult->execute(array(":order_id"=>$order_id));

if($pdoExec)
{
echo '<script>alert("Vous avez supprimer cette commande !");
       window.location="ordres.php"; 
      </script>';
  }
  else{
    echo "<script>alert('Operation non reussie');</script>";
}

?>