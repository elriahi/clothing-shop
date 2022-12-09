<?php 

// !-- MAiN FUNCTION PAGE -- !
// DB CONNECTION

$db = mysqli_connect('localhost','root','','articles');

// Get IP

function getIp() {

	$ip = $_SERVER['REMOTE_ADDR'];

	if(!empty($_SERVER['HTTP_CLIENT_IP']))
	{

		$ip = $_SERVER['HTTP_CLIENT_IP'];
	}

	elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) 
	{

		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	}

   return $ip;

}

// Cart Function (tous les produits)

function cart() {

if(isset($_GET['add_cart'])) {

    $id_produit = (int)$_GET['add_cart'];

    global $db;

    // tous les produits ( GET )
    $qty = isset($_GET['qty']) ? $_GET['qty'] : '1'; 
    $_SESSION['qty'] = $qty;
    $size = isset($_GET['size']) ? $_GET['size'] : 'XL';
    $_SESSION['size'] = $size;
    $p_cat = 'tous_les_produits'; // $_POST insert into column p_cat



    // tous les produits ( Price )
    $price_pro = "SELECT * from tous_produits where id_produit = '$id_produit'";
    $run_price_pro = mysqli_query($db, $price_pro); 
    while($row_pro_price = mysqli_fetch_array($run_price_pro)) {
    $p_reference = $row_pro_price['reference'];
    $marque = $row_pro_price['marque'];
    $p_single_p = $row_pro_price['prix'];
    }


     $p_final = $p_single_p*$qty;
     $_SESSION['p_final'] = $p_final; // calcul prix total

	$ip = getIp();

	$get_cart = "SELECT * from cart where ip_add = '$ip' AND id_produit = '$id_produit'";
	$run_cart = mysqli_query($db, $get_cart);
	if(mysqli_num_rows($run_cart) > 0 ) {

      echo "<script>
      alert('Ce produit déjà dans votre panier !');
      window.location.href='http://localhost/projet/cart.php';
      </script>";

	}

	else

	{

    $tous_produits = "INSERT into cart(id_produit,marque,reference,p_cat,ip_add,qty,size,pfinal) VALUES('$id_produit','$marque','$p_reference','$p_cat','$ip','$qty','$size','$p_final')";
    $run_query_1 = mysqli_query($db,$tous_produits);

      if(isset($run_query_1)) {

      echo "<script>
      alert('Ce produit a été ajouté dans votre panier !');
      window.location.href='http://localhost/projet/cart.php';
      </script>";

       }
         
         }	
         }
         }

 // CART ( Arrivals )

function cart_arrivals() {

if(isset($_GET['add_cart'])) {

    $id_produit = (int)$_GET['add_cart'];

    global $db;

    // Arrivals ( GET )
    $qty_B = isset($_GET['qty_B']) ? $_GET['qty_B'] : '1'; 
    $_SESSION['qty_B'] = $qty_B;
    $size_B = isset($_GET['size_B']) ? $_GET['size_B'] : 'XL';
    $_SESSION['size_B'] = $size_B;
    $p_cat_2= 'arrivals'; // $_POST insert into column p_cat


    // arrivals (Price)
    $price_pro_1 = "SELECT * from arrivals where id_produit = '$id_produit'";
    $run_price_pro_1 = mysqli_query($db, $price_pro_1);
    while($row_pro_price_1 = mysqli_fetch_array($run_price_pro_1)) {
    $p_reference_2 = $row_pro_price_1['reference'];
    $marque2 = $row_pro_price_1['marque'];
    $p_single_p_B = $row_pro_price_1['prix'];
     }

    $p_final_B = $p_single_p_B*$qty_B;
    $_SESSION['p_final_B'] = $p_final_B; // calcul prix total

       $ip = getIp();

       $get_cart = "SELECT * from cart where ip_add = '$ip' AND id_produit = '$id_produit'";
       $run_cart = mysqli_query($db, $get_cart);

     if(mysqli_num_rows($run_cart) > 0 ) {

      echo "<script>
      alert('Ce produit déjà dans votre panier !');
      window.location.href='http://localhost/projet/index.php';
      </script>";

      }

    else

    {

    $arrivals = "INSERT INTO cart(id_produit,reference,marque,p_cat,ip_add,qty,size,pfinal) VALUES('$id_produit','$marque2','$p_reference_2','$p_cat_2','$ip','$qty_B','$size_B','$p_final_B')";
    $run_query_2 = mysqli_query($db,$arrivals);

      if(isset($run_query_2)) {

      echo "<script>
      alert('Ce produit a été ajouté dans votre panier !');
      window.location.href='http://localhost/projet/cart.php';
      </script>";

       }
         
         }  
         }
         }

