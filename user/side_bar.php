<div class="panel panel-default sidebar-menu">
	<div class="panel-heading" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;"> <!-- start panel heading -->


      <?php 
       $connect = mysqli_connect("localhost", "root", "", "articles");
       $client_session = $_SESSION['SESSION_PSEUDO'];
       $get_client = "SELECT * FROM membre WHERE pseudo = '$client_session' ";
       $run_g_c = mysqli_query($connect, $get_client);
       while($row=mysqli_fetch_array($run_g_c)) {
       echo '


		<center>
			<img src="usres_images/'.$row['main_img'].'" class="img-responsive pt-2" width="100% ">
		</center>
        <h3 align="center" class="panel-title pb-2 pt-1" style="font-family: Poppins;">'.$row['prenom'].' '.$row['nom'].'</h3>


       ';  

        }
      ?>

		</div> <!-- end of panel heading --> 
		<div class="panel-body" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
			<ul class="nav nav-pills nav-stacked" style="font-family: Poppins; justify-content: left; font-size: 14px;">
                <div class="mybarnav">

				<li class="<?php if(isset($_GET[order])) {echo "active";} ?> ">
				  <a href="profil.php?order" style="color: black;"><i class="fas fa-bags-shopping" style="color: black; margin-bottom: 15px; margin-top: 15px; margin-left: 13px; "></i> Mes commandes</a>	
				</li>

				<li class="<?php if(isset($_GET[edit_profil])) {echo "active";} ?> ">
				  <a href="profil.php?edit_profil" style="color: black;"><i class="fas fa-address-card" style="color: black; margin-bottom: 15px; margin-left: 13px;"></i>  Modifier profil / Adresse</a>	
				</li>

				<li class="<?php if(isset($_GET[change_password])) {echo "active";} ?> ">
				  <a href="profil.php?change_password" style="color: black;"><i class="fas fa-lock-alt" style="color: black; margin-bottom: 15px; margin-left: 13px;"></i>  Changer mot de passe</a>	
				</li>


				<li class="<?php if(isset($_GET[supprimer])) {echo "active";} ?> ">
				  <a href="profil.php?supprimer" style="color: black;"><i class="fas fa-minus-hexagon" style="color: black; margin-bottom: 15px; margin-left: 13px;"></i> Supprimer le compte</a>	
				</li>

				<li>
				  <a href="../logout.php" style="color: black;"><i class="fas fa-sign-out-alt" style="color: black; margin-bottom: 15px; margin-left: 13px;"></i> Se déconnecter</a>	
				</li>

			</div>
			
			</ul>	
	</div>
</div>