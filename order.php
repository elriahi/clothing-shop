  <?php 

  session_start();

  include 'login/includes/config/db.php'; // DB Connection ..
  include 'login/includes/function.php'; // Functions  ..


    if(isset($_GET['c_id'])){
    $id_membre = $_GET['c_id'];
    }

    $ip_add = getIp();
    $status = "En cours";
    $invoice_no = mt_rand();
    $select_cart = "SELECT * FROM cart where ip_add = '$ip_add'";
    $run_cart = mysqli_query($db, $select_cart);

    while($row_cart = mysqli_fetch_array($run_cart)) {

    $pro_id = $row_cart['id_produit'];
    $marque = $row_cart['marque'];
    $size = $row_cart['size'];
    $qty = $row_cart['qty'];
    $pfinal = $row_cart['pfinal'];
    $frais_liv = '7'; // Frais Livraison
    $pfinal_frais_liv = $pfinal+$frais_liv; // Prix final
    $reference = $row_cart['reference'];
    $p_cat = $row_cart['p_cat'];

    $insert_customer_order = "INSERT INTO commande_client
    (id_membre,due_amount,invoice_no,qty,size,order_date,order_status)
    VALUES ('$id_membre','$pfinal_frais_liv','$invoice_no','$qty','$size',NOW(),'$status')";

    $run_cust_order = mysqli_query($db, $insert_customer_order);	

    $insert_pending_order = "INSERT INTO commande_en_cours 
    (id_membre,invoice_no,id_produit,reference,marque,p_cat,qty,size,due_amount,order_status) 
    VALUES ('$id_membre','$invoice_no','$pro_id','$reference','$marque','$p_cat','$qty','$size','$pfinal_frais_liv','$status')";

    $run_pending_order = mysqli_query($db, $insert_pending_order);	

    $delete = "DELETE FROM cart where ip_add = '$ip_add' ";
    $run_delete = mysqli_query($db, $delete);
    
    echo "<script>alert('Votre commande a été soumise')</script>";
    echo "<script>window.open('user/profil.php?order','_self')</script>";

    }

    ?>

