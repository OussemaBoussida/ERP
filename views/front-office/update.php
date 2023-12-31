<?php

    include_once '../../model/perso.php';
	  include_once '../../controller/persoCRUD.php';
	//affichage 
	$persoCRUD = new persoCRUD();
	$listeperso=$persoCRUD->AfficherPerso(); 
  //update
  $error = "";

  $perso = null;
  
  $persos = new persoCRUD();
  
  if (isset($_GET['modifier'])) { // Utilisez $_GET au lieu de $_POST
  
      if (
          isset($_GET['cin']) &&		
          isset($_GET['nom']) &&
          isset($_GET['prenom']) && 
          isset($_GET['datee']) && 
          isset($_GET['adresse']) && 
          isset($_GET['email']) && 
          isset($_GET['tel']) && 
          isset($_GET['document_cin']) && 
          isset($_GET['titre_poste']) && 
          isset($_GET['salaire']) &&  
          isset($_GET['type_contrat']) &&
          isset($_GET['rib']) &&
          isset($_GET['imagee']) 
      ) {
          if (
              !empty($_GET['cin']) &&
              !empty($_GET['nom']) && 
              !empty($_GET['prenom']) && 
              !empty($_GET['datee']) &&
              !empty($_GET['adresse']) &&
              !empty($_GET['email']) &&
              !empty($_GET['tel']) &&
              !empty($_GET['document_cin']) &&
              !empty($_GET['titre_poste']) &&
              !empty($_GET['salaire']) &&
              !empty($_GET['type_contrat']) &&
              !empty($_GET['rib']) &&
              !empty($_GET['imagee'])
          ) {
  
              $perso = new personnel(
                null,
                $_GET['cin'],
                $_GET['nom'],
                $_GET['prenom'],
                $_GET['datee'],
                $_GET['adresse'],
                $_GET['email'],
                $_GET['tel'],
                $_GET['document_cin'],
                $_GET['titre_poste'],
                $_GET['salaire'],
                $_GET['type_contrat'],
                $_GET['rib'],
                $_GET['imagee']
              );
  
              $persos->ModifierPerso($perso,$_GET['id']);
  
              header('Location: index.php');
              echo '<script>alert("Ajouté avec succées !");</script>';

              echo 'yes';
          } else {
              $error = "Missing information brooo";
              echo $error;
              header('Location: update.php');

          }
      }
  }
  

?>
<!DOCTYPE html>
<html>
<head>
  <title>ClickErp</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-wu6aXjILOvI2XuMpk5S3Iyxf6AZTF5/jMBbHEfDo1mUQDdNzcRGtRqZnBY1CwvHTg6vEDLc78/QIENp2AfsszA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="icon" href="photos/logo.ico">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


</head>
<body>
<!-----------------------------------------------------navbar elements--------------------------------------------------->

<div class="navbar1">
    <img src="photos/navbar_one.png" alt="navbar_one Image">
    <div class="search">  
        <input type="text" placeholder="Search..">
          <i class="material-icons">search</i>
      </div>
</div>


<div class="navbar2">
    <img src="photos/shadow.png" alt="navbar_two Image">
   
</div>
<div class="navbar22">
    <img src="photos/Groupe2.png" alt="navbar22 Image">
</div>

<!--------------------------------------------------Sidebar elements---------------------------------------------------->
<div class="sidebar">
    <img src="photos/sidebar.png" alt="Sidebar Image">
    
<div class="dashboard">
    <a href="#"><img src="photos/dashboard.png" alt="dashboard Image"></a>
</div>
<div class="manager">
    <a href="#"><img src="photos/manager.png" alt="manager Image"></a>
</div>
<div class="labo">
    <a href="#"><img src="photos/labo.png" alt="labo Image"></a>
</div>
<div class="sections">
    <a href="#"><img src="photos/sections.png" alt="section Image"></a>
</div>
<div class="calendrier">
    <a href="#"><img src="photos/calendrier.png" alt="calendrier Image"></a>
</div>
<div class="tache">
    <a href="#"><img src="photos/tache.png" alt="tache Image"></a>
</div>
<div class="reporting">
    <a href="#"><img src="photos/reporting.png" alt="reporting Image"></a>
</div>
<div class="notes">
    <a href="#"><img src="photos/notes.png" alt="notes Image"></a>
</div>
<div class="msg">
    <a href="#"><img src="photos/message.png" alt="msg Image"></a>
</div>
<div class="profil">
    <a href="#"><img src="photos/profil.png" alt="profil Image"></a>
</div>
</div>
<div class="camera">
    <img src="photos/camera.png" alt="camera image">
</div>

<div class="content">
  
    <div class="circle2" onclick="toggleList()">
    <img src="photos/fleche.png">
      </div>
      <ul class="choice-list" id="choices">
        <button onclick="selectOption('pdf')">PDF</button>
        <button onclick="selectOption('excel')">Excel</button>
        <button onclick="selectOption('csv')">CSV</button>
      </ul>
