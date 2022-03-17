<?php

require_once '../../conn.php';
$sql = 'SELECT * FROM livre';
$query = $conn->prepare($sql);
$query->execute();
$livre = $query->fetchAll(PDO::FETCH_OBJ);




$CodeL = $_GET['CodeL'];

$sql = 'SELECT * FROM livre WHERE CodeL=:CodeL';
var_dump($CodeL);
$statement = $conn->prepare($sql);
$statement->execute([':CodeL' => $CodeL ]);
$livre = $statement->fetch(PDO::FETCH_OBJ);
if (isset($_POST['titreL'] ) && isset($_POST['auteurL']) && isset($_POST['genre'] )  ) {
  
  $titreL = $_POST['titreL'];
  $auteurL = $_POST['auteurL'];
  $genre = $_POST['genre'];
  $sql = 'UPDATE livre SET titreL=:titreL,auteurL=:auteurL,genre=:genre WHERE CodeL=:CodeL';
  $statement = $conn->prepare($sql);
  if ($statement->execute([':CodeL' => $CodeL, ':titreL' => $titreL, 'auteurL' =>$auteurL, 'genre' =>$genre])) {
    header("location: livre.php");
   
   
  }



}




 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Classe Wang Chan LI</title>
</head>
<body>
    <!--Begin Conatainer-->
<div class="container">

    <div class="bg-info text-white" style="border:2px solid;background-color:bleu;margin:25px"> <h2 class="text-center">EDITION DU LIVTRE </h2> <span></span></div>
        
       <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm">
                <form method="post">
                    <div class="form-group">

                        <label for="exampleInputEmail1">CODE LIVRE</label>
                        <input type="text" class="form-control" id="exampleInputEmail1"  value="<?= $livre->CodeL; ?>" disabled>

                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">TITRE LIVRE</label>
                        <input type="text" class="form-control" value="<?= $livre->titreL; ?>" name="titreL">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">AUTEUR LIVRE</label>
                        <input type="text" class="form-control" value="<?= $livre->auteurL; ?>" name="auteurL">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">GENRE LIVRE</label>
                        <input type="text" class="form-control" value="<?= $livre->genre; ?>" name="genre">
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
        </div>
        <div class="col-sm-3"></div>
</div>
    <!--end container-->
    
    
  
    


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>




