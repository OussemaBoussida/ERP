<?php

include_once '../../Model/perso.php';
include_once '../../Controller/persoCRUD.php';

require_once('fpdf/fpdf.php');

$db = new PDO('mysql:host=localhost;dbname=erp','root','');

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

   class PDF extends FPDF{

    function header(){
        $this->SetFont('Arial','B',24);
        $this->Cell(0,10,'Liste des personnels',0,0,'C');
        $this->Ln();
        $this->SetFont('Times','',20);
        $this->Cell(0,10,'ClickErp',0,0,'C');
        $this->Ln(20);
    }

    function footer(){
        $this->SetY(-15);
        $this->SetFont('Arial','',8);
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }

    function headerTable(){
        $this->SetFont('Times','B',12);
        $this->Cell(20,10,'cin',1,0,'C');
        $this->Cell(30,10,'nom',1,0,'C');
        $this->Cell(40,10,'prenom',1,0,'C');
        $this->Cell(70,10,'gmail',1,0,'C');
        $this->Cell(30,10,'poste',1,0,'C');
        $this->Ln();
    }

    function viewTable($db){
        $this->SetFont('Times','',10);
        $liste = $db->query('SELECT * FROM personnel');
        while($data = $liste->fetch(PDO::FETCH_OBJ)){
            $this->Cell(20,10,$data->cin,1,0,'C');
            $this->Cell(30,10,$data->nom,1,0,'C');
            $this->Cell(40,10,$data->prenom,1,0,'C');
            $this->Cell(70,10,$data->email,1,0,'C');
            $this->Cell(30,10,$data->titre_poste,1,0,'C');
            $this->Ln();
        }
    }

   }

  
   // Instantiation of FPDF class
   $pdf = new PDF();
  
   $pdf->AliasNbPages();
   $pdf->AddPage();
   $pdf->headerTable();
   $pdf->viewTable($db);
   $pdf->Output("ClickErp.pdf","D");

?>