</div>
    <!--------------------------------------FORMULAIRE-------------------------------------------->
    <?php
                            if (isset($_GET['id'])){
                                $perso = $persoCRUD->RecupererPerso($_GET['id']);
                            }
                            ?>
    <form method="get" onsubmit="return CTRL()">
    <div class="form1">
        <img src="photos/form.png" alt="form1 image">
    </div>
    <div class="part1">
          <label for="prenom">Prénom<span class="required">*</span></label> <span id="error_prenom" style="color: red; font-size: 10pt;font-family: 'Acumin Variable Concept', Arial, sans-serif;" ></span><br>
          <input type="text" id="prenom" name="prenom" style="height: 30px;" value="<?php echo $perso['prenom']; ?>"><br><br><br>
          <label for="nom">Nom<span class="required">*</span></label> <span id="error_nom" style="color: red; font-size: 10pt;font-family: 'Acumin Variable Concept', Arial, sans-serif;"></span><br>
          <input type="text" id="nom" name="nom" style="height: 30px;" value="<?php echo $perso['nom']; ?>"><br><br><br>
          <label for="date">Date de naissance<span class="required">*</span></label> <span id="error_date" style="color: red; font-size: 10pt;font-family: 'Acumin Variable Concept', Arial, sans-serif;"></span><br>
          <input type="date" id="datee" name="datee" style="height: 35px;" value="<?php echo $perso['datee']; ?>" ><br><br><br>
          <label for="adresse">Adresse<span class="required">*</span></label> <span id="error_adresse" style="color: red; font-size: 10pt;font-family: 'Acumin Variable Concept', Arial, sans-serif;"></span><br>
          <input type="text" id="adresse" name="adresse" style="height: 30px;" value="<?php echo $perso['adresse']; ?>">
    </div>
    <div class="part2">
        <label for="cin">CIN<span class="required">*</span></label> <span id="error_cin" style="color: red; font-size: 10pt;font-family: 'Acumin Variable Concept', Arial, sans-serif;"></span><br>
        <input type="text" id="cin" name="cin" style="height: 30px;" value="<?php echo $perso['cin']; ?>"><br><br><br>
        <label for="email">E-mail<span class="required">*</span></label> <span id="error_email" style="color: red; font-size: 10pt;font-family: 'Acumin Variable Concept', Arial, sans-serif;"></span><br>
        <input type="text" id="email" name="email" style="height: 30px;" value="<?php echo $perso['email']; ?>"><br><br><br>
        <label for="tel">Tel<span class="required">*</span></label> <span id="error_tel" style="color: red; font-size: 10pt;font-family: 'Acumin Variable Concept', Arial, sans-serif;"></span><br>
        <input type="tel" id="tel" name="tel" style="height: 30px;" value="<?php echo $perso['tel']; ?>"><br><br><br>
        <label for="document">Document CIN<span class="required">*</span></label> <span id="error_document" style="color: red; font-size: 10pt;font-family: 'Acumin Variable Concept', Arial, sans-serif;"></span><br>
        <input type="file" id="document_cin" name="document_cin" style="height: 35px;" accept=".pdf, .jpg, .jpeg, .png">
    </div>

    <div class="part3">
        <label for="myfile">
          <div class="circleWrapper">
             <img id="circleImage" src="http://via.placeholder.com/200x200" />
          </div>
        </label>
        <input type="file" id="imagee" name="imagee" style="display:none" accept=".png, .jpg"/>
    </div>

    <div class="part4">
        <label for="poste">Titre du poste<span class="required">*</span></label> <span id="error_poste" style="color: red; font-size: 10pt;font-family: 'Acumin Variable Concept', Arial, sans-serif;"></span><br>
        <input type="text" id="titre_poste" name="titre_poste" style="height: 30px;" value="<?php echo $perso['titre_poste']; ?>"><br><br><br>
        <label for="contrat">Type du contrat<span class="required">*</span></label> <span id="error_contrat" style="color: red; font-size: 10pt;font-family: 'Acumin Variable Concept', Arial, sans-serif;"></span><br>
        <input type="text" id="type_contrat" name="type_contrat" style="height: 30px;" value="<?php echo $perso['type_contrat']; ?>">
    </div>

    <div class="part5">
        <label for="salaire">Salaire (DT)<span class="required">*</span></label> <span id="error_salaire" style="color: red; font-size: 10pt;font-family: 'Acumin Variable Concept', Arial, sans-serif;"></span><br>
        <input type="number" id="salaire" name="salaire" style="height: 30px;" value="<?php echo $perso['salaire']; ?>"><br><br><br>
        <label for="rib">RIB<span class="required">*</span></label> <span id="error_rib" style="color: red; font-size: 10pt;font-family: 'Acumin Variable Concept', Arial, sans-serif;"></span><br>
        <input type="text" id="rib" name="rib" style="height: 30px;" value="<?php echo $perso['rib']; ?>">
    </div>
        <button type="submit" name="modifier">Valider</button>
        <input type="hidden" name="id" value="<?php echo $perso['id']; ?>" >

    </form>
    
    <div class="part6">
       <img src="photos/table.png" alt="part6 image">
       <div class="search2">  
        <input type="text" placeholder="Recherche..">
          <i class="material-icons">search</i>
      </div>
    </div>
    <div class="part7">
        <img src="photos/th.png" alt="part7 image">
     </div>
     <div class="part10">
     <img src="photos/search2.png" >

     </div>
    <form >
        <div class="date1">
            <input type="date" id="date1" name="date1" style="height: 35px;" ><br><br><br>
        </div>
        <div class="date2">
            <input type="date" id="date1" name="date1" style="height: 35px;" ><br><br><br>
        </div>
        <div class="poste1">
            <input type="text" id="poste1" name="poste1" placeholder="poste" style="height: 33px;"><br><br><br>
        </div>
        <div class="filtrer">
        <button type="submit" name="filtre">Filtrer</button>
        </div>
    </form>
    <div class="table-container">
        <table> 
          <thead>
            <tr>
              <th>CIN</th>
              <th>NOM</th>
              <th>E-MAIL</th>
              <th>TEL</th>
              <th>UPDATE</th>
              <th>DELETE</th>
            </tr>
          </thead>
          <tbody id="table-body">
      <?php foreach ($listeperso as $index => $perso) : ?>
        <tr <?php if ($index >= 4) echo 'style="display: none;"'; ?>>
          <td><?php echo $perso['cin']; ?></td>
          <td><?php echo $perso['nom']; ?></td>
          <td><?php echo $perso['email']; ?></td>
          <td><?php echo $perso['tel']; ?></td>
          <td><i class="fas fa-edit"></i></td>
