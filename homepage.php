<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="css/style1.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <title>Homepage | Verrassend Barcelona</title>
</head>

<body>
  <div class="fixedbar">

    <div class="topnav">
      <div class="logo">
        <img src="images/vblogo.png" alt="obama">
      </div>

      <script>  
function myFunction(){
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>



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
          <b>Verrassend Barcelona - fietsverhuur & rondleidingen</b>
        </h2>
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
  <br /><br />
  <div class="fixedinhoud">
  <div>
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
   
<?php
if(isset($message)){
   foreach($message as $message){
      echo '<div class="message" onclick="this.remove();">'.$message.'</div>';
   }
}
?>

<div class="container">
<div class="user-profile">

<?php
   $select_user = mysqli_query($conn, "SELECT * FROM `users` WHERE id = '$user_id'") or die('query failed');
   if(mysqli_num_rows($select_user) > 0){
      $fetch_user = mysqli_fetch_assoc($select_user);
   };
?>
<p style="color:red;"> Gebruiker: <span><?php echo $fetch_user['name']; ?></span> </p>
<div class="flex">
   <a style="color:red;" href="homepage.php?logout=<?php echo $user_id; ?>" onclick="return confirm('Weet u zeker dat u wilt uitloggen?');" class="delete-btn">Log uit</a>
</div>


  </div>
  
    <div class="info">
      <h1>Fietsverhuur en/of Rondleidingen in Barcelona!</h1>
      <p>
        Huur nu voordelig fietsen en/of boek een rondleiding in Barcelona!
        <br />
        Ideaal voor een dagje uit in Barcelona!
        <br />
      </p>
    </div>
    <div class="info">
      <a href="informatie.php"><button>Klik voor meer informatie!</button></a>
    </div>

    <br /><br />

  </div>

<center>
<div class="products">
   <h1 class="heading">Alle producten</h1>

   <div class="box-container">

   <?php
   include('config.php');
   $result = mysqli_query($conn, "SELECT * FROM products");      
   while($row = mysqli_fetch_array($result)){
   ?>
      <form method="post" class="box" action="">
         <img src="admin/<?php echo $row['image']; ?>"  width="200">
         <div class="name"><?php echo $row['name']; ?></div>
         <div class="price"><?php echo $row['price']; ?></div>
         <input type="number" min="1" name="product_quantity" value="1">
         <input type="hidden" name="product_image" value="<?php echo $row['image']; ?>">
         <input type="hidden" name="product_name" value="<?php echo $row['name']; ?>">
         <input type="hidden" name="product_price" value="<?php echo $row['price']; ?>">
         <input type="submit" value="add to cart" name="add_to_cart" class="btn">
         <br><br>
      </form>
   <?php
      };
   ?>

   </div>

</div>
</center>


</div>

<br /><br />
    <div class="footer">
      <p>
        Gemaakt door: Ahmed Ridha, Bukhari Igueh, Morhaf Derbas & Masoud Khasismatouri!</a>
        <br /><br />
        Disclaimer: de foto's zijn voorbeelden.
      </p>
      <p>FIETSVERHUUR & RONDLEIDINGEN BARCA &copy; 2022</p>
    </div>

</body>
</html>