// Cart function ( Produits populaires )  

function cart_all_articles() {

if(isset($_GET['add_cart'])) {

    $id_produit = (int)$_GET['add_cart'];

    global $db;

    // All_articles ( GET )
    $qty_A = isset($_GET['qty_A']) ? $_GET['qty_A'] : '1'; 
    $_SESSION['qty_A'] = $qty_A;
    $size_A = isset($_GET['size_A']) ? $_GET['size_A'] : 'XL';
    $_SESSION['size_A'] = $size_A;
    $p_cat_3 = 'all_articles '; // $_POST insert into column p_cat


    // all articles (Price)
    $price_pro_2 = "SELECT * from all_articles where id_produit = '$id_produit'";
    $run_price_pro_2 = mysqli_query($db, $price_pro_2);
    while($row_pro_price_2 = mysqli_fetch_array($run_price_pro_2)) {
    $p_reference_3 = $row_pro_price_2['reference'];
    $marque3 = $row_pro_price_2['marque'];
    $p_single_p_A = $row_pro_price_2['prix'];
     }

    $p_final_A = $p_single_p_A*$qty_A;
    $_SESSION['p_final_A'] = $p_final_A; // calcul prix total

       $ip = getIp();

       $get_cart = "SELECT * from cart where ip_add = '$ip' AND id_produit = '$id_produit'";
       $run_cart = mysqli_query($db, $get_cart);
       if(mysqli_num_rows($run_cart) > 0 ) {

      echo '<script>
      alert("Ce produit déjà dans votre panier !");
      window.location.href="http://localhost/projet/index.php";
      </script>';

      }

    else

    {

    $all_articles = "INSERT INTO cart(id_produit,marque,reference,p_cat,ip_add,qty,size,pfinal) VALUES('$id_produit','$marque3','$p_reference_3','$p_cat_3','$ip','$qty_A','$size_A','$p_final_A')";
    $run_query_3 = mysqli_query($db,$all_articles);

      if(isset($run_query_3)) {

      echo "<script>
      alert('Ce produit a été ajouté dans votre panier !');
      window.location.href='http://localhost/projet/cart.php';
      </script>";

       }
         
         }  
         }
         }

// Cart function (Robes )

function cart_robes() {

if(isset($_GET['add_cart'])) {

    $id_produit = (int)$_GET['add_cart'];

    global $db;

    // Robes ( GET )

    $qty_R = isset($_GET['qty_R']) ? $_GET['qty_R'] : '1'; 
    $_SESSION['qty_R'] = $qty_R;
    $size_R = isset($_GET['size_R']) ? $_GET['size_R'] : 'XL';
    $_SESSION['size_R'] = $size_R;
    $p_cat_4 = 'Robes '; // $_POST insert into column p_cat


    // Robes (Price)

    $price_pro_2 = "SELECT * from robes where id_produit = '$id_produit'";
    $run_price_pro_2 = mysqli_query($db, $price_pro_2);
    while($row_pro_price_3 = mysqli_fetch_array($run_price_pro_2)) {
    $p_reference_4 = $row_pro_price_3['reference'];
    $marque4 = $row_pro_price_3['marque'];
    $p_single_p_R = $row_pro_price_3['prix'];
     }

    $p_final_R = $p_single_p_R*$qty_R;
    $_SESSION['p_final_R'] = $p_final_R; // calcul prix total

       $ip = getIp();

       $get_cart = "SELECT * from cart where ip_Rdd = '$ip' AND id_produit = '$id_produit'";
       $run_cart = mysqli_query($db, $get_cart);
       if(mysqli_num_rows($run_cart) > 0 ) {

      echo "<script>
      alert('Ce produit déjà dans votre panier !');
      window.location.href='http://localhost/projet/index.php';
      </script>";

      }

    else

    {

    $robes = "INSERT INTO cart(id_produit,marque,reference,p_cat,ip_add,qty,size,pfinal) VALUES('$id_produit','$marque4','$p_reference_4','$p_cat_4','$ip','$qty_R','$size_R','$p_final_R')";
    $run_query_4 = mysqli_query($db,$robes);

      if(isset($run_query_4)) {

      echo "<script>
      alert('Ce produit a été ajouté dans votre panier !');
      window.location.href='http://localhost/projet/cart.php';
      </script>";

       }
         
         }  
         }
         }

