<?php include "../includes/header.php" ?>

<?php

include '../includes/database.php';
 
if (isset($_GET['edit'])) {
    $req = $db->prepare('SELECT * FROM pending_order WHERE order_id = ?');
    $req->execute(array($_GET['edit']));
    $pending_order = $req->fetch();
}

if(isset($_POST['update']))

{

    // Count total posts

    $order_id = $_POST['order_id'];
    $id_membre = $_POST['id_membre'];
    $invoice_no = $_POST['invoice_no'];
    $id_produit = $_POST['id_produit'];
    $reference = $_POST['reference'];
    $marque = $_POST['marque'];
    $p_cat = $_POST['p_cat'];
    $qty = $_POST['qty'];
    $size = $_POST['size'];
    $due_amount = $_POST['due_amount'];
    $order_status = $_POST['order_status'];


extract($_POST);

$pdoQuery = "UPDATE pending_order SET invoice_no=:invoice_no, id_membre=:id_membre, id_produit=:id_produit, reference=:reference , due_amount=:due_amount, marque=:marque , p_cat=:p_cat, qty=:qty, size=:size, order_status=:order_status WHERE order_id=:order_id ";

$pdoQuery_run = $db->prepare($pdoQuery);

$pdoQuery_exec = $pdoQuery_run->execute(array(":id_membre"=>$id_membre,":invoice_no"=>$invoice_no, ":id_produit"=>$id_produit, ":reference"=>$reference, ":due_amount"=>$due_amount,":marque"=>$marque,":p_cat"=>$p_cat,":qty"=>$qty,"size"=>$size, ":order_status"=>$order_status, ":order_id"=>$order_id));

if($pdoQuery_exec)
{
       echo "<script>alert('Ce commande a été modfier')</script>";
       echo "<script>window.open('ordres.php','_self')</script>";
}
else
{
       echo "<script>alert('Ce commande n'étais pas modfier')</script>";
       echo "<script>window.open('ordres.php','_self')</script>";
   }

}

?>

<div class="content">

    <a type="button" class="btn btn-outline-success" href="ordres.php">Retour à la page précédent</a><br> <br>

<form class="form-floating pt-3" action="" method="POST">

    <input type="hidden" name="order_id" value="<?php echo $pending_order['order_id']; ?>" class="form form-control">
    <div>
        <label for="id_membre">Client ID :</label>
        <input class="form-control" type="text" name="id_membre" value="<?php echo $pending_order['id_membre']; ?>" >
    </div>
    <div>
        <label for="invoice_no">Invoice .No :</label>
        <input class="form-control" type="text" name="invoice_no" value="<?php echo $pending_order['invoice_no']; ?>" >
    </div>
    <div>
        <label for="id_produit">ID Produit :</label>
        <input class="form-control" type="text" name="id_produit" value="<?php echo $pending_order['id_produit']; ?>">
    </div>
    <div>
        <label for="reference">Reference :</label>
        <input class="form-control" type="text" name="reference" value="<?php echo $pending_order['reference']; ?>">
    </div>
    <div>
        <label for="due_amount">Prix :</label>
        <input class="form-control" type="text" name="due_amount" value="<?php echo $pending_order['due_amount']; ?>">
    </div>
    <div>
        <label for="marque">Marque :</label>
        <input class="form-control" type="text" name="marque" value="<?php echo $pending_order['marque']; ?>">
    </div>
    <div>
        <label for="p_cat">CAT :</label>
        <input class="form-control" type="text" name="p_cat" value="<?php echo $pending_order['p_cat']; ?>" >
    </div>
    <div>
        <label for="qty">Quantité :</label>
        <input class="form-control" type="text" name="qty" value="<?php echo $pending_order['qty']; ?>">
    </div>

    <div>
        <label for="size">Taille :</label>
        <input class="form-control" type="text" name="size" value="<?php echo $pending_order['size']; ?>">
    </div>
    <div>
        <label for="order_status">Order status :</label>
        <input class="form-control" type="text" name="order_status" value="<?php echo $pending_order['order_status']; ?>">
    </div>
<br>
   <div class="from-group mb-3">
         <button type="submit" name="update" class="btn btn-success">Edit</button>
    </div>
  
</form>
</div>

