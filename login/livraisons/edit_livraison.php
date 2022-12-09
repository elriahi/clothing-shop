<?php include "../includes/header.php" ?>

<?php

include '../includes/database.php';
 
if (isset($_GET['edit'])) {
    $req = $db->prepare('SELECT * FROM pending_livraisons WHERE order_id = ?');
    $req->execute(array($_GET['edit']));
    $pending_livraisons = $req->fetch();
}

if(isset($_POST['update']))

{

    // Count total posts

    $order_id = $_POST['order_id'];
    $invoice_no = $_POST['invoice_no'];
    $id_produit = $_POST['id_produit'];
    $reference = $_POST['reference'];
    $tel = $_POST['tel'];
    $due_amount = $_POST['due_amount'];
    $marque = $_POST['marque'];
    $qty = $_POST['qty'];
    $size = $_POST['size'];
    $ville = $_POST['ville'];
    $code_postal = $_POST['code_postal'];
    $adresse = $_POST['adresse'];
    $order_status = $_POST['order_status'];

extract($_POST);

$pdoQuery = "UPDATE pending_livraisons SET invoice_no=:invoice_no, id_produit=:id_produit, reference=:reference ,tel=:tel, due_amount=:due_amount, marque=:marque ,qty=:qty, size=:size,ville=:ville, code_postal=:code_postal, adresse=:adresse, order_status=:order_status WHERE order_id=:order_id ";

$pdoQuery_run = $db->prepare($pdoQuery);

$pdoQuery_exec = $pdoQuery_run->execute(array(":invoice_no"=>$invoice_no, ":id_produit"=>$id_produit, ":reference"=>$reference, ":tel"=>$tel, ":due_amount"=>$due_amount,":marque"=>$marque,":qty"=>$qty,"size"=>$size,":ville"=>$ville, ":code_postal"=>$code_postal, ":adresse"=>$adresse, ":order_status"=>$order_status, ":order_id"=>$order_id));

if($pdoQuery_exec)
{
       echo "<script>alert('Ce livraison a été modfier')</script>";
       echo "<script>window.open('livraisons.php','_self')</script>";
}
else
{
       echo "<script>alert('Ce livraison n'étais pas modfier')</script>";
       echo "<script>window.open('livraisons.php','_self')</script>";
   }

}

?>

<div class="content">

    <a type="button" class="btn btn-outline-success" href="livraisons.php">Retour à la page précédent</a><br> <br>

<form class="form-floating pt-3" action="" method="POST">

    <input type="hidden" name="order_id" value="<?php echo $pending_livraisons['order_id']; ?>" class="form form-control">

    <div>
        <label for="invoice_no">Invoice .No :</label>
        <input class="form-control" type="text" name="invoice_no" value="<?php echo $pending_livraisons['invoice_no']; ?>" >
    </div>
    <div>
        <label for="id_produit">ID Produit :</label>
        <input class="form-control" type="text" name="id_produit" value="<?php echo $pending_livraisons['id_produit']; ?>">
    </div>
    <div>
        <label for="reference">Reference :</label>
        <input class="form-control" type="text" name="reference" value="<?php echo $pending_livraisons['reference']; ?>">
    </div>
    <div>
        <label for="tel">Numéro de téléphone :</label>
        <input class="form-control" type="text" name="tel" value="<?php echo $pending_livraisons['tel']; ?>">
    </div>
    <div>
        <label for="due_amount">Prix :</label>
        <input class="form-control" type="text" name="due_amount" value="<?php echo $pending_livraisons['due_amount']; ?>">
    </div>
    <div>
        <label for="marque">Marque :</label>
        <input class="form-control" type="text" name="marque" value="<?php echo $pending_livraisons['marque']; ?>">
    </div>
    <div>
        <label for="qty">Quantité :</label>
        <input class="form-control" type="text" name="qty" value="<?php echo $pending_livraisons['qty']; ?>">
    </div>

    <div>
        <label for="size">Taille :</label>
        <input class="form-control" type="text" name="size" value="<?php echo $pending_livraisons['size']; ?>">
    </div>
        <div>
        <label for="ville">Ville :</label>
        <input class="form-control" type="text" name="ville" value="<?php echo $pending_livraisons['ville']; ?>">
    </div>

    <div>
        <label for="code_postal">Code postal :</label>
        <input class="form-control" type="text" name="code_postal" value="<?php echo $pending_livraisons['code_postal']; ?>">
    </div>
        <div>
        <label for="adresse">Adresse :</label>
        <input class="form-control" type="text" name="adresse" value="<?php echo $pending_livraisons['adresse']; ?>">
    </div>
        <div>
        <label for="order_status">Order status :</label>
        <input class="form-control" type="text" name="order_status" value="<?php echo $pending_livraisons['order_status']; ?>">
    </div>
<br>
   <div class="from-group mb-3">
         <button type="submit" name="update" class="btn btn-success">Edit</button>
    </div>
  
</form>
</div>