// Cart function (Montres)

 function cart_montres() {

if(isset($_GET['add_cart'])) {

    $id_produit = (int)$_GET['add_cart'];

    global $db;

    // Montres ( GET )
    $qty_M = isset($_GET['qty_M']) ? $_GET['qty_M'] : '1'; 
    $_SESSION['qty_M'] = $qty_M;
    $size_M = isset($_GET['size_M']) ? $_GET['size_M'] : 'XL';
    $_SESSION['size_M'] = $size_M;
    $p_cat_5 = 'Montres'; // $_POST insert into column p_cat


    // arrivals (Price)
    $price_pro_2 = "SELECT * from montres where id_produit = '$id_produit'";
    $run_price_pro_2 = mysqli_query($db, $price_pro_2);
    while($row_pro_price_4 = mysqli_fetch_array($run_price_pro_2)) {
    $p_reference_5 = $row_pro_price_4['reference'];
    $marque5 = $row_pro_price_4['marque'];
    $p_single_p_M = $row_pro_price_4['prix'];
     }

    $p_final_M = $p_single_p_M*$qty_M;
    $_SESSION['p_final_M'] = $p_final_M; // calcul prix total

       $ip = getIp();

       $get_cart = "SELECT * from cart where ip_Rdd = '$ip' AND id_produit = '$id_produit'";
       $run_cart = mysqli_query($db, $get_cart);
       if(mysqli_num_rows($run_cart) > 0 ) {

      echo "<script>
      alert('Ce produit déjà dans votre panier !');
      window.location.href='http://localhost/projet/index.php';
      </script>";

      }

    else

    {

    $montres = "INSERT INTO cart(id_produit,marque,reference,p_cat,ip_add,qty,size,pfinal) VALUES('$id_produit','$marque5','$p_reference_5','$p_cat_5','$ip','$qty_M','$size_M','$p_final_M')";
    $run_query_5 = mysqli_query($db,$montres);

      if(isset($run_query_5)) {

      echo "<script>
      alert('Ce produit a été ajouté dans votre panier !');
      window.location.href='http://localhost/projet/cart.php';
      </script>";

       }
         
         }  
         }
         }        
         
// total items

function total_item() {

	if(isset($_GET['add_cart'])) {

		global $db;

		$ip = getIp();

		$get_total = "select * from cart where ip_add = '$ip'";

		$run_total = mysqli_query($db, $get_total);

		$total_item = mysqli_num_rows($run_total);

	}
	else
	{

		global $db;

		$ip = getIp();

		$get_total = "select * from cart where ip_add = '$ip'";

		$run_total = mysqli_query($db, $get_total);

		$total_item = mysqli_num_rows($run_total);
	}

	echo $total_item;
    }

 // total price
 
 function total_price() {

 	global $db;

 	$total = 0;

 	$ip = getIp();   

 	$t_price = "select * from cart where ip_add = '$ip'";

 	$run_price = mysqli_query($db, $t_price);

 	while($row_t_price = mysqli_fetch_array($run_price)) {

 		$id_produit = $row_t_price['id_produit'];

 		$price_pro = "select * from cart where id_produit ='$id_produit'";

 		$run_price_pro = mysqli_query($db, $price_pro);


 		while($row_pro_price = mysqli_fetch_array($run_price_pro)) {

 			$pro_price = array($row_pro_price['pfinal']);

 			$values = array_sum($pro_price);

 			$total +=$values; 

 		}

         }

        echo $total;

 	}

// Get categories

function get_cat() {

	global $db;

	$get_cat = "SELECT * from categories";

	$run_cat = mysqli_query($db, $get_cat);

	while($row_cat = mysqli_fetch_array($run_cat)) {

		echo '<li><a class="dropdown-item dropdown-toggle" href="cat.php?cat='.$row_cat['cat_id'].'">'.$row_cat['catname'].'</a>';

	}
}



// get subcat

