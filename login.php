<?php

include 'config.php';
session_start();

if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

   $select = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
      $row = mysqli_fetch_assoc($select);
      $_SESSION['user_id'] = $row['id'];
      header('location:homepage.php');
   }else{
      $message[] = 'incorrect password or email!';
   }

}

?>


<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="css/style1.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <title>login | Verrassend Barcelona</title>
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

          <div class="menu-item"><a href="reserveren.php">Registratie</a>
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
      <h1>Fietsverhuur en/of Rondleidingen in Barcelona!</h1>
      <p>
        Huur nu voordelig fietsen en/of boek een rondleiding in Barcelona!
        <br />
        Ideaal voor een dagje uit in Barcelona!
        <br />
        <b>! ! ! DEZE SITE IS EEN PROTOTYPE EN VERBETERING EN DETAILS KOMEN LATER! ! !</b>
      </p>
    </div>
    <div class="info">
      <a href="informatie.php"><button>Klik voor meer informatie!</button></a>
    </div>

    <?php
if(isset($message)){
   foreach($message as $message){
      echo '<div class="message" onclick="this.remove();">'.$message.'</div>';
   }
}
?>
   
<div class="form-container">

   <form action="" method="post">
      <h3>Login</h3>
      <input type="email" name="email" required placeholder="email" class="box">
      <input type="password" name="password" required placeholder="password" class="box">
      <input type="submit" name="submit" class="btn" value="login">
   </form>
</div>
<center>
<p>Geen account :<a href="reserveren.php"><button style="background-color:blue;"> Klik hier </button></a></p>
</center>
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

     <!-- custom css file link  -->
     <link rel="stylesheet" href="css/style.css">
   <style>
      input{
         text-align: center;
      }
   </style>

</body>
</html>