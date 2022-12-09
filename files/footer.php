     <!-- footer -->

    <section id="foooter" class="mt-5 py-5">

        <div class="row container mx-auto pt-1">
            <div class="footer-one col-lg-3 col-md-6 col-12">
                <a class="navbar-brand" href="./index.php" style="color: white;"><b>Cara.</b></a>
                <p class="pt-2">Notre website CARA. est un plateforme en ligne spécialisé dans la vente de la plus dernière modes avec la possibilité de livrer sur tout le territoire de la République Tunisiene .</p>
                <a href="#"><i class="fab fa-facebook-square" style="font-size: 20px; color: white; padding-right: 5px;"></i></a>
                <a href="#"><i class="fab fa-instagram" style="font-size: 20px; color: white; padding-right: 5px;"></i></a>
                <a href="#"><i class="fab fa-linkedin" style="font-size: 20px; color: white; padding-right: 5px;"></i></a>
                <a href="#"><i class="fab fa-twitter" style="font-size: 20px; color: white; padding-right: 5px;"></i></a>
                <br><br>
            </div>

             <div class="footer-one col-lg-3 col-md-6 col-12">

                <h5 class="pb-2">Accés rapide</h5>

                              <?php if (isset($_SESSION['SESSION_PSEUDO'])):?>
                <ul class="navbar-nav ml-auto">
                  <li class="nav-item pt-auto"><a class="nav-link" href="./user/profil.php">Mon profil</a></li>
                  <li class="nav-item pt-auto"><a class="nav-link" href="./user/profil.php?order">Mes commandes </a></li>
                  <li class="nav-item pt-auto"><a class="nav-link" href="./logout.php">Se déconecter </a></li>
                </ul>   

                                <?php else: ?>
               <ul class="navbar-nav ml-auto">
                  <li class="nav-item pt-auto"><a class="nav-link" href="" data-bs-toggle="modal" data-bs-target="#ModalForm">Login</a></li>
                  <li class="nav-item pt-auto"><a class="nav-link" href="./inscription.php">S'inscrire</a></li>
              </ul>     

                                <?php endif ?>

            </div>

         <div class="footer-one col-lg-3 col-md-6 col-12">
                <h5 class="pb-2">Contact</h5>
                <div>
                    <h5 class="text-uppercase">Address</h5>
                    <p>Béja , Medjez el beb , 9070</p>
                </div>
                <div>
                    <h5 class="text-uppercase">Téléphone</h5>
                    <p>+(216) 43 513 874</p>
                </div>
               <div>
                    <h5 class="text-uppercase">Email</h5>
                    <p>CARA@GMAIL.COM</p>
                </div>
         
        </div>
             <div class="footer-one col-lg-3 col-md-6 col-12">
                
                <h5 class="pb-2">Catégories</h5>


                <ul class="navbar-nav ml-auto">
                  <li class="nav-item pt-auto"><a class="nav-link" href="./cat.php?cat=1">Homme</a></li>
                  <li class="nav-item pt-auto"><a class="nav-link" href="./cat.php?cat=2">Femme </a></li>
                  <li class="nav-item pt-auto"><a class="nav-link" href="./cat.php?cat=3">Enfatns - filles </a></li>
                  <li class="nav-item pt-auto"><a class="nav-link" href="./cat.php?cat=4">Enfatns - Garcons </a></li>
                  <li class="nav-item pt-auto"><a class="nav-link" href="./cat.php?cat=5">Bébés - Filles </a></li>
                  <li class="nav-item pt-auto"><a class="nav-link" href="./cat.php?cat=6">Bébés - Garcons </a></li>
                  <li class="nav-item pt-auto"><a class="nav-link" href="./cat.php?cat=7">Accessoires </a></li>
                  </li>
                  </ul>
            </div>
       </div>
        </div>
        <div class="copyright">
            <div class="row container mx-auto">
                <div class="col-lg-3 col-md-6 col-12">
                </div>
                     <div class="col-lg-4 col-md-6 col-12 text-nowrap">
                        <p class="text-center">CARA Company. © 2022. All Rights Reserved</p>
                 </div>

            </div>
            
        </div>



    </section>

<!-- Bootsrap JS CDN -->
<script src="./Js/popper.min.js"></script>
<script src="./Js/bootstrap.min.js"></script>
<!-- My Js -->
<script type="text/javascript" src="./Js/scroll.js"></script>
</body>
</html>