function get_subcat() {

    global $db;

    $get_catname = "SELECT * from categories";

    $run_catname = mysqli_query($db, $get_catname);

    $check = mysqli_num_rows($run_catname);

    if($check > 0) {

        while($data= mysqli_fetch_assoc($run_catname)) {

        $catname = $data['catname'];

        $get_subcat = "SELECT * from subcat where catname ='$catname' AND subcat_display='Oui' ";

        $run_subcat = mysqli_query($db, $get_subcat);

        while($row_subcat = mysqli_fetch_array($run_subcat)) {

        echo '<li><a class="dropdown-item" href="subcat.php?subcat='.$row_subcat['subcat_id'].'">'.$row_subcat['subcat_name'].'</a></li>';

    }
        }
    }


}



// get product by cat ( tous les produits )
function get_pro_cat() {

	global $db;

	if(isset($_GET['cat'])) {

		$cat = (int)$_GET['cat'];

        // Main table of products

		$get_pro_cat = "select * from tous_produits where p_cat = '$cat' ";
 
		$run_pro_cat = mysqli_query($db, $get_pro_cat);

		if(mysqli_num_rows($run_pro_cat) > 0 ) {

			while($row_pro_cat = mysqli_fetch_array($run_pro_cat)) {

				echo '

                       <div class="product text-center col-lg-3 col-d col-12">

                        <img class="img-fluid mb-3" src="login/images/'.$row_pro_cat['images_name'].'" alt="product image">

                        <div class="star">

                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>

                        </div>

                        <h5 class="p-name">'.$row_pro_cat['marque'].'</h5>
                        <h4 class="p-price">'.$row_pro_cat['prix'].' DT</h4>

                        <a href="produit.php?id='.$row_pro_cat['id_produit'].'" style="color: white;" class="btn buy-btn" role="button">Acheter</a>

                     </div>
                ';

			}
		}


	}
}
// get product by cat ( All Articles)

function get_pro_cat_2() {

    global $db;

    if(isset($_GET['cat'])) {

        $cat = (int)$_GET['cat'];

        $get_pro_cat = "select * from all_articles where p_cat = '$cat' ";
 
        $run_pro_cat = mysqli_query($db, $get_pro_cat);

        if(mysqli_num_rows($run_pro_cat) > 0 ) {

            while($row_pro_cat = mysqli_fetch_array($run_pro_cat)) {

                echo '

                       <div class="product text-center col-lg-3 col-d col-12">

                        <img class="img-fluid mb-3" src="login/images/'.$row_pro_cat['images_name'].'" alt="product image">

                        <div class="star">

                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>

                        </div>

                        <h5 class="p-name">'.$row_pro_cat['marque'].'</h5>
                        <h4 class="p-price">'.$row_pro_cat['prix'].' DT</h4>

                        <a href="p_populaires.php?id='.$row_pro_cat['id_produit'].'" style="color: white;" class="btn buy-btn" role="button">Acheter</a>

                     </div>
                ';

            }
        }


    }
}
// get product by cat ( arrivals )
function get_pro_cat_3() {

    global $db;

    if(isset($_GET['cat'])) {

        $cat = (int)$_GET['cat'];

        $get_pro_cat = "select * from arrivals where p_cat = '$cat' ";
 
        $run_pro_cat = mysqli_query($db, $get_pro_cat);

        if(mysqli_num_rows($run_pro_cat) > 0 ) {

            while($row_pro_cat = mysqli_fetch_array($run_pro_cat)) {

                echo '   

                       <div class="product text-center col-lg-3 col-d col-12">

                        <img class="img-fluid mb-3" src="login/images/'.$row_pro_cat['images_name_arrivals'].'" alt="product image">

                        <div class="star">

                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>

                        </div>

                        <h5 class="p-name">'.$row_pro_cat['marque'].'</h5>
                        <h4 class="p-price">'.$row_pro_cat['prix'].' DT</h4>

                        <a href="p_arrivals.php?id='.$row_pro_cat['id_produit'].'" style="color: white;" class="btn buy-btn" role="button">Acheter</a>

                     </div>
                ';

            }
        }


    }
}
//get product by cat ( robes)
function get_pro_cat_4() {

    global $db;

    if(isset($_GET['cat'])) {

        $cat = (int)$_GET['cat'];

        $get_pro_cat = "select * from robes where p_cat = '$cat' ";
 
        $run_pro_cat = mysqli_query($db, $get_pro_cat);

        if(mysqli_num_rows($run_pro_cat) > 0 ) {

            while($row_pro_cat = mysqli_fetch_array($run_pro_cat)) {

                echo '

                        

                       <div class="product text-center col-lg-3 col-d col-12">

                        <img class="img-fluid mb-3" src="login/images/'.$row_pro_cat['images_name_robes'].'" alt="product image">

                        <div class="star">

                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>

                        </div>

                        <h5 class="p-name">'.$row_pro_cat['marque'].'</h5>
                        <h4 class="p-price">'.$row_pro_cat['prix'].' DT</h4>

                        <a href="p_robes.php?id='.$row_pro_cat['id_produit'].'" style="color: white;" class="btn buy-btn" role="button">Acheter</a>

                     </div>
                ';

            }
        }


    }
}
// get product by car ( montres )
function get_pro_cat_5() {

    global $db;

    if(isset($_GET['cat'])) {

        $cat = (int)$_GET['cat'];

        $get_pro_cat = "select * from montres where p_cat = '$cat' ";
 
        $run_pro_cat = mysqli_query($db, $get_pro_cat);

        if(mysqli_num_rows($run_pro_cat) > 0 ) {

            while($row_pro_cat = mysqli_fetch_array($run_pro_cat)) {

                echo '

                       <div class="product text-center col-lg-3 col-d col-12">

                        <img class="img-fluid mb-3" src="login/images/'.$row_pro_cat['images_name_montres'].'" alt="product image">

                        <div class="star">

                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>

                        </div>

                        <h5 class="p-name">'.$row_pro_cat['marque'].'</h5>
                        <h4 class="p-price">'.$row_pro_cat['prix'].' DT</h4>

                        <a href="p_montres.php?id='.$row_pro_cat['id_produit'].'" style="color: white;" class="btn buy-btn" role="button">Acheter</a>

                     </div>
                ';

            }
        }


    }
}

