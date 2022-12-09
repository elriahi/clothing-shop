<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
    header('Location: ../index.php');
    exit;
}
?>

<?php

    include '../includes/function.php'; // Functions  ..


    if(isset($_GET['ajouter'])){
    $order_id = $_GET['ajouter'];
    }

    $select_order = "SELECT * FROM commande_en_cours where order_id = '$order_id'";

    $run_order = mysqli_query($db, $select_order);

    while($row_order = mysqli_fetch_array($run_order)) {

    $order_id = $row_order['order_id'];
    $invoice_no = $row_order['invoice_no'];
    $id_produit = $row_order['id_produit'];
    $reference = $row_order['reference'];
    $marque = $row_order['marque'];
    $qty = $row_order['qty'];
    $size = $row_order['size'];
    $due_amount = $row_order['due_amount'];
    $id_client = $row_order['id_membre'];
       
   $select_details_client = "SELECT * FROM membre WHERE id_membre = '$id_client'";
   $run_details_client = mysqli_query($db, $select_details_client);
   while($row_client = mysqli_fetch_array($run_details_client)) {

   	$tel = $row_client['tel'];
   	$adresse = $row_client['adresse'];
   	$code_postal = $row_client['code_postal'];
   	$ville = $row_client['ville'];

    }


   $new_order_status = 'En cours de livraison';

   $insert_pending_livraisons = "INSERT INTO livraisons_en_cours
   (order_id,invoice_no,id_produit,reference,marque,qty,size,due_amount,tel,ville,code_postal,adresse,order_status)
   VALUES ('$order_id','$invoice_no','$id_produit','$reference','$marque','$qty','$size','$due_amount','$tel','$ville','$code_postal','$adresse','$new_order_status')";
   $run_insert_pending_livraisons = mysqli_query($db, $insert_pending_livraisons);
   
   if($run_insert_pending_livraisons) {


   $up_cust_order = "UPDATE commande_client SET order_status = '$new_order_status' WHERE invoice_no = '$invoice_no'";
   $run_query_cust_order = mysqli_query($db, $up_cust_order);
   $up_order_pending = "UPDATE commande_en_cours SET order_status = '$new_order_status' WHERE invoice_no = '$invoice_no'";
   $run_query_order_pending = mysqli_query($db, $up_order_pending);

   	   echo "<script>alert('Ce commande a été ajouter pour le livraison')</script>";
   	   echo "<script>window.open('../livraisons/livraisons.php','_self')</script>";

   }else {

       echo "<script>alert('Ce commande déjà ajouter pour le livraison')</script>";
       echo "<script>window.open('../livraisons/livraisons.php','_self')</script>";
   }

   }

?>
   

