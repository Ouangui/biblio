<?php
	require '../../../conn.php';
	session_start();
	
	if(!ISSET($_SESSION['user'])){
		header('location:index.php');
	}
	$id = $_SESSION['user'];
	$sql = $conn->prepare("SELECT * FROM `member` WHERE `mem_id`='$id'");
	$sql->execute();
	$fetch = $sql->fetch();



    $sql1 = 'SELECT CodeCl FROM classe';
    $result = $conn->query($sql1);
    
    $listcodecl = $result->fetchAll();


  $message = "";
   //On traite le formulaire
   if(!empty($_POST)){
      if(
          isset($_POST['matricule'], $_POST['nom'], $_POST['prenom'], $_POST['date_naiss'], $_POST['lieux'], $_POST['sexe'], $_POST['CodeCl'], $_FILES['photo']['name'], $_FILES['cv']['name'])
          && !empty($_POST['matricule']) && !empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['date_naiss']) && !empty($_POST['lieux']) && !empty($_POST['sexe']) && !empty($_POST['CodeCl']) && !empty($_FILES['photo']['name']) && !empty($_FILES['cv']['name'])
        ){
            //Le formulaire est complet , on recupere les données et on se protege des failles xss
            $Matricule = strip_tags($_POST['matricule']); // retire les balises
            $Matricule = htmlspecialchars($Matricule); //neutralise les balises

            $nom =strip_tags($_POST['nom']); 
            $nom =htmlspecialchars($nom); 

            $prenom =strip_tags($_POST['prenom']);
            $prenom =htmlspecialchars($prenom);

            $date_naiss =strip_tags($_POST['date_naiss']);
            $date_naiss =htmlspecialchars($date_naiss);

            $lieux =strip_tags($_POST['lieux']); 
            $lieux =htmlspecialchars($lieux); 

            $sexe =strip_tags($_POST['sexe']); 
            $sexe =htmlspecialchars($sexe); 

            $CodeCl =strip_tags($_POST['CodeCl']); 
            $CodeCl =htmlspecialchars($CodeCl); 

            $photo = $_FILES['photo']['name']; 
            $destination_image = 'imagesEtu/'. $photo; 
            $imagePath = pathinfo($destination_image,PATHINFO_EXTENSION);
            $valid_extension = array("jpg","png","gif");
            if(!in_array(strtolower($imagePath),$valid_extension)){
              $message = "<p style='color:red'>le fichier n'est pas une image</p>";
              
            }
        

            $maxsize = 5000  ;
            $cv = $_FILES['cv']['name']; 
            $cvtaille = $_FILES['cv']['size']; 
            $destination_dossier = 'dossiers/'. $cv; 
            $dossierPath = pathinfo($destination_dossier,PATHINFO_EXTENSION);
            $valid_extension = array("pdf","doc");

            // verification de l'extension du fichier
            if(!in_array(strtolower($dossierPath),$valid_extension)){
              $message = "<p style='color:red'>fichier non pris en charge</p>";
              
            }
          // verification de la taille du fichier
            elseif($cvtaille > $maxsize){
               $message = "<p style='color:red'>Oups ! une Erreur est suervenue veillez verifier la taille ou le format du fichier</p>";
                
            }else{
              $message ="<p style='color:green'>ENREGISTREMENT EFFECTUE AVEC SUCCES</p>";
            $tmpNamecv = $_FILES['cv']['tmp_name'];
            $resultat = move_uploaded_file($tmpNamecv, $destination_dossier);
            
            $tmpNameimage = $_FILES['photo']['tmp_name'];
            $uniqueNameImage = md5(uniqid(rand(), true));
            $resultatimage = move_uploaded_file($tmpNameimage, $destination_image);  
           // Ecriture de la requête
            $sqlQuery = 'INSERT INTO etudiant(Matricule, nom, prenom, date_naiss, lieux, sexe, photo, cv, CodeCl) VALUES (:Matricule, :nom, :prenom, :date_naiss, :lieux, :sexe, :photo, :cv, :CodeCl)';
  
          // Préparation
          $insertEtudiant = $conn->prepare($sqlQuery);
      
          // Exécution ! La recette est maintenant en base de données
          $insertEtudiant->execute([
      
              'Matricule' => $Matricule,
              'nom' => $nom,
              'prenom' => $prenom,
              'date_naiss' => $date_naiss,
              'lieux' => $lieux,
              'sexe' => $sexe,
              'photo' => $photo,
              'cv' => $cv,
              'CodeCl' => $CodeCl,
      
          ]);

          header("location: inscription.php");
          exit;

            }
          
            
        

        }else{
            echo '<script>alert("Veillez remplir tous les champs du formaulaire")</script>';
        }
   }

