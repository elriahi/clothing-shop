<div class="container-sm" style="margin-right: 100px; margin-left: 100px;"> 
 <div class="modal-content" style="margin-left: auto; margin-top: 100px;">

           <?php 

            $session_pseudo = $_SESSION['SESSION_PSEUDO'];

            $select_customer = "SELECT * FROM membre WHERE pseudo = '$session_pseudo' ";

            $run_cust = mysqli_query($db, $select_customer);

            $row_customer = mysqli_fetch_array($run_cust);

            $id_membre = $row_customer['id_membre'];

           ?>

            <h5 class="lead text-center">Payment option</h5>

           <div class="form-check text-center">
             <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
             <label class="form-check-label" for="exampleRadios1">
              Paiement à la livraison
             </label>
           </div> <br>
           <a type="submit" href="order.php?c_id=<?php echo $id_membre ?>" class="btn btn-success">Suivant</a>

</div>
</div>