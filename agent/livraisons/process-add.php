<?php


$con = mysqli_connect("localhost","root","","articles");

if(isset($_POST['save_select']))
{
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


    $query = "INSERT INTO pending_livraisons 
    (order_id,invoice_no,id_produit,reference,marque,qty,size,due_amount,tel,ville,code_postal,adresse,order_status) 
    VALUES ('$order_id','$invoice_no','$id_produit','$reference','$marque','$qty','$size','$due_amount','$tel','$ville','$code_postal','adresse','$order_status')";

    $query_run = mysqli_query($con, $query);

    if($query_run)
    {

       echo "<script>alert('Ce livraison a été ajouter')</script>";
       echo "<script>window.open('livraisons.php','_self')</script>";
    }
    else
    {

       echo "<script>alert('Ce livraison déjà ajouter)</script>";
       echo "<script>window.open('livraisons.php','_self')</script>";
    }
}
?>