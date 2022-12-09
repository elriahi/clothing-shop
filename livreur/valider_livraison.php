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

    include '../login/includes/function.php'; // Functions  ..
    if(isset($_GET['valider'])){
    $order_id = $_GET['valider'];
    }

       
   $select_details_client = "SELECT * FROM commande_client WHERE order_id = '$order_id'";

   $run_details_client = mysqli_query($db, $select_details_client);

   while($row_client = mysqli_fetch_array($run_details_client)) {

   $invoice_no = $row_client['invoice_no'];

   $new_order_status = 'expédié';
    
   //up pending livraisons status
   $up_pending_livraisons = "UPDATE livraisons_en_cours SET order_status = '$new_order_status' WHERE invoice_no = '$invoice_no'";
   $run_query_pending_livraisons = mysqli_query($db, $up_pending_livraisons);

   $select_details = "SELECT * FROM livraisons_en_cours WHERE invoice_no = '$invoice_no'";
   $run_details = mysqli_query($db, $select_details);
   while($row_ref = mysqli_fetch_array($run_details)) {
   $ref = $row_ref['reference'];
      
   if($run_query_pending_livraisons) {
   //up customer order status
   $up_cust_order = "UPDATE commande_client SET order_status = '$new_order_status' WHERE invoice_no = '$invoice_no'";
   $run_query_cust_order = mysqli_query($db, $up_cust_order);
   //up pending order status
   $up_order_pending = "UPDATE commande_en_cours SET order_status = '$new_order_status' WHERE invoice_no = '$invoice_no'";
   $run_query_order_pending = mysqli_query($db, $up_order_pending);
       //up stock tous_produits
   $up_qty_stock1 = "UPDATE tous_produits SET quantity = quantity -1 WHERE reference ='$ref'";
   $run_qty_stock1 = mysqli_query($db, $up_qty_stock1);
       //up stock all_articles
   $up_qty_stock2 = "UPDATE all_articles SET quantity = quantity -1 WHERE reference ='$ref'";
   $run_qty_stock2 = mysqli_query($db, $up_qty_stock2);
       //up stock arrivals
   $up_qty_stock3 = "UPDATE arrivals SET quantity = quantity -1 WHERE reference ='$ref'";
   $run_qty_stock3 = mysqli_query($db, $up_qty_stock3);
       //up stock montres
   $up_qty_stock4 = "UPDATE montres SET quantity = quantity -1 WHERE reference ='$ref'";
   $run_qty_stock4 = mysqli_query($db, $up_qty_stock4);
       //up stock robes
   $up_qty_stock5 = "UPDATE robes SET quantity = quantity -1 WHERE reference ='$ref'";
   $run_qty_stock5 = mysqli_query($db, $up_qty_stock5);



   	   echo "<script>alert('Ce commande a été expédié')</script>";
   	   echo "<script>window.open('livraisons.php','_self')</script>";

   }

   else 

   {

           echo "<script>alert('Ce commande déjà expédié')</script>";
           echo "<script>window.open('livraisons.php','_self')</script>";

   }


   }
   }



?>
   