?>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../../../Style/style.css" />





  <link rel="stylesheet" href="../../livres/dist/css/adminlte.min.css">


    <title>Ouangui</title>
  </head>
  <body>
<!--Debut Menu-->
    <div class="menu-bar" style="background-color:cornflowerblue,">
      <h1 class="logo"> Wang Chan <span> Li .</span></h1>
      <ul>
      
        <li><a href="#">Parametrage <i class="fas fa-caret-down"></i></a>

            <div class="dropdown-menu">
                <ul>
                  <li><a href="../../classe.php">Classe</a></li>
                  <li><a href="../../livres/livre.php">Livre</a></li>
                  <li><a href="../../Importation/page_import.php">Importation</a></li>
                 
                  
                </ul>
              </div>
        </li>

        <li><a href="#">Saisie <i class="fas fa-caret-down"></i></a>

            <div class="dropdown-menu">
                <ul>
                  <li class="active"><a href="#">Inscription</a></li>
                  <li><a href="../../EmpruntLivre/emprunt_livre.php">Emprunt Livre</a></li>
                  <li><a href="#">Depot Livre</a></li> 
                </ul>
              </div>
        </li>
        <li><a href="#">Edition <i class="fas fa-caret-down"></i></a>

            <div class="dropdown-menu" >
                <ul>
                  
                  <li><a href="../../livreParAuteur/liste_livre_auteur.php">Livre Par Auteur</a></li>
                  <li><a href="#" style="width: 100rem">Liste Des Emprunt Par Auteur</a></li> 
                </ul>
              </div>
        </li>


        <li><a href="#"> <?php echo $fetch['username']?> <i class="fas fa-caret-down"></i></a>

            <div class="dropdown-menu" >
                <ul>
                  <li><a href = "logout.php">Logout</a></li>
                  
                </ul>
              </div>
        </li>
        
      </ul>
    </div>
<!--fin menu-->
<div class="container" style="padding:40px">
<div class="bg-info text-white" role="alert" style="background-color:bleu">
    <h1 class="text-center"><a href="#" class="alert-link">INSCRIPTION</a> ETUDIANT.</h1>
   
</div>
<div role="alert">
    <h1 class="text-center"><?php echo $message ;?></h1>
   
</div>
<form method="post" enctype="multipart/form-data">
  <div class="form-row">
    <div class="form-group col-md-4">
      <label for="inputEmail4">Matricule</label>
      <input type="text" class="form-control" required id="inputEmail4" name="matricule" placeholder="Matricule Etudiant">
    </div>
    <div class="form-group col-md-4">
      <label for="inputPassword4">Nom</label>
      <input type="text" class="form-control"  required id="inputPassword4" name="nom" placeholder="Nom">
    </div>
    <div class="form-group col-md-4">
      <label for="inputPassword4">Prenom</label>
      <input type="text" class="form-control" required id="inputPassword4" name="prenom" placeholder="prenom">
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Date de Naissance</label>
      <input type="date" class="form-control" required id="inputEmail4" name="date_naiss" placeholder="Date de Naissance">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Lieu de Naissance</label>
      <input type="text" class="form-control" required id="inputPassword4" name="lieux" placeholder="Lieu de Naissance">
    </div>
  </div>
  <div class="form-group">
    <label for="inputAddress2">Sexe</label>
    <select required id="inputState" name="sexe" class="form-control">
        <option ></option>
        <option value="Masculain">Masculain</option>
        <option value="Feminin">Feminin</option>
      </select>
  </div>
  <div class="form-row">
    <div class="form-group col-md">
      <label for="inputCity">Photo</label>
      <input type="file" class="form-control" required id="inputCity" name="photo" placeholder="Photo Etudiant">
    </div>
    <div class="form-group col-md">
      <label for="inputCity">Cv</label>
      <input type="file" class="form-control" required id="inputCity" name="cv" placeholder="Cv Etudiant">
    </div>
    <div class="form-group col-md-6">
      <label for="inputState">Code Classe</label>
      <select required id="inputState"  name="CodeCl" class="form-control">

        <?php
        
            for ($i=0;$i<count($listcodecl);$i++)
            {
                $CodeCl=$listcodecl[$i]["CodeCl"];
                echo"<option value='$CodeCl'>$CodeCl</option>";
            }
        
        ?>
     
      </select>
    </div>
    
  </div>

  <button type="submit" name="submit" class="btn btn-primary">INSCRIRE</button>
 
</form>
</div>
    




<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
