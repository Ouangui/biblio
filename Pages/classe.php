<?php
session_start();
require_once '../conn.php';
$sql = 'SELECT * FROM classe';
$query = $conn->prepare($sql);
$query->execute();
$classe = $query->fetchAll(PDO::FETCH_OBJ);

 ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../Style/style.css" />  
    
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../Pages/livres/plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../Pages/livres/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../Pages/livres/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../Pages/livres/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../Pages/livres/dist/css/adminlte.min.css">

    
    <title>Classe Wang Chan LI</title>
</head>
<body>
    <!--Begin Conatainer-->
<div class="container-fluid">
<div class="menu-bar" style="background-color:cornflowerblue,">
      <h1 class="logo"><a href="../home.php">Wang Chan <span> Li .</span></a> </h1>
      <ul>
      
        <li><a href="#">Parametrage <i class="fas fa-caret-down"></i></a>

            <div class="dropdown-menu">
                <ul>
                  <li><a href="classe.php">Classe</a></li>
                  <li><a href="livres/livre.php">Livre</a></li>
                 
                  
                </ul>
              </div>
        </li>

        <li><a href="#">Saisie <i class="fas fa-caret-down"></i></a>

            <div class="dropdown-menu">
                <ul>
                  <li><a href="../Pages/saisie/etudiant/inscription.php">Inscription</a></li>
                  <li><a href="../Pages/EmpruntLivre/emprunt_livre.php">Emprunt Livre</a></li>
                  <li><a href="#">Depot Livre</a></li> 
                </ul>
              </div>
        </li>
        <li><a href="#">Edition <i class="fas fa-caret-down"></i></a>

            <div class="dropdown-menu" >
                <ul>
                 
                  <li><a href="livreParAuteur/liste_livre_auteur.php">Livre Par Auteur</a></li>
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
    <div class="bg-info text-white" style="border:2px solid;background-color:bleu;margin:25px"> <h2 class="text-center">LISTE DES CLASSES </h2> </div>
            <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-4"></div>
            <div class="col-sm-4">


<button type="button" class="btn bg-info text-white" style="margin-bottom:15px" data-toggle="modal" data-target="#exampleModal" data-whatever="@fat">AJOUTER UNE NOUVELLE CLASSE</button>



    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">NOUVELLE CLASSE</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <!--action="classe_query.php"-->
            <form  method="POST">
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">CODE CLASSE:</label>
                <input type="text" class="form-control" id="recipient-name"  name="CodeCl">
              </div>
              <div class="form-group">
                <label for="message-text" class="col-form-label">LIBELLE CLASSE:</label>
                <input type="text" class="form-control" id="recipient-name"  name="libellecl">
              </div>
              <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">FERMER</button>
            <button type="submit" name="submit" class="btn btn-primary">CREER</button>
          </div>
            </form>
          </div>
          
        </div>
      </div>
    </div>

    
    </div>
    </div>

    <!-- <div class="card-body">
      <?php if(!empty($message)): ?>
        <div class="alert alert-success">
          <?= $message; ?>
        </div>
      <?php endif; ?>  -->


<?php




// Vérifier si le formulaire est soumis 
// if ( isset( $_POST['submit'] ) ) {
//   /* récupérer les données du formulaire en utilisant 
//      la valeur des attributs name comme clé 
//     */
//   $CodeCl = strip_tags($_POST['CodeCl']);
//   $CodeCl = htmlspecialchars($CodeCl);
//   $libellecl = strip_tags($_POST['libellecl']); 
//   $libellecl = htmlspecialchars($libellecl); 


//    // Ecriture de la requête
//   $sqlQuery = 'INSERT INTO classe(CodeCl, libellecl) VALUES (:CodeCl, :libellecl)';

//   // Préparation
//   $insertClasse = $conn->prepare($sqlQuery);
  
//   // Exécution ! La recette est maintenant en base de données
//   if ($insertClasse->execute(['CodeCl' => $CodeCl, 'libellecl' => $libellecl])) {
      
//       echo '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
//       <strong>😁</strong> Felicitation classe enregistrée avec succes.
//       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
//         <span aria-hidden="true">&times;</span>
//       </button>
//     </div>';
//       // header("location: classe.php");
//     }
//     else{
//       echo '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
//       <strong>😥😥</strong> Désolé cette classe exite déjà !!!.
//       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
//         <span aria-hidden="true">&times;</span>
//       </button>
//     </div>';
        
//     }
    


// }


?>





<?php 

//On traite le formulaire
if(!empty($_POST)){
    if(
        isset($_POST['CodeCl'], $_POST['libellecl'])
        && !empty($_POST['CodeCl']) && !empty($_POST['libellecl'])
      ){
          //Le formulaire est complet , on recupere les données et on se protege des failles xss
          $CodeCl = strip_tags($_POST['CodeCl']); 
          $CodeCl = htmlspecialchars($CodeCl); 
 

          $libellecl =strip_tags($_POST['libellecl']);
          $libellecl =htmlspecialchars($libellecl);


         // Ecriture de la requête
          $sqlQuery = 'INSERT INTO classe(CodeCl, libellecl) VALUES (:CodeCl, :libellecl)';

        // Préparation
        $insertClasse = $conn->prepare($sqlQuery);
    
        // Exécution ! La recette est maintenant en base de données
        if ($insertClasse->execute(['CodeCl' => $CodeCl, 'libellecl' => $libellecl])) {
          
          echo '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
          <strong>😁</strong> Felicitation classe enregistrée avec succes.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>';
          // header("location: classe.php");
        }
        else{
          echo '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
          <strong>😥😥</strong> Désolé cette classe exite déjà !!!.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>';
            
        }

        // header("location: classe.php");
        exit;
      

      }else{
          echo '<script>alert("Veillez remplir tous les champs du formaulaire")</script>';
      }
 }




?>


































    
    <!--end container-->



    <div class="container">
        <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>

                    <th># CodeCl</th>
                    <th># Libellecl</th>
                    <th># Actions</th>
                   

                  </tr>
                  </thead>
                  <tbody>

                    <?php foreach($classe as $classe): ?>
                    <tr>
                      <td><?= $classe->CodeCl; ?></td>
                      <td><?= $classe->libellecl; ?></td>
                     
                      <td>
          
                      <a href="edit_classe.php?CodeCl=<?= $classe->CodeCl ?>" class="btn btn-info">Edit</a>
                      <a onclick="return confirm('VOULEZ VOUS VRAIMENT SUPPRIMER CETTE DONNEE ?')" href="delete_classe.php?CodeCl=<?= $classe->CodeCl ?>"  class='btn btn-danger'>Delete</a>
          
                         
                      </td>
                    </tr>
                  <?php endforeach; ?>
                             
                    
                  </tbody>
                  <tfoot>
                  <tr>
                    <th># CodeCl</th>
                    <th># Libellecl</th>
                    <th># Actions</th>
                  </tr>
                  </tfoot>
          </table>
      </div>
    
    
  
    


<<!-- jQuery -->
<script src="../Pages/livres/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../Pages/livres/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="../Pages/livres/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../Pages/livres/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../Pages/livres/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../Pages/livres/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../Pages/livres/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../Pages/livres/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../Pages/livres/plugins/jszip/jszip.min.js"></script>
<script src="../Pages/livres/plugins/pdfmake/pdfmake.min.js"></script>
<script src="../Pages/livres/plugins/pdfmake/vfs_fonts.js"></script>
<script src="../Pages/livres/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../Pages/livres/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../Pages/livres/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="../Pages/livres/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../Pages/livres/dist/js/demo.js"></script>
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