<td><a href="Delete.php?id=<?php echo $perso['id']; ?>"><i class="fas fa-trash-alt"></i></a></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
        </table>
 
        <div class="rei">
        <button type="submit">Réinitialiser</button>
        <img src="photos/load.png" >
        </div>
      
</div>
<div class="compte">
  <img src="photos/compte.png">
  <div class="sep"> 
  <img src="photos/separate.png">
  </div>
  <div class="triangle">
    <button type="submit">▼</button>
  </div>
  <div class="msg1">
    <img src="photos/msg.png">
    <button type="submit"></button>
  </div>
  <div class="notif">
    <img src="photos/notifi.png">
    <button type="submit"></button>
  </div>
  </div>
  <div class="pagination">
    <button type="submit" id="next-btn"></button>
    <button type="submit" id="prev-btn"></button>
    <img src="photos/nxt.png">
      </div>


</body>

<script>
  const prevBtn = document.getElementById('prev-btn');
  const nextBtn = document.getElementById('next-btn');
  const tableBody = document.getElementById('table-body');
  const rows = tableBody.querySelectorAll('tr');
  const itemsPerPage = 4;
  let currentPage = 1;
  const totalPages = Math.ceil(rows.length / itemsPerPage);

  function showPage(page) {
    const startIndex = (page - 1) * itemsPerPage;
    const endIndex = startIndex + itemsPerPage;

    for (let i = 0; i < rows.length; i++) {
      if (i >= startIndex && i < endIndex) {
        rows[i].style.display = 'table-row';
      } else {
        rows[i].style.display = 'none';
      }
    }

    // Gestion de l'état des boutons
    prevBtn.disabled = page === 1;
    nextBtn.disabled = page === totalPages;
  }

  function showNextPage() {
    currentPage++;
    showPage(currentPage);
  }

  function showPrevPage() {
    currentPage--;
    showPage(currentPage);
  }

  nextBtn.addEventListener('click', showNextPage);
  prevBtn.addEventListener('click', showPrevPage);

  // Afficher la première page par défaut
  showPage(currentPage);
</script>

<!----------------------------------------------image click--------------------------------------------------------->
<script>
    document.addEventListener('DOMContentLoaded', function() {
      const circleImage = document.querySelector('#circleImage');
      const fileInput = document.querySelector('#imagee');
  
      circleImage.addEventListener('click', function() {
        event.stopPropagation(); // Empêche la propagation de l'événement "click"
        fileInput.click();
        
      });
  
      fileInput.addEventListener('change', function() {
        const file = fileInput.files[0];
        if (file) {
          const reader = new FileReader();
          reader.onload = function(e) {
            circleImage.src = e.target.result;
          };
          reader.readAsDataURL(file);
        }
      });
    });
  </script>
 
  <!------------------------------------table list choices generate---------------------------------------->
<script>
    function toggleList() {
      var choices = document.getElementById('choices');
      choices.classList.toggle('visible');
    }
    function selectOption(option) {
    console.log("Option sélectionnée :", option);
    // Ajoutez le code ici pour effectuer l'action souhaitée en fonction de l'option sélectionnée
  }
  </script>
  <!----------------------------------------controle de saisie------------------------------------------------>

</html>
