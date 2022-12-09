<?php


$con = mysqli_connect("localhost","root","","articles");

if(isset($_POST['save_select']))
{
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


    $query = "INSERT INTO pending_order 
    (order_id,id_membre,invoice_no,id_produit,reference,marque,p_cat,qty,size,due_amount,order_status) 
    VALUES ('$order_id','$id_membre','$invoice_no','$id_produit','$reference','$marque','$p_cat','$qty','$size','$due_amount','$order_status')";

    $query_run = mysqli_query($con, $query);

    if($query_run)
    {

       echo "<script>alert('Ce commande a été ajouter')</script>";
       echo "<script>window.open('ordres.php','_self')</script>";
    }
    else
    {

       echo "<script>alert('Ce commande déjà ajouter)</script>";
       echo "<script>window.open('oredres.php','_self')</script>";
    }
}
?>