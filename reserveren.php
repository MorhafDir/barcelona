<?php

include 'config.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));

   $select = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
      $message[] = 'user already exist!';
   }else{
      mysqli_query($conn, "INSERT INTO `users`(name, email, password) VALUES('$name', '$email', '$pass')") or die('query failed');
      $message[] = 'registered successfully!';
      header('location:login.php');
   }

}

?>

<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="css/reserveren.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <title>Registreren | Verrassend Barcelona</title>
</head>

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

</div>
<br /><br />
<div class="fixedinhoud">
  <div class="info">
    <h1>Registreer nu om fietsen en/of Rondleidingen te huren in Barcelona!</h1>
    
    <p>
      Nog geen idee wat voor fiets u wilt huren? Klik op de knop hieronder om extra informatie te lezen over de fietsen.
      <br /><br />
      <a href="informatie.php"><button>Klik voor meer informatie!</button></a>     

        <br />
    </p>
    
</div>
<?php
if(isset($message)){
   foreach($message as $message){
      echo '<div class="message" onclick="this.remove();">'.$message.'</div>';
   }
}
?>
 
<center>
<div class="form-container">

   <form action="" method="post">
      <h3 style="background-color:black; color:white; width:40%;"> Nieuw account </h3>
      <input type="text" name="name" required placeholder="Naam" class="box">
      <br>
      <input type="email" name="email" required placeholder="Email" class="box">
      <br>
      <input type="password" name="password" required placeholder="Wachtwoord*" class="box">
      <br>
      <input type="password" name="cpassword" required placeholder="Wachtwoord*" class="box">
      <br><br>
      <input type="submit" name="submit" class="btn" value="Registreer ">
      <br>
      <p>Heb je al een account? <a href="login.php"><button>Log in</a></button></p>
   </form>

</div>

<br />
</center>


    <br /><br />
    <div class="footer">
      <p>
        Gemaakt door: Ahmed Ridha, Bukhari Igueh, Morhaf Derbas & Masoud Khasismatouri!</a>
      </p>
      
        Disclaimer: de foto's zijn voorbeelden.
      <p>FIETSVERHUUR & RONDLEIDINGEN BARCA &copy; 2022</p>
    </div>
  </div>

</body>

</html>