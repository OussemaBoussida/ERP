<?php

    include_once '../../model/perso.php';
	  include_once '../../controller/persoCRUD.php';
	//affichage 
	$persoCRUD = new persoCRUD();
	$listeperso=$persoCRUD->AfficherPerso(); 
  //ajout
  $error = "";

  $perso = null;
  
  $persos = new persoCRUD();
  
  if (isset($_GET['ajout'])) { // Utilisez $_GET au lieu de $_POST
  
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
  
              $persos->AjouterPerso($perso);
  
              header('Location: index.php');
              echo '<script>alert("Ajouté avec succées !");</script>';

              echo 'yes';
          } else {
              $error = "Missing information brooo";
              echo $error;
              header('Location: index.php');

          }
      }
    
    
  }

    //recherche par titre du poste

    if (!empty($_GET['poste1'])) {
      $listeperso = $persoCRUD->RechercherPoste($_GET['poste1']);
    }
    else 
    {
      $error = "Missing information";
    }


  //reinistialiser

  if (isset($_GET['rei'])) {
    $listeperso=$persoCRUD->AfficherPerso(); 
  } else 
  {
    $error = "Missing information";
  }

  //filtrage selon date de naissance

  if (isset($_GET['filtre'])) {
  $listeperso = $persoCRUD->RechercherDates($_GET['date1'], $_GET['date2']);
  }
  else 
  {
  $error = "Missing information";
  }


  //chercher un personnel selon le nom

  if (!empty($_POST['search2'])) {
  $listeperso = $persoCRUD->Rechercher($_POST['search2']);
  }
  else
  {
  $error = "Missing information";
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
        <!--------------------------Exportation pdf------------------------------->
        <form method="get" action="pdf.php">
        <button onclick="selectOption('pdf')" name="pdf">PDF</button>
        </form>
        <!--------------------------Exportation excel------------------------------->
        <form method="get" action="excel.php">
        <button onclick="selectOption('excel')" name="excel">Excel</button>
        </form>
        <!--------------------------Exportation csv------------------------------->
        <form method="get" action="csvv.php">
        <button onclick="selectOption('csv')" name="csvv">CSV</button>
        </form>
      </ul>
</div>
    <!--------------------------------------FORMULAIRE-------------------------------------------->
    <form method="get" enctype="multipart/form-data" onsubmit="return CTRL()">
    <div class="form1">
        <img src="photos/form.png" alt="form1 image">
    </div>
    <div class="part1">
          <label for="prenom">Prénom<span class="required">*</span></label> <span id="error_prenom" style="color: red; font-size: 10pt;font-family: 'Acumin Variable Concept', Arial, sans-serif;"></span><br>
          <input type="text" id="prenom" name="prenom" style="height: 30px;"><br><br><br>
          <label for="nom">Nom<span class="required">*</span></label> <span id="error_nom" style="color: red; font-size: 10pt;font-family: 'Acumin Variable Concept', Arial, sans-serif;"></span><br>
          <input type="text" id="nom" name="nom" style="height: 30px;"><br><br><br>
          <label for="date">Date de naissance<span class="required">*</span></label> <span id="error_date" style="color: red; font-size: 10pt;font-family: 'Acumin Variable Concept', Arial, sans-serif;"></span><br>
          <input type="date" id="datee" name="datee" style="height: 35px;" ><br><br><br>
          <label for="adresse">Adresse<span class="required">*</span></label> <span id="error_adresse" style="color: red; font-size: 10pt;font-family: 'Acumin Variable Concept', Arial, sans-serif;"></span><br>
          <input type="text" id="adresse" name="adresse" style="height: 30px;">
    </div>
    <div class="part2">
        <label for="cin">CIN<span class="required">*</span></label> <span id="error_cin" style="color: red; font-size: 10pt;font-family: 'Acumin Variable Concept', Arial, sans-serif;"></span><br>
        <input type="text" id="cin" name="cin" style="height: 30px;"><br><br><br>
        <label for="email">E-mail<span class="required">*</span></label> <span id="error_email" style="color: red; font-size: 10pt;font-family: 'Acumin Variable Concept', Arial, sans-serif;"></span><br>
        <input type="text" id="email" name="email" style="height: 30px;"><br><br><br>
        <label for="tel">Tel<span class="required">*</span></label> <span id="error_tel" style="color: red; font-size: 10pt;font-family: 'Acumin Variable Concept', Arial, sans-serif;"></span><br>
        <input type="tel" id="tel" name="tel" style="height: 30px;"><br><br><br>
        <label for="document">Document CIN<span class="required">*</span></label> <span id="error_document" style="color: red; font-size: 10pt;font-family: 'Acumin Variable Concept', Arial, sans-serif;"></span><br>
        <input type="file" id="document_cin" name="document_cin" style="height: 35px;" accept=".pdf, .jpg, .jpeg, .png" >
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
        <input type="text" id="titre_poste" name="titre_poste" style="height: 30px;"><br><br><br>
        <label for="contrat">Type du contrat<span class="required">*</span></label> <span id="error_contrat" style="color: red; font-size: 10pt;font-family: 'Acumin Variable Concept', Arial, sans-serif;"></span><br>
        <input type="text" id="type_contrat" name="type_contrat" style="height: 30px;">
    </div>

    <div class="part5">
        <label for="salaire">Salaire (DT)<span class="required">*</span></label> <span id="error_salaire" style="color: red; font-size: 10pt;font-family: 'Acumin Variable Concept', Arial, sans-serif;"></span><br>
        <input type="number" id="salaire" name="salaire" style="height: 30px;"><br><br><br>
        <label for="rib">RIB<span class="required">*</span></label> <span id="error_rib" style="color: red; font-size: 10pt;font-family: 'Acumin Variable Concept', Arial, sans-serif;"></span><br>
        <input type="text" id="rib" name="rib" style="height: 30px;">
    </div>
        <button type="submit" name="ajout">Valider</button>
    </form>
    <form method="post">
    <div class="part6">
       <img src="photos/table.png" alt="part6 image">
       <div class="search2">  
        <input type="text" name="search2" placeholder="Recherche..">
          <i class="material-icons">search</i>
      </div>
    </div>
</form>
</div>
    <div class="part7">
        <img src="photos/th.png" alt="part7 image">
     </div>
     <div class="part10">
     <img src="photos/search2.png" >

     </div>
    <form method="get">
        <div class="date1">
            <input type="date" id="date1" name="date1" style="height: 35px;" ><br><br><br>
        </div>
        <div class="date2">
            <input type="date" id="date2" name="date2" style="height: 35px;" ><br><br><br>
        </div>
       
        <div class="filtrer">
            <button type="submit" name="filtre"><img src="photos/filtre.png"></button>
        </div>
    </form>
    <form method="get">
    <div class="poste1">
            <input type="text" id="poste1" name="poste1" placeholder="poste" style="height: 33px;"><br><br><br>
    </div>
</form>
    <div class="table-container">
        <table> 
          <thead>
            <tr>
              <th>CIN</th>
              <th>NOM</th>
              <th>E-MAIL</th>
              <th>POSTE</th>
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
          <td><?php echo $perso['titre_poste']; ?></td>
          <td>
          <form method="GET" action="update.php">
          <input type="hidden" value=<?php echo $perso['id']; ?> name="id">
          <a  href="update.php?id=<?php echo $perso['id']; ?>"><i class="fas fa-edit"></i></a>
            </form>
          </td>
          <td>
           <a href="Delete.php?id=<?php echo $perso['id']; ?>"><i class="fas fa-trash-alt"></i></a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
        </table>
<form method="get">
        <div class="rei">
        <button type="submit" name="rei">Réinitialiser</button>
        <img src="photos/load.png" >
        </div>
      </form>
      
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
<!--------------------------------affichage tableau------------------------------------------------------->
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
  <script>
     function CTRL()
                                {
                                    //charger les variables avec les inputs que je vais saisir 
                                    var prenom=document.getElementById("prenom").value;
                                    var nom=document.getElementById("nom").value;
                                    var date=document.getElementById("datee").value;
                                    var adresse=document.getElementById("adresse").value;
                                    var cin=document.getElementById("cin").value;
                                    var email=document.getElementById("email").value;
                                    var tel=document.getElementById("tel").value;
                                    var poste=document.getElementById("titre_poste").value;
                                    var contrat=document.getElementById("type_contrat").value;
                                    var salaire=document.getElementById("salaire").value;
                                    var rib=document.getElementById("rib").value;
                                    //variable error 
                                    var error_prenom = document.getElementById("error_prenom");
                                    var error_nom = document.getElementById("error_nom");
                                    var error_date = document.getElementById("error_date");
                                    var error_adresse = document.getElementById("error_adresse");
                                    var error_cin = document.getElementById("error_cin");
                                    var error_email=document.getElementById("error_email");
                                    var error_tel=document.getElementById("error_tel");
                                    var error_poste=document.getElementById("error_poste");
                                    var error_contrat=document.getElementById("error_contrat");
                                    var error_salaire=document.getElementById("error_salaire");
                                    var error_rib=document.getElementById("error_rib");
                                    //verifier si les champs sont vides + autre fonctionnalitees

                                    //prenom
                                    if(prenom=="")
                                    {
                                        error_prenom.innerHTML="Champ obligatoire !";  
                                    }
                                    else 

                                        if(prenom.charAt(0)>="a" && prenom.charAt(0)<="z")
                                        {
                                            error_prenom.innerHTML="Commence par lettre majuscule !";  
                                        }
                                        else
                                        {
                                            error_prenom.innerHTML="";  
                                        }
                                        //nom
                                        if(nom=="")
                                    {
                                        error_nom.innerHTML="Champ obligatoire !";  
                                    }
                                    else 
                                        if(nom.charAt(0)>="a" && nom.charAt(0)<="z")
                                        {
                                            error_nom.innerHTML="Commence par lettre majuscule !";  
                                        }
                                        else
                                        {
                                            error_nom.innerHTML="";  
                                        }

                                      //date
                                        if(date=="")
                                    {
                                        error_date.innerHTML="Champ obligatoire !";  
                                    }
                                    else
                                        {
                                            error_date.innerHTML="";  
                                        }
                                      //adresse
                                      if(adresse=="")
                                    {
                                        error_adresse.innerHTML="Champ obligatoire !";  
                                    }
                                    else
                                        {
                                            error_adresse.innerHTML="";  
                                        }
                                        //cin
                                       if(cin=="")
                                      {
                                        error_cin.innerHTML="Champ obligatoire !";  
                                      }
                                       else
                                        {
                                            error_cin.innerHTML="";  
                                        }
                                        //email
                                        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                                        if (email === "") {
                                        error_email.innerHTML = "Champ obligatoire !";
                                        } else if (!emailPattern.test(email)) {
                                        error_email.innerHTML = "Adresse e-mail invalide !";
                                       } else {
                                        error_email.innerHTML = "";
                                        }
                                        //tel
                                        var telPattern = /^\d{8}$/;
                                       if (tel === "") {
                                       error_tel.innerHTML = "Champ obligatoire !";
                                       } 
                                       else if (!telPattern.test(tel)) {
                                       error_tel.innerHTML = "Numéro de téléphone invalide !";
                                       } 
                                       else {
                                        error_tel.innerHTML = "";
                                       }

                                       
                                       //poste
                                       if(poste=="")
                                       {
                                        error_poste.innerHTML="Champ obligatoire !";  
                                       }
                                       else
                                        {
                                            error_poste.innerHTML="";  
                                        }

                                       //contrat
                                       if(contrat=="")
                                       {
                                        error_contrat.innerHTML="Champ obligatoire !";  
                                       }
                                       else
                                        {
                                            error_contrat.innerHTML="";  
                                        }

                                        //salaire
                                       if(salaire=="")
                                       {
                                        error_salaire.innerHTML="Champ obligatoire !";  
                                        }
                                       else
                                        {
                                            error_salaire.innerHTML="";  
                                        }

                                       //rib
                                      if(rib=="")
                                       {
                                        error_rib.innerHTML="Champ obligatoire !";  
                                       }
                                       else
                                        {
                                         error_rib.innerHTML="";  
                                        }
                                        if (
        error_prenom.innerHTML !== "" &&
        error_nom.innerHTML !== "" &&
        error_date.innerHTML !== "" &&
        error_adresse.innerHTML !== "" &&
        error_cin.innerHTML !== "" &&
        error_email.innerHTML !== "" &&
        error_tel.innerHTML !== "" &&
        error_poste.innerHTML !== "" &&
        error_contrat.innerHTML !== "" &&
        error_salaire.innerHTML !== "" &&
        error_rib.innerHTML !== ""
      ) {
        return false;
      }
 }
  </script>
</html>
