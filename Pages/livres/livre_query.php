<?php
session_start();
require_once '../../conn.php';


// Vérifier si le formulaire est soumis 
// // if ( isset( $_POST['submit'] ) ) {
// //     /* récupérer les données du formulaire en utilisant 
// //        la valeur des attributs name comme clé 
// //       */
// //     $CodeL = $_POST['CodeL']; 
// //     $titreL = $_POST['titreL']; 
// //     $auteurL = $_POST['auteurL']; 
// //     $genre = $_POST['genre']; 
    


// //      // Ecriture de la requête
// //     $sqlQuery = 'INSERT INTO livre(CodeL, titreL, auteurL, genre) VALUES (:CodeL, :titreL, :auteurL, :genre)';

// //     // Préparation
// //     $insertLivre = $conn->prepare($sqlQuery);

// //     // Exécution ! La recette est maintenant en base de données
// //     $insertLivre->execute([

// //         'CodeL' =>  $CodeL,
// //         'titreL' => $titreL,
// //         'auteurL' => $auteurL,
// //         'genre' => $genre,

// //     ]);
// //     header("location: livre.php");
// //     exit;
    
//  }


?>




<?php 

//On traite le formulaire
if(!empty($_POST)){
    if(
        isset($_POST['CodeL'], $_POST['titreL'], $_POST['auteurL'], $_POST['genre'])
        && !empty($_POST['CodeL']) && !empty($_POST['titreL']) && !empty($_POST['auteurL']) && !empty($_POST['genre'])
      ){
          //Le formulaire est complet , on recupere les données et on se protege des failles xss
          $CodeL = strip_tags($_POST['CodeL']); 
          $CodeL = htmlspecialchars($CodeL); 
 

          $titreL =strip_tags($_POST['titreL']);
          $titreL =htmlspecialchars($titreL);

          $auteurL =strip_tags($_POST['auteurL']);
          $auteurL =htmlspecialchars($auteurL);

          $genre =strip_tags($_POST['genre']); 
          $genre =htmlspecialchars($genre); 

         // Ecriture de la requête
          $sqlQuery = 'INSERT INTO livre(CodeL, titreL, auteurL, genre) VALUES (:CodeL, :titreL, :auteurL, :genre)';

        // Préparation
        $insertLivre = $conn->prepare($sqlQuery);
    
        // Exécution ! La recette est maintenant en base de données
        $insertLivre->execute([
    
            'CodeL' => $CodeL,
            'nom' => $nom,
            'titreL' => $titreL,
            'auteurL' => $auteurL,
            'genre' => $genre,

    
        ]);

        header("location: livre.php");
        exit;
      

      }else{
          echo '<script>alert("Veillez remplir tous les champs du formaulaire")</script>';
      }
 }








?>
