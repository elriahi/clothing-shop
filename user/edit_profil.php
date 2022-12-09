<h3 style="font-family: Poppins;  margin-top: 10px; margin-left: 13px;"> Modifier information profil</h3>
<hr style="margin-left: 13px;">


  <?php 

    $connect = mysqli_connect("localhost", "root", "", "articles");

    if(isset($_POST['update']))

    {

       // Count total value

        $client_session = $_SESSION['SESSION_PSEUDO'];
        $id_membre = $_POST['id_membre'];
        $prenom = $_POST['prenom'];
        $nom = $_POST['nom'];
        $email = $_POST['email'];
        $tel = $_POST['tel'];
        $civilite = $_POST['civilite'];
        $ville = $_POST['ville'];
        $code_postal = $_POST['code_postal'];
        $adresse = $_POST['adresse'];

        $content_dir = "usres_images/";

        $tmp_file = $_FILES['name_file']['tmp_name'];


        if (!is_uploaded_file($tmp_file)) {
        //    exit('le fichier est introuvable');
        }
        $type_file = $_FILES['name_file']['type'];

        if(!strstr($type_file, 'jpeg') && !strstr($type_file,'png')) {
           //exit("ce fichier n'est pas une image");
        }

        $name_file = time().'.jpg';

        if(!move_uploaded_file($tmp_file,$content_dir.$name_file)) {
          //  exit('impossible de copier le fichier');
        }


        $query_up = "UPDATE membre 
        SET prenom = '$prenom', nom = '$nom' ,main_img = '$name_file' , email = '$email', tel = '$tel' , civilite = '$civilite' , ville = '$ville' , code_postal = '$code_postal' , adresse = '$adresse'
        WHERE pseudo = '$client_session'";

        $run_query = mysqli_query($connect,$query_up);

        if($run_query) {

                  echo '
                  <script type="text/javascript">
                  $(document).ready(function() {
                  swal({
                  text: "Votre information changé",
                  icon: "success",
                  button: false,
                  timer: 2500,
                  className: "popup"
                  }).then(function() {
                  window.location = "http://localhost/projet/user/profil.php?edit_profil";
                  });
                  });
                  </script>
                  ';       
                   }
        }

  ?>


<?php

       $connect = mysqli_connect("localhost", "root", "", "articles");
       $client_session = $_SESSION['SESSION_PSEUDO'];
       $get_client = "SELECT * FROM membre WHERE pseudo = '$client_session' ";
       $run_g_c = mysqli_query($connect, $get_client);
       while($row=mysqli_fetch_array($run_g_c)) {

echo '

<div class="container">
<div class="row my-5">
<div class="col-md-3">

<form method="POST" action="" enctype="multipart/form-data">
<input type="hidden" name="id_membre" value="'.$row['id_membre'].'" class="form form-control">

<div class="form-group">
	<label style="font-family: Poppins;">Prénom :</label><br>
	<input type="text" name="prenom" class="form-control text-center" value="'.$row['prenom'].'" required="">
</div>

<div class="form-group">
	<label style="font-family: Poppins;">Nom :</label><br>
	<input type="text" name="nom" class="form-control text-center" value="'.$row['nom'].'" required="">
</div>

<div class="form-group">
	<label style="font-family: Poppins;">E-mail :</label><br>
	<input type="text" name="email" class="form-control text-center" value="'.$row['email'].'" required="">
</div>

<div class="form-group">
	<label style="font-family: Poppins;">Tél :</label><br>
	<input type="text" name="tel" class="form-control text-center" value="'.$row['tel'].'" required="">
</div>

<div class="form-group">
	<label style="font-family: Poppins;">Génre :</label><br>
	<select name="civilite" class="form-control">
		<option value="Homme">Homme</option>
		<option value="Femme">Femme</option>
	</select>
</div>

</div>

<div class="col-md-9">

<div class="form-group">
	<label style="font-family: Poppins;">Ville :</label><br>
	<input type="text" name="ville" class="form-control text-center" value="'.$row['ville'].'" required="">
</div>

<div class="form-group">
	<label style="font-family: Poppins;">Code postal :</label><br>
	<input type="text" name="code_postal" class="form-control text-center" value="'.$row['code_postal'].'" required="">
</div>



<div class="form-group">
	<label style="font-family: Poppins;">Adresse :</label><br>
	<input type="text" name="adresse" class="form-control text-center" value="'.$row['adresse'].'" required="">
</div>

<div class="form-group">
	<label style="font-family: Poppins;">Photo de profil :</label><br>
	<input type="file" name="name_file"> <br>
</div>

<div>
<button name="update" class="form-control btn btn-success" style="font-family: Poppins;" >Mise à jour</button>
</div>

</form>

</div>
</div>
</div>
 ';

 }

 
  ?>




