<?php
session_start();
require_once '../conn.php';


// Vérifier si le formulaire est soumis 
if ( isset( $_POST['submit'] ) ) {
    /* récupérer les données du formulaire en utilisant 
       la valeur des attributs name comme clé 
      */
    $CodeCl = $_POST['CodeCl']; 
    $libellecl = $_POST['libellecl']; 
    


     // Ecriture de la requête
    $sqlQuery = 'INSERT INTO classe(CodeCl, libellecl) VALUES (:CodeCl, :libellecl)';

    // Préparation
    $insertClasse = $conn->prepare($sqlQuery);

    // Exécution ! La recette est maintenant en base de données
    if ($insertClasse->execute([':CodeCl' => $CodeCl, ':libellecl' => $libellecl])) {
        $message = 'Felicitation classe enregistrée avec succes';
      }
      else{
          $message="La classe existe dejà desolé 😂";
      }
    
    
    
    // $insertClasse->execute([

    //     'CodeCl' =>  $CodeCl,
    //     'libellecl' => $libellecl,

    // ]);
    // header("location: classe.php");
    exit;







 }


?>