// Get product by subcat ( tous les produits )
function get_pro_subcat() {

    global $db;

    if(isset($_GET['subcat'])) {

        $subcat = (int)$_GET['subcat'];

        // Main table of products

        $get_pro_cat = "select * from tous_produits where p_subcat = '$subcat' ";
 
        $run_pro_cat = mysqli_query($db, $get_pro_cat);

        if(mysqli_num_rows($run_pro_cat) > 0 ) {

            while($row_pro_cat = mysqli_fetch_array($run_pro_cat)) {

                echo '

                       <div class="product text-center col-lg-3 col-d col-12">

                        <img class="img-fluid mb-3" src="login/images/'.$row_pro_cat['images_name'].'" alt="product image">

                        <div class="star">

                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>

                        </div>

                        <h5 class="p-name">'.$row_pro_cat['marque'].'</h5>
                        <h4 class="p-price">'.$row_pro_cat['prix'].' DT</h4>

                        <a href="produit.php?id='.$row_pro_cat['id_produit'].'" style="color: white;" class="btn buy-btn" role="button">Acheter</a>

                     </div>
                ';

            }
        }


    }
}
// Get product by subcat ( all_articles )
function get_pro_subcat_2() {

    global $db;

    if(isset($_GET['subcat'])) {

        $subcat = (int)$_GET['subcat'];

        // Main table of products

        $get_pro_cat = "select * from all_articles where p_subcat = '$subcat' ";
 
        $run_pro_cat = mysqli_query($db, $get_pro_cat);

        if(mysqli_num_rows($run_pro_cat) > 0 ) {

            while($row_pro_cat = mysqli_fetch_array($run_pro_cat)) {

                echo '

                       <div class="product text-center col-lg-3 col-d col-12">

                        <img class="img-fluid mb-3" src="login/images/'.$row_pro_cat['images_name'].'" alt="product image">

                        <div class="star">

                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>

                        </div>

                        <h5 class="p-name">'.$row_pro_cat['marque'].'</h5>
                        <h4 class="p-price">'.$row_pro_cat['prix'].' DT</h4>

                        <a href="p_populaires.php?id='.$row_pro_cat['id_produit'].'" style="color: white;" class="btn buy-btn" role="button">Acheter</a>

                     </div>
                ';

            }
        }


    }
}
// Get product by subcat ( Arrivals )
function get_pro_subcat_3() {

    global $db;

    if(isset($_GET['subcat'])) {

        $subcat = (int)$_GET['subcat'];

        // Main table of products

        $get_pro_cat = "select * from arrivals where p_subcat = '$subcat' ";
 
        $run_pro_cat = mysqli_query($db, $get_pro_cat);

        if(mysqli_num_rows($run_pro_cat) > 0 ) {

            while($row_pro_cat = mysqli_fetch_array($run_pro_cat)) {

                echo '

                       <div class="product text-center col-lg-3 col-d col-12">

                        <img class="img-fluid mb-3" src="login/images/'.$row_pro_cat['images_name_arrivals'].'" alt="product image">

                        <div class="star">

                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>

                        </div>

                        <h5 class="p-name">'.$row_pro_cat['marque'].'</h5>
                        <h4 class="p-price">'.$row_pro_cat['prix'].' DT</h4>

                        <a href="p_arrivals.php?id='.$row_pro_cat['id_produit'].'" style="color: white;" class="btn buy-btn" role="button">Acheter</a>

                     </div>
                ';

            }
        }


    }
}
// Get product by subcat ( Montres )
function get_pro_subcat_4() {

    global $db;

    if(isset($_GET['subcat'])) {

        $subcat = (int)$_GET['subcat'];

        // Main table of products

        $get_pro_cat = "select * from montres where p_subcat = '$subcat' ";
 
        $run_pro_cat = mysqli_query($db, $get_pro_cat);

        if(mysqli_num_rows($run_pro_cat) > 0 ) {

            while($row_pro_cat = mysqli_fetch_array($run_pro_cat)) {

                echo '

                       <div class="product text-center col-lg-3 col-d col-12">

                        <img class="img-fluid mb-3" src="login/images/'.$row_pro_cat['images_name_montres'].'" alt="product image">

                        <div class="star">

                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>

                        </div>

                        <h5 class="p-name">'.$row_pro_cat['marque'].'</h5>
                        <h4 class="p-price">'.$row_pro_cat['prix'].' DT</h4>

                        <a href="p_montres.php?id='.$row_pro_cat['id_produit'].'" style="color: white;" class="btn buy-btn" role="button">Acheter</a>

                     </div>
                ';

            }
        }


    }
}
// Get product by subcat ( Robes )
function get_pro_subcat_5() {

    global $db;

    if(isset($_GET['subcat'])) {

        $subcat = (int)$_GET['subcat'];

        // Main table of products

        $get_pro_cat = "select * from robes where p_subcat = '$subcat' ";
 
        $run_pro_cat = mysqli_query($db, $get_pro_cat);

        if(mysqli_num_rows($run_pro_cat) > 0 ) {

            while($row_pro_cat = mysqli_fetch_array($run_pro_cat)) {

                echo '

                       <div class="product text-center col-lg-3 col-d col-12">

                        <img class="img-fluid mb-3" src="login/images/'.$row_pro_cat['images_name_robes'].'" alt="product image">

                        <div class="star">

                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>

                        </div>

                        <h5 class="p-name">'.$row_pro_cat['marque'].'</h5>
                        <h4 class="p-price">'.$row_pro_cat['prix'].' DT</h4>

                        <a href="p_robes.php?id='.$row_pro_cat['id_produit'].'" style="color: white;" class="btn buy-btn" role="button">Acheter</a>

                     </div>
                ';

            }
        }


    }
}



