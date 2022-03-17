<?php
session_start();
require_once '../../conn.php';
$sql = 'SELECT * FROM livre';
$query = $conn->prepare($sql);
$query->execute();
$livre = $query->fetchAll(PDO::FETCH_OBJ);
// var_dump($livre)
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
  
    <title>LISTE DES LIVRES </title>
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
                  <li><a href="#">Livre</a></li>
                  <li><a href="../Importation/page_import.php">Importation</a></li>
                  
                </ul>
              </div>
        </li>

        <li><a href="#">Saisie <i class="fas fa-caret-down"></i></a>

            <div class="dropdown-menu">
                <ul>
                  <li><a href="../saisie/etudiant/inscription.php">Inscription</a></li>
                  <li><a href="../EmpruntLivre/emprunt_livre.php">Emprunt Livre</a></li>
                  <li><a href="#">Depot Livre</a></li> 
                </ul>
              </div>
        </li>
        <li><a href="#">Edition <i class="fas fa-caret-down"></i></a>

            <div class="dropdown-menu" >
                <ul>
                  <li><a href="#">Liste Classe</a></li>
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
    <div class="bg-info text-white" style="border:2px solid;background-color:bleu;margin:25px"> <h2 class="text-center">LISTE DES LIVRES </h2> </div>
            <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-4"></div>
            <div class="col-sm-4">


        <button type="button" class="btn bg-info text-white" style="margin-bottom:15px" data-toggle="modal" data-target="#exampleModal" data-whatever="@fat">AJOUTER UN NOUVEAU LIVRE</button>



        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">NOUVEAU LIVRE</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form  method="POST">
                  <div class="form-group">
                    <label for="recipient-name" class="col-form-label">CODE LIVRE:</label>
                    <input type="text" required class="form-control" id="recipient-name" name="CodeL">
                  </div>
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">TITRE LIVRE:</label>
                    <input type="text" required class="form-control" id="recipient-name" name="titreL">
                  </div>
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">AUTEUR LIVRE:</label>
                    <input type="text" required class="form-control" id="recipient-name" name="auteurL">
                  </div>
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">GENRE:</label>
                    <input type="text" required class="form-control" id="recipient-name" name="genre">
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
        
    













    












    </div>
    <!--end container-->
    
    <div class="container">
        <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>

                    <th># CodeL</th>
                    <th># Titre Livre</th>
                    <th># Auteur Livre</th>
                    <th># Genrer Livre</th>
                    <th> 	# Actions</th>

                  </tr>
                  </thead>
                  <tbody>

                    <?php foreach($livre as $livre): ?>
                    <tr>
                      <td><?= $livre->CodeL; ?></td>
                      <td><?= $livre->titreL; ?></td>
                      <td><?= $livre->auteurL; ?></td>
                      <td><?= $livre->genre; ?></td>
                     
                      <td>
          
                      <a href="edit_livre.php?CodeL=<?= $livre->CodeL ?>" class="btn btn-info">Edit</a>
                      <a onclick="return confirm('VOULEZ VOUS VRAIMENT SUPPRIMER CETTE DONNEE ?')" href="delete_livre.php?CodeL=<?= $livre->CodeL ?>"  class='btn btn-danger'>Delete</a>
          
                        <!-- <a href="edit.php?CodeCl=<?= $livre->CodeL ?>" class="btn btn-info">Edit</a>
                        <a onclick="return confirm('Are you sure you want to delete this entry?')" href="delete.php?CodeCl=<?= $livre->CodeL ?>" class='btn btn-danger'>Delete</a> -->
                      </td>
                    </tr>
                  <?php endforeach; ?>
                             
                    
                  </tbody>
                  <tfoot>
                  <tr>
                    <th># CodeL</th>
                    <th># Titre Livre</th>
                    <th># Auteur Livre</th>
                    <th># Genrer Livre</th>
                    <th> 	# Actions</th>
                  </tr>
                  </tfoot>
          </table>
      </div>


    



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







