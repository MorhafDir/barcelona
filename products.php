<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="style/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        h3{
            font-family: 'Cairo', sans-serif;
            font-weight: bold;
        }
        .card{
            float: right;
            margin-top: 20px;
            margin-left: 10px;
            margin-right: 10px;
        }
        .card img{
            width: 100%;
            height: 200px;
        }
        main{
            width: 60%;
        }
    </style>
</head>
<body>
    <center>
        <h3>All Products</h3>
    </center>
    <main>
    <?php 
    include('config.php');

    $query = "SELECT * FROM prod";
    $result = mysqli_query($con, $query);
    while($row = mysqli_fetch_array($result)){
        echo "
        <center>
        <main>
    <div class='card' style='width: 18rem;'>
       <img src='$row[image]' class='card-img-top' alt='logo'>
       <div class='card-body'>
       <h5 class='card-title'>$row[name]</h5>
       <p class='card-text'>$row[price]</p>
       <a href='delete.php? id=$row[id]' class='btn btn-danger'>Delete Product</a>
       <a href='update.php? id=$row[id]' class='btn btn-primary'>Update Product</a>
       </div>
    </div>
    </mai>
        </center>
        ";
    };
        
    ?>
    </main>
    <a href="index.php">
            <button>Back</button>
    </a>
</body>
</html>