// Get products by search

function get_pro_search() {

global $db;

if (isset($_GET['search'])) {

$searchArea = $_GET['searchArea'];

$get_pro_search = "select * from tous_produits where p_key_word like '%$searchArea%'"; // tous_produis

$run_pro_search = mysqli_query($db, $get_pro_search); // tous_produits

$get_pro_search_2 = "select * from all_articles where p_key_word like '%$searchArea%'"; // all_articles (populaires) 

$run_pro_search_2 = mysqli_query($db, $get_pro_search_2); // all_articles (populaires) 

$get_pro_search_3 = "select * from arrivals where p_key_word like '%$searchArea%'"; // arrivals (new arrivals) 

$run_pro_search_3 = mysqli_query($db, $get_pro_search_3); // arrivals (new arrivals) 

$get_pro_search_4 = "select * from robes where p_key_word like '%$searchArea%'"; // robes

$run_pro_search_4 = mysqli_query($db, $get_pro_search_4); // robes

$get_pro_search_5 = "select * from montres where p_key_word like '%$searchArea%'"; // montres

$run_pro_search_5 = mysqli_query($db, $get_pro_search_5); // montres

// tous produits
if (mysqli_num_rows($run_pro_search) > 0 ) {

			while($row_pro_search = mysqli_fetch_array($run_pro_search)) {

				echo '
                       <div class="product text-center col-lg-3 col-d col-12">

                        <img class="img-fluid mb-3" src="login/images/'.$row_pro_search['images_name'].'" alt="product image">

                        <div class="star">

                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>

                        </div>

                        <h5 class="p-name">'.$row_pro_search['marque'].'</h5>
                        <h4 class="p-price">'.$row_pro_search['prix'].' TD</h4>

                        <a href="produit.php?id='.$row_pro_search['id_produit'].'" style="color: white;" class="btn buy-btn" role="button">Acheter</a>

                     </div>

				';

			}
		}
        // all_articles (populaires) 
        if (mysqli_num_rows($run_pro_search_2) > 0 ) {

            while($row_pro_search_2 = mysqli_fetch_array($run_pro_search_2)) {

                echo '
                       <div class="product text-center col-lg-3 col-d col-12">

                        <img class="img-fluid mb-3" src="login/images/'.$row_pro_search_2['images_name'].'" alt="product image">

                        <div class="star">

                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>

                        </div>

                        <h5 class="p-name">'.$row_pro_search_2['marque'].'</h5>
                        <h4 class="p-price">'.$row_pro_search_2['prix'].' TD</h4>

                        <a href="p_populaires.php?id='.$row_pro_search_2['id_produit'].'" style="color: white;" class="btn buy-btn" role="button">Acheter</a>

                     </div>

                ';

            }
        }
         // Arrivals (new arrivals) 
        if (mysqli_num_rows($run_pro_search_3) > 0 ) {

            while($row_pro_search_3 = mysqli_fetch_array($run_pro_search_3)) {

                echo '
                       <div class="product text-center col-lg-3 col-d col-12">

                        <img class="img-fluid mb-3" src="login/images/'.$row_pro_search_3['images_name_arrivals'].'" alt="product image">

                        <div class="star">

                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>

                        </div>

                        <h5 class="p-name">'.$row_pro_search_3['marque'].'</h5>
                        <h4 class="p-price">'.$row_pro_search_3['prix'].' TD</h4>

                        <a href="p_arrivals.php?id='.$row_pro_search_3['id_produit'].'" style="color: white;" class="btn buy-btn" role="button">Acheter</a>

                     </div>

                ';

            }
        }
         // Robes
        if (mysqli_num_rows($run_pro_search_4) > 0 ) {

            while($row_pro_search_4 = mysqli_fetch_array($run_pro_search_4)) {

                echo '
                       <div class="product text-center col-lg-3 col-d col-12">

                        <img class="img-fluid mb-3" src="login/images/'.$row_pro_search_4['images_name_robes'].'" alt="product image">

                        <div class="star">

                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>

                        </div>

                        <h5 class="p-name">'.$row_pro_search_4['marque'].'</h5>
                        <h4 class="p-price">'.$row_pro_search_4['prix'].' TD</h4>

                        <a href="p_robes.php?id='.$row_pro_search_4['id_produit'].'" style="color: white;" class="btn buy-btn" role="button">Acheter</a>

                     </div>

                ';

            }
        }
        // Montres
        if (mysqli_num_rows($run_pro_search_5) > 0 ) {

            while($row_pro_search_5 = mysqli_fetch_array($run_pro_search_5)) {

                echo '
                       <div class="product text-center col-lg-3 col-d col-12">

                        <img class="img-fluid mb-3" src="login/images/'.$row_pro_search_5['images_name_montres'].'" alt="product image">

                        <div class="star">

                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>

                        </div>

                        <h5 class="p-name">'.$row_pro_search_5['marque'].'</h5>
                        <h4 class="p-price">'.$row_pro_search_5['prix'].' TD</h4>

                        <a href="p_montres.php?id='.$row_pro_search_5['id_produit'].'" style="color: white;" class="btn buy-btn" role="button">Acheter</a>

                     </div>

                ';

            }
        }

       

}

}

// END


?>