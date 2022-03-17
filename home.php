<?php
	require 'conn.php';
	session_start();
	
	if(!ISSET($_SESSION['user'])){
		header('location:index.php');
	}
	$id = $_SESSION['user'];
	$sql = $conn->prepare("SELECT * FROM `member` WHERE `mem_id`='$id'");
	$sql->execute();
	$fetch = $sql->fetch();
?>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"/>
    
    <link rel="stylesheet" href="Style/style.css" />
    <title>Ouangui</title>
  </head>
  <body>
    <div class="menu-bar" style="background-color:cornflowerblue,">
      <h1 class="logo"> Wang Chan <span> Li .</span></h1>
      <ul>
      
        <li><a href="#">Parametrage <i class="fas fa-caret-down"></i></a>

            <div class="dropdown-menu">
                <ul>
                  <li><a href="Pages/classe.php">Classe</a></li>
                  <li><a href="Pages/livres/livre.php">Livre</a></li>
                  <li><a href="Pages/Importation/page_import.php">Importation</a></li>
                  
                </ul>
              </div>
        </li>

        <li><a href="#">Saisie <i class="fas fa-caret-down"></i></a>

            <div class="dropdown-menu">
                <ul>
                  <li><a href="Pages/saisie/etudiant/inscription.php">Inscription</a></li>
                  <li><a href="#">Emprunt Livre</a></li>
                  <li><a href="#">Depot Livre</a></li> 
                </ul>
              </div>
        </li>
        <li><a href="#">Edition <i class="fas fa-caret-down"></i></a>

            <div class="dropdown-menu" >
                <ul>
                 
                  <li><a href="Pages/livreParAuteur/liste_livre_auteur.php">Livre Par Auteur</a></li>
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

    <div class="hero" style="background-color:#61ffed">
      &nbsp;
    </div>
  </body>
</html>
