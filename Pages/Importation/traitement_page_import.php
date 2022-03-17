<?php
session_start();
require_once '../../conn.php';
$message = "";
//On traite le formulaire
if(!empty($_POST)){
    if(
        isset($_FILES['donnee']['name'])
        && !empty($_FILES['donnee']['name'])
      ){
          //Le formulaire est complet , on recupere les données et on se protege des failles xss
 
          $maxsize = 2000  ;
          $donnee = $_FILES['donnee']['name']; 
          $donneetaille = $_FILES['donnee']['size']; 
          $destination_dossier = '../saisie/etudiant/dossiers/'. $donnee; 
          $dossierPath = pathinfo($destination_dossier,PATHINFO_EXTENSION);
          $valid_extension = array("pdf","doc","csv");

          // verification de l'extension du fichier
          if(!in_array(strtolower($dossierPath),$valid_extension)){
            $message="<p style='color:red'>FORMAT DU FICHIER NON PRIS EN CHARGE</p></br><a href='page_import.php'>👉Clicker ici Pour Reprendre l'Importation</a>";
            
          }
        // verification de la taille du fichier
          elseif($donneetaille > $maxsize){
            $message="<p style='color:red'>FICHIER TROP VOLUMINEUX </p></br><a href='page_import.php'>👉Clicker ici Pour Reprendre l'Importation</a>";
              
          }
          else{
        
            $tmpNamedonnee = $_FILES['donnee']['tmp_name'];
            // var_dump("Affichage tmp : ".$tmpNamedonnee);
            $resultat = move_uploaded_file($tmpNamedonnee, $destination_dossier);


            $file = fopen($destination_dossier, 'r');

            while (($line = fgetcsv($file)) !== FALSE) {
                // echo '<pre>';
                // print_r($line[0]);
                // echo '</pre>';

                $sqlQuery = 'INSERT INTO livre(CodeL, titreL, auteurL, genre) VALUES (:CodeL, :titreL, :auteurL, :genre)';

                // Préparation
                $insertLivre = $conn->prepare($sqlQuery);

                // Exécution ! La recette est maintenant en base de données
                $insertLivre->execute([

                    'CodeL' => $line[0],
                    'titreL' => $line[1],
                    'auteurL' => $line[2],
                    'genre' => $line[3],


                ]);
            }
            fclose($file);
          
            $message ="<p style='color:green'>FICHIER IMPORTE AVEC SUCCES</p></br><a href='page_import.php'>👉Clicker ici </a>";
        }
      
      

      }else{
          echo '<script>alert("Veillez remplir tous les champs du formaulaire")</script>';
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
    <link rel="stylesheet" href="../../Style/style.css" />  

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">





  <!-- Theme style -->
  
    <title>PAGE IMPORTATION</title>
</head>
<body>
    <!--Begin Conatainer-->
<div class="container-fluid">
    <div class="menu-bar" style="background-color:cornflowerblue,">
      <h1 class="logo"><a href="../../home.php">Wang Chan <span> Li .</span></a> </h1>
      <ul>
      
        <li><a href="#">Parametrage <i class="fas fa-caret-down"></i></a>

            <div class="dropdown-menu">
                <ul>
                  <li><a href="../classe.php">Classe</a></li>
                  <li><a href="../livres/livre.php">Livre</a></li>
                  <li><a href="page_import.php">Importation</a></li>
                  
                </ul>
              </div>
        </li>

        <li><a href="#">Saisie <i class="fas fa-caret-down"></i></a>

            <div class="dropdown-menu">
                <ul>
                  <li><a href="../saisie/etudiant/inscription.php">Inscription</a></li>
                  <li><a href="#">Emprunt Livre</a></li>
                  <li><a href="#">Depot Livre</a></li> 
                </ul>
              </div>
        </li>
        <li><a href="#">Edition <i class="fas fa-caret-down"></i></a>

            <div class="dropdown-menu" >
                <ul>
                 
                  <li><a href="#">Livre Par Auteur</a></li>
                  <li><a href="#" style="width: 100rem">Liste Des Emprunt Par Auteur</a></li> 
                </ul>
              </div>
        </li>


        <!-- <li><a href="#"> <?php $session['username']?> <i class="fas fa-caret-down"></i></a>

            <div class="dropdown-menu" >
                <ul>
                  <li><a href = "logout.php">Logout</a></li>
                  
                </ul>
              </div>
        </li> -->

        
		
        
      </ul>
    </div>
    <div class="bg-info text-white" style="border:2px solid;background-color:bleu;margin:25px"> <h2 class="text-center">PAGE IMPORTATION </h2> </div>


    <div class="container">
            
            <div class="row">
                <div class="col-sm-3">
                        
                </div>
                <div class="col-sm-6" style="border:solid 5px;height: 200px;width:500px;color:bleu">
                        <h1 class="text-center" style="padding-top:50px"><?php echo $message;?></h1>
                </div>
                <div class="col-sm-3">
                        
                </div>
            </div>

    </div>
    

    
    </div>
    </div>
        
    













    












    </div>
    <!--end container-->
    
    


    



<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

</body>
</html>







