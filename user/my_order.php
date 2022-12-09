<h3 class="text-center" style="font-family: Poppins; margin-bottom: 20px; margin-top: 5px;">Mes commandes</h3>
<h6 class="text-center" style="font-family: Poppins; color: #a3a19c;">Vos commandes en un seul endroit</h6>
<h6 class="text-center" style="font-family: Poppins; color: #a3a19c; font-size: 15px;">Si vous avez des questions, n'hésitez pas <a href="../contact.php"> à nous contacter </a>, notre service client travaille pour vous 24h/7j.</h6>

<div class="alert alert-danger" role="alert">
<h6 class="text-center" style="font-family: Poppins; color: #black; font-size: 15px;">Le frais d'expédition ( 7 DT ) ont été ajoutés au prix principal.</h6>
</div>

<hr>

<div class="table-responsive">
<table class="table table-bordered table-hover">
<thead>
	<tr>
      <th style="text-align:center">Order. No</th> 
      <th style="text-align:center">Facture. No</th> 
      <th style="text-align:center">Quantité</th> 
      <th style="text-align:center">Taille</th> 
      <th style="text-align:center">Date de commande</th> 
      <th style="text-align:center">Total montant</th> 
      <th style="text-align:center">Status</th> 
	</tr>
</thead>	
<tbody>

  <?php 
  $connect = mysqli_connect("localhost", "root", "", "articles");
  $client_session = $_SESSION['SESSION_PSEUDO'];
  $get_client = "SELECT * FROM membre WHERE pseudo = '$client_session' ";
  $run_g_c = mysqli_query($connect, $get_client);
  $row_client = mysqli_fetch_array($run_g_c);
  $client_id = $row_client['id_membre'];
  $get_order = "SELECT * FROM commande_client WHERE id_membre = '$client_id' ";
  $run_order = mysqli_query($connect, $get_order);
  while($row=mysqli_fetch_array($run_order)) {
  echo '<tr>
  <td style="text-align:center">'.$row['order_id'].'</td>
  <td style="text-align:center">'.$row['invoice_no'].'</td>
  <td style="text-align:center">'.$row['qty'].'</td>
  <td style="text-align:center">'.$row['size'].'</td>
  <td style="text-align:center">'.$row['order_date'].'</td>
  <td style="text-align:center">'.$row['due_amount'].' DT</td>
  <td style="text-align:center">'.$row['order_status'].'</td>
  </tr>';
   }
    ?>
	</tbody>
</table>
</table>
</div>

