<?php
	require '../../conn.php';
	session_start();
	
	if(!ISSET($_SESSION['user'])){
		header('location:index.php');
	}
	$id = $_SESSION['user'];
	$sql = $conn->prepare("SELECT * FROM `member` WHERE `mem_id`='$id'");
	$sql->execute();
	$fetch = $sql->fetch();


    // on recupere les matriclues etudiant
    $lesmatris = 'SELECT Matricule FROM etudiant';
    $resultM = $conn->query($lesmatris);
    $listeMat = $resultM->fetchAll();

    // on recupere les codes des classes
    $sql1 = 'SELECT CodeCl FROM classe';
    $result = $conn->query($sql1);
    
    $listcodecl = $result->fetchAll();


  $message = "";
   //On traite le formulaire
   if(!empty($_POST)){
      if(
          isset($_POST['Matricule'], $_POST['codecl'], $_POST['datesortie'], $_POST['dateretour'])
          && !empty($_POST['Matricule']) && !empty($_POST['codecl']) && !empty($_POST['datesortie']) && !empty($_POST['dateretour'])
          
          ){
            //Le formulaire est complet , on recupere les données et on se protege des failles xss
            $Matricule = strip_tags($_POST['Matricule']); // retire les balises
            $Matricule = htmlspecialchars($Matricule); //neutralise les balises

            $datesortie =strip_tags($_POST['datesortie']);
            $datesortie =htmlspecialchars($datesortie);

            $dateretour =strip_tags($_POST['dateretour']);
            $dateretour =htmlspecialchars($dateretour); 

            $codecl =strip_tags($_POST['codecl']); 
            $codecl =htmlspecialchars($codecl); 


          // verification de la taille du fichier

            $message ="<p style='color:green'>ENREGISTREMENT EFFECTUE AVEC SUCCES</p>";
           
           // Ecriture de la requête
            $sqlQuery = 'INSERT INTO emprunter(Matricule, codecl, datesortie, dateretour) VALUES (:Matricule, :codecl, :datesortie, :dateretour)';
  
          // Préparation
          $insertEmprunt = $conn->prepare($sqlQuery);
      
          // Exécution ! La recette est maintenant en base de données
          $insertEmprunt->execute([
      
              'Matricule' => $Matricule,
              'codecl' => $codecl,
              'datesortie' => $datesortie,
              'dateretour' => $dateretour
              
      
          ]);

         
           
                $message = "<p> EMPRUNT ENREGISTRE AVEC SUCCES ✔️✔️</p>";
            
 

            
          
            


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
    <link rel="stylesheet" href="../../Style/style.css" />





  <link rel="stylesheet" href="../livres/dist/css/adminlte.min.css">


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
                  <li><a href="../classe.php">Classe</a></li>
                  <li><a href="../livres/livre.php">Livre</a></li>
                  <li><a href="../Importation/page_import.php">Importation</a></li>
                 
                  
                </ul>
              </div>
        </li>

        <li><a href="#">Saisie <i class="fas fa-caret-down"></i></a>

            <div class="dropdown-menu">
                <ul>
                  <li class="#"><a href="../saisie/etudiant/inscription.php">Inscription</a></li>
                  <li><a href="#">Emprunt Livre</a></li>
                  <li><a href="#">Depot Livre</a></li> 
                </ul>
              </div>
        </li>
        <li><a href="#">Edition <i class="fas fa-caret-down"></i></a>

            <div class="dropdown-menu" >
                <ul>
                  
                  <li><a href="../livreParAuteur/liste_livre_auteur.php">Livre Par Auteur</a></li>
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
    <h1 class="text-center"><a href="#" class="alert-link">EMPRUNT</a> DE LIVRE.</h1>
   
</div>
<div role="alert">
    <h1 class="text-center"><?php echo $message ;?></h1>
   
</div>
<form method="post" style="padding-top:20px">
  <div class="form-row">
    <div class="form-group col-md-6">
        <label for="inputState">Selectionner le Matricule Etudiant</label>
        <select required id="inputState"  name="Matricule" class="form-control">

            <?php
            
                for ($i=0;$i<count($listeMat);$i++)
                {
                    $Matricule=$listeMat[$i]["Matricule"];
                    echo"<option value='$Matricule'>$Matricule</option>";
                }
            
            ?>
        
        </select>
    </div>

    <div class="form-group col-md-6">
      <label for="inputState">Selectionner le Code de la Classe</label>
      <select required id="inputState"  name="codecl" class="form-control">

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
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Date de Sortie</label>
      <input type="date" class="form-control" required id="inputEmail4" name="datesortie" >
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Date de Retour</label>
      <input type="date" class="form-control" required id="inputPassword4" name="dateretour" >
    </div>
  </div>
  

  <button type="submit" name="submit" class="btn btn-primary">Valider Emprunt</button>
 
</form>
</div>
    




<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
