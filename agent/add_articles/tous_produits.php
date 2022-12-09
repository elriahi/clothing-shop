            <?php include "../includes/header.php"; ?>

			<?php
				require_once("../includes/database.php");
				if (isset($_POST['submit'])) {
					
					extract($_POST);

					//print_r($_FILES['fichier']);

					$content_dir = "../../login/images/";

					$tmp_file = $_FILES['fichier']['tmp_name'];


					if (!is_uploaded_file($tmp_file)) {
						exit('le fichier est introuvable');
					}
					$type_file = $_FILES['fichier']['type'];

					if(!strstr($type_file, 'jpeg') && !strstr($type_file,'png')) {
						exit("ce fichier n'est pas une image");
					}

					$name_file = time().'.jpg';

					if(!move_uploaded_file($tmp_file,$content_dir.$name_file)) {
						exit('impossible de copier le fichier');
					}
					$save_article = $db->prepare('INSERT INTO tous_produits(reference,marque,p_cat,p_subcat,contenu,p_key_word,images_name,prix,quantity,stock,date_creation) VALUES(?,?,?,?,?,?,?,?,?,?,?)');

					$save_article->execute(array($reference,$marque,$p_cat,$p_subcat,$contenu,$p_key_word,$name_file,$prix,$quantity,$stock,$date_creation));

                      echo "<script>
                      alert('Ce produit a été ajouté avec succès!');
                      window.location.href='http://localhost/projet/login/check_articles/list_articles_tous_produits.php';
                      </script>";


				}
			?>
		<div class="content">

             <a type="button" class="btn btn-primary bg-danger" href="/projet/login/check_articles/list_articles_tous_produits.php">retour à la page précédent</a>

         </div>
		    <div class="content" class="form-floating">
			<form method="POST" action="" enctype="multipart/form-data"><br><br>
			<input type="text" name="reference" placeholder="reference :" required class="form form-control"> <br><br>
			<lable for="floatingTextarea2"><input type="text" name="marque" placeholder="entrer le nom de marque" required="" class="form form-control"></label><br><br>



			   <select name="p_cat" class="form-control">

				<?php

				$db = mysqli_connect('localhost','root','','articles'); 

				$get_c = "select * from categories";

				$run_c = mysqli_query($db, $get_c);

				while($row_c = mysqli_fetch_array($run_c)) {

				?>

				<option value="<?php echo $row_c['cat_id']; ?>"><?php echo $row_c['catname']; ?></option>

				 <?php } ?>

			   </select> <br><br>

			   <select name="p_subcat" class="form-control">

				<?php

				$db = mysqli_connect('localhost','root','','articles'); 

				$get_c = "select * from subcat";

				$run_c = mysqli_query($db, $get_c);

				while($row_c = mysqli_fetch_array($run_c)) {

				?>

				<option value="<?php echo $row_c['subcat_id']; ?>"><?php echo $row_c['catname']; ?> - <?php echo $row_c['subcat_name']; ?></option>

				 <?php } ?>

		     	</select> <br><br>


			<lable for="floatingTextarea2"><textarea type="text" name="contenu" placeholder="entrer le contenu de produit .." required="" class="form-control" aria-label="With textarea"></textarea></label><br><br>
			<lable for="floatingTextarea2"><input type="text" name="p_key_word" placeholder="keywords" required="" class="form form-control"></label><br><br>
			<lable for="floatingTextarea2"><input type="file" name="fichier"></label><br><br>
			<lable for="floatingTextarea2"><input type="text" name="prix" placeholder="entrer prix de produit" required="" class="form form-control"></label><br>
			<lable for="floatingTextarea2"><input type="text" name="quantity" placeholder="entrer quantity" required="" class="form form-control"></label><br>
			<lable for="floatingTextarea2"><input type="text" name="stock" placeholder="entrer si en stock ou non" required="" class="form form-control"></label><br>
			<lable for="date"><input type="date" name="date_creation" id="date" placeholder="entrer date de création" required="" class="form form-control"></label><br>
			<lable for="floatingTextarea2"><input type="submit" name="submit" class="btn btn-primary"></label><br><br>
			</form>

		    </div>

			
     <!-- Bootsrap JS CDN -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>