<?php include "../includes/header.php" ?>
<div class="content">

<form class="form-floating pt-3" action="process-add.php" method="POST">

    <div class="content">
    <a type="button" class="btn btn-outline-success" href="livraisons.php">Retour à la page précédent</a>
    </div><br> 

    <h5>Ajouter un nouveau livraison</h5> <br>

    <div>
        <label for="order_id">Order .No :</label>
        <input class="form-control" type="text" name="order_id" required >
    </div>
    <div>
        <label for="invoice_no">Facture .No :</label>
        <input class="form-control" type="text" name="invoice_no" required >
    </div>
       <div>
        <label for="id_produit">ID produit :</label>
        <input class="form-control" type="text" name="id_produit" required >
    </div>
    <div>
        <label for="reference">Réference :</label>
        <input class="form-control" type="text" name="reference" required >
    </div>
    <div>
        <label for="marque">Marque :</label>
        <input class="form-control" type="text" name="marque" required >
    </div>
    <div>
        <label for="qty">Quantité:</label>
        <input class="form-control" type="text" name="qty" required >
    </div>
 
   <div>
        <label for="size">Taille :</label>
        <input class="form-control" type="text" name="size" required >
    </div>
       <div>
        <label for="due_amount">Prix :</label>
        <input class="form-control" type="text" name="due_amount" required >
    </div>
    <div>
        <label for="tel">Numéro de téléphone !</label>
        <input class="form-control" type="text" name="tel" required >
    </div>
    <div>
        <label>Adresse d'éxpidition :</label>
         <input class="form-control" type="text" name="ville" placeholder="Ville" required > <br>
         <input class="form-control" type="numbre" name="code_postal" placeholder="Code postal" required > <br>
         <input class="form-control" type="text" name="adresse" placeholder="Adresse" required > <br>
    </div>
     <div>
        <label for="order_status">Order status :</label>
        <input class="form-control" type="text" name="order_status" required > <br>
    </div>
   <div class="from-group mb-3">
         <button type="submit" name="save_select" class="btn btn-success">Ajouter</button>
    </div>

  
</form>
</div>