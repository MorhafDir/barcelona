<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="css/prijzen.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <title>Fietsen | Verrassend Barcelona</title>
</head>

<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_GET['logout'])){
   unset($user_id);
   session_destroy();
   header('location:login.php');
};

if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($select_cart) > 0){
      $message[] = 'you have added the product!';
   }else{
      mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, image, quantity) VALUES('$user_id', '$product_name', '$product_price', '$product_image', '$product_quantity')") or die('query failed');
      $message[] = 'you are adding the product!';
   }

};

if(isset($_POST['update_cart'])){
   $update_quantity = $_POST['cart_quantity'];
   $update_id = $_POST['cart_id'];
   mysqli_query($conn, "UPDATE `cart` SET quantity = '$update_quantity' WHERE id = '$update_id'") or die('query failed');
   $message[] = 'it is succefull!';
}

if(isset($_GET['remove'])){
   $remove_id = $_GET['remove'];
   mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$remove_id'") or die('query failed');
   header('location:prijzen.php');
}
  
if(isset($_GET['delete_all'])){
   mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
   header('location:prijzen.php');
}

?>

<body>
  <div class="fixedbar">

    <div class="topnav">
      <div class="logo">
        <img src="images/vblogo.png" alt="obama">
      </div>


      <div class="search-container">
      <form action="">
          <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search..." name="search" title="Type in a name">
          <button type="submit"><i class="fa fa-search"></i></button>
        </form>
      </div>
    </div>
    <div class="content">
      <div class="w3-container w3-center">
      <h2 class="textcolorbruh">
        <b>Verrassend Barcelona - fietsverhuur & rondleidingen
        </b>      </h2>
      <div class="menu-nav">
        <div class="menu-item"><a href="homepage.php">Home</a></div>

        <div class="menu-item"><a href="reserveren.php">Registreren</a>
        </div>
        <div class="menu-item"><a href="informatie.php">Informatie</a>
        </div>

        <div class="menu-item"><a href="prijzen.php">Winkelwagen</a>
        </div>
      </div>
    </div>
  </div>
  </div>
  </div>
  </div>

  

  </div>
  <br /><br />
  <div class="fixedinhoud">
    <div class="info">
      <h1>De prijzen van de Fietsverhuur en/of Rondleidingen in Barcelona!</h1>
      <p>
        Gelukkig is Verassend Barcelona voordelig waardoor iedereen een fiets of tour kan betalen.
        <br />
      </p>
    </div>

    <div class="info">
      <h1>Prijzen van de huurfietsen!</h1>
      <p>
        De prijzen voor <b>ALLE</b> huurfietsen zijn <b>15,00 euro per 4 uur</b>.
        <br /><br />
        Wilt u meer informatie over welke huurfietsen wij hebben? Klik hieronder.
        <br /><br />

        <center>
        <h3>Alle Producten</h3>
    </center>
    <main>

        <a href="informatie.php"><button>Informatie over de fietsen!</button></a>
      </p>
    </div>

<div class="info">

<h1 class="heading">Winkelwagen</h1>

<table>
   <thead>
      <th>Foto</th>
      <th>Soort</th>
      <th>Prijs</th>
      <th>Aantal</th>
      <th>Totale prijs    </th>
      <th> Verwijderen?</th>
   </thead>
   <tbody>
   <?php
   include('config.php');
      $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
      $grand_total = 0;
      if(mysqli_num_rows($cart_query) > 0){
         while($fetch_cart = mysqli_fetch_assoc($cart_query)){
   ?>
      <tr>
         <td><img src="admin/<?php echo $fetch_cart['image']; ?>" height="75" alt=""></td>
         <td><?php echo $fetch_cart['name']; ?></td>
         <td><?php echo $fetch_cart['price']; ?>$</td>
         <td>
            <form action="" method="post">
               <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id']; ?>">
               <input type="number" min="1" name="cart_quantity" value="<?php echo $fetch_cart['quantity']; ?>">
               <input type="submit" name="update_cart" value="update" class="option-btn">
            </form>
         </td>
         <td><?php echo $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?>$</td>
         <td><a href="prijzen.php?remove=<?php echo $fetch_cart['id']; ?>" class="delete-btn" onclick="return confirm('delete product');">delete</a></td>
      </tr>
   <?php
      $grand_total += $sub_total;
         }
      }else{
         echo '<tr><td style="padding:20px; text-transform:capitalize;" colspan="6">empty cart</td></tr>';
      }
   ?>
   <tr class="table-bottom">
      <td colspan="4"> Total price :</td>
      <td><?php echo $grand_total; ?>$</td>
      <td><a href="prijzen.php?delete_all" onclick="return confirm('delete all from cart');" class="delete-btn <?php echo ($grand_total > 1)?'':'disabled'; ?>">Delete All</a></td>
   </tr>
</tbody>
</table>



</div>


    <br /><br />



    <br /><br />
    <div class="footer">
      <p>
        Gemaakt door: Ahmed Ridha, Bukhari Igueh, Morhaf Derbas & Masoud Khasismatouri!</a>
        <br /><br />
        Disclaimer: de foto's zijn voorbeelden.
      </p>
      <p>FIETSVERHUUR & RONDLEIDINGEN BARCA &copy; 2022</p>
    </div>
  </div>

</body>